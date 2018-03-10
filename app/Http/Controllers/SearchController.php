<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShopFavourite;
use App\ShopDetails;
use App\OrderDetail;
use App\Category;
use App\Product;
use App\Shop;
use Session;
use Auth;
use DB;


class SearchController extends Controller
{

    public function search(Request $request){

        $searchProducts = Product::search($request->search)->get();
        return view('frontEnd.includes.searchResult',['searchProducts'=>$searchProducts]);
    }




    public function SearchByProductName(Request $request)
    {
        if(!is_null($request->productName)){
            $productsInfos = Product::where('productName','LIKE', '%'.$request->productName.'%')->where('publicationStatus', 1)->paginate(15);
            Session::put('productsInfos', $productsInfos);
            return redirect()->route('productName.search.result');
        }else{
            return redirect()->back();
        }
    }

    public function SearchByProductNameResult()
    {
        $products = Session::get('productsInfos');
        $categoryId = Category::where('publicationStatus', 1)->select('id')->orderBy('position', 'asc')->first();
        $categorise = Category::where('publicationStatus', 1)->where('parentsId', NULL)->select('id', 'categoryName','parentsId')->orderBy('position', 'asc')->get();
        $shops = Shop::select('id', 'shopName')->get();
        $siteMap=8;
        return view('frontEnd.products.viewProductContent',['siteMap'=>$siteMap,'categoryId'=>$categoryId,'products'=>$products, 'categorise'=>$categorise, 'shops'=>$shops]);

    }

    public function productSearch(Request $request )
    {  
        $sizeValue = $request->sizeValue;
        $size = $this->selectSize($sizeValue);
        //chack has depertment Id and payment Id
        if (strlen($request->categoryId)>'0' && strlen($request->shopId)>'0') {
             //if has both of then
            if (is_null($sizeValue)) {
                $productsInfos =DB::table('products')
                    ->join('categories', 'products.categoryId', '=', 'categories.id')
                    ->join('shops', 'products.uploderId', '=', 'shops.id')
                    ->join('product_overviews', 'products.id', '=', 'product_overviews.id')
                    ->select('products.*', 'categories.categoryName', 'shops.shopName')
                    ->where('products.categoryId',$request->categoryId )
                    ->orWhere('products.uploderId', $request->shopId)
                    ->orderBy('id', 'desc')
                    ->paginate(15);
            } else {
                $productsInfos =DB::table('products')
                    ->join('categories', 'products.categoryId', '=', 'categories.id')
                    ->join('shops', 'products.uploderId', '=', 'shops.id')
                    ->join('product_overviews', 'products.id', '=', 'product_overviews.id')
                    ->select('products.*', 'categories.categoryName', 'shops.shopName')
                    ->where('products.categoryId',$request->categoryId )
                    ->orWhere('products.uploderId', $request->shopId)
                    ->where('product_overviews.$size->colName', $size->value)
                    ->orderBy('id', 'desc')
                    ->paginate(15);
            }
            
            
        
        }elseif (strlen($request->categoryId)>'0' && strlen($request->shopId) =='0') {
            
            if (is_null($sizeValue)) {
                $productsInfos =DB::table('products')
                    ->join('categories', 'products.categoryId', '=', 'categories.id')
                    ->join('shops', 'products.uploderId', '=', 'shops.id')
                    ->select('products.*', 'categories.categoryName', 'shops.shopName')
                    ->where('categories.id',$request->categoryId )
                    ->orderBy('id', 'desc')
                    ->paginate(20);
            } else {
                $productsInfos =DB::table('products')
                    ->join('categories', 'products.categoryId', '=', 'categories.id')
                    ->join('shops', 'products.uploderId', '=', 'shops.id')
                    ->select('products.*', 'categories.categoryName', 'shops.shopName')
                    ->where('categories.id',$request->categoryId )
                    ->where('product_overviews.$size->colName', $size->value)
                    ->orderBy('id', 'desc')
                    ->paginate(20);
            }
            
            

        }elseif (strlen($request->categoryId)=='0' && strlen($request->shopId)>'0') {
            
            if (is_null($sizeValue)) {
                $productsInfos =DB::table('products')
                    ->join('categories', 'products.categoryId', '=', 'categories.id')
                    ->join('shops', 'products.uploderId', '=', 'shops.id')
                    ->select('products.*', 'categories.categoryName', 'shops.shopName')
                    ->where('products.UploderType',0 )
                    ->where('products.uploderId', $request->shopId)
                    ->orderBy('id', 'desc')
                    ->paginate(20);
            } else {
                $productsInfos =DB::table('products')
                    ->join('categories', 'products.categoryId', '=', 'categories.id')
                    ->join('shops', 'products.uploderId', '=', 'shops.id')
                    ->select('products.*', 'categories.categoryName', 'shops.shopName')
                    ->where('products.UploderType',0 )
                    ->where('products.uploderId', $request->shopId)
                    ->where('product_overviews.$size->colName', $size->value)
                    ->orderBy('id', 'desc')
                    ->paginate(20);
            }
            
            

        }else {
            return redirect()->back()->with('unsuccess','First Select atlest One Search Option ');
        }

        Session::put('productsInfos', $productsInfos);
        return redirect()->route('consumer.product.search.result');
    }

    private function selectSize( $sizeValue )
    {   
        $size = array();

        if($sizeValue =='1'){ $size['colName']='small'; $size['value']='1'; return $size; }
        if($sizeValue =='2'){ $size['colName']='mediam'; $size['value']='2'; return $size; }
        if($sizeValue =='3'){ $size['colName']='large'; $size['value']='3'; return $size; }
        if($sizeValue =='4'){ $size['colName']='mLarge'; $size['value']='4'; return $size; }
        if($sizeValue =='5'){ $size['colName']='eLarge'; $size['value']='5'; return $size; }
        if($sizeValue =='6'){ $size['colName']='allSize'; $size['value']='6'; return $size; }
        else{ $size['colName']='allSize'; $size['value']='6'; return $size;  }
    }

    public function productSearchResult()
    {
        $products = Session::get('productsInfos');
        $categoryId = Category::where('publicationStatus', 1)->select('id')->orderBy('position', 'asc')->first();
        $categorise = Category::where('publicationStatus', 1)->where('parentsId', NULL)->select('id', 'categoryName','parentsId')->orderBy('position', 'asc')->get();
        $shops = Shop::select('id', 'shopName')->get();
        $siteMap=8;
        return view('frontEnd.products.viewProductContent',['siteMap'=>$siteMap,'categoryId'=>$categoryId,'products'=>$products, 'categorise'=>$categorise, 'shops'=>$shops]);

    }


    public function adminProductSearch(Request $request )
    {
        //chack has depertment Id and payment Id
        if (strlen($request->categoryId)<'3' && strlen($request->shopId)<'3') {
             //if has both of then
            $productsInfos =DB::table('products')
                ->join('categories', 'products.categoryId', '=', 'categories.id')
                ->join('shops', 'products.uploderId', '=', 'shops.id')
                ->select('products.*', 'categories.categoryName', 'shops.shopName')
                ->where('products.UploderType',0 )
                ->where('products.categoryId',$request->categoryId )
                ->orWhere('products.uploderId', $request->shopId)
                ->orderBy('id', 'desc')
                ->paginate(15);
        
        }elseif (strlen($request->categoryId)<'3' && strlen($request->shopId) > '3') {
            
            $productsInfos =DB::table('products')
                ->join('categories', 'products.categoryId', '=', 'categories.id')
                ->join('shops', 'products.uploderId', '=', 'shops.id')
                ->select('products.*', 'categories.categoryName', 'shops.shopName')
                ->where('products.UploderType',0 )
                ->where('categories.id',$request->categoryId )
                ->orderBy('id', 'desc')
                ->paginate(20);



        }elseif (strlen($request->categoryId)>'3' && strlen($request->shopId)<'3') {
            
            $productsInfos =DB::table('products')
                ->join('categories', 'products.categoryId', '=', 'categories.id')
                ->join('shops', 'products.uploderId', '=', 'shops.id')
                ->select('products.*', 'categories.categoryName', 'shops.shopName')
                ->where('products.UploderType',0 )
                ->where('products.uploderId', $request->shopId)
                ->orderBy('id', 'desc')
                ->paginate(20);

        }else {
            return redirect()->back()->with('unsuccess','First Select atlest One Search Option ');
        }


        return redirect()->route('admin.product.search.result')->with('productsInfos', $productsInfos);

    }

    public function adminProductSearchResult()
    {
        $productsInfos = Session::get('productsInfos');
        $categories= Category::where('publicationStatus', 1)->select('id','categoryName')->get();
        $shops= Shop::select('id', 'shopName')->get();
        return view('admin.Product.manageProductContent',['categories'=>$categories,'shops'=>$shops,'productsInfos'=>$productsInfos]);
    }



    public function shopProductSearch(Request $request)
    {
        if (!is_null($request->productName)) {
            $products = Product::where('productName','LIKE', '%'.$request->productName.'%')->where('uploderId', Auth::user()->shopId)->where('UploderType', 0)->paginate(15);
            
            if(is_null($products) || empty($products) || count($products)==0){
                return redirect()->back()->with('unsuccess', 'No Product Found In '. $request->productName.' This Name...!');
            }
            return redirect()->route('shop.search.result')->with('products', $products);
        } else {
            return redirect()->back()->with('unsuccess', 'Please Insert A Product Name First...!');
        }
        
    }


    public function shopProductSearchResult()
    {   
        $categories = Category::where('publicationStatus', 1)->where('parentsId', NULL)->get();
        $products = Session::get('products');
        $shopInfo = Shop::where('id', Auth::user()->shopId)->select('shopName', 'shopLogo','webAddress', 'created_at')->first();
        $shopDetails = ShopDetails::where('ownerId', Auth::user()->shopId)->where('ownerType', 0)->first();
        $totalItem = Product::where('uploderId', Auth::user()->shopId)->get();
        $productsReviews = DB::table('product_reviews_comments')
                        ->join('products', 'product_reviews_comments.productId', '=','products.id')
                        ->select('product_reviews_comments.*','products.productName')
                        ->where('product_reviews_comments.uploderId', Auth::user()->shopId)
                        ->where('product_reviews_comments.UploderType',0)
                        ->orderBy('product_reviews_comments.id', 'desc')
                        ->paginate(4);

       $totalLike = ShopFavourite::where('shopId', Auth::user()->shopId)->get();
        $totalSales = OrderDetail::where('uploderId', Auth::user()->shopId)->where('uploderType', 0)->select('id')->get();
        $siteMap =8;
        return view('frontEnd.shops.dashboard.merchantileDashboardContent', ['siteMap'=>$siteMap ,'shopInfo'=>$shopInfo, 'shopDetails'=>$shopDetails, 'categories'=>$categories,
            'totalItem'=>$totalItem, 'products'=>$products,'productsReviews'=> $productsReviews, 'totalLike'=>$totalLike, 'totalSales'=>$totalSales]);
    
    }

    public function categorySearch(Request $request)
    {
        if (!is_null($request->categoryId)) {
            $categoryId = $request->categoryId;
            $products = Product::where('categoryId', $categoryId )->where('UploderType', '0')->where('uploderId', Auth::User()->shopId)->paginate(15);
            if(is_null($products) || empty($products) || count($products)==0){
                return redirect()->back()->with('unsuccess', 'No Product Found In This Category...!');
            }
            return redirect()->route('category.search.result')->with('products', $products);
        } else {
            return redirect()->back()->with('unsuccess', 'Please Select A Product Category First...!');
        }
        
    }

    public function categorySearchResult()
    {   
        $products = Session::get('products');
        $categories = Category::where('publicationStatus', 1)->where('parentsId', NULL)->get();
        $shopInfo = Shop::where('id', Auth::user()->shopId)->select('shopName', 'shopLogo','webAddress', 'created_at')->first();
        $shopDetails = ShopDetails::where('ownerId', Auth::user()->shopId)->where('ownerType', 0)->first();
        $totalItem = Product::where('uploderId', Auth::user()->shopId)->get();
        $productsReviews = DB::table('product_reviews_comments')
                        ->join('products', 'product_reviews_comments.productId', '=','products.id')
                        ->select('product_reviews_comments.*','products.productName')
                        ->where('product_reviews_comments.uploderId', Auth::user()->shopId)
                        ->where('product_reviews_comments.UploderType',0)
                        ->orderBy('product_reviews_comments.id', 'desc')
                        ->paginate(4);

        $totalLike = ShopFavourite::where('shopId', Auth::user()->shopId)->get();
        $totalSales = OrderDetail::where('uploderId', Auth::user()->shopId)->where('uploderType', 0)->select('id')->get();
        $siteMap=8;
        return view('frontEnd.shops.dashboard.merchantileDashboardContent', ['siteMap'=>$siteMap,'shopInfo'=>$shopInfo, 'shopDetails'=>$shopDetails, 'categories'=>$categories,
            'totalItem'=>$totalItem, 'products'=>$products,'productsReviews'=> $productsReviews, 'totalLike'=>$totalLike, 'totalSales'=>$totalSales]);
    
    }
}
