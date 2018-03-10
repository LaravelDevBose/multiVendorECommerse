<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
Use App\Mail\ShopStatus;
use App\ConsumerQuestion;
use App\DorponAssociate;
use App\ShopFavourite;
use App\Merchantile;
use App\OrderDetail;
use App\ShopDetails;
use App\Product;
use App\Order;
use App\Shop;
use App\User;
use App\ShopAddress;
use Session;
use Auth;
use Mail;
use DB;
use Carbon\Carbon;
use Charts;
use DateTime;

class AccountHolderInfoController extends Controller
{	
	public function __construct()
    {
        Carbon::setWeekStartsAt(Carbon::FRIDAY);
        Carbon::setWeekEndsAt(Carbon::THURSDAY);
        
    }

    public function shopList() 
    {   
        $shopsInfo = DB::table('shops')
                    ->join('merchantile_infos', 'shops.id','=', 'merchantile_infos.shopId')
                    ->select('shops.id', 'shops.shopName', 'shops.shopLogo','shops.status','shops.created_at','merchantile_infos.name','merchantile_infos.email','merchantile_infos.phoneNo')
                    ->where('merchantile_infos.authority', 1)
                    ->latest()
                    ->get();
    	
    	return view('admin.shopHistory.viewShopInfo',['shopsInfo'=>$shopsInfo]);
    }




    public function shopSingelView($shopId)
    {

        $shopInfo = Shop::where('id', $shopId)->first();
        $ownerInfo = Merchantile::where('shopId', $shopId)->where('authority', 1)->select('name', 'email','avater','authority', 'phoneNo')->first();
        $modarators = Merchantile::where('shopId', $shopId)->select('name', 'email','avater','authority', 'phoneNo')->get();
        $shopProducts = Product::where('ownerId',$shopId)->select('id','mainCatId','secondCatId','thirdCatId','productName','productCode','costPrice','finalPrice','status')->get();
        $ShopDetails = ShopDetails::where('shopId', $shopId)->first();

        $weeklyReport = $this->weeklySellReport($shopId);
        $monthlyReport = $this->monthlySellReport($shopId);

        $orders = DB::table('order_details')
                    ->join('users', 'order_details.consumerId', '=', 'users.id')
                    ->select('order_details.*','users.name')
                    ->where('order_details.ownerId', $shopId)->paginate(10);

        $topSellProducts = OrderDetail::where('ownerId', $shopId)->select('productId', DB::raw('count("productQuantity") as sellCount'))->groupBy('productId')->orderBy('sellCount', 'desc')->take(7)->get();

        $topSellPriceProducts = OrderDetail::where('ownerId', $shopId)->select('productId', DB::raw('sum(subTotal) as ammount'))->groupBy('productId')->orderBy('ammount', 'desc')->take(7)->get();
        
        $topRateProducts = $topSellProducts;

        $shopAddress = ShopAddress::where('shopId', $shopId)->first();
        $shopAssoInfo = DorponAssociate::where('status', 1)->select('name', 'id')->get();

    	return view('admin.shopHistory.singelShopView',['shopInfo'=>$shopInfo, 'ownerInfo'=>$ownerInfo,'modarators'=>$modarators,'shopProducts'=>$shopProducts,'ShopDetails'=>$ShopDetails, 'weeklyReport'=>$weeklyReport, 'monthlyReport'=>$monthlyReport, 'topSellProducts'=>$topSellProducts,'topSellPriceProducts'=>$topSellPriceProducts, 'topRateProducts'=>$topRateProducts ,'shopAddress'=>$shopAddress, 'shopAssoInfo'=>$shopAssoInfo]);

    }

    private function weeklySellReport($shopId){

        $thisWeek = OrderDetail::where('ownerId', $shopId)
                            ->where('created_at','>=', Carbon::now()->startOfWeek())
                            ->where('created_at','<=' ,Carbon::now()->endOfWeek())
                            ->select('created_at',DB::raw('sum(subTotal) as ammount'))->groupBy('created_at')->get();

        $lastWeek = OrderDetail::where('ownerId', $shopId)
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

    private function monthlySellReport($shopId)
    {
        $monthlyReports = OrderDetail::where('ownerId', $shopId)
                            ->where('created_at','>=', Carbon::now()->startOfYear())
                            ->where('created_at','<=' ,Carbon::now()->endOfYear())
                            ->select('created_at',DB::raw('sum(subTotal) as ammount'))->groupBy('created_at')->get();
        
        $month = array();
        foreach ($monthlyReports as $value) {
            $date = new DateTime($value->created_at);
            $m = date_format($date, 'n');
            $month[$m]= $value->ammount;
        }
        
        
        $data = array();
        
        for($i=0; $i<12; $i++){
            $data[$i] = 0;

            if(array_key_exists($i+1, $month)){
                $data[$i] = $month[$i+1];
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

    


    public function shopBlock(Request $request)
    {   

        $report = Validator::make($request->all(), [
                    'password' => 'required',
                ]);
        

        //cheak the Validation
        if($report->passes()){

            //make The Cridentioal
            $credentials = [
                'email'=>Auth::User()->email,
                'password'=>$request->password,
            ];

            //chcak The admail Valid or not
            if(Auth::guard('admin')->once($credentials)){

                //chack Shop Currnet Status if Active make block else make Active
                $status = ($request->status==1)?'0':'1';

                //update Shop Status
                $shopBlock = Shop::find($request->shopId);
                $shopBlock->status = $status;
                $shopBlock->save();

                $shopName =$shopBlock->shopName;

                //get All Product of this Shop
                $shopProducts = Product::where('ownerId', $request->shopId)->select('id')->get();

                foreach ($shopProducts as $shopProduct) {
                    //chack the status naow if 0 make all product Unpublish else make them publish
                    if ($status == 0) {
                        Product::where('id', $shopProduct->id)->update(['publicationStatus'=>0]);
                    }else{
                        Product::where('id', $shopProduct->id)->update(['publicationStatus'=>1]);
                    }
                    
                }

                //make a message if Action is for block than send  block message or Active message
                $message=($status == 0)?'Shop Block SuccessFully':'Shop UnBlock SuccessFully';
                $shopFounder = Merchantile::where('shopId',$request->shopId )->where('authority', 1)->select('name','email')->first();

                //send a mail to shop Founder
                mail::send( new ShopStatus($status,$shopFounder,$shopName));

                //flash Session message and redirect it the shop list page
                Session::flash('success', $message);
                return redirect()->route('shop.list');

            }else{
                //if not valid admin redirect back with message
                return redirect()->back()->with('unsuccess', 'Password Will Not Match..!');
            }
        }
        
        //return back with error message
        return redirect()->back()->withErrors($report);
    }


    public function userList()
    {
        $users = User::latest()->get();

        return view('admin.users.usersList', ['users'=>$users]);
    }

    public function userSingelView($userId)
    {   
        $userInfo = User::where('id' , $userId)->first();
        $inboxs = ConsumerQuestion::where('name', $userInfo->name)->where('email', $userInfo->email)->get();
        $unread = ConsumerQuestion::where('status',0)->where('name', $userInfo->name)->where('email', $userInfo->email)->count();

        $orders = Order::where('consumerId',$userId)->latest()->paginate(10);
        return view('admin.users.singelUser',['userInfo'=>$userInfo,'inboxs'=>$inboxs, 'unread'=>$unread, 'orders'=>$orders]);

    }

}
