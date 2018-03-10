<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\ShopFavourite;
use App\Category;
use App\Product;
use App\Shop;
use App\Admin;
use App\User;
use App\PrimaryColor;
use App\logo;
use Auth;
use Session;
use DB;
use Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view::composer('frontEnd.includes.headerContent', function($view){
            $logo = logo::where('publicationStatus', 1)->orderBy('id','dese')->first();
            $mainCatrories=Category::where('mainCatId', null)->where('publicationStatus', 1)->orderBy('position', 'asc')->get();
            $cartProducts = null;
            if(Cart::content()){
                $cartProducts = Cart::content();
            }

            $view->with('logo', $logo)
                ->with('cartProducts', $cartProducts)
                ->with('mainCatrories', $mainCatrories);
        });

        view::composer('emailsTemplate.*', function($view){
            $logo = logo::where('publicationStatus', 1)->value('logo');

            $view->with('logo', $logo);
        });


        view::composer('frontEnd.includes.footerContent', function($view){
            $featureShops =DB::table('shops')->join('shop_details','shops.id','=','shop_details.shopId')->select('shops.id','shops.shopName','shops.shopLogo','shops.shopSkills')->where('shops.status',1)->where('shop_details.shopDetailsTwo',1)->take(3)->get();
            
           
            $view->with('featureShops', $featureShops);
        });

        view::composer('frontEnd.products.viewProductContent', function($view){

            $mainCatrories=Category::where('mainCatId', null)->where('publicationStatus', 1)->get();

            $view->with('mainCatrories', $mainCatrories);
        });

        view::composer('admin.includes.navbar', function($view){
            $admin = Admin::find(Auth::user()->id);
            
            $logo = logo::where('publicationStatus', 1)->orderBy('id','dese')->value('logo');
            $newShopNotifData = $admin->unreadNotifications()->where('type', 'App\Notifications\NewShopCreated')->select('data','id')->latest()->take(10)->get();
            $newShopNotification = json_decode($newShopNotifData);
            
            $newProductNotification = $admin->unreadNotifications()->where('type', 'App\Notifications\ProductInserted')->select('data','id')->latest()->take(10)->get();
            $newProductNotify = json_decode($newProductNotification);
            
            $newShop = $admin->unreadNotifications()->where('type', 'App\Notifications\NewShopCreated')->count();
            $newProduct = $admin->unreadNotifications()->where('type', 'App\Notifications\ProductInserted')->count();
            

            $view->with('logo', $logo)
                    ->with('newShopNotification', $newShopNotification)
                    ->with('newProductNotify', $newProductNotify)
                    ->with('newShop', $newShop)
                    ->with('newProduct', $newProduct);
        });

        view::composer('artisan.includes.navbar', function($view){
            $newShopNotifData = DB::table('notifications')->where('type', 'App\Notifications\ProductStatus')->select('data','created_at')->latest()->take(10)->get();
            $productStatusNotifications = json_decode($newShopNotifData);
            
            $view->with('productStatusNotifications', $productStatusNotifications);
        });

        view::composer('frontEnd.includes.latestProductsContent', function($view){
            $latestProducts = DB::table('products')
                    ->join('categories', 'products.categoryId', '=', 'categories.id')
                    ->select('products.id', 'products.productName', 'products.newPrice','categories.categoryName' )
                    ->where('products.publicationStatus', 1)
                    ->orderBy('products.id', 'desc')
                    ->take(12)
                    ->get();
                    
            $view->with('latestProducts', $latestProducts);
        });

        view::composer('frontEnd.includes.addsContent', function($view){
            //get All shop id
            $addShops = null;
            $shopProducts = null;
            $userFvrtShop = null;
            $allShops = Shop::select('id')->get();
            if($allShops->count() >0 ){
                $shopIds = array();
                $count = 0;
                //make foreach loop
                foreach ($allShops as $shop) {
                    //store all shop id in a array
                    $shopIds[$count]= $shop->id;
                    $count++;
                }
                //take a randome shop id from array
                $shopId = $shopIds[rand(0,$count-1)];

                //take shopinformation where random take id and shop id will match
                $addShops = Shop::where('id', $shopId)->first();

                //take 4 product info of that shop
                $shopProducts = Product::where('ownerId', $shopId)->where('status', 1)->take(4)->get();

                $userFvrtShop=NULL;
                if (!Auth::guest()) {
                    $userFvrtShop = ShopFavourite::where('userId', Auth::User()->id)->where('shopId',$shopId)->first();
                }


            }
            $view->with('addShops', $addShops)
                ->with('shopProducts', $shopProducts)
                ->with('userFvrtShop', $userFvrtShop);

        });

    

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
