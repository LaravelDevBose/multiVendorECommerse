<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductMaterial;
use Illuminate\Support\Facades\Validator;
use App\Product;

class ProductMaterialController extends Controller
{
    public function view()
    {
        $materials =ProductMaterial::latest()->get();
        return view('admin.materials.materialsContent', ['materials'=>$materials]);
    }

    public function store($name, $des){
        $inputData = [
            'materialName'=>$name,
            'details'=>$des,
        ];

        $report = Validator::make($inputData, [
            'materialName'=>'required|max:20',
            'details'=>'required|max:250',
        ]);
        if($report->passes()){
            ProductMaterial::insert($inputData);
            $materials =ProductMaterial::latest()->get();
            return response()->json($materials);
        }

        return redirect()->back()->withErrors($report);
    }

    public function update($id,$name, $des){

        $inputData = [
            'materialName'=>$name,
            'details'=>$des,
        ];

        $report = Validator::make($inputData, [
            'materialName'=>'required|max:20',
            'details'=>'required|max:250',
        ]);
        if($report->passes()){
            ProductMaterial::find($id)->update($inputData);
            $materials =ProductMaterial::latest()->get();
            return response()->json($materials);
        }

        return redirect()->back()->withErrors($report);
    }

    public function destroy($id)
    {

        $products = Product::where( function($query) use ($id){
            $query->orwhere('materialsIds', "LIKE", "%" .$id. "%");
        })->select('id', 'materialsIds')->get();
        if($products->count() != 0){

            foreach ($products as $product) {
                $materialArray = explode(',', $product->materialsIds);
                if(in_arrry($id, $materialArray)){
                    $withOutThisId = array_diff($materialArray, array($id));

                    $materialsId = implode(',', $withOutThisId);

                    Product::find($product->id)->update([
                        'materialsIds'=>$materialsId,
                    ]);

                }
            }
        }

        ProductMaterial::find($id)->delete();
        $materials =ProductMaterial::latest()->get();
        return response()->json($materials);

    }
}
