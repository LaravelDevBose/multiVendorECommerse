<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Notifications\NewShopCreated;
use Illuminate\Http\Request;
use App\Traits\ProfileImage;
use App\Merchantile;
use App\ShopDetails;
use App\Shop;
use Session;
use Mail;
use App\Admin;
use App\Mail\ShopMailVerfiy;

class MerchantileRegisterController extends Controller
{	

    use ProfileImage;
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){

        $this->middleware('guest:merchantile'); 
    }
    /**
     * Show Merchantile Register Form.
     *
     * @return void
     */
    public function showRegistrationForm(){

        return view('frontEnd.accountSection.createShopContent');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //Shop Section
            'shopName' => 'required|string|max:255',
            'shopTypeId' => 'required',
            //Account Section
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:merchantile_infos',
            'phoneNo' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Merchantile
     */
    protected function create(array $data , $shopId, $artisanImage)
    {
        return Merchantile::create([
            'shopId'=>$shopId,
            'name' => ucfirst($data['name']),
            'gender' => $data['gender'],
            'email' => $data['email'],
            'phoneNo' => $data['phoneNo'],
            'authority'=> 1,
            'avater'=> $artisanImage,
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function createShop($request, $imageUrl, $shopViewId){
         $shop = New Shop;
         $shop->shopName = ucfirst($request->shopName);
         $shop->shopSkills = $request->shopTypeId;
         $shop->onlineAddress = $request->onlineAddress;
         $shop->shopLogo = $imageUrl;
         $shop->shopTags = $request->shopName;
         $shop->shopViewId = $shopViewId;
         $shop->status = 0;
         $shop->save();

         return $shop->id;
    }

    /**
     * Handle a registration request for the application.
     *Account Active With Email Varivaction.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function shopRegister(Request $request)
    {

        $validatore=$this->validator($request->all());
        
        if($validatore->passes()){
            //if validation pass than chack the image validation
            $shopLogo = null;
            $imageInfo=$request->file('shopLogo');
            if(file_exists($imageInfo)){
                if ($imageInfo->getClientMimeType()) {
                    //if validation pass than uplode the image in folder
                    $folderName = $request->shopName;
                    $shopLogo =$this->shopLogoUplodeAndResize($imageInfo, $folderName);

                } else {
                    // if image validation not pass than redirect back with input and validation message
                    return redirect()
                        ->back()->with('warning', 'Only Uplode Jpg, Png, & Jpeg Image.')
                        ->withInput();
                }
            }

            $artisanImage = null;
            $imageInfo=$request->file('avater');
            if(file_exists($imageInfo)){
                if ($imageInfo->getClientMimeType()) {
                    //if validation pass than uplode the image in folder
                    $folderName = $request->shopName;
                    $artisanImage =$this->newShopArtisanProfileImage($imageInfo, $folderName);

                } else {
                    // if image validation not pass than redirect back with input and validation message
                    return redirect()
                        ->back()->with('warning', 'Only Uplode Jpg, Png, & Jpeg Image.')
                        ->withInput();
                }
            }


                //$shopViewId =shop::orderBy('id', 'desc')->value('shopViewId');
                //now store Shop information and get shop id
                $shopViewId = $this->shopViewIdCustom();

                $shopId = $this->createShop($request, $shopLogo, $shopViewId);
                //insert shop Details Tabale a new Shop
                $shopDetails = New ShopDetails;
                $shopDetails->shopId = $shopId;
                $shopDetails->save();

                //now store Acount Section infroamtion with shop id
                $data = $this->create($request->all(), $shopId, $artisanImage)->toArray();

                //generate a 25 lenth string Token
                $data['token']= str_random(25);

                //find the information where data id will match then store the token
                $merchantile = Merchantile::find($data['id']);
                $merchantile->token = $data['token'];
                $merchantile->save();

                //create a mail for Account Holder  with token
                Mail::send(new ShopMailVerfiy($merchantile));

                //redirect Account holder to login page with Success message and Check the email and Confirm his Account
                return redirect()->back()->with('success', 'Confirmation mail has been send. please check your mail.');

                
            }else{
                //if Validation not pass redirect back with errors and input
             return redirect()
                    ->back()
                    ->withErrors($validatore) 
                    ->withInput();
            
        }

    }

  
    public function confirmation($token){
        $merchantile= Merchantile::where('token', $token)->first();
       
        if(!empty($merchantile)){
            $data= Merchantile::find($merchantile->id);
            $data->confirmed = 1;
            $data->token = '';
            $data->save();
            $shop = Shop::where('id',$merchantile->shopId)->first();
            $admins = Admin::all();
            foreach ($admins as $admin) {
                $admin->notify(new NewShopCreated($shop));
            }

            return redirect( route('index') )->with('success', 'Your Shop is Created SuccessFully. Admin Will Contact With You As Soon By Your Mail Or Mobile Number.');
        }

        return redirect(route('index') )->with('unsuccess', 'Oops Something Went Wrong');
    }

    private function shopViewIdCustom(){
        $shopViewId = Shop::orderBy('id', 'desc')->value('shopViewId');

        if(is_null($shopViewId) || empty($shopViewId)){
            $shopViewId = 'A000';
        }
        $newId = ' ';
        $char = substr($shopViewId,0, 1);
        $IdLength = substr($shopViewId, 1, strlen($shopViewId));

        if($IdLength == 999){
            $char++;
            $IdLength ++;
            $newId = substr($IdLength,1, 4);
        }else{
            $IdLength++;
            $newId = $IdLength;
            for($i=3; $i >strlen($IdLength); $i--){
                $newId = '0'.$newId;
            }
        }

        return $char.$newId;
    }
    
}
