<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Size;
use App\SizeCredential;
use Illuminate\Support\Facades\Validator;
use App\Product;
use Session;
use Auth;
use App\Category;
use App\ProductQuentity;
class SizeColtroller extends Controller
{

    public function view()
    {
        $sizes =Size::latest()->get();
        return view('admin.size.sizeContent', ['sizes'=>$sizes]);
    }

    public function insert(){
        $mainCategoris = Category::Where('mainCatId', null)->latest()->get();
        return view('admin.size.sizeInsert',['mainCategoris'=>$mainCategoris]);
    }
    public function store(Request $request){


        $report = Validator::make($request->all(), [
            'sizeTitle'=>'required|max:20',
        ]);
        if($report->passes()){

            if(count($request->mainCatId) > 0 && count($request->sizeFileName) >0 && count($request->sizeData)>0 &&count($request->sizeData) == count($request->sizeFileName) ){

                $mainCatId = array_where($request->mainCatId , function ($value, $key){
                    return !is_null($value);
                });
                $thirdCatIds = null;
                $secondCatIds = Null;
                if(isset($request->secondCatId )){
                    $secondCatId = array_where($request->secondCatId , function ($value, $key){
                        return !is_null($value);
                    });
                    $secondCatIds = implode(',',$secondCatId);
                }

                if(isset($request->thirdCatId)){
                    $thirdCatId = array_where($request->thirdCatId , function ($value, $key){
                        return !is_null($value);
                    });
                    $thirdCatIds = implode(',',$thirdCatId);
                }


                $size = new Size;
                $size->mainCatId = implode(',',$mainCatId);
                $size->secondCatId = $secondCatIds;
                $size->thirdCatId = $thirdCatIds;
                $size->sizeTitle = strtoupper($request->sizeTitle);
                $size->details = ucfirst($request->details);
                $size->status = $request->status;
                $size->save();

                $sizeFileName = array_where($request->sizeFileName , function ($value, $key){
                    return !is_null($value);
                });
                $sizeData = array_where($request->sizeData , function ($value, $key){
                    return !is_null($value);
                });

                for($i=0; $i<count($sizeData); $i++){
                    $sizeCri = new SizeCredential;
                    $sizeCri->sizeId = $size->id;
                    $sizeCri->sizeFileName = $sizeFileName[$i];
                    $sizeCri->sizeData = $sizeData[$i];
                    $sizeCri->save();
                }

                Session::flash('success', 'Size Information Inserted SuccessFully');
                return redirect()->route('size.copy',$size->id);

            }else if(count($request->mainCatId) <= 0){
                Session::flash('warning', 'Must Be Select Main Category');
                return redirect()->back()->withInput();
            }else if(count($request->sizeFileName) <= 0){
                Session::flash('warning', 'Size Field Name is Required');
                return redirect()->back()->withInput();
            }else if(count($request->sizeData) <= 0){
                Session::flash('warning', 'Size Field Data is Required');
                return redirect()->back()->withInput();
            }else if(count($request->sizeData) != count($request->sizeFileName)){
                Session::flash('warning', 'Size Field Name Or Field Value one of them is Not Inputted. Inputted Both Of Them.');
                return redirect()->back()->withInput();
            }

        }

        return redirect()->back()->withErrors($report);
    }

    public function copy($sizeId){


        $copySize = Size::where('id', $sizeId)->first();

        $sizeCrids = SizeCredential::where('sizeId', $sizeId)->get();
        $mainCategoris = Category::Where('mainCatId', null)->latest()->get();

        return view('admin.size.sizeCopy', ['copySize'=>$copySize, 'sizeCrids'=>$sizeCrids, 'mainCategoris'=>$mainCategoris]);

    }

    public function edit($sizeId){


        $copySize = Size::where('id', $sizeId)->first();

        $sizeCrids = SizeCredential::where('sizeId', $sizeId)->get();
        $mainCategoris = Category::Where('mainCatId', null)->latest()->get();

        return view('admin.size.sizeEdit', ['copySize'=>$copySize, 'sizeCrids'=>$sizeCrids, 'mainCategoris'=>$mainCategoris]);

    }

    public function update(Request $request){


        $report = Validator::make($request->all(), [
            'sizeTitle'=>'required|max:20',
        ]);
        if($report->passes()){

            if(count($request->mainCatId) > 0 && count($request->sizeFileName) >0 && count($request->sizeData)>0 &&count($request->sizeData) == count($request->sizeFileName) ){

                $mainCatId = array_where($request->mainCatId , function ($value, $key){
                    return !is_null($value);
                });
                $secondCatId = array_where($request->secondCatId , function ($value, $key){
                    return !is_null($value);
                });

                $thirdCatId = array_where($request->thirdCatId , function ($value, $key){
                    return !is_null($value);
                });

                $size = Size::find($request->sizeId);
                $size->mainCatId = implode(',',$mainCatId);
                $size->secondCatId = implode(',',$secondCatId);
                $size->thirdCatId = implode(',',$thirdCatId);
                $size->sizeTitle = strtoupper($request->sizeTitle);
                $size->details = ucfirst($request->details);
                $size->status = $request->status;
                $size->save();

                $sizeFileName = array_where($request->sizeFileName , function ($value, $key){
                    return !is_null($value);
                });

                $sizeData = array_where($request->sizeData , function ($value, $key){
                    return !is_null($value);
                });
                $sizeCriIds = SizeCredential::where('sizeId',$request->sizeId)->pluck('id')->all();
                SizeCredential::destroy($sizeCriIds);

                for($o=0; $o<count($sizeData); $o++){

                    $sizeCri =new  SizeCredential;
                    $sizeCri->sizeId = $request->sizeId;
                    $sizeCri->sizeFileName = $sizeFileName[$o];
                    $sizeCri->sizeData = $sizeData[$o];
                    $sizeCri->save();

                }


                Session::flash('success', 'Size Information Updated SuccessFully');
                return redirect()->route('sizes');

            }else if(count($request->mainCatId) <= 0){
                Session::flash('warning', 'Must Be Select Main Category');
                return redirect()->back()->withInput();
            }else if(count($request->sizeFileName) <= 0){
                Session::flash('warning', 'Size Field Name is Required');
                return redirect()->back()->withInput();
            }else if(count($request->sizeData) <= 0){
                Session::flash('warning', 'Size Field Data is Required');
                return redirect()->back()->withInput();
            }else if(count($request->sizeData) != count($request->sizeFileName)){
                Session::flash('warning', 'Size Field Name Or Field Value one of them is Not Inputted. Inputted Both Of Them.');
                return redirect()->back()->withInput();
            }

        }

        return redirect()->back()->withErrors($report);
    }

    public function destroy(Request $request)
    {


        $report = Validator::make($request->all(), [
            'password' => 'required|min:6',
        ]);

        if($report->passes()){
            $credentials = [
                'email'=>Auth::User()->email,
                'password'=>$request->password,
            ];

            if(Auth::guard('admin')->once($credentials)){
                $productSizes = ProductQuentity::where('sizeId', $request->sizeId)->get();

                if($productSizes->count() > 0){

                    foreach ($productSizes as $size) {
                        ProductQuentity::destroy($size->id);
                    }
                }

                $sizeCrids = SizeCredential::where('sizeId',$request->sizeId)->get();
                foreach ($sizeCrids as $sizeCrid) {
                    SizeCredential::destroy($sizeCrid->id);
                }

                Size::destroy($request->sizeId);

                return response()->json();
            }
            Session::flash('warning', 'Admin password Not Match');
            return response()->json('$("#size_edit_modal").modal("hide")');
        }
        return redirect()->back()->withErrors($report);
    }
}
