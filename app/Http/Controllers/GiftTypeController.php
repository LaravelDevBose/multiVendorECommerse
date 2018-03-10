<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Traits\TemplatImage;
use App\GiftType;
use App\Product;
use Session;
use Auth;

class GiftTypeController extends Controller
{   
    use TemplatImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    	$giftTypes = GiftType::orderBy('position', 'asc')->get();
        $position = GiftType::pluck('position', 'id')->all();
        return view('admin.gift.giftContent',['giftTypes'=>$giftTypes, 'position'=>$position]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //Create validation
        $report=Validator::make($request->all(), [
            'giftTitle' => 'required',
            'position' => 'required',
            'image' => 'required|image|mimes:jpeg,bmp,png',
            'status' => 'required|boolean',

            ]);

        if ($report->passes()) {
            //if validation pass Store data
            $imageInfo=$request->file('image');

            $imageUrl =$this->giftTypeImageUplodeAndResize($imageInfo);

            //If validation pass then Save data 
            $giftType = new GiftType;
            $giftType->giftTitle = $request->giftTitle;
            $giftType->position = $request->position;
            $giftType->image = $imageUrl;
            $giftType->publicationStatus = $request->status;
            $giftType->save();

            Session::flash('success', ' Gift Type Information Save SuccessFully !');
            return redirect()->back();
	            
        }else{
            //if Validation not pass/fails backe to the page with old data 
            //also with error message
            return redirect()->back()->withErrors($report);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){

        //Create validation
        $report=Validator::make($request->all(), [
            'giftTitle' => 'required',
            'status' => 'required|boolean',

            ]);

        if ($report->passes()) {
            //if validation pass Store data
            if ( file_exists($request->file('image')) ) {
                $imageInfo=$request->file('image');

                $imageUrl =$this->giftTypeImageUplodeAndResize($imageInfo);

                //If validation pass then Save data 
                $giftType =GiftType::find($request->giftId);

                //get oldimage path
                $oldimage = $giftType->image;

                //now Update New Date
                $giftType->giftTitle = $request->giftTitle;
                $giftType->position = $request->position;
                $giftType->image = $imageUrl;
                $giftType->publicationStatus = $request->status;
                $giftType->save();

                //cheack old image Exist or not
                if(file_exists($oldimage)){

                    //if Exist than delete old image from folder
                    unlink($oldimage);
                }

            }else{

                $giftType =GiftType::find($request->giftId);
                $giftType->giftTitle = $request->giftTitle;
                $giftType->position = $request->position;
                $giftType->publicationStatus = $request->status;
                $giftType->save();

            }
            

            Session::flash('success', ' Gift Type Information Save SuccessFully !');
            return redirect()->back();
                
        }else{
            //if Validation not pass/fails backe to the page with old data 
            //also with error message
            return redirect()->back()->withErrors($report);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){  

        $report = Validator::make($request->all(), [
                    'password' => 'required|min:6',
                ]);

        $credentials = [
            'email'=>Auth::User()->email,
            'password'=>$request->password,
        ];

        if($report->passes()){
            if(Auth::guard('admin')->once($credentials)){

                //find all product Where giftId will match
                $giftProducts = Product::where('giftTypeId', $request->giftId)->select('id')->get();

                foreach ($giftProducts as $giftProduct) {
                    //Make All Product GiftTypeId Will be null
                    Product::where('id',$giftProduct->id)->update(['giftTypeId'=>null]);
                }

                //find the Gifttype Info

                $giftType = GiftType::find($request->giftId);

                //if Image Will exist in folder than unlink it
                if(file_exists($giftType->image)){
                    unlink($giftType->image);
                }
                $giftType->delete();


                Session::flash('success', 'Gift Type Information was Delete SuccessFully !');
                 //Return Manage page With Success message
                return redirect()->back();
            }else{
                return redirect()->back()->with('unsuccess', 'Current Password was Not Match..!');
            }
        }

        return redirect()->back()->withErrors($report);

        
       
    }

}
