<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Admin;
use Auth;

class AdminRegisterController extends Controller
{
    
	/**
     * Show Admin Register Form.
     *
     * @return void
     */
    public function showRegisterForm(){
    	$adminsInfo = Admin::all();
    	return view('admin.subAdmin.addAdminContent', ['adminsInfo'=>$adminsInfo]);
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
            'email' => 'required|string|email|max:255|unique:admins',
            'authority' => 'required',
            'password' => 'required|string|min:6|confirmed',
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
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'authority' => $data['authority'],
            'password' => bcrypt($data['password']),
        ]);
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adminRegister(Request $request)
    {
        $validatore=$this->validator($request->all());
        
        if($validatore->passes()){
            $data = $this->create($request->all())->toArray();
            
            if($request->hasFile('avater')){
            	$imageInfo=$request->file('avater');
            	$imageUrl = $this->moveUplodeImage($imageInfo);

            	$admin =Admin::find($data['id']);
            	$admin->avater = $imageUrl;
            	$admin->save();
            }

            return redirect()->route('admin.register.form')->with('success', 'New Admin Add Successfully .');
        }else{
             return redirect()
                    ->back()
                    ->withErrors($validatore) 
                    ->withInput();
            
        }

    }

    public function accountSetting()
    {	
    	$id = Auth::User()->id;
    	$adminById = Admin::where('id', $id)->first();
    	return view('admin.subAdmin.editAdminContent', ['adminById'=>$adminById]);
    }

    public function accountSettingUpdate(Request $request)
    {	
    	$accountSetting = Admin::find($request->adminId);
    	$accountSetting->name = $request->name;
    	$accountSetting->email = $request->email;
    	$accountSetting->save();

    	if($request->hasFile('avater')){

    		if(!is_null($accountSetting->avater) || !empty($accountSetting->avater)){
    			$this->destroyPvesImage($accountSetting->avater);
    		}
    		

    		$imageInfo=$request->file('avater');
    		$imageUrl = $this->moveUplodeImage($imageInfo);

    		$admin =Admin::find($request->adminId);
        	$admin->avater = $imageUrl;
        	$admin->save();
    	}
    	
    return redirect()->route('account.setting')->with('success', 'Account Information Update Successfully.');
    }

    public function changePassword(Request $request)
    {	
    	$validationReport = $this->checkValidateData( $request );
    	if ($validationReport->passes()) {

	    	$changePassword = Admin::find($request->adminId);
	    	$changePassword->password = bcrypt($request->password);
	    	$changePassword->save();
	    	return redirect()->route('account.setting')->with('success', 'Password Change Successfully.');
    	}
    	else{
            //if Validation not pass/fails backe to the page with old data 
            //also with error message
            return redirect()->back()
                    ->withErrors($validationReport)
                    ->withInput( $request->all());
        }
    }

    public function adminDelete($id)
    {
    	$admin = Admin::find($id);
    	$admin->delete();
    	return redirect()->back()->with('success', 'Admin Delete Successfully .');
    }

    private function moveUplodeImage($imageInfos){
        //Get Image name
        $imageName =$imageInfos->getClientOriginalName();

        //Define Uplode path 
        $uploadPath = 'public/images/Admin/';

        //move to Define folder
        $imageInfos->move($uploadPath, $imageName);

        //return totel url to join uplodepath and imageName
        return $imageUrl = $uploadPath . $imageName;

    }

    private function destroyPvesImage($imageinfoById){
        //Destroy Image
        unlink($imageinfoById->avater);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function checkValidateData($request){
        // create roles
        $validation=Validator::make($request->all(), [
            'oldPassword' => 'required',
            'password' => 'required|string|min:6|confirmed',
            ]);
        //return report
        return $validation;
    }
}
