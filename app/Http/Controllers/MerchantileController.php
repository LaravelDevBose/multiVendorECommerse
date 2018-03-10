<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use App\ProductReviewsComment;
use App\Notifications\ShopDeleteRequest;
use Illuminate\Http\Request;
use App\Traits\ProfileImage;
use App\ProductFavourite;
use App\ProductOverview;
use App\ShopFavourite;
use App\ProductImage;
use App\OrderDetail;
use App\Merchantile;
use App\ShopDetails;
use Carbon\Carbon;
use App\Category;
use App\Product;
use App\Admin;
use App\Shop;
use Session;
use Charts;
use Auth;
use DB;
use DateTime;

class MerchantileController extends Controller
{   

    use ProfileImage;

    protected $publishData;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:merchantile');

        Carbon::setWeekStartsAt(Carbon::FRIDAY);
        Carbon::setWeekEndsAt(Carbon::THURSDAY);
        

        
    }

    public function confarmationCheck()
    {   
        

        $shopStatus = Shop::where('id', Auth::User()->shopId)->select('status')->first();
        if($shopStatus->status == 1 ){
            
            Session::put('shopId',Auth::User()->shopId);
            return redirect()->route('merchantile.dashboard');
            
        }elseif ($shopStatus->status == 2) {
            Auth::guard('merchantile')->logout();
            return redirect()->route('index')->with('unsuccess','Your Shop Account Is Blocked. Pleass Contract With Dorpon Athority.');
        }else{
            Auth::guard('merchantile')->logout();
            return redirect()->route('index')->with('unsuccess','Your Shop Account Is not Confirmed. Pleass Confirmed It By Your Email.');
        }

        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    

        $weeklyReport = $this->weeklySellReport();
        $monthlyReport = $this->monthlySellReport();

        $orders = DB::table('order_details')
                    ->join('users', 'order_details.consumerId', '=', 'users.id')
                    ->select('order_details.*','users.name')
                    ->where('order_details.ownerId', Auth::User()->shopId)->paginate(10);

        $topBuyers = OrderDetail::where('ownerId', Auth::User()->shopId)->select('consumerId', DB::raw('count("consumerId") as buyer_count'))->groupBy('consumerId')->orderBy('buyer_count', 'desc')->take(7)->get();

        $topSellProducts = OrderDetail::where('ownerId', Auth::User()->shopId)->select('productId', DB::raw('count("productQuantity") as sellCount'))->groupBy('productId')->orderBy('sellCount', 'desc')->take(7)->get();

        $topSellPriceProducts = OrderDetail::where('ownerId', Auth::User()->shopId)->select('productId', DB::raw('sum(subTotal) as ammount'))->groupBy('productId')->orderBy('ammount', 'desc')->take(7)->get();
        $topRateProducts = $topSellProducts;

        return view('artisan.dassboard.dassboard',['weeklyReport'=>$weeklyReport, 'monthlyReport'=>$monthlyReport,'orders'=>$orders,'topBuyers'=>$topBuyers, 'topSellProducts'=>$topSellProducts, 'topSellPriceProducts'=>$topSellPriceProducts, 'topRateProducts'=>$topRateProducts]);
    }


    private function weeklySellReport(){

        $thisWeek = OrderDetail::where('ownerId', Auth::User()->shopId)
                            ->where('created_at','>=', Carbon::now()->startOfWeek())
                            ->where('created_at','<=' ,Carbon::now()->endOfWeek())
                            ->select('created_at',DB::raw('sum(subTotal) as ammount'))->groupBy('created_at')->get();

        $lastWeek = OrderDetail::where('ownerId', Auth::User()->shopId)
                                ->where('created_at','<=', Carbon::now()->startOfWeek()->subWeek())
                                ->where('created_at','>=' ,Carbon::now()->startOfWeek()->subDay() )
                                ->select('created_at',DB::raw('sum(subTotal) as ammount'))->groupBy('created_at')->get();
        
        
        $chartReport = Charts::multi('line', 'c3')
            ->title(" ")
            ->dimensions(0, 400) // Width x Height
            ->template("material")
            ->responsive(false)
            ->colors(['#2196F3', '#F44336'])
            ->dataset('This Week', $thisWeek->pluck('ammount'))
            ->dataset('Last Week', $lastWeek->pluck('ammount'))
            ->labels(['Sat', 'Sun', 'Mon', 'Tus', 'Wen', 'Tus', 'Fri']);


        return $chartReport;
    }
    private function monthlySellReport()
    {
        $monthlyReports = OrderDetail::where('ownerId', Auth::User()->shopId)
                            ->where('created_at','>=', Carbon::now()->startOfYear())
                            ->where('created_at','<=' ,Carbon::now()->endOfYear())
                            ->select('created_at',DB::raw('sum(subTotal) as ammount'))->groupBy('created_at')->get();
        $data = array();
        $month = array();
        if (!is_null($monthlyReports) || !empty($monthlyReports)){
            $ammount = $monthlyReports->pluck('ammount');
            $k= 0;
            foreach ($monthlyReports as $value) {
                $date = new DateTime($value->created_at);
                $m = date_format($date, 'n');
                $month[$m]= $value->ammount;
            }


            for($i=0; $i<12; $i++){
                $data[$i] = 0;

                if(array_key_exists($i+1, $month)){
                    $data[$i] = $month[$i+1];
                }
            }
        }


        $chartReport = Charts::create('bar', 'highcharts')
            ->title(" ")
            ->dimensions(0, 400) // Width x Height
            ->template("material")
            ->responsive(false)
            ->elementLabel("Total (Tk)")
            ->values($data)
            ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ]);

        
        return $chartReport;
    }

    public function artisanProfileimage(){
        return view('artisan.profile.changeProfileImage');
    }

    public function artisanProfileImageChange(Request $request)
    {

        $report = Validator::make($request->all(), [
                    'avater' => 'required|image|mimes:jpeg,png',
                ]);

        if($report->passes()){
            $imageInfo = $request->file('avater');

            //find old logo url
            $folderName = Shop::where('id', Auth::User()->shopId)->value('shopName');
            $oldImage = Merchantile::where('id',Auth::User()->id)->value('avater');

            $imagePath = $this->profileImageUplodeAndResize($imageInfo, $folderName);

            //save image url in database
            $artisan = Merchantile::find(Auth::User()->id);
            $artisan->avater = $imagePath;
            $artisan->save();

            if(file_exists($oldImage)){
                //unlink prevoius  logo
                unlink($oldImage);
            }
            

            //session flash message
            Session::flash('success', 'Logo Uplode was successful!');

            //return back with success message
            return redirect()->back();
        }else{
            return redirect()->back()->withErrors($report);
        }
    }

    public function artisanPasswordChangeForm()
    {
        return view('artisan.profile.changePassword');
    }

    public function artisanChangePassword( Request $request)
    {
        $report = Validator::make($request->all(), [
                    'current_password' => 'required|min:6',
                    'password' => 'required|string|min:6|confirmed',

                ]);

        $credentials = [
            'email'=>Auth::User()->email,
            'password'=>$request->current_password,
        ];

        if($report->passes()){
            if(Auth::guard('merchantile')->once($credentials)){

                Merchantile::where('id', Auth::User()->id)->update(['password' => bcrypt($request->password)]);
                Session::flash('success', 'Password was Update SuccessFully !');
                return redirect()->back();
            }else{
                return redirect()->back()->with('unsuccess', 'Current Password was Not Match..!');
            }
        }

        return redirect()->back()->withErrors($report);
    }

    public function shopDeleteRequest(Request $request)
    {
        $shop = Shop::where('id',Auth::User()->shopId)->select('id', 'shopName', 'shopLogo')->first();
        $artisan = Merchantile::where('id', Auth::User()->id)->select('id', 'name', 'authority')->first();
        $admins = Admin::select('id', 'name', 'authority')->get();
        foreach ($admins as $admin) {
            $admin->notify(new ShopDeleteRequest($shop, $artisan , $request->deteleReason));
        }

        Session::flash('success', 'Request Submit SuccessFully. Admin Take Step as Soon as Posible.');
        return redirect()->back();
    }

    //Shop Account Delete Function
    public function shopDelete(Request $request)
    {
        $report = Validator::make($request->all(), [
            'admin_password' => 'required|min:6',
            
        ]);

        $credentials = [
            'email'=>Auth::User()->email,
            'password'=>$request->admin_password,
            'authority'=>1,
        ];

        if($report->passes()){
            if(Auth::guard('merchantile')->once($credentials)){


                echo 'yes'; die();
                $shopId=Session::get('shopId');

                $this->productReviewDelete($shopId);
                $this->deleteShopFavourite($shopId);
                $this->productDelete($shopId);
                $this->deleteShopDetails($shopId);
                $this->deleteArtisanAccount($shopId);
                $this->deleteShopAccount($shopId);

                $this->logout($shopId);
                return redirect()->route('merchantile.login')->with('success', 'You Delete Your Shop SuccessFully');



            }else{
                return redirect()->back()->with('unsuccess', 'Password Will Not Match..!');
            }
        }
        return redirect()->back()->withErrors($report);
    }


    /*
    *Delete Product Review Function
    */
    private function productReviewDelete($shopId)
    {
        $allReviews = ProductReviewsComment::where('uploderId', $shopId)->where('UploderType', 0)->select('id')->get();

        if(count($allReviews) != 0){

            foreach ($allReviews as $review) {
                
                $deleteComment = ProductReviewsComment::find($review->id);
                $deleteComment->delete();
            }
        }

        return;
    }

    /*
    *Delete shop like Function
    */

    private function deleteShopFavourite($shopId)
    {
        $allLikes = ShopFavourite::where('shopId', $shopId)->select('id')->get();

        if(count($allLikes) != 0){

            foreach ($allLikes as $like) {
                
                $deletelike = ShopFavourite::find($like->id);
                $deletelike ->delete();
            }
        }

        return;
    }

    /*
    *Delete All Product Delete Function
    */
    private function productDelete($shopId)
    {
        $allProducts = Product::where('uploderId', $shopId)->where('UploderType',0)->select('id')->get();
        
        if( count($allProducts) != 0){
            foreach ($allProducts as $product) {
                
                $this->singelProductDelete($product->id);
                $this->productImageDelete($product->id);
                $this->productOverViewDelete($product->id);
                $this->productFavarateDelete($product->id);
            }
        }

        return;
    }

    /*
    *Delete shop Details  Function
    */

    private function deleteShopDetails($shopId)
    {   
        $detail = ShopDetails::where('ownerId', $shopId)->where('ownerType', 0)->select('id')->first();

        if(!is_null($detail)){
            $shopDetails = ShopDetails::find($detail->id);

            if(!is_null($shopDetails->bannerImage)){
                unlink( $shopDetails->bannerImage);
            }

            if(!is_null($shopDetails->ownerImage)){
                unlink( $shopDetails->ownerImage);
            }
            
            $shopDetails->delete();
        }

        return;
        
    }

    /*
    *Delete Artisan/Marchent Account Information Function
    */

    private function deleteArtisanAccount($shopId)
    {
        $marchintInfo = Merchantile::where('shopId', $shopId)->select('id')->first();

        $accountDelete = Merchantile::find($marchintInfo->id);
        $accountDelete->delete();

        return;
    }

    /*
    *Delete Singel Product Delete Function
    */

    private function deleteShopAccount($shopId)
    {
        $shopDelete = Shop::find($shopId);
        unlink( $shopDelete->shopLogo);
        $shopDelete->delete();

        return;
    }


    /*
    *LogOut from Account Function
    */
    private function logout($shopId)
    {
        
        session()->flush($shopId);
        Auth::guard('merchantile')->logout();
        return;
    }


    /*
    *Delete Singel Product Delete Function
    */
    private function singelProductDelete($productId)
    {
        $productdelete = Product::find($productId);
        $productdelete->delete();

        return;
    }
    
    /*
    *Delete Product Image Function
    */
    private function productImageDelete($productId)
    {
        $productImages = ProductImage::where('productTableId', $productId)->select('id')->get();

        if(count($productImages) != 0)
        {
            foreach ($productImages as $image) {
                
                $deleteImage = ProductImage::find($image->id);
                unlink($deleteImage->image);
                $deleteImage->delete();
            }
        }

        return;
    }

    /*
    *Delete Product Overview  Function
    */
    private function productOverViewDelete($productId)
    {
        $overView= ProductOverview::where('productTableId',$productId )->select('id')->first();

        if( !is_null($overView)){
            $deleteOverview = ProductOverview::find($overView->id);
            $deleteOverview->delete();
        }
         return ;
    }

    /*
    *Delete Product Favarate  Function
    */
    public function productFavarateDelete($productId)
    {
        $allFavarates = ProductFavourite::where('productId', $productId)->select('id')->get();

        if( count($allFavarates) != 0){

            foreach ($allFavarates as $favarate) {
                
                $deleteFavert = ProductFavourite::find($favarate->id);
                $deleteFavert->delete();
            }
        }

        return ;
    }
    
    
}
