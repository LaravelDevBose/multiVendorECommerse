<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Traits\ProfileImage;
use App\ShopDetails;
use App\Merchantile;
use App\ShopAddress;
use App\TransportLocation;
use App\Shop;
use Auth;
use Session;
use DB;

class ShopDetailsController extends Controller 
{   

    use ProfileImage;


    public function index()
    {   
        
        $shopInfo = DB::table('shops')
                ->join('shop_details', 'shops.id','=', 'shop_details.shopId')
                ->select('shops.*','shop_details.*')
                ->where('shops.id', Auth::User()->shopId)->first();

        $modarators = Merchantile::where('shopId', Auth::User()->shopId)->select('id','name','email','phoneNo','avater','authority')->get();
        $shopAdress =ShopAddress::where('shopId',Auth::User()->shopId )->first();
        $divisions = TransportLocation::where('divisionId', null)->get();
        $districts = TransportLocation::where('divisionId', '!=',null)->where('divisionId', null)->get();
        $areas = TransportLocation::where('divisionId', '!=',null)->where('divisionId', '!=',null)->get();

        return view('artisan.profile.shopProfile',['shopInfo'=>$shopInfo, 'modarators'=>$modarators,'shopAdress'=>$shopAdress, 'divisions'=>$divisions,'districts'=>$districts,'areas'=>$areas]);
    }

    //Update Shop Address Details Imformation

    public function updateShopAddress(Request $request)
    {
        $report = Validator::make($request->all(), [
                    'areaName' => 'required|string',
                    'areaId' => 'required',
                    'districtId' => 'required',
                    'divisionId' => 'required',
                ]);
        if($report->passes()){
            $address = new ShopAddress;
            $address->shopId = Auth::User()->shopId;
            $address->houseNo = $request->houseNo;
            $address->roadNo = $request->roadNo;
            $address->block = $request->block;
            $address->areaName = $request->areaName;
            $address->areaId = $request->areaId;
            $address->districtId = $request->districtId;
            $address->divisionId = $request->divisionId;
            $address->save();

            //session message
            Session::flash('success', 'Shop Address was Update SuccessFully !');
            return redirect()->back();

        }else{
            return redirect()->back()->withErrors($report);


        }
    }

    //Update About Shop Details Imformation

    public function updateAboutShop(Request $request)
    {   
        
        
            ShopDetails::where('shopId', Auth::User()->shopId)->update(['aboutShop'=>$request->aboutShop]);

            Session::flash('success', 'About Shop Information was Update SuccessFully !');
            return redirect()->back();
        
        
    }

    //Update Return Policy Details Imformation

    public function updateReturnPolicy(Request $request)
    {
        
            ShopDetails::where('shopId', Auth::User()->shopId)->update(['returnPolicy'=>$request->returnPolicy]);

            Session::flash('success', 'Return Policy Information was Update SuccessFully !');
            return redirect()->back();
          
    }

    //Update Shipping Policy Details Imformation

    public function updateSippingPolicy(Request $request)
    {
        
            ShopDetails::where('shopId', Auth::User()->shopId)->update(['shippingPolicy'=>$request->shippingPolicy]);

            Session::flash('success', 'Shipping Policy Information was Update SuccessFully !');
            return redirect()->back();
        
    }

    //Update Shop Name Information

    public function shopNameChange(Request $request)
    {
        $report = Validator::make($request->all(), [
                    'shopName' => 'required|string|max:30|unique:shops,shopName',
                    'admin_password' => 'required',
                ]);
        $credentials = [
            'email'=>Auth::User()->email,
            'password'=>$request->admin_password,
            'authority'=>1,
        ];

        if($report->passes()){
            if(Auth::guard('merchantile')->once($credentials)){
                Shop::where('id', Auth::User()->shopId)->update(['shopName' => $request->shopName]);
                Session::flash('success', 'Shop Name was Update SuccessFully !');
                return redirect()->back();
            }else{
                return redirect()->back()->with('unsuccess', 'Password Will Not Match..!');
            }
        }

        return redirect()->back()->withErrors($report);
    }

    //Change Shop Email Address Information

    public function shopEmailChange(Request $request)
    {
        $report = Validator::make($request->all(), [
                    'shopEmail' => 'required|email|unique:shops,shopEmail',
                    'admin_password' => 'required',
                ]);
        $credentials = [
            'email'=>Auth::User()->email,
            'password'=>$request->admin_password,
            'authority'=>1,
        ];

        if($report->passes()){
            if(Auth::guard('merchantile')->once($credentials)){

                Shop::where('id', Auth::User()->shopId)->update(['shopEmail' => $request->shopEmail]);
                Session::flash('success', 'Shop Email was Update SuccessFully !');
                return redirect()->back();

            }else{
                return redirect()->back()->with('unsuccess', 'Password Will Not Match..!');
            }
        }
        
        return redirect()->back()->withErrors($report);
    }

    //Change Shop Email Address Information

    public function shopWebsiteChange(Request $request)
    {
        $report = Validator::make($request->all(), [
                    'webAddress' => 'required|url',
                    'admin_password' => 'required',
                ]);
        $credentials = [
            'email'=>Auth::User()->email,
            'password'=>$request->admin_password,
            'authority'=>1,
        ];
        
        if($report->passes()){
            if(Auth::guard('merchantile')->once($credentials)){

                Shop::where('id', Auth::User()->shopId)->update(['webAddress' => $request->webAddress]);
                Session::flash('success', 'Shop Website Address was Update SuccessFully !');
                return redirect()->back();
            }else{
                return redirect()->back()->with('unsuccess', 'Password Will Not Match..!');
            }
        }
        
        return redirect()->back()->withErrors($report);
    }

    //Change Shop Logo Function

    public function shoplogoChange(Request $request)
    {

        $report = Validator::make($request->all(), [
                    'shopLogo' => 'required|image|mimes:jpeg,png',
                ]);

        if($report->passes()){
            $logoInfo = $request->file('shopLogo');

            //find old logo url
            $shopInfo = Shop::where('id', Auth::User()->shopId)->select('shopName', 'shopLogo')->first();

            //make folder name as shop name
            $folderName = $shopInfo->shopName;
            //save New Logo by traits function  pass image Information and folder name
            //get image url

            $logoPath = $this->shopLogoUplodeAndResize($logoInfo, $folderName);

            //save image url in database
            $shop = Shop::find(Auth::User()->shopId);
            $shop->shopLogo = $logoPath;
            $shop->save();

            if(file_exists($shopInfo->shopLogo)){
                //unlink prevoius  logo
                unlink($shopInfo->shopLogo);
            }
            

            //session flash message
            Session::flash('success', 'Logo Uplode was successful!');

            //return back with success message
            return redirect()->back();
        }else{
            return redirect()->back()->withErrors($report);
        }
    }


    //Change Shop Cover Image Function

    public function shopCoverImageChange(Request $request)
    {

        $report = Validator::make($request->all(), [
            'bannerImage' => 'required|image|mimes:jpeg,png',
            
        ]);

        if($report->passes()){

            $bannerInfo = $request->file('bannerImage');

            //find old Image url
            $shopInfo = ShopDetails::where('shopId', Auth::User()->shopId)->select('id','bannerImage')->first();

            //make folder name as shop name
            $folderName = Shop::where('id', Auth::user()->shopId)->value('shopName');
            //save New iamge by traits function  pass image Information and folder name
            //get image url

            $bannerPath = $this->shopBannerUplodeAndResize($bannerInfo, $folderName);

            //save image url in database
            $shopBanner = ShopDetails::find($shopInfo->id);
            $shopBanner->bannerImage = $bannerPath;
            $shopBanner->save();

            //cheak if privours image is not insert
            if(file_exists($shopInfo->bannerImage)){
                //unlink prevoius  image
                unlink($shopInfo->bannerImage);
            }
            

            //session flash message
            Session::flash('success', 'Banner Image Uplode was successful!');

            //return back with success message
            return redirect()->back();
        }else{
            return redirect()->back()->withErrors($report);
        }
        
    }

    public function areaList($disId){
        $district = TransportLocation::where('districtId', $disId)->latest()->pluck("areaName","id")->all();
        return Response()->json($district);
    }

    public function artisanViewName(Request $request){

        $report = Validator::make($request->all(), [
                    
                    'admin_password' => 'required',
                ]);
        $credentials = [
            'email'=>Auth::User()->email,
            'password'=>$request->admin_password,
            'authority'=>1,
        ];
        
        if($report->passes()){
            if(Auth::guard('merchantile')->once($credentials)){

                ShopDetails::where('shopId', Auth::User()->shopId)->update(['shopDetailsFour'=>ucfirst($request->shopDetailsFour)]);
                //session flash message
                Session::flash('success', 'Artisan Custom View Name Changed SuccessFully!');

                //return back with success message
                return redirect()->back();
            }else{
                return redirect()->back()->with('unsuccess', 'Password Will Not Match..!');
            }
        }
        
        return redirect()->back()->withErrors($report);
    }
    

}
