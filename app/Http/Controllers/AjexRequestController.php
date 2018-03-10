<?php

namespace App\Http\Controllers;

use App\DorponSupplyer;
use App\Shop;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\DorponAssociate;
use App\SecondaryColor;
use App\PrimaryColor;
use App\ShopDetails;
use App\ProductTag;
use App\Category;
use App\ProductTransport;
use App\TransportLocation;
use App\Size;
use DB;
use Session;

class AjexRequestController extends Controller
{
    public function tagStore($title, $value)
    {
        if(!empty($title) || !empty($value)){
            

            $tag = new ProductTag;
            $tag->tagTitle = $title;
            $tag->description = $value;
            $tag->save();

            $data = [$tag->id => $tag->tagTitle ];
            return json_encode($data);
        }


    }
    public function mianCategorySearch(){
        $mainCategoris = Category::where('mainCatId', null)->orderBy('position', 'asc')->pluck('categoryName', 'id')->all();
        return response()->json($mainCategoris);
    }

    public function secondCategoryFind($id)
    {   
     
        $secCategories = Category::where('mainCatId', $id)->where('secondCatId', null)->orderBy('position', 'asc')->pluck("categoryName","id")->all();
        return json_encode($secCategories);
    }

    public function thirdCategoryFind($mainCatId, $secCatId)
    {   
     
        $thirdCategories = Category::where('mainCatId', $mainCatId)->where('secondCatId', $secCatId)->where('thirdCatId', null)->orderBy('position', 'asc')->pluck("categoryName","id")->all();
        return json_encode($thirdCategories);
    }



    public function mianCategorySize($mainCatId){

        $allCollection = Size::where('mainCatId',"LIKE", "%" .$mainCatId. "%")->pluck('mainCatId', 'id')->all();

        $catSize = collect($allCollection)->map( function($sizeIds, $key) use ($mainCatId){

            $sizeIdArray = explode(',', $sizeIds);
            if(in_array($mainCatId, $sizeIdArray)){
                return Size::where('id', $key)->pluck('sizeTitle', 'id')->first();
            }
        })->reject( function($sizeIds){
            return is_null($sizeIds);
        });

        return response()->json($catSize);
    }
    public function secCategorySize($secCatId){

        $allCollection = Size::where('secondCatId',"LIKE", "%" .$secCatId. "%")->pluck('secondCatId', 'id')->all();

        $catSize = collect($allCollection)->map( function($sizeIds, $key) use ($secCatId){

            $sizeIdArray = explode(',', $sizeIds);
            if(in_array($secCatId, $sizeIdArray)){
                return Size::where('id', $key)->pluck('sizeTitle', 'id')->first();
            }
        })->reject( function($sizeIds){
            return is_null($sizeIds);
        });

        return response()->json($catSize);
    }
    public function thirdCategorySize($thirdCatId){

        $allCollection = Size::where('thirdCatId',"LIKE", "%".$thirdCatId."%")->pluck('thirdCatId', 'id')->all();

        $catSize = collect($allCollection)->map( function($sizeIds, $key) use ($thirdCatId){

            $sizeIdArray = explode(',', $sizeIds);
            if(in_array($thirdCatId, $sizeIdArray)){
                 return Size::where('id', $key)->pluck('sizeTitle', 'id')->first();
            }
        })->reject( function($sizeIds){
            return is_null($sizeIds);
        });

        return response()->json($catSize);
    }



    public function primaryColorsStore($colorName, $colorCode){
        $inputData = [
            'colorName'=>$colorName,
            'colorCode'=>$colorCode,
        ];
        $report = Validator::make($inputData ,[
            'colorName'=>'required|string|max:20',
            'colorCode'=>'required|string|max:10',
        ]);

        if($report->passes()){
            
            $color = new PrimaryColor;
            $color->colorName = $colorName;
            $color->colorCode = '#'.$colorCode;
            $color->save();

            $data = [$color->id => $color->colorName];
            return response()->json($data);
        }

        return redirect()->back()->withErrors($report);
    }

    public function secondaryColorsStore($colorName, $colorCode){
        $inputData = [
            'colorName'=>$colorName,
            'colorCode'=>$colorCode,
        ];
        $report = Validator::make($inputData ,[
            'colorName'=>'required|string|max:20',
            'colorCode'=>'required|string|max:10',
        ]);

        if($report->passes()){
            
            $color = new SecondaryColor;
            $color->colorName = $colorName;
            $color->colorCode = '#'.$colorCode;
            $color->save();

            $data = [$color->id => $colorName];
            return response()->json($data);
        }

        return redirect()->back()->withErrors($report);
    }

    public function shopAssoChanege($assocId, $shopId){
        
        if($assocId == 0){
            $assocId = Null;
        }

        ShopDetails::where('shopId', $shopId)->update(['associateId'=>$assocId]);
        $shopAssoInfo = DorponAssociate::where('status', 1)->pluck('name', 'id')->all();
        return response()->json($shopAssoInfo);
    }

    public function shopZoneChanege(Request $request){

    }

    public function dorponPersentChanege($persent, $shopId){
        if($persent == 0){
            $persent = Null;
        }
        ShopDetails::where('shopId', $shopId)->update(['dorponPersent'=>$persent]);
        return;
    }
    public function shopQualityChange($check, $shopId){
        ShopDetails::where('shopId', $shopId)->update(['qtyCheck'=>$check]);
        return;
    }
    public function shopPickUpChange($check, $shopId){
        ShopDetails::where('shopId', $shopId)->update(['pickUpStatus'=>$check]);
        return;
    }
    public function shopPublicationChange($check, $shopId){
        ShopDetails::where('shopId', $shopId)->update(['publicationCheck'=>$check]);
        return;
    }

    public function featureShopStatus($check, $shopId){
        if(ShopDetails::where('shopDetailsTwo', 1)->count() < 3){
            ShopDetails::where('shopId', $shopId)->update(['shopDetailsTwo'=>$check]);
            $message[0]= 0;
            return response()->json($message);
        }
        $message[0]= 1;
        return response()->json($message);

    }

    public function featureArtisanStatus($check, $shopId){
        ShopDetails::where('shopId', $shopId)->update(['shopDetailsOne'=>$check]);
        return;
    }

    public function productPriceCount(Request $request){

        if($request->shopId == 0){

            if(isset($request->sellPrice) && isset($request->discount)){

                $qtyCheckCost = 25;
                $finalPrice = $request->sellPrice*(1-$request->discount /100) -$qtyCheckCost ;

                $data['finalPrice']=round($finalPrice);
                return response()->json($data);

            }else if(isset($request->sellPrice)){
                $qtyCheckCost = 25;
                $finalPrice = $request->sellPrice-$qtyCheckCost;
                $data['finalPrice']=round($finalPrice);
                return response()->json($data);
            }
        }else{

            $shopInfo = ShopDetails::where('shopId', $request->shopId)->select('dorponPersent','pickUpStatus','shopAreaType','associateId','qtyCheck')->first();

            $pickUpCost = 0;
            if($shopInfo->pickUpStatus !=0 ){
                $pickUpCost =ProductTransport::where('id',$shopInfo->shopAreaType)->value('price');
            }
            $assoPersent = 0;
            if($shopInfo->associateId != null){
                $assoPersent =DorponAssociate::where('id', $shopInfo->associateId)->value('assocPersent');
            }
            $qtyCheckCost = 25;
            if($shopInfo->qtyCheck == 0){
                $qtyCheckCost = 0;
            }

            $data = array();
            if(isset($request->sellPrice) && isset($request->discount)){

                $finalPrice = $request->sellPrice*(1-$request->discount /100);

                $artisanPrice =$finalPrice- $finalPrice*($shopInfo->dorponPersent /100) - $finalPrice*($assoPersent/100)-$qtyCheckCost -$pickUpCost;
                $data['finalPrice']=round($finalPrice);
                $data['costPrice']=round($artisanPrice);
                return response()->json($data);

            }else if(isset($request->sellPrice)){
                $finalPrice = $request->sellPrice;

                $artisanPrice =$finalPrice- $finalPrice*($shopInfo->dorponPersent /100) - $finalPrice*($assoPersent/100)-$qtyCheckCost -$pickUpCost;
                $data['finalPrice']=round($finalPrice);
                $data['costPrice']=round($artisanPrice);
                return response()->json($data);
            }
        }
    }

    public function shopFind(){
        $shopList = Shop::where('status',1)->pluck('shopName', 'id')->all();
        return response()->json($shopList);
    }

    public function suplierFind(){
        $shopList = DorponSupplyer::where('status',1)->pluck('supplier', 'id')->all();
        return response()->json($shopList);
    }

    public function districtList($divId)
    {
        $allDistricts = TransportLocation::where('divisionId', $divId)->whereNull('districtId')->select("areaName","id")->get();
        $districts = array_values(array_sort($allDistricts, function ($value) {
            return $value['areaName'];
        }));
        return Response()->json($districts);
    }

    public function areaList($divId, $disId)
    {
        $allAreaList = TransportLocation::where('divisionId', $divId)->where('districtId', $disId)->select("areaName","id")->get();
        $areaList = array_values(array_sort($allAreaList, function ($value) {
            return $value;
        }));
        return Response()->json($areaList);
    }
}
