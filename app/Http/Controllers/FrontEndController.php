<?php

namespace App\Http\Controllers;
use App\PrimaryColor;
use App\ShopAddress;
use Illuminate\Http\Request;
use App\ProductReviewsComment;
use App\ProductFavourite;
use App\ConsumerQuestion;
use App\ProductOverview;
use App\ProductQuentity;
use App\ShopFavourite;
use App\ProductImage;
use App\Menufacture;
use App\Merchantile;
use App\ShopDetails;
use App\OrderDetail;
use App\Category;
use App\GiftType;
use App\Product;
use App\Slider;
use App\Shop;
use Auth;
use DB;



class FrontEndController extends Controller
{


    public function index(){

        $mainCategories = Category::where('mainCatId',Null)->where('publicationStatus',1)->orderBy('position', 'asc')->take(4)->get();

        $slidersInfo = Slider::where('publicationStatus', 1)->orderBy('id', 'desc')->get();
        $giftTypeInfos = GiftType::where('publicationStatus', 1)->orderBy('position', 'asc')->get();
        $featureArtisans =DB::table('merchantile_infos')->join('shop_details', 'merchantile_infos.shopId', '=', 'shop_details.shopId')->join('shops', 'merchantile_infos.shopId', '=', 'shops.id')->select('merchantile_infos.name','merchantile_infos.avater','shops.id','shop_details.shopDetailsFour','shops.created_at')->where('shops.status',1)->where('shop_details.shopDetailsOne', 1)->where('merchantile_infos.authority', 1)->latest()->get();
        $featureProducts= Product::where('status', 1)->where('feature', 1)->select('id','productName', 'finalPrice', 'ownerId', 'thumbImage')->take(12)->get();
        $reviewsComments = DB::table('product_reviews_comments')
                        ->join('users', 'product_reviews_comments.userId', '=','users.id')
                        ->select('product_reviews_comments.id','product_reviews_comments.productId','product_reviews_comments.comment','users.name','users.avater')
                        ->orderBy('product_reviews_comments.id', 'desc')
                        ->get();
        


        return view('frontEnd.home.homeContent', ['mainCategories'=>$mainCategories,'slidersInfo'=>$slidersInfo,
            'featureProducts'=>$featureProducts,'giftTypeInfos'=>$giftTypeInfos,'featureArtisans'=>$featureArtisans, 'reviewsComments'=>$reviewsComments]);
    }

    public function categoryProducts(Request $request, $id){

        if($request->ajax()){
            $productCollection = Product::orWhere('mainCatId',$id)->orWhere('secondCatId',$id)->orWhere('thirdCatId',$id)->select('id', 'ownerId', 'productName', 'finalPrice', 'sellPrice','discount','ownerId', 'status', 'thumbImage', 'priColorId')->latest()->get();
            $colorResult = $productCollection;
            if(isset($request->colors)){

                $colors = explode(',', $request->colors);
                $colorResult = $productCollection->map(function($value, $key) use ($colors){

                    $primaryColor = explode(',', $value->priColorId);
                    foreach ($colors as $color) {

                        if(in_array($color,$primaryColor )){
                            return $value;
                        }
                    }
                })->reject( function($value){
                    return is_null($value);
                });

            }

            $shopShortResult = $colorResult;
            if(isset($request->shopIds)){
                $shopIdArray = explode(',',$request->shopIds );
                $shopShortResult = $productCollection->whereIn('ownerId', $shopIdArray);

            }

            $discountSortResult = $shopShortResult;
            if($request->discount){
                $discountSortResult = $shopShortResult->where('discount' ,'!=', Null);
            }

            $priceRange = $discountSortResult;
            if(isset($request->start) && isset($request->end)){
                $priceRange = $discountSortResult->where('finalPrice','>=',$request->start)->where('finalPrice','<=', $request->end);
            }

            $products = $priceRange->filter(function ($value, $key){
                return $value->status == 1;
            });

             return view('frontEnd.products.productsContent',['products'=>$products]);

        }else{
            $productCollection = Product::orWhere('mainCatId',$id)->orWhere('secondCatId',$id)->orWhere('thirdCatId',$id)->select('id', 'ownerId', 'productName', 'finalPrice', 'sellPrice','discount','ownerId', 'status', 'thumbImage','priColorId')->get();
            $products = $productCollection->filter(function ($value, $key){
                return $value->status == 1;
            });

            
            $colorArray = $products->pluck('priColorId');
            $colors = $this->productColorFind($colorArray);

            $ownerArray = $products->pluck('ownerId');
            $sellerList = $this->productOwnerFind($ownerArray);

            return view('frontEnd.products.viewProductContent',['products'=>$products,'sellerList'=>$sellerList,'colors'=>$colors]);
        }



    }


    public function allProducts(Request $request){

        if($request->ajax()){
            $productCollection = Product::where('status', 1)->select('id', 'ownerId', 'productName', 'finalPrice','priColorId', 'sellPrice','discount', 'thumbImage','status')->latest()->get();
            $colorResult = $productCollection;
            if(isset($request->colors)){

                $colors = explode(',', $request->colors);
                $colorResult = $productCollection->map(function($value, $key) use ($colors){

                    $primaryColor = explode(',', $value->priColorId);
                    foreach ($colors as $color) {

                        if(in_array($color,$primaryColor )){
                            return $value;
                        }
                    }
                })->reject( function($value){
                    return is_null($value);
                });

            }

            $shopShortResult = $colorResult;
            if(isset($request->shopIds)){
                $shopIdArray = explode(',',$request->shopIds );
                $shopShortResult = $productCollection->whereIn('ownerId', $shopIdArray);

            }

            $discountSortResult = $shopShortResult;
            if($request->discount){
                $discountSortResult = $shopShortResult->whereNotNull('discount');
            }

            $priceRange = $discountSortResult;
            if(isset($request->start) && isset($request->end)){
                $priceRange = $discountSortResult->whereIn('finalPrice',[$request->start , $request->end]);
            }

            $products = $priceRange->filter(function ($value, $key){
                return $value->status == 1;
            });

            return view('frontEnd.products.productsContent',['products'=>$products]);

        }else{
            $productCollection = Product::where('status', 1)->select('id', 'ownerId', 'productName', 'finalPrice', 'sellPrice','discount', 'thumbImage','status')->latest()->get();
            $products = $productCollection->filter(function ($value, $key){
                return $value->status == 1;
            });
            $colorArray = $products->pluck('priColorId');
            $colors = $this->productColorFind($colorArray);

            $ownerArray = $products->pluck('ownerId');
            $sellerList = $this->productOwnerFind($ownerArray);

            return view('frontEnd.products.viewProductContent',['products'=>$products,'sellerList'=>$sellerList,'colors'=>$colors]);
        }


    }

    public function featureProducts(Request $request)
    {

        if($request->ajax()){
            $productCollection= Product::where('status', 1)->where('feature', 1)->select('id','productName','priColorId', 'finalPrice', 'ownerId', 'thumbImage','status')->latest()->get();
            
            $colorResult = $productCollection;
            if(isset($request->colors)){

                $colors = explode(',', $request->colors);
                $colorResult = $productCollection->map(function($value, $key) use ($colors){

                    $primaryColor = explode(',', $value->priColorId);
                    foreach ($colors as $color) {

                        if(in_array($color,$primaryColor )){
                            return $value;
                        }
                    }
                })->reject( function($value){
                    return is_null($value);
                });

            }

            $shopShortResult = $colorResult;
            if(isset($request->shopIds)){
                $shopIdArray = explode(',',$request->shopIds );
                $shopShortResult = $productCollection->whereIn('ownerId', $shopIdArray);

            }

            $discountSortResult = $shopShortResult;
            if($request->discount){
                $discountSortResult = $shopShortResult->whereNotNull('discount');
            }

            $priceRange = $discountSortResult;
            if(isset($request->start) && isset($request->end)){
                $priceRange = $discountSortResult->whereIn('finalPrice',[$request->start , $request->end]);
            }

            $products = $priceRange->filter(function ($value, $key){
                return $value->status == 1;
            });

            return view('frontEnd.products.productsContent',['products'=>$products]);

        }else{
            $productCollection= Product::where('status', 1)->where('feature', 1)->select('id','productName', 'finalPrice', 'ownerId', 'thumbImage','status')->latest()->get();
            $products = $productCollection->filter(function ($value, $key){
                return $value->status == 1;
            });
            $colorArray = $products->pluck('priColorId');
            $colors = $this->productColorFind($colorArray);

            $ownerArray = $products->pluck('ownerId');
            $sellerList = $this->productOwnerFind($ownerArray);

            return view('frontEnd.products.viewProductContent',['products'=>$products,'sellerList'=>$sellerList,'colors'=>$colors]);
        }


    }

    public function giftTypeIdProducts(Request $request, $giftId)
    {
        if($request->ajax()){
            $giftShortResult= Product::where('status', 1)->where('giftTypeId',"LIKE", "%" .$giftId. "%")->pluck('giftTypeId', 'id')->get();;
            $productCollection = collect($giftShortResult)->map(function ($value, $key) use ($giftId){

                $giftProductArray = explode(',', $value);
                if(in_array($giftId, $giftProductArray)){
                    return Product::where('id', $key)->select('id', 'ownerId', 'productName', 'finalPrice', 'sellPrice','discount','ownerId', 'thumbImage','priColorId')->first();
                }
            })->reject( function($value){
                return is_null($value);
            });

            $colorResult = $productCollection;
            if(isset($request->colors)){

                $colors = explode(',', $request->colors);
                $colorResult = $productCollection->map(function($value, $key) use ($colors){

                    $primaryColor = explode(',', $value->priColorId);
                    foreach ($colors as $color) {

                        if(in_array($color,$primaryColor )){
                            return $value;
                        }
                    }
                })->reject( function($value){
                    return is_null($value);
                });

            }

            $shopShortResult = $colorResult;
            if(isset($request->shopIds)){
                $shopIdArray = explode(',',$request->shopIds );
                $shopShortResult = $productCollection->whereIn('ownerId', $shopIdArray);

            }

            $discountSortResult = $shopShortResult;
            if($request->discount){
                $discountSortResult = $shopShortResult->whereNotNull ('discount');
            }

            $priceRange = $discountSortResult;
            if(isset($request->start) && isset($request->end)){
                $priceRange = $discountSortResult->whereIn('finalPrice',[$request->start , $request->end]);
            }

            $products = $priceRange->filter(function ($value, $key){
                return $value->status == 1;
            });

            return view('frontEnd.products.productsContent',['products'=>$products]);

        }else{
            $productCollection= Product::where('status', 1)->where('giftTypeId',"LIKE", "%" .$giftId. "%")->pluck('giftTypeId', 'id')->get();;
            $products = collect($productCollection)->map(function ($value, $key) use ($giftId){

                $giftProductArray = explode(',', $value);
                if(in_array($giftId, $giftProductArray)){
                    return Product::where('id', $key)->select('id', 'ownerId', 'productName', 'finalPrice', 'sellPrice','discount','ownerId', 'thumbImage')->first();
                }
            })->reject( function($value){
                return is_null($value);
            });

            $colorArray = $products->pluck('priColorId');
            $colors = $this->productColorFind($colorArray);

            $ownerArray = $products->pluck('ownerId');
            $sellerList = $this->productOwnerFind($ownerArray);

            return view('frontEnd.products.viewProductContent',['products'=>$products,'sellerList'=>$sellerList,'colors'=>$colors]);
        }


    }

    public function allGiftProducts(Request $request)
    {
        if($request->ajax()){
            $productCollection= Product::where('status', 1)->whereNotNull('giftTypeId')->select('id','productName', 'finalPrice', 'ownerId', 'thumbImage','status')->latest()->get();
            $colorResult = $productCollection;
            if(isset($request->colors)){

                $colors = explode(',', $request->colors);
                $colorResult = $productCollection->map(function($value, $key) use ($colors){

                    $primaryColor = explode(',', $value->priColorId);
                    foreach ($colors as $color) {

                        if(in_array($color,$primaryColor )){
                            return $value;
                        }
                    }
                })->reject( function($value){
                    return is_null($value);
                });

            }

            $shopShortResult = $colorResult;
            if(isset($request->shopIds)){
                $shopIdArray = explode(',',$request->shopIds );
                $shopShortResult = $productCollection->whereIn('ownerId', $shopIdArray);

            }

            $discountSortResult = $shopShortResult;
            if($request->discount){
                $discountSortResult = $shopShortResult->whereNotNull ('discount');
            }

            $priceRange = $discountSortResult;
            if(isset($request->start) && isset($request->end)){
                $priceRange = $discountSortResult->whereIn('finalPrice',[$request->start , $request->end]);
            }

            $products = $priceRange->filter(function ($value, $key){
                return $value->status == 1;
            });

            return view('frontEnd.products.productsContent',['products'=>$products]);

        }else{

            $products= Product::where('status', 1)->whereNotNull('giftTypeId')->select('id','productName', 'finalPrice', 'ownerId', 'thumbImage','status')->latest()->get();

            $colorArray = $products->pluck('priColorId');
            $colors = $this->productColorFind($colorArray);

            $ownerArray = $products->pluck('ownerId');
            $sellerList = $this->productOwnerFind($ownerArray);

            return view('frontEnd.products.viewProductContent',['products'=>$products,'sellerList'=>$sellerList,'colors'=>$colors]);
        }

    }

    public function singelProduct($id , Request $request)
    {
        if($request->ajax()){
            if(isset($request->sizeId)){
                $productQty = ProductQuentity::where('productId', $id)->where('sizeId', $request->sizeId)->select('quantity', 'sizeId')->first();
                return response()->json($productQty);
            }
            if(isset($request->rating)){
                if(Auth::guard('web')->check()){
                    $product = Product::find($id);

                    $rating = new \willvincent\Rateable\Rating;
                    $rating->rating = $request->rating;
                    $rating->user_id = Auth::User()->id;

                    $product->ratings()->save($rating);
                    return response()->json(1);
                }
                return response()->json(0);

            }

        }else{
            $singelProduct = Product::where('id', $id)->first();
            $productImages =ProductImage::where('productId', $id)->get();
            $shopLatestProducts = Product::where('status', 1)->where('ownerId', $singelProduct->ownerId)->select('id', 'productName','thumbImage')->latest()->take(5)->get();
            $reviews = ProductReviewsComment::where('productId', $id)->get();
            $questions = ConsumerQuestion::where('productId', $id)->get();
            $productSizes = ProductQuentity::where('productId', $id)->where('quantity','>', 0)->get();
            $fvrtCount = ProductFavourite::where('productId', $id)->count();
            $colorIds = explode(',', $singelProduct->priColorId);
            $primaryColors = PrimaryColor::whereIn('id', $colorIds)->select('id', 'colorName', 'colorCode')->get();
            $relatedProducts = Product::where('status', 1)->orWhere('mainCatId', $singelProduct->mainCatId)->orWhere('secondCatId', $singelProduct->secondCatId)->orWhere('thirdCatId', $singelProduct->thirdCatId)->select('id', 'productName', 'ownerId', 'finalPrice', 'thumbImage')->take(20)->get();


            $shopBestProducts = Product::where('status', 1)->where('ownerId', $singelProduct->ownerId)->select('id', 'productName','thumbImage','finalPrice')->latest()->take(6)->get();

            return view('frontEnd.products.singelProductContent',['singelProduct'=>$singelProduct, 'productImages'=>$productImages,'shopLatestProducts'=>$shopLatestProducts,'reviews'=>$reviews,
                'questions'=>$questions,'productSizes'=>$productSizes, 'fvrtCount'=>$fvrtCount,'primaryColors'=>$primaryColors, 'relatedProducts'=>$relatedProducts, 'shopBestProducts'=>$shopBestProducts]);
        }

    }

    public function viewShop($id, Request $request)
    {

        if($request->ajax() && isset($request->rating)){
            if(Auth::guard('web')->check()){
                $shop = Shop::find($id);

                $rating = new \willvincent\Rateable\Rating;
                $rating->rating = $request->rating;
                $rating->user_id = Auth::User()->id;

                $shop->ratings()->save($rating);
                return response()->json(1);
            }
            return response()->json(0);

        }

        $shopInfo = Shop::where('id', $id)->select('id','shopName', 'shopLogo','shopViewId','created_at')->first();
        $shopDetails = ShopDetails::where('shopId', $id)->select('aboutShop','bannerImage')->first();
        $shopAddress = ShopAddress::where('shopId', $id)->select('areaId','districtId','divisionId')->first();
        $allUserId = ShopFavourite::where('shopId', $id)->value('userId');
        $userIds = explode(",", $allUserId);
        $totalProducts = Product::where('ownerId', $id)->count();
        $products = Product::where('ownerId', $id)->where('status', 1)->select('id','mainCatId', 'productName', 'finalPrice', 'sellPrice','discount', 'thumbImage')->latest()->paginate(224);
        $totalSales = OrderDetail::where('ownerId', $id)->count();
        $ownerInfo = Merchantile::where('shopId', $id)->where('authority', 1)->select('id','avater','name')->first();
        $totalSalesAmount = OrderDetail::where('ownerId', $id)->sum('subTotal');
        return view('frontEnd.shopView.viewShopsContent', ['shopId'=>$id,'shopInfo'=>$shopInfo,'shopDetails'=>$shopDetails,'shopAddress'=>$shopAddress,
            'totalProducts'=>$totalProducts, 'products'=>$products,'ownerInfo'=>$ownerInfo,
            'totalSales'=>$totalSales, 'totalSalesAmount'=>$totalSalesAmount, 'userIds'=>$userIds]);
    }

    public function productFavourite($productId, $action)
    {
        if($action==0){

            $cheackFvrt = ProductFavourite:: where('productId', $productId)->first();

            if (is_null($cheackFvrt)) {

                //not Exits than save new 
                $favourite = New ProductFavourite;
                $favourite->userId = Auth::User()->id.',';
                $favourite->productId = $productId;
                $favourite->save();

            }elseif (empty($cheackFvrt->userId)) {
                $userId = Auth::user()->id.",";
                $saveFvrt = ProductFavourite::find($cheackFvrt->id);
                $saveFvrt->userId = $userId;
                $saveFvrt->save();
            }else{
                //take all user id
                $userIds = $cheackFvrt->userId;
                //concrite with new user id
                $userId = $userIds. ','.Auth::User()->id;

                //now save 
                $saveFvrt = ProductFavourite::find($cheackFvrt->id);
                $saveFvrt->userId = $userId;
                $saveFvrt->save();
            }
        }
        else{

            $current_user = Auth::User()->id;

            //find where fvrt id is match take all user Id
             $userIds = ProductFavourite::where('productId', $productId)->select('id','userId')->first(); 
            //make userId string to array
            $userIdArray = explode(',', $userIds->userId);
            $dlt_fvrt = array_diff($userIdArray, array($current_user)); //delete user id where match with id
            $current_fvrt_list = implode(',', $dlt_fvrt); // again convert arry to string

            //now save update data 
            $frvt_update = ProductFavourite::find($userIds->id);
            $frvt_update->userId = $current_fvrt_list;
            $frvt_update->save();
            
            
        }

        return redirect()->back();
    }

    public function shopFavourite($shopId, $action)
    {   
        $shopfvrt = ShopFavourite::where('shopId', $shopId)->first();
        if($action==0){

            if (is_null($shopfvrt)) {

                //not Exits than save new 
                $favourite = New ShopFavourite;
                $favourite->userId = Auth::User()->id.',';
                $favourite->shopId = $shopId;
                $favourite->save();

            }elseif (empty($shopfvrt->userId)) {
                $userId = Auth::user()->id.",";
                $saveFvrt = ShopFavourite::find($shopfvrt->id);
                $saveFvrt->userId = $userId;
                $saveFvrt->save();
            }else{
                //take all user id
                $userIds = $shopfvrt->userId;
                //concrite with new user id
                $userId = $userIds. ','.Auth::User()->id;

                //now save 
                $saveFvrt = ShopFavourite::find($shopfvrt->id);
                $saveFvrt->userId = $userId;
                $saveFvrt->save();
            }
        }
        else{

            $current_user = Auth::User()->id;
            //make userId string to array
            $userIdArray = explode(',', $shopfvrt->userId);
            $dlt_fvrt = array_diff($userIdArray, array($current_user)); //delete user id where match with id
            $current_fvrt_list = implode(',', $dlt_fvrt); // again convert arry to string

            //now save update data 
            $frvt_update = ShopFavourite::find($shopfvrt->id);
            $frvt_update->userId = $current_fvrt_list;
            $frvt_update->save();
        }

        return redirect()->back();
    }

    public function aboutDorpon($page){

        return view('frontEnd.pages.aboutDorpon',['page'=>$page]);
    }

    public function helpCenter($page){

        return view('frontEnd.pages.helpCenter',['page'=>$page]);
    }

    private function productOwnerFind($ownerArray){
        $selerId = array();
        $k=0;
        for($i=0; $i<count($ownerArray); $i++){
            if(!in_array($ownerArray[$i],$selerId)){
                $selerId[$k++]=$ownerArray[$i];
            }
        }
        return Shop::where('status', 1)->whereIn('id',$selerId)->pluck('shopName', 'id')->all();
    }

    private function productColorFind($colorArray){
        $colorId = array();
        $k=0;
        for($i=0; $i<count($colorArray); $i++){
            $color = explode(',',$colorArray[$i]);

            for($j=0; $j<count($color); $j++){

                if(!in_array($color[$j],$colorId)){
                    $colorId[$k++]=$color[$j];
                }
            }

        }
        return PrimaryColor::whereIn('id',$colorId)->get();
    }
}
