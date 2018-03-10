<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Mail\UserEmailConfirmation;
use App\ConsumerDetail;
use App\PaymentDetail;
use Socialite;
use App\User;
use Session;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'consumer/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => 'required|string|max:255',
            'firstName' => 'required|string|max:200',
            'lastName' => 'required|string|max:200',
            'email' => 'required|string|email|max:255|unique:users',
            'phoneNo' => 'required',
            'gender' => 'required',
            'birthDate' => 'required|date',
            'password' => 'required|string|min:6|confirmed',
            'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'birthDate' => $data['birthDate'],
            'phoneNo' => $data['phoneNo'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function signUp(Request $request)
     {
         $validatore=$this->validator($request->all());
        
         if($validatore->passes()){
            $data = $this->create($request->all())->toArray();
            $route = 'signUp.confirmation';
            $this->newUserCridantial($data,$route);

            return redirect()->back()->with('success', 'Confirmation mail has been send. please check your mail.');
         }else{
              return redirect()
                     ->back()
                     ->withErrors($validatore)
                     ->withInput();
            
         }

     }

  
     public function signUpconfirmation($token){
         $user= User::where('token', $token)->first();
       
         if(!empty($user)){
             $data= User::find($user->id);
             $data->confirmed = 1;
             $data->token = '';
             $data->save();

             return redirect()->route('checkout')->with('success', 'Your Account Activation is Complete ');
         }

         return redirect()->route('checkout')->with('unsuccess', 'Oops Something Went Wrong');
     }



    private function newUserCridantial($data, $route)
    {
        $data['token']= str_random(25);

        $user = User::find($data['id']);
        $user->token = $data['token'];
        $user->save();

        $details= New ConsumerDetail;
        $details->userId = $user->id;
        $details->save();

        $payment= New PaymentDetail;
        $payment->userId = $user->id;
        $payment->save();

         //send mail via Mailable Class
        Mail::send(new UserEmailConfirmation($user, $route));

        return $user;
    }

    public function registerConfirmation($token){
         $user= User::where('token', $token)->first();
       
         if(!empty($user)){
             $data= User::find($user->id);
             $data->confirmed = 1;
             $data->token = '';
             $data->save();

             return redirect()->route('register')->with('success', 'Your Account Activation is Complete ');
         }

         return redirect()->route('register')->with('unsuccess', 'Oops Something Went Wrong');
     }
}
