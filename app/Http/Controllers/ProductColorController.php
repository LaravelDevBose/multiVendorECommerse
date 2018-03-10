<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Product;
use App\PrimaryColor;
use App\SecondaryColor;

class ProductColorController extends Controller
{
    public function view()
    {
        $primaryColors =PrimaryColor::latest()->get();
        $secondaryColors =SecondaryColor::latest()->get();
        return view('admin.colors.colorsContent', ['primaryColors'=>$primaryColors ,'secondaryColors'=>$secondaryColors ]);
    }

    public function store($colorName, $colorCode, $type){
        $inputData = [
            'colorName'=>$colorName,
            'colorCode'=>$colorCode,
        ];
        $report = Validator::make($inputData ,[
            'colorName'=>'required|string|max:20',
            'colorCode'=>'required|string|max:10',
        ]);

        if($report->passes()){
            if($type == 1){

                $color = new PrimaryColor;
                $color->colorName = $colorName;
                $color->colorCode = '#'.$colorCode;
                $color->save();
                $colors = PrimaryColor::latest()->get();

            }else{
                $color = new SecondaryColor;
                $color->colorName = $colorName;
                $color->colorCode = '#'.$colorCode;
                $color->save();
                $colors = SecondaryColor::latest()->get();

            }


            return response()->json($colors);
        }

        return redirect()->back()->withErrors($report);
    }

    public function update($id,$colorName, $colorCode, $type){

        $inputData = [
            'colorName'=>$colorName,
            'colorCode'=>$colorCode,
        ];
        $report = Validator::make($inputData ,[
            'colorName'=>'required|string|max:20',
            'colorCode'=>'required|string|max:10',
        ]);

        if($report->passes()){
            if($type == 1){

                $color = PrimaryColor::find($id);
                $color->colorName = $colorName;
                $color->colorCode = '#'.$colorCode;
                $color->save();
                $colors = PrimaryColor::latest()->get();
            }else{
                $color = SecondaryColor::find($id);
                $color->colorName = $colorName;
                $color->colorCode = '#'.$colorCode;
                $color->save();
                $colors = SecondaryColor::latest()->get();
            }

            return response()->json($colors);
        }

        return redirect()->back()->withErrors($report);
    }

    public function destroy($id, $type)
    {

        if($type == 1){
            $products = Product::where( function($query) use ($id){
                $query->orwhere('priColorId', "LIKE", "%" .$id. "%");
            })->select('id', 'priColorId')->get();
        }else{
            $products = Product::where( function($query) use ($id){
                $query->orwhere('secColorId', "LIKE", "%" .$id. "%");
            })->select('id', 'secColorId')->get();
        }

        if($products->count() != 0){

            foreach ($products as $product) {
                if($type == 1){
                    $colorArray = explode(',', $product->priColorId);
                }else{
                    $colorArray = explode(',', $product->secColorId);
                }

                if(in_arrry($id, $colorArray)){
                    $withOutThisId = array_diff($colorArray, array($id));

                    $colorIds = implode(',', $withOutThisId);

                    if($type == 1){
                        Product::find($product->id)->update([
                            'priColorId'=>$colorIds,
                        ]);
                    }else{
                        Product::find($product->id)->update([
                            'secColorId'=>$colorIds,
                        ]);
                    }


                }
            }
        }

        if($type == 1){
            PrimaryColor::find($id)->delete();
            $colors = PrimaryColor::latest()->get();
        }else{
            SecondaryColor::find($id)->delete();
            $colors = SecondaryColor::latest()->get();
        }

        return response()->json($colors);

    }
}
