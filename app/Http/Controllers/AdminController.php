<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menufacture;
use App\Category;
use App\Product;
use App\Admin;
use App\Order;
use App\logo;
use DB;
use Auth;
use Carbon\Carbon;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        

        return view('admin.dassboard.dassboard');
    }

    public function singelInvoice($id)
    {
        return view('admin.invoice.singelInvoiceContent');
    }

    public function newShopNotification($notifyId){
        $notify = DB::table('notifications')->where('type', 'App\Notifications\NewShopCreated')->where('id', $notifyId)->first();
        $shopInfo = json_decode($notify->data);

        $admin = Admin::find(Auth::user()->id);
        $admin->unreadNotifications()->where('id', $notifyId)->update(['read_at' => Carbon::now()]);

        return redirect()->route('shop.singel.view', $shopInfo->shop->id);
    }

    public function newProductNotification($notifyId){
        $notify = DB::table('notifications')->where('type', 'App\Notifications\ProductInserted')->where('id', $notifyId)->first();
        $notifyInfo = json_decode($notify->data);

        $admin = Admin::find(Auth::user()->id);
        $admin->unreadNotifications()->where('id', $notifyId)->update(['read_at' => Carbon::now()]);
        return redirect()->back();
        return redirect()->route('singel.product', $notifyInfo->product);
    }
}
