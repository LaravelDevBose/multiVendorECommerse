<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Traits\TemplatImage;
use App\Category;
use App\Product;


class CategoryController extends Controller
{
    use TemplatImage;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        if($request->ajax() && isset($request->mainCat)){

            if($request->mainCat != 0){
                $mainCatPosition = Category::where('mainCatId', $request->mainCat)->where('secondCatId', null)->pluck('position');
                $position=array(); $e=0;
                foreach ($mainCatPosition as $value){
                    $position[$e++]= $value;
                }
            }else{
                $mainCatPosition = Category::where('mainCatId', null)->pluck('position');
                $position=array(); $e=0;
                foreach ($mainCatPosition as $value){
                    $position[$e++]= $value;
                }

            }
            return response()->json($position);

        }else if($request->ajax() && isset($request->secCat)){

            if($request->secCat != 0){
                $mainCatPosition = Category::where('mainCatId', $request->mainCatId)->where('secondCatId', $request->secCat)->where('thirdCatId', null)->pluck('position');
                $position=array(); $e=0;
                foreach ($mainCatPosition as $value){
                    $position[$e++]= $value;
                }
            }else{
                $mainCatPosition = Category::where('mainCatId', $request->mainCatId)->where('secondCatId', null)->pluck('position');
                $position=array(); $e=0;
                foreach ($mainCatPosition as $value){
                    $position[$e++]= $value;
                }

            }
            return response()->json($position);
        }else{
            $mainCategoris = Category::where('mainCatId', null)->orderBy('position', 'asc')->get();
            $mainCatPosition = Category::where('mainCatId', null)->pluck('position');
            $position=array(); $e=0;
            foreach ($mainCatPosition as $value){
                $position[$e++]= $value;
            }

            return view('admin.category.categoryContent',['mainCategoris'=>$mainCategoris, 'position'=>$position]);
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        //Create validation
        $report=Validator::make($request->all(), [
            'categoryName' => 'required',
            'position' => 'required',
            'status' => 'required|boolean',

        ]);

        if($report->passes()){
            if(file_exists($request->image)){
                $imageInfo = $request->file('image');
                $imageUrl = $this->categoryImageUplodeAndResize($imageInfo);
            }

            $category = new Category;
            if(!is_null($request->mainCatId) && $request->mainCatId !=0 ){
                $category->mainCatId = $request->mainCatId;
            }
            if(!is_null($request->secondCatId) && $request->secondCatId !=0 ){
                $category->secondCatId = $request->secondCatId;
            }
            $category->categoryName = $request->categoryName;
            $category->position = $request->position;
            $category->publicationStatus = $request->status;

            if(is_null($request->mainCatId) || $request->mainCatId ==0 ){
                $category->image = $imageUrl;
            }
            $category->save();

            Session::flash('success', 'Category Inserted SucceddFully !');
            return redirect()->back();
        }
        return redirect()->back()->withInput()->withErrors($report);
 
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
            'categoryName' => 'required',
            'position' => 'required',
            'status' => 'required|boolean',

        ]);

        if($report->passes()) {

            $category = Category::find($request->categoryId);
            if (!is_null($request->mainCatId) && $request->mainCatId != 0) {
                $category->mainCatId = $request->mainCatId;

            } else {
                $category->mainCatId = null;

            }
            if (!is_null($request->secondCatId) && $request->secondCatId != 0) {
                $category->secondCatId = $request->secondCatId;
            } else {
                $category->secondCatId = null;
            }

            if (is_null($request->mainCatId) || $request->mainCatId == 0) {
                if (file_exists($request->image)) {
                    $imageInfo = $request->file('image');
                    $imageUrl = $this->categoryImageUplodeAndResize($imageInfo);
                    $category->image = $imageUrl;
                }
            }

            $category->categoryName = $request->categoryName;
            $category->position = $request->position;
            $category->publicationStatus = $request->status;
            $category->save();

            Session::flash('success', 'Category Updated SuccessFully !');
            return redirect()->back();
        }
        return redirect()->back()->withInput()->withErrors($report);

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

                $product = Product::where('mainCatId', $request->categoryId)->orWhere('secondCatId', $request->categoryId)->orWhere('thirdCatId', $request->categoryId)->count();

                if($product ==0 ){
                    $categoryCheck = Category::where('id', $request->categoryId)->first();
                    if(is_null($categoryCheck->mainCatId) && is_null($categoryCheck->secondCatId)){ // when main  delete all 2nd and 3rd Category
                        $mainCategorys = Category::where('mainCatId', $request->categoryId)->select('id')->get();
                        foreach($mainCategorys as $mainCategory ){
                            Category::where('id', $mainCategory->id)->delete();
                        }
                        Category::where('id', $request->categoryId)->delete();

                    }else if(!is_null($categoryCheck->mainCatId) && is_null($categoryCheck->secondCatId)){ // when second Category  delete all and 3rd Category
                        $secCategorys = Category::where('secondCatId', $request->categoryId)->select('id')->get();
                        foreach($secCategorys as $secCategory ){
                            Category::where('id', $secCategory->id)->delete();
                        }
                        Category::where('id', $request->categoryId)->delete();
                    }else{
                        Category::where('id', $request->categoryId)->delete();
                    }
                }else{

                    Session::flash('warning','All Products In this Category is Not Deleted. Plesse Delete Products First ..');
                    return redirect()->back();
                }

            }else{
                return redirect()->back()->with('unsuccess', 'Password Will Not Match..!');
            }
        }

        return redirect()->back()->withErrors($report);
    }




}
