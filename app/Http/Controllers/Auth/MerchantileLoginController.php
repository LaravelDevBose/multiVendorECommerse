<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Merchantile;
use Auth;
use Session;

class MerchantileLoginController extends Controller
{
    public function __construct(){ 
		$this->middleware('guest:merchantile',['except'=>['logout']]);
	}

    public function showloginform(){
    	$siteMap=20;
    	return view('frontEnd.accountSection.artisenLoginFormContent',['siteMap'=>$siteMap]);
    }

    public function login( Request $request){


    	//Validate the form date
    	$this->validate($request, [
    		'email'=>'required|email', 
    		'password'=>'required|min:6',
    	]);

    	//attempt to log the user in
    	if (Auth::guard('merchantile')->attempt(['email'=>$request->email, 'password'=>$request->password, 'confirmed'=>1 ], $request->remember)) {
    		
            //if Sucessfull, than redirect to their intended location
    		return redirect()->intended(route('merchantile.confarmation.check'));
    	}
    	
    	//if Unsucessfull, then redirect back to their login with the form data
    	return redirect()->back()->withInput($request->only('email', 'remember'))->with('unsuccess', 'Email And password Not match !');

    }


    public function logout()
    {   
        $shopId=Session::get('shopId');
        session()->flush($shopId);
        Auth::guard('merchantile')->logout();
        return redirect()->route('index');
    }
}
