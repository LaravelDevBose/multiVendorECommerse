<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\SocialProvider;
use App\ConsumerDetail;
use App\PaymentDetail;
use Socialite;
use App\User;
use App\Subcriber;
use Session;
use Auth;
use Route;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
 
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/consumer/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest', ['except'=>['userlogout','logout' ]]);
    }

    public function consumerSignIn( Request $request){
        

        //Validate the form date
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);

        //attempt to log the user in
        if (Auth::guard('web')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)) {
            
            //if Sucessfull, than redirect to their intended location
            return redirect()->intended(route('shipping'));
        }
        
        //if Unsucessfull, then redirect back to their login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('unsuccess', 'Email Address And password Not match !');

    }


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {   

    
        Session::put('socialRouteName',Route::currentRouteName());
        return Socialite::driver($provider)->redirect('/consumer/home');
    }
    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {

        $routeName = Session::get('socialRouteName');
        

        try
        {
            $socialUser = Socialite::driver($provider)->user();
            
            

            // return '<img src="'.$socialUser->getAvatar().'">' ;
        }
        catch(\Exception $e)
        {
            return redirect()->back();

        }

        if($routeName == 'social-login'){

            //check if we have logged provider
            $socialProvider = SocialProvider::where('providerId',$socialUser->getId())->first();
            if(!$socialProvider)
            {
                

                //create a new user and provider
                $user = User::firstOrCreate(['name' => $socialUser->getName(), 'email' => $socialUser->getEmail()]);

                User::where('id', $user->id)->update(['avater'=>$socialUser->getAvatar()]);

                $user->socialProviders()->create(
                    ['providerId' => $socialUser->getId(), 'provider' => $provider]
                );

                $details= New ConsumerDetail;
                $details->userId = $user->id;
                $details->save();

                $payment= New PaymentDetail;
                $payment->userId = $user->id;
                $payment->save();
            }
            else{
                $user = $socialProvider->user;
            }

            auth()->login($user);
            return redirect('/consumer/home');
        }elseif ($routeName == 'social-subcribe') {
            
            $subcriber = Subcriber::where('subcriber_email', $socialUser->getEmail())->first();

            if(is_null($subcriber)){
                Subcriber::create(['subcriber_email'=>$socialUser->getEmail(),'providerId' => $socialUser->getId(), 'provider' => $provider]);
                return redirect('/')->with('success','Thank You For You Subcription');
            }

            return redirect('/')->with('warning','You Are Already Subcriber By Your '.$subcriber->provider.' Account');
        }

    }

    public function storeSubcriber(Request $request){
        $subcriber = Subcriber::where('subcriber_email', $request->subcriber_email)->first();

            if(is_null($subcriber)){
                Subcriber::create(['subcriber_email'=>$request->subcriber_email]);
                return redirect('/')->with('success','Thank You For You Subcription');
            }

            if(is_null($subcriber->provider)){

                return redirect('/')->with('warning','You Are Already Subcriber. Thank You.!');
            }else{
                return redirect('/')->with('warning','You Are Already Subcriber By Your '.$subcriber->provider.' Account');
            }
    }


    public function userlogout(){

        
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
