<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\Traits\ProfileImage;
use App\ConsumerDetail;
use App\PaymentDetail;
use App\ProductFavourite;
use App\TransportLocation;
use App\Product;
use App\Order;
use Auth;
use DB;

class HomeController extends Controller
{
    use ProfileImage;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $consumerDetail = ConsumerDetail::where('userId', Auth::user()->id)->first();
        $paymentDetail = PaymentDetail::where('userId', Auth::user()->id)->first();
        $productsReviews = DB::table('product_reviews_comments')
                        ->join('products', 'product_reviews_comments.productId', '=','products.id')
                        ->select('product_reviews_comments.*','products.productName')
                        ->where('product_reviews_comments.userId', Auth::user()->id)
                        ->orderBy('product_reviews_comments.id', 'desc')
                        ->paginate(4);
        $purchasedProducts = Product::orderBy('id', 'desc')->paginate(15);
        $ordersInfo = Order::where('consumerId', Auth::User()->id)->paginate(25);
        $totalProduct = Order::where('consumerId', Auth::User()->id)->sum('totalProduct');
        $totalAmmount = Order::where('consumerId', Auth::User()->id)->sum('totalAmmount');
        $totalLikes = ProductFavourite::where('userId', Auth::User()->id)->get();
        return view('frontEnd.consumer.homeContent', ['consumerDetail'=>$consumerDetail,
            'paymentDetail'=>$paymentDetail, 'productsReviews'=>$productsReviews, 'purchasedProducts'=>$purchasedProducts,
            'ordersInfo'=>$ordersInfo, 'totalLikes'=>$totalLikes,'totalProduct'=>$totalProduct, 'totalAmmount'=>$totalAmmount]);
        
    }

    public function detailsEditFrom()
    {   $allDiv =TransportLocation::whereNull('divisionId')->whereNull('districtId')->select('id','areaName')->get();
        $divisions = array_values(array_sort($allDiv, function ($value) {
            return $value['areaName'];
        }));
        $consumerDetails = ConsumerDetail::where('userId', Auth::user()->id)->first();
        return view('frontEnd.consumer.editConsumerDetailsContent', ['divisions'=>$divisions,'consumerDetails'=>$consumerDetails]);
    }
    
    public function profileImageChnage()
    {   
        return view('frontEnd.consumer.profileImageChange');
    }
    
    public function profileImageUpdate(Request $request)
    {   
        
        $report = Validator::make($request->all(),[
            'avater' => 'required|image|mimes:jpeg,png',
        ]);
        
        if($report->passes()){
            $oldImage = User::where('id', Auth::User()->id)->value('avater');
            $imagesInfo= $request->file('avater');
            $imageUrl = $this->userProfileImageUplodeAndResize($imagesInfo);
            User::where('id', Auth::User()->id)->update(['avater'=>$imageUrl]);
            
            if(strpos($oldImage, 'public/images') !== false  && file_exists($oldImage)){
                
                unlink($oldImage);
            } 
            return redirect()->route('user.home')->with('success', 'Your Profile Image Change Successfully !');
        }
        return redirect()->back()->withErrors($report)->withInput();
    }

    public function detailsCreateOrUpdate(Request $request)
    {   
        $consumerId = ConsumerDetail::where('userId', $request->userId)->value('id');
        
        if ($consumerId) {
            $details = ConsumerDetail::find($consumerId);
        } else {
            $details = New ConsumerDetail;
            $details->userId= $request->userId;
        }
        
        
        if($request->nationalId)
            $details->nationalId= $request->nationalId;        
        if($request->houseNo)
            $details->houseNo= $request->houseNo;        
        if($request->roadNo)
            $details->roadNo= $request->roadNo;  
        if($request->block)
            $details->block= $request->block;  
        if($request->areaName)
            $details->areaName= $request->areaName;        
        if($request->zipCode)
            $details->zipCode= $request->zipCode;        
        if($request->areaId)
            $details->areaId= $request->areaId;
        if($request->districtId)
            $details->districtId= $request->districtId;
        if($request->divisionId)
            $details->divisionId= $request->divisionId;
                       

        $details->save();

        return redirect()->route('user.home')->with('success','Your Details Information Update  Successfully');
    }



    
}
