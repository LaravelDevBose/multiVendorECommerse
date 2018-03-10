<?php

namespace App\Http\Controllers\Auth; 

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Admin;

class AdminLoginController extends Controller
{
	public function __construct(){ 
		$this->middleware('guest:admin',['except'=>['logout']]);
	}

    public function showloginform(){
    	
    	return view('admin.login.loginContent');
    }

    public function login( Request $request){
    	//Validate the form date
    	$this->validate($request, [
    		'email'=>'required|email',
    		'password'=>'required|min:6',
    	]);

    	//attempt to log the user in
    	if (Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)) {
    		//if Sucessfull, than redirect to their intended location
    		return redirect()->intended(route('admin.dashboard'));
    	}
    	
    	//if Unsucessfull, then redirect back to their login with the form data
    	return redirect()->back()->withInput($request->only('email', 'remember'))->with('unsucces', 'Email And Password Not Match !');

    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}
