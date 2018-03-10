<?php

namespace App\Http\Controllers;

use App\ProductTransport;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\ConsumerDetail;
use App\ShippingDetail;
use App\PaymentDetail;
use App\ProductImage;
use App\OrderDetail;
use App\Product;
use App\Order;
use App\logo;
use App\User;
use App\ProductQuentity;
Use App\TransportLocation;
use Carbon\Carbon;
Use Session;
use Cart;
use Auth;
use Mail;
use DB;
use App\Mail\OrderInvoice;
use App\Library\SSLCommerz\SSLCommerz;
use App\InternetPayment;

class ShoppingController extends Controller
{
    public function addToCart(Request $request)
    {

        if($request->ajax() && isset($request->productId)){

            $productId = $request->productId;
            $productById = Product::where('id', $productId)->select('productName','finalPrice')->first();

            Cart::add([
                'id'=>$productId,
                'name'=>$productById->productName,
                'price'=>$productById->finalPrice,
                'qty'=>1,
            ]);
            $cartProducts = Cart::content();
            return view('frontEnd.shopping.cartShortView', ['cartProducts'=>$cartProducts]);
        }else{



            $validation=Validator::make($request->all(), [
//                'size' => 'required',
                'qty' => 'required|numeric',
            ]);

            if($validation->passes()){

                $qty =ProductQuentity::where('productId',$request->productId)->where('sizeId',$request->size )->value('quantity');



                if($request->qty <= $qty){
                    $newStock = $qty - $request->qty;

                    ProductQuentity::where('productId',$request->productId)->where('sizeId',$request->size )->update(['quantity'=>$newStock]);

                    $productId = $request->productId;
                    $productById = Product::where('id', $productId)->select('productName','finalPrice')->first();

                    $cart = Cart::add([
                        'id'=>$productId,
                        'name'=>$productById->productName,
                        'qty'=>$request->qty,
                        'price'=>$productById->finalPrice,
                    ]);

                    $cartCrit = [
                        'productId'=>$cart->id,
                        'size'=>$request->size,
                        'color'=>$request->color,
                    ];

                    Session::put($cart->rowId, $cartCrit);

                    return redirect()->route('cart.show');
                }
                Session::flash('warning', $request->qty.'of Product is not Available Right Now..!');
                return redirect()->back();
            }

            return redirect()->back()->withErrors($validation);
        }

    }

    public function cartShow()
    {
        if(count(Cart::content()) == 0|| empty(Cart::content())){
            Session::flash('warning','Cart is Empty. Pleass Add Item First');
            return redirect()->route('index');
        }

        $cartProducts = Cart::content();
        return view('frontEnd.shopping.cartContent', ['cartProducts'=>$cartProducts]);
    }

    public function cartUpdate(Request $request)
    {
        $cartProduct = Cart::get($request->rowId);
        $proCri = Session::get($request->rowId);

        $newQty = $cartProduct->qty - $request->qty;
        //find product qty info and add cart qty and product exist qty and update
        $productQty = ProductQuentity::where('productId',$cartProduct->id)->where('sizeId',$proCri['size'])->first();
        $qty = $productQty->quantity + $newQty;
        $productQty->quantity = $qty;
        $productQty->save();

        $update =  Cart::update($request->rowId, $request->qty);
        return response()->json($update);
    }

    public function deleteCartProduct($rowId) {

        //retrive cart product and session data where $rowId exist
        $cartProduct = Cart::get($rowId);
        $proCri = Session::get($rowId);


        //find product qty info and add cart qty and product exist qty and update
        $productQty = ProductQuentity::where('productId',$cartProduct->id)->where('sizeId',$proCri['size'])->first();
        $newQty = $productQty->quantity + $cartProduct->qty;
        $productQty->quantity = $newQty;
        $productQty->save();

        //remove cart product and session data
        Cart::remove($rowId);
        Session::forget($rowId);
        if(count(Cart::content()) == 0|| empty(Cart::content())){
            return redirect()->route('index');
        }
        return redirect()->route('cart.show');
    }


    public function checkout()
    {
        if (count(Cart::content()) == 0) {

            return redirect()->back()->with('emptyMsg', 'Cart is Empty. Pleass Add Item First');
        }
        $cartProducts = Cart::content();
        return view('frontEnd.shopping.checkoutContent', ['cartProducts'=>$cartProducts]);
    }

    public function shippingInfo()
    {
        if (count(Cart::content()) == 0) {

            return redirect()->back()->with('emptyMsg', 'Cart is Empty. Pleases Add Item First');
        }
        $cartProducts = Cart::content();
        $allDiv =TransportLocation::whereNull('divisionId')->whereNull('districtId')->select('id','areaName')->get();
        $divisions = array_values(array_sort($allDiv, function ($value) {
            return $value['areaName'];
        }));

        $detailsInfo = ConsumerDetail::firstOrCreate(['userId'=> Auth::User()->id]);
        return view('frontEnd.shopping.shippingContent', ['cartProducts'=>$cartProducts,'divisions'=>$divisions,'detailsInfo'=>$detailsInfo ]);
    }

    public function payment()
    {
        if(count(Cart::content()) == 0|| empty(Cart::content())){
            Session::flash('warning','Cart is Empty. Pleass Add Item First');
            return redirect()->route('index');
        }

        $cartProducts = Cart::content();
        return view('frontEnd.shopping.@paymentContent',['cartProducts'=>$cartProducts]);
    }

    public function saveShippingInfo(Request $request)
    {

        //Create validation
        $validation=Validator::make($request->all(), [
            'areaName' => 'required|string|min:5|max:25',
            'zipCode' => 'required|numeric',
            'divisionId' => 'required|numeric',
            'districtId' => 'required|numeric',
            'areaId' => 'required|numeric',
        ]);

        if($validation->passes()){
            $shippingInfo = New ShippingDetail;

            $shippingInfo->userId= Auth::User()->id;
            if($request->houseNo)
                $shippingInfo->houseNo= $request->houseNo;
            if($request->roadNo)
                $shippingInfo->roadNo= $request->roadNo;
            if($request->block)
                $shippingInfo->block= $request->block;

            $shippingInfo->areaName= $request->areaName;
            $shippingInfo->zipCode= $request->zipCode;
            $shippingInfo->divisionId= $request->divisionId;
            $shippingInfo->districtId= $request->districtId;
            $shippingInfo->areaId= $request->areaId;

            $shippingInfo->save();


//            Delevary Price Count

            $cartWeight = 0.0;
            $extraWeight = 0.0;
            $deliveryPrice = 0.0;
            //take all cart added product from cart
            $cartProducts = Cart::content();
            //make a foreach loop and count total cart weight
            foreach ($cartProducts as $cartProduct) {
                $productWeight = Product::where('id', $cartProduct->id)->value('productWeight');
                $subWeight =$productWeight*$cartProduct->qty;
                $cartWeight = $cartWeight+$subWeight;
            }

            //put total cart weight in session
            Session::put('cartWeight', $cartWeight);


            //find location where match this areaId
            $areaId = $shippingInfo->areaId;
            $deleviryLoc = ProductTransport::where('transportType', 1)->where('areaIds','LIKE' , '%'.$areaId."%")->pluck('areaIds', 'id')->all();

            ////check one by one area id is this match or not
            $deleviryCri = collect($deleviryLoc)->map( function($areaIds, $key) use ($areaId){

                $sizeIdArray = explode(',', $areaIds);
                if(in_array($areaId, $sizeIdArray)){
                    return ProductTransport::where('id', $key)->select('cartWeight','price')->first();
                }
            })->reject( function($areaIds){
                return is_null($areaIds);

            });

            //check is match area id with data base
            if(!is_null($deleviryCri) && count($deleviryCri) >0 ){

                //continue count price unless cart is Zero
                while ($cartWeight > 0){
                    echo 'Yes'.'<br>';
                    //if cart weight in one kg
                    if($cartWeight > 0.01 && $cartWeight <= 1.1){

                        $price = $this->delivaryPriceCount($deleviryCri, 1);
                        $deliveryPrice = $deliveryPrice + $price;
                        break;

                    }else if($cartWeight > 1.1 && $cartWeight <= 2.1){ //if cart weight brtween  1-2 kg

                        $price = $this->delivaryPriceCount($deleviryCri, 2);
                        $deliveryPrice = $deliveryPrice + $price;
                        break;

                    }else if($cartWeight > 2.1 && $cartWeight <= 5.5){

                        $price = $this->delivaryPriceCount($deleviryCri, 5);//if cart weight between 2 - 5 kg
                        $deliveryPrice = $deliveryPrice + $price;
                        break;

                    }else if($cartWeight > 5.5){ //if cart weight more than 5 kg
                        //  than find how match it more than count step by step
                        $extraWeight = $cartWeight - 5.5;
                        $price = $this->delivaryPriceCount($deleviryCri, 5);
                        $deliveryPrice = $deliveryPrice + $price;

                    }

                    if($extraWeight ==0.0 || $extraWeight < 0.01){
                        break;
                    }else{
                        $cartWeight = $extraWeight;
                    }

                }

            }else{

                while($cartWeight > 0){
                    echo 'Yes'.'<br>';
                    //if cart weight in one kg
                    if($cartWeight > 0.01 && $cartWeight <= 1.1){

                        $price = 120.0;
                        $deliveryPrice = $deliveryPrice + $price;
                        break;
                    }else if($cartWeight > 1.1 && $cartWeight <= 2.1){ //if cart weight brtween  1-2 kg

                        $price = 190.0;
                        $deliveryPrice = $deliveryPrice + $price;
                        break;
                    }else if($cartWeight > 2.1 && $cartWeight <= 5.5){//if cart weight between 2 - 5 kg

                        $price = 400.0;
                        $deliveryPrice = $deliveryPrice + $price;
                        break;

                    }else if($cartWeight > 5.5){ //if cart weight more than 5 kg
                        //  than find how match it more than count step by step
                        $extraWeight = $cartWeight - 5.5;
                        $price = 400.0;
                        $deliveryPrice = $deliveryPrice + $price;
                    }

                    if($extraWeight ==0.0 || $extraWeight < 0.01){
                        break;
                    }else{
                        $cartWeight = $extraWeight;
                    }
                    $deliveryPrice = $deliveryPrice + $price;
                }

            }


//            Delevary Price Count
            Session::put('shippingId', $shippingInfo->id);
            Session::put('deliveryPrice', $deliveryPrice);


            return redirect()->route('payment');
        }


        return redirect()->back()->withErrors($validation)->withInput();
    }

    private function delivaryPriceCount($deleviryCri, $weight){

        $deiveryPrice =  $deleviryCri->map(function($value, $key) use ($weight){

            if($value->cartWeight == $weight){
                return $value->price;
            }
        })->reject(function($value){
            return is_null($value);
        });
        $price = array_first($deiveryPrice, function ($value, $key) {
            return $value;
        });

        return $price;
    }

    public function paymentStore(Request $request)
    {
        $payment_method = strtolower($request->paymentType);
        if($payment_method == 'sslcommerz'){
            $trans_id = uniqid(rand());
            Session::put('trans_id', $trans_id);
            $post_data = array();
            $post_data['total_amount'] = Session::get('totalAmmount');
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = Session::get('trans_id');
            $post_data['success_url'] = url('/shopping/payment-status/success');
            $post_data['fail_url'] = url('/shopping/payment-status/fail');
            $post_data['cancel_url'] = url('/shopping/payment-status/cancel');

            # CUSTOMER INFORMATION
            $userInfo = User::find(Auth::User()->id);
            if(!empty($userInfo)){
                $post_data['cus_name'] = $userInfo->name;
                $post_data['cus_email'] = $userInfo->email;
                $post_data['cus_phone'] = $userInfo->phoneNo;
            }


            # SHIPMENT INFORMATION
            $shipping_id = Session::get('shippingId');
            $shipping_info = ShippingDetail::find($shipping_id);
            if(!empty($shipping_info)){
                $post_data['ship_name'] = $userInfo->name;
                $address = $shipping_info->houseNo.' '.$shipping_info->roadNo.' '.$shipping_info->village.' '.$shipping_info->policeStation.' '.$shipping_info->postOffice.' '.$shipping_info->zipCode.' '.$shipping_info->district;
                $address = trim($address);
                $post_data['ship_add1 '] = $address;
            }
            $sslc = new SSLCommerz();
            $options = $sslc->initiate($post_data, true);
            if(!empty($options['url'])){
                return redirect($options['url']);
            }else{
                return redirect()->back()->with('unsuccess', 'Something Went Wrong. Please Try Again')->withInput( $request->all());
            }
        }else{
            $payment_id = 'cash';
            Session::put('paymentId', $payment_id);
            return redirect()->route('order.store');
        }
        exit;

        $validationReport = $this->paymentValidation( $request );

        if ($validationReport->passes()) {
            //if validation pass Store data
            $exptDate = $request->month.'-'.$request->year;

            $paymentInfo = New PaymentDetail;
            $paymentInfo->userId= Auth::User()->id;
            $paymentInfo->paymentType= $request->paymentType;
            $paymentInfo->cardname= $request->cardname;
            $paymentInfo->cardNumber= $request->cardNumber;
            $paymentInfo->cardHolderName= $request->cardHolderName;
            $paymentInfo->exptDate= $exptDate;
            $paymentInfo->save();

            Session::put('paymentId', $paymentInfo->id);
            return redirect()->route('order.store');
        }
        else{
            //if Validation not pass/fails backe to the page with old data
            //also with error message
            return redirect()->back()
                ->withErrors($validationReport)
                ->withInput( $request->all());
        }
    }

    public function paymentVerify(Request $request, $status){
        if($status == 'success'){
            $sslc = new SSLCommerz();
            $validation = $sslc->orderValidate($request->tran_id, $request->currency_amount, $request->currency_type, $request);
            if($validation == true && ( $request->status=='VALID' || $request->status=='VALIDED')){
                $internetPayment = new InternetPayment;
                $internetPayment->trans_id = $request->tran_id;
                $internetPayment->bank_tran_id = $request->bank_tran_id;
                $internetPayment->amount = $request->amount;
                $internetPayment->save();
                Session::put('paymentId', $internetPayment->id);
                return redirect()->route('order.store');
            }else{
                return redirect()->route('payment')->with('unsuccess', 'Transaction Not Successful');
            }
            exit;
        }elseif($status == 'fail'){
            return redirect()->route('payment')->with('unsuccess', 'Your payment has been failed. Please try again');
        }elseif($status == 'cancel'){
            return redirect()->route('payment')->with('unsuccess', 'Your payment has been cancelled.');
        }else{
            return redirect()->route('payment')->with('unsuccess', 'Something Went Wrong');
        }
    }

    public function storeOrderInfo()
    {
        //store oder short information
        $order = New Order;
        $order->consumerId = Auth::User()->id;
        $order->shippingId = Session::get('shippingId');
        $order->paymentId = Session::get('paymentId');
        $order->totalProduct = Session::get('totalProduct');
        $order->totalAmmount = Session::get('totalAmmount');
        $order->cartWeight = Session::get('cartWeight');
        $order->deliveryPrice = Session::get('deliveryPrice');
        $order->save();

        //get oder table id from $order
        $orderId = $order->id;

        //make a Invoice View Id
        $invoiceId = $this->makeInvoiceId($orderId);
        //update Order Invoice Id
        $invoiceIdInfo = Order::find($orderId);
        $invoiceIdInfo->invoiceId = $invoiceId;
        $invoiceIdInfo->save();
        //store orderable Product details

        //take all cart added product from cart
        $cartProducts = Cart::content();

        //make a foreach loop add store all information

        foreach ($cartProducts as $cartProduct) {
            //get uploderId and uploderType information of cart added product
            $productInfo = Product::where('id', $cartProduct->id)->select('ownerId', 'productWeight')->first();

            //store Order details Information
            $orderDetails = New OrderDetail;
            $orderDetails->consumerId = Auth::User()->id;
            $orderDetails->orderId = $orderId;
            $orderDetails->ownerId = $productInfo->ownerId;
            $orderDetails->productId = $cartProduct->id;
            $orderDetails->productName = $cartProduct->name;
            $orderDetails->productPrice = $cartProduct->price;
            $orderDetails->productQuantity = $cartProduct->qty;
            if(Session::get($cartProduct->rowId)){

                $priCri = Session::get($cartProduct->rowId);
                $orderDetails->sizes = $priCri['size'];
                $orderDetails->priColor = $priCri['color'];
            }

            $orderDetails->subWeight = $productInfo->productWeight*$cartProduct->qty;
            $orderDetails->subTotal = $cartProduct->price*$cartProduct->qty;
            $orderDetails->save();

        }

        //after Store all information destroy card all product for new  order
        Cart::destroy();

        $order = Order::where('id', $orderId)->first();

        $logo = logo::where('publicationStatus',1)->value('logo');
        $userInfo = DB::table('users')
            ->join('consumer_details','users.id','=','consumer_details.userId')
            ->select('users.name','users.email','consumer_details.*')->where('users.id', Auth::User()->id)->first();
        $paymentType = PaymentDetail::where('id', $order->paymentId)->value('paymentType');
        $shippingInfo = ShippingDetail::where('id', $order->shippingId)->first();

        Mail::to(Auth::User()->email)->send(new OrderInvoice($logo,$order,$userInfo,$shippingInfo, $paymentType));


        //return to consumer home
        return redirect()->route('user.home')->with('success', 'Thank You for Your Payment. Your Order has been Successful.');

    }

    private function paymentValidation($request)
    {
        //Create validation
        $validation=Validator::make($request->all(), [
            'paymentType' => 'required',
            'cardname' => 'required',
            'cardNumber' => 'required',
            'cardHolderName' => 'required',
            'month' => 'required|numeric',
            'year' => 'required|numeric',

        ]);

        //return report
        return $validation;
    }
    private function makeInvoiceId($orderId){
        $userStatus = '0'.Auth::User()->userStatus;
        $date = Carbon::now()->format('my');
        $zipCode = ShippingDetail::where('id',Session::get('shippingId'))->value('zipCode');
        $customId = '';
        for ($i = 0; $i<(6-strlen($orderId)); $i++){
            $customId = '0'.$customId;
        }

        return $userStatus.'-'.$date.'-'.$zipCode.'-'.$customId.$orderId;
    }

}
