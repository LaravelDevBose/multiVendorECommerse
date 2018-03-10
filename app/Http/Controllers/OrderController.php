<?php

namespace App\Http\Controllers;

Use App\Mail\ArtisanProductShippedMail;
use Illuminate\Http\Request;
Use App\ShippingDetail;
Use App\PaymentDetail;
Use App\OrderDetails;
Use App\Order;
Use App\User;
use Session;
Use Auth;
Use DB;
Use Mail;

class OrderController extends Controller
{	

	//view All Orders List From artisan
    public function shopViewOrders()
    {   
        $orders = DB::table('order_details')
                    ->join('users', 'order_details.consumerId', '=', 'users.id')
                    ->select('order_details.*','users.name')
                    ->where('order_details.ownerId', Auth::User()->shopId)->latest()->paginate(50);
    	return view('artisan.order.orders',['orders'=>$orders]);
    }



    //view Singel Order Details Information
    //this Function work For Artisan And also for Admin 
    //Singel Order View 

    public function shopSingelOrderView($orderId)
    {   

        

        $orderInfo = Order::where('id', $orderId)->first();
        $paymentDetail = PaymentDetail::where('id', $orderInfo->paymentId)->first();
        $shippingInfo = ShippingDetail::where('id', $orderInfo->shippingId)->first();
        $userInfo = User::where('id', $orderInfo->consumerId)->select('name', 'email','avater','phoneNo')->first();

        $orderProducts = DB::table('products')
                        ->join('order_details', 'products.id', '=', 'order_details.productId')
                        ->where('order_details.orderId', $orderId)
                        ->where('order_details.ownerId', Auth::User()->shopId)
                       ->select('products.productCode', 'order_details.*')
                        ->get();

    	
    	return view('artisan.order.singelOrder',['orderInfo'=>$orderInfo,'userInfo'=>$userInfo, 'shippingInfo'=>$shippingInfo, 'paymentDetail'=>$paymentDetail, 'orderProducts'=>$orderProducts]);
    }

    

    public function shippingOrder($id)
    {   
        //update product Details Satus ase product delevari

        $orderStatus = OrderDetails::find($id);
        $orderStatus->status = 1;
        $orderStatus->save();

        //find all product Details Status
        $orders = OrderDetails::where('orderId',$orderStatus->orderId)->select('status')->get();

        $count=1;
        foreach ($orders as $order) {
            //if product Deliverd the count ++
            if($order->status == 1){
                $count++;
            }
        }

        //cheak all product deleverd or not
        if($count == count($orders)){
            //if all product deleverd than status as all product Deleverd
            Order::where('id',$orderStatus->orderId)->update(['status'=> 1]);
        }

        //Send A Mail To Admin
        Mail::to('admin@dorpon.com')->send( new ArtisanProductShippedMail());

        //Flash a Success message 
        Session::flash('success', 'Order is Successfully Mark As Shipping and Also Inform to Admin !');

        return redirect()->back();
    }


    public function viewOrders()
    {
        $orders = Order::latest()->paginate(50);
        return view('admin.order.orders',['orders'=>$orders]);
    }

    public function singelOrderView($orderId , Request $request)
    {   

        $orderInfo = Order::where('id', $orderId)->first();
        $paymentDetail = PaymentDetail::where('id', $orderInfo->paymentId)->first();
        $shippingInfo = ShippingDetail::where('id', $orderInfo->shippingId)->first();
        $userInfo = User::where('id', $orderInfo->consumerId)->select('name', 'email','avater','phoneNo')->first();

        $orderProducts = DB::table('products')
                        ->join('order_details', 'products.id', '=', 'order_details.productId')
                        ->where('order_details.orderId', $orderId)
                        ->select('products.productCode', 'order_details.*')
                        ->get();



        
        return view('admin.order.singelOrder',['userInfo'=>$userInfo, 'shippingInfo'=>$shippingInfo, 'paymentDetail'=>$paymentDetail, 'orderProducts'=>$orderProducts, 'orderInfo'=>$orderInfo]);
    }

    public function shippingConfirmMail($orderId)
    {   
        //find Where match $orderId
        $order = Order::find($orderId);
        $userInfo = User::where('id', $order->consumerId)->select('id', 'name', 'email')->first();
        $orderDetils = OrderDetails::where('orderId', $orderId)->get();
        $shippingInfo = ShippingDetail::where('id', $order->shippingId)->first();
        $paymentInfo = PaymentDetail::where('id', $order->paymentId)->first();

        //send mail via Mailable Class
        Mail::send(new OrderShipped($order,$userInfo, $orderDetils,$shippingInfo,$paymentInfo));

        //make order staus ase send the mail as 2

        $order->status = 2;
        $order->save();

        //view Success message via Session
        Session::flash('success', 'Shipping Mail was Send Successfully !');

        //return back
        return redirect()->back();
    }

}
