<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Merchantile;
use Auth;
use Session;
use Mail;
use App\Mail\ModaratorMailVerifiy;

class ShopModaratorController extends Controller
{


    //Insert Shop Modarator 

    public function store(Request $request)
    {   
        $report = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:merchantile_infos',
                    'phoneNo' => 'required',
                    'authority' => 'required',
                    'password' => 'required|string|min:6|confirmed',
                    'admin_password' => 'required|string|min:6',
                ]);

        $credentials = [
            'email'=>Auth::User()->email,
            'password'=>$request->admin_password,
            'authority'=>1,
        ];

        if($report->passes()){

            if(Auth::guard('merchantile')->once($credentials)){

                //store Modarator Information
                $data = $this->create($request->all())->toArray();

                //generate a 25 lenth string Token 
                $data['token']= str_random(25);
                
                
                //find the information where data id will match then store the token 
                $artisan = Merchantile::find($data['id']);
                $artisan->token = $data['token'];
                $artisan->save();

                //create a mail for Account Holder  with token 
                Mail::send(new ModaratorMailVerifiy($artisan));

                //Sesstion Success message And Email Send message
                Session::flash('success', 'New Modarator Account was Create Successfully And Also Mail Send!');
                return redirect()->back();

            }else{  
                return redirect()->back()->with('unsuccess', 'Super Admin Password Will Not Match..!');
            }

        }else{
            return redirect()->back()->withErrors($report)->withInputs($request->expect('password', 'admin_password'));
        }
        	
    }

    //delete Shop Modarator 

    public function delate(Request $request)
    {

        $report = Validator::make($request->all(), [
                    'admin_password' => 'required|string|min:6',
                ]);

        $credentials = [
            'email'=>Auth::User()->email,
            'password'=>$request->admin_password,
            'authority'=>1,
        ];

        if($report->passes()){

            if(Auth::guard('merchantile')->once($credentials)){


            	$modarator = Merchantile::find($request->modaraterId);
                if(file_exists($modarator->avater) && !is_null($modarator->avater)){
                    unlink($modarator->avater);
                }

                $modarator->delete();

                //session Message

                Session::flash('success', 'Modarator Account was Delete Successfully.!');

                return redirect()->route('shop.profile');

            }else{
                return redirect()->back()->with('unsuccess', 'Super Admin Password Will Not Match..!');
            }

        }else{
            return redirect()->back()->withErrors($report);
        }

    }  


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Merchantile
     */
    protected function create(array $data )
    {
        return Merchantile::create([
            'shopId'=>Auth::User()->shopId,
            'name' => $data['name'],
            'email' => $data['email'],
            'phoneNo' => $data['phoneNo'],
            'authority'=> $data['authority'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function modaratorConfirmation($token){
        $merchantile= Merchantile::where('token', $token)->first();
       
        if(!empty($merchantile)){
            $data= Merchantile::find($merchantile->id);
            $data->confirmed = 1;
            $data->token = '';
            $data->save();

            return redirect()->route('index')->with('success', 'Your Shop Modarator Account Activation is Complete!');
        }

        return redirect(route('index') )->with('unsuccess', 'Oops Something Went Wrong');
    }


        
}
