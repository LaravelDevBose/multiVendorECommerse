<?php

namespace App\Http\Controllers;


use App\Size;
use Illuminate\Support\Facades\Validator;
use App\Notifications\ProductInserted;
use App\Notifications\ProductStatus;
use App\Traits\ProductImageResize;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\ProductFavourite;
use App\ProductMaterial;
use App\ProductQuentity;
use App\SecondaryColor;
use App\PrimaryColor;
use App\ProductImage;
use App\Merchantile;
use App\ProductTag;
use App\Category;
use App\GiftType;
use App\Product;
use App\Admin;
use App\Shop;
use Session;
use Auth;
use DB;

class ProductController extends Controller
{

    use ProductImageResize;

    //Artisan Product View Fuction

    public function shopProductView(Request $request)
    {

        $shopId = Auth::User()->shopId;
        $mainCategoris = Category::where('mainCatId', Null)->where('publicationStatus', 1)->orderBy('position', 'asc')->select('id',"categoryName")->get();

        $tags = ProductTag::latest()->select("id","tagTitle")->get();
        $primaryColors = PrimaryColor::latest()->get();

        $secondaryColors = SecondaryColor::latest()->get();
        $giftTypes = GiftType::where('publicationStatus', 1)->latest()->select('id','giftTitle')->get();


        if($request->ajax()){
            $products = $this->shopAjaxRequest($request, $shopId);
            response()->json($products);
            return view('artisan.ajaxView.productSortingView' ,['products'=>$products]);

        }else{
            $products = Product::where('ownerId', $shopId)->latest()->get();
            return view('artisan.product.viewProducts' ,['products'=>$products, 'mainCategoris'=>$mainCategoris,'tags'=>$tags, 'primaryColors'=>$primaryColors, 'secondaryColors'=>$secondaryColors, 'giftTypes'=>$giftTypes]);
        }


    }

    public function adminProductsView(Request $request)
    {

        $mainCategoris = Category::where('mainCatId', Null)->where('publicationStatus', 1)->orderBy('position', 'asc')->select('id',"categoryName")->get();

        $tags = ProductTag::latest()->select("id","tagTitle")->get();
        $primaryColors = PrimaryColor::latest()->get();

        $secondaryColors = SecondaryColor::latest()->get();
        $giftTypes = GiftType::where('publicationStatus', 1)->latest()->select('id','giftTitle')->get();


        if($request->ajax()){
            $products = $this->adminAjaxRequest($request);
            response()->json($products);
            return view('admin.ajexView.ajexBackEndProducts' ,['products'=>$products]);

        }else{
            $products = Product::latest()->paginate(20);
            return view('admin.product.viewProducts' ,['products'=>$products, 'mainCategoris'=>$mainCategoris,'tags'=>$tags, 'primaryColors'=>$primaryColors, 'secondaryColors'=>$secondaryColors, 'giftTypes'=>$giftTypes]);
        }


    }

    private function adminAjaxRequest($request)
    {
        if (isset($request->tCatId)) {

            $thirdCatId = $request->tCatId;
            $products = Product::where('thirdCatId', $thirdCatId)->latest()->get();

        }
        else if(isset($request->sCatId)) {

            $secCatId = $request->sCatId;
            $products = Product::where('secondCatId', $secCatId)->latest()->get();


        }else if(isset($request->mCatId)){

            $mainCatId = $request->mCatId;
            $products = Product::where('mainCatId', $mainCatId)->latest()->get();

        }else if(isset($request->sizeIds)){

            $sizeIds = explode(',', $request->sizeIds);
            $products = Product::where( function($query) use ($sizeIds){
                foreach ($sizeIds as $size) {
                    $query->orwhere('sizeId', "LIKE", "%" .$size. "%");
                }
            })->latest()->get();

        }
        else if(isset($request->priColors)){

            $colors = explode(',', $request->priColors);
            $products = Product::where( function($query) use ($colors){
                foreach ($colors as $color) {
                    $query->orwhere('sizeId', "LIKE", "%" .$color. "%");
                }
            })->latest()->get();


        }else{
            $products = Product::latest()->get();

        }
        return $products;
    }

    private function shopAjaxRequest($request, $shopId)
    {
        if (isset($request->tCatId)) {

            $thirdCatId = $request->tCatId;
            $products = Product::where('ownerId', $shopId)->where('thirdCatId', $thirdCatId)->latest()->get();

        }
        else if(isset($request->sCatId)) {

            $secCatId = $request->sCatId;
            $products = Product::where('ownerId', $shopId)->where('secondCatId', $secCatId)->latest()->get();


        }else if(isset($request->mCatId)){

            $mainCatId = $request->mCatId;
            $products = Product::where('ownerId', $shopId)->where('mainCatId', $mainCatId)->latest()->get();

        }else if(isset($request->sizeIds)){

            $sizeIds = explode(',', $request->sizeIds);
            $products = Product::where('ownerId', $shopId)->where( function($query) use ($sizeIds){
                foreach ($sizeIds as $size) {
                    $query->orwhere('sizeId', "LIKE", "%" .$size. "%");
                }
            })->latest()->get();

        }
        else if(isset($request->priColors)){

            $colors = explode(',', $request->priColors);
            $products = Product::where('ownerId', $shopId)->where( function($query) use ($colors){
                foreach ($colors as $color) {
                    $query->orwhere('sizeId', "LIKE", "%" .$color. "%");
                }
            })->latest()->get();


        }else{
            $products = Product::where('ownerId', $shopId)->latest()->get();

        }
        return $products;
    }


    public function adminInsert(){

        $mainCategoris = Category::where('mainCatId', Null)->where('publicationStatus', 1)->orderBy('position', 'asc')->select("id","categoryName")->get();
        $materials = ProductMaterial::latest()->select('id', 'materialName')->get();
        $tags = ProductTag::latest()->select("id","tagTitle")->get();
        $primaryColors = PrimaryColor::latest()->select('id', 'colorName')->get();
        $secondaryColors = SecondaryColor::latest()->select('id', 'colorName')->get();
        $giftTypes = GiftType::where('publicationStatus', 1)->latest()->select('id','giftTitle')->get();
        return view('admin.product.insertProduct',['mainCategoris'=>$mainCategoris,'tags'=>$tags, 'primaryColors'=>$primaryColors, 'secondaryColors'=>$secondaryColors, 'giftTypes'=>$giftTypes,'materials'=>$materials]);


    }



    public function shopInsert(){
        $mainCategoris = Category::where('mainCatId', Null)->where('publicationStatus', 1)->orderBy('position', 'asc')->select("id","categoryName")->get();
        $materials = ProductMaterial::latest()->select('id', 'materialName')->get();
        $tags = ProductTag::latest()->select("id","tagTitle")->get();
        $primaryColors = PrimaryColor::latest()->select('id', 'colorName')->get();
        $secondaryColors = SecondaryColor::latest()->select('id', 'colorName')->get();
        $giftTypes = GiftType::where('publicationStatus', 1)->latest()->select('id','giftTitle')->get();
        return view('artisan.product.insertProduct',['mainCategoris'=>$mainCategoris,'tags'=>$tags, 'primaryColors'=>$primaryColors, 'secondaryColors'=>$secondaryColors, 'giftTypes'=>$giftTypes,'materials'=>$materials]);
    }

    public function store(Request $request)
    {

        //make Product validation
        $report = Validator::make($request->all(),[
            'mainCatId' => 'required',
            'productName' => 'required|string|max:70',
            'productWeight' => 'required',
            'sellPrice' => 'required|integer',
            'finalPrice' => 'required|integer',
            'costPrice' => 'required|integer',
            'shortDes' => 'required|string|max:150',
            'details' => 'required|string|min:20|max:2500',
            'materialsIds' => 'required',
            'viewStyle' => 'required',
            'thumbImage' => 'required',
            'image' => 'required',
            // 'size' => 'required',
            'priColorId' => 'required',
        ]);

        $secCat = Category::where('mainCatId', $request->mainCatId)->where('secondCatId', null)->count();

        if(is_null($request->secondCatId) && $secCat >0){
            //if image is not uploded redirect back With Error message
            Session::flash('warning', 'Product Second Category is Required');
            return redirect()->back()->withInput();
        }else if(isset($request->secondCatId)){
            $thirdCat = Category::where('mainCatId', $request->mainCatId)->where('secondCatId', $request->secondCatId)->where('thirdCatId', null)->count();

            if(is_null($request->thirdCatId) && $thirdCat >0){

                //if image is not uploded redirect back With Error message
                Session::flash('warning', 'Product Third Category is Required');
                return redirect()->back()->withInput();
            }
        }


        //check image Validation is passes or not
        if($report->passes()){

            if (is_numeric($request->mainCatId)) {

                //get all Image info
                $imagesInfos= $request->file('image');

                //check image is less than or equeal to 4 Item
                if(count($imagesInfos) <= 5 && count($imagesInfos) > 0){
                    $folderName = 'admin';
                    if(Auth::guard('merchantile')->check()){
                        $folderName = Shop::where('id', Auth::user()->shopId)->value('shopName');
                    }else if(isset($request->owner) && $request->owner == 1){
                        $folderName = Shop::where('id', $request->supplierId)->value('shopName');
                    }
                    //Resize Rename and Store Images in folder and and get image Urls as array
                    $imageUrls = $this->multiImageStoreInFolder($imagesInfos, $folderName);

                    $thumbImage = $this->thumblImageStore($request->thumbImage, $folderName);

                    //store Product Details via function and get id
                    $productId = $this->productStore($request, $thumbImage);

                    $this->productSizeAndQtyStore($productId,$request->size, $request->qty);
                    //store images via function
                    $this->multiImageStoreInDatabase($imageUrls, $productId);

                    //check product Uploded Owner is shop owner than 
                    //send notification to admin a new produc is uploded
                    if (Auth::guard('merchantile')->check()) {
                        //send notification in database notification
                        $shop = Shop::where('id',Auth::User()->shopId)->select('id','shopName', 'shopLogo')->first();
                        $admins = Admin::all();
                        foreach ($admins as $admin) {
                            $admin->notify(new ProductInserted($shop,$productId));
                        }
                    }

                    //flash Session Success Message
                    Session::flash('success', 'Product Uploded SuucessFully.');

                    //redirecd back 
                    return redirect()->back();

                }else{

                    if(count($imagesInfos) > 5){
                        //if image is more than 4 than redirect back With Error message
                        Session::flash('warning', 'Uplode Product Image Less Than or Equeal 5 Image.!');
                        return redirect()->back()->withInput();
                    }else{
                        //if image is not uploded redirect back With Error message
                        Session::flash('warning', 'Product image Required. Uploded Product Image.');

                        return redirect()->back()->withInput();
                    }

                }
            }else{
                //if image is not uploded redirect back With Error message
                Session::flash('warning', 'Main Category is Required. Use Valid Category.!');

                return redirect()->back()->withInput();
            }

        }else{
            //if not passes than retun Redirect back with Errors message also with Inputs
            return redirect()->back()->withErrors($report)->withInput();
        }
    }

    private function productStore($request,$thumbImage)
    {
        //Make Tag Id Array to String And Separated By Coma
        $tagsId = null;
        if(isset($request->tagsId)){
            $tagsId = $this->makeTagsArrayToString();
        }

        $giftTypeId = null;
        if(isset($request->giftTypeId)){
            $giftTypeId = $this->makeProductGiftTypeIdArrayToString($request->giftTypeId);
        }


        //Make Primary Color Id Array To String And Separated By Coma
        $primaryColors = null;
        if(isset($request->priColorId)){
            $primaryColors = $this->makePrimaryColorsArrayToString($request->priColorId);
        }


        //Make Secanday Coler Id Array To String And Separated By Coma
        $secondaryColors = null;
        if(isset($request->secColorId)){
            $secondaryColors = $this->makeSecondaryColorsArrayToString($request->secColorId);
        }


        //Make Product Size Value Array  To String And Separated By Coma

        $materials = $this->makeProductMaterialArrayToString($request->materialsIds);
        $ownerId = 0;
        if(isset($request->owner) && $request->owner == 1){
            $ownerId = $request->supplierId;
        }
        $productCode = $this->productCodemake($ownerId, $request->mainCatId);
        $productVideo = null;
        //check product video insert or not
        if(!is_null($request->productVideo)){
            //make product video as enable
            $productVideo = $this->makeProductVideoEnable($request->productVideo);
        }

        //Store Product 
        $productStore = new Product;
        $productStore->mainCatId = $request->mainCatId;
        //if has valid second Category Id than store
        if (isset($request->secondCatId)) {

            $productStore->secondCatId = $request->secondCatId;
            //if has valid Third Category Id than store
            if (isset($request->thirdCatId)) {
                $productStore->thirdCatId = $request->thirdCatId;
            }
        }
        $productStore->productName  = $request->productName;
        $productStore->productCode = $productCode;
        $productStore->slugs = $request->productName;
        $productStore->productWeight = $request->productWeight;
        //Check Current Loging User is Admin Or Artisan
        //if Artisan than Pulication will 0 And Owner id is ShopId Or  Publication is 1 And owner Id will 0
        if (Auth::guard('merchantile')->check()) {
            $productStore->ownerId = Auth::user()->shopId;
            $productStore->status = 0;
        }else{
            if(isset($request->owner)){
                if($request->owner == 0){ // When Admin Insert Product For Supplier
                    $productStore->supplierId = $request->supplierId;
                    $productStore->ownerId = '0';
                    $productStore->status = $request->status;
                }else{ //When Admin Insert Product For Shop
                    $productStore->ownerId = $request->supplierId;
                    $productStore->supplierId = 0;
                    $productStore->status = $request->status;
                }
            }

        }

        $productStore->discount  = $request->discount;
        $productStore->margin  = $request->margin;
        $productStore->costPrice = $request->costPrice;
        $productStore->sellPrice = $request->sellPrice;
        $productStore->finalPrice = $request->finalPrice;
        $productStore->tagsId = $tagsId;
        $productStore->priColorId = $primaryColors;
        $productStore->secColorId = $secondaryColors;
        $productStore->productVideo = $productVideo;
        $productStore->materialsIds = $materials;
        $productStore->shortDes = $request->shortDes;
        $productStore->details = $request->details;
        $productStore->giftTypeId = $giftTypeId;
        $productStore->feature = $request->feature;
        $productStore->customeStatus = $request->customeStatus;
        $productStore->customeMessage = $request->customeMessage;
        $productStore->thumbImage = $thumbImage;
        $productStore->viewStyle = $request->viewStyle;
        $productStore->save();

        //Return Product Id

        return $productStore->id;
    }

    public function adminProductEdit($productId)
    {
        $productById = Product::where('id', $productId)->first();
        $productImages = ProductImage::where('productId', $productId)->get();
        $mainCategoris = Category::where('mainCatId', Null)->where('publicationStatus', 1)->orderBy('position', 'asc')->select("id","categoryName")->get();
        $materials = ProductMaterial::latest()->select('id', 'materialName')->get();
        $tags = ProductTag::latest()->select("id","tagTitle")->get();
        $primaryColors = PrimaryColor::latest()->select('id', 'colorName')->get();
        $secondaryColors = SecondaryColor::latest()->select('id', 'colorName')->get();
        $giftTypes = GiftType::where('publicationStatus', 1)->latest()->select('id','giftTitle')->get();

        if(!is_null($productById->mainCatId) && !is_null($productById->secondCatId) && !is_null($productById->thirdCatId)){
            $catSizes = Size::where('mainCatId', $productById->mainCatId)->where('secondCatId',$productById->secondCatId)->where('thirdCatId',$productById->thirdCatId)->get();
        }elseif(!is_null($productById->mainCatId) && !is_null($productById->secondCatId)){
            $catSizes = Size::where('mainCatId', $productById->mainCatId)->where('secondCatId',$productById->secondCatId)->get();
        }else{
            $catSizes = Size::where('mainCatId', $productById->mainCatId)->get();
        }

        $productQty = ProductQuentity::where('productId', $productId)->get();




        return view('admin.product.editProduct',['productById'=>$productById, 'productImages'=>$productImages, 'mainCategoris'=>$mainCategoris,'materials'=>$materials,'catSizes'=>$catSizes,'tags'=>$tags,
            'primaryColors'=>$primaryColors, 'secondaryColors'=>$secondaryColors,'giftTypes'=>$giftTypes ,'productQty'=>$productQty]);

    }

    public function shopProductEdit($productId)
    {
        $productById = Product::where('id', $productId)->first();
        $productImages = ProductImage::where('productId', $productId)->get();
        $mainCategoris = Category::where('mainCatId', Null)->where('publicationStatus', 1)->orderBy('position', 'asc')->select("id","categoryName")->get();
        $materials = ProductMaterial::latest()->select('id', 'materialName')->get();
        $tags = ProductTag::latest()->select("id","tagTitle")->get();
        $primaryColors = PrimaryColor::latest()->select('id', 'colorName')->get();
        $secondaryColors = SecondaryColor::latest()->select('id', 'colorName')->get();
        $giftTypes = GiftType::where('publicationStatus', 1)->latest()->select('id','giftTitle')->get();

        if(!is_null($productById->mainCatId) && !is_null($productById->secondCatId) && !is_null($productById->thirdCatId)){
            $catSizes = Size::where('mainCatId', $productById->mainCatId)->where('secondCatId',$productById->secondCatId)->where('thirdCatId',$productById->thirdCatId)->get();
        }elseif(!is_null($productById->mainCatId) && !is_null($productById->secondCatId)){
            $catSizes = Size::where('mainCatId', $productById->mainCatId)->where('secondCatId',$productById->secondCatId)->get();
        }else{
            $catSizes = Size::where('mainCatId', $productById->mainCatId)->get();
        }

        $productQty = ProductQuentity::where('productId', $productId)->get();


        return view('artisan.product.editProduct',['productById'=>$productById, 'productImages'=>$productImages, 'mainCategoris'=>$mainCategoris,'materials'=>$materials,'catSizes'=>$catSizes,
            'tags'=>$tags, 'primaryColors'=>$primaryColors, 'secondaryColors'=>$secondaryColors,'giftTypes'=>$giftTypes, 'productQty'=>$productQty ]);


    }



    public function update(Request $request)
    {

        //Validate All Data
        $report = Validator::make($request->all(),[
            'mainCatId' => 'required',
            'productName' => 'required|string|max:70',
            'productWeight' => 'required',
            'sellPrice' => 'required|integer',
            'finalPrice' => 'required|integer',
            'costPrice' => 'required|integer',
            'shortDes' => 'required|string|max:150',
            'details' => 'required|string|min:20|max:2500',
            'materialsIds' => 'required',
            'viewStyle' => 'required',
            // 'size' => 'required',
            'priColorId' => 'required',
        ]);


        $secCat = Category::where('mainCatId', $request->mainCatId)->where('secondCatId', null)->count();

        if(is_null($request->secondCatId) && $secCat >0){
            //if image is not uploded redirect back With Error message
            Session::flash('warning', 'Product Second Category is Required');
            return redirect()->back()->withInput();
        }else if(isset($request->secondCatId)){
            $thirdCat = Category::where('mainCatId', $request->mainCatId)->where('secondCatId', $request->secondCatId)->where('thirdCatId', null)->count();

            if(is_null($request->thirdCatId) && $thirdCat >0){

                //if image is not uploded redirect back With Error message
                Session::flash('warning', 'Product Third Category is Required');
                return redirect()->back()->withInput();
            }
        }


        //check Validation Report if Passes
        if ($report->passes()) {
            //check Main Category Id Exist or not if exist than pass
            if (is_numeric($request->mainCatId)) {
                //check new Image are uplode or not  if Uploded than  do belong this

                //find this Product old Image and count this and New image
                $prviousImages = ProductImage::where('productId', $request->productId)->count();

                if($request->file('image')){

                    //get new image data
                    $imagesInfos = $request->file('image');

                    //count total image
                    $totalImage = count($imagesInfos)+$prviousImages;
                    //check New Image And old Total is not more than 5and less then 0 if not than pass
                    if ($totalImage <= 5 && $totalImage > 0) {

                        //check Who Uplode the product admin or Artisan
                        //if Artisan than Get Shop name And mack it Product images Folder name
                        //if Admin Uploded Than Make Folder name as Admin For Store tha Images
                        $folderName = 'admin';
                        if(Auth::guard('merchantile')->check()){
                            $folderName = Shop::where('id', Auth::user()->shopId)->value('shopName');
                        }else if(isset($request->owner) && $request->owner == 1){
                            $folderName = Shop::where('id', $request->supplierId)->value('shopName');
                        }else if($request->ownerId != 0){
                            $folderName = Shop::where('id', $request->ownerId)->value('shopName');
                        }

                        //Resize Rename and Store Images in folder and and get image Urls as array
                        $imageUrls = $this->multiImageStoreInFolder($imagesInfos, $folderName);

                        $thumbImage = Product::where('id', $request->productId)->value('thumbImage');
                        if(isset($request->thumbImage) && file_exists($request->thumbImage)){
                            if(file_exists($thumbImage)){
                                unlink($thumbImage);
                            }
                            $thumbImage = $this->thumblImageStore($request->thumbImage, $folderName);
                        }




                        //store Product Details via function and get id
                        $productId = $request->productId;

                        $this->productUpdate($request , $thumbImage);

                        $this->productSizeAndQtyUpdate($productId, $request->size, $request->qty);

                        //store images via function
                        $this->multiImageStoreInDatabase($imageUrls, $productId);

                        //flash Session Success Message
                        Session::flash('success', 'Product Updated SuucessFully.');

                        //return Rediretc back
                        $routeName = 'products';
                        //check where Request was come from
                        if(Auth::guard('merchantile')->check()){
                            $routeName = 'items';
                        }
                        return redirect()->route($routeName);


                    }else {
                        //return error messge is that more or less than validation
                        if ($totalImage > 5) {
                            //if image is more than 5 than redirect back With Error message
                            Session::flash('warning', 'Total Product Image Less Than or Equeal 5 Image.!');
                            return redirect()->back();
                        } else {
                            //if image is not uploded redirect back With Error message
                            Session::flash('warning', 'Product image Required. Uploded Product Image.');
                            return redirect()->back();
                        }

                    }
                }else{
                    if($prviousImages >0){

                        $folderName = 'admin';
                        if(Auth::guard('merchantile')->check()){
                            $folderName = Shop::where('id', Auth::user()->shopId)->value('shopName');
                        }else if(isset($request->owner) && $request->owner == 1){
                            $folderName = Shop::where('id', $request->supplierId)->value('shopName');
                        }else if($request->ownerId != 0){
                            $folderName = Shop::where('id', $request->ownerId)->value('shopName');
                        }

                        $thumbImage = Product::where('id', $request->productId)->value('thumbImage');
                        if(isset($request->thumbImage) && file_exists($request->thumbImage)){
                            if(file_exists($thumbImage)){
                                unlink($thumbImage);
                            }
                            $thumbImage = $this->thumblImageStore($request->thumbImage, $folderName);
                        }


                        //store Product Details via function and get id
                        $productId = $request->productId;

                        $this->productUpdate($request , $thumbImage);

                        $this->productSizeAndQtyUpdate($productId, $request->size, $request->qty);


                        //flash Session Success Message
                        Session::flash('success', 'Product Updated SuucessFully.');

                        //return Rediretc back
                        $routeName = 'products';

                        //check where Request was come from
                        if(Auth::guard('merchantile')->check()){
                            $routeName = 'items';
                        }
                        return redirect()->route($routeName);
                    }

                    //if image is not uploded redirect back With Error message
                    Session::flash('warning', 'Product image Required. Uploded Product Image.');
                    return redirect()->back();
                }

            }else{
                //if not Exist than return back With error message
                Session::flash('warning', 'Main Category is Required. Use Valid Category.!');
                return redirect()->back();
            }
        }else{
            //else Not pass tha validation return redirect back with Error message
            return redirect()->back();
        }
    }


    private function productUpdate($request, $thumbImage)
    {

        //Make Tag Id Array to String And Separated By Coma
        $tagsId = null;
        if(isset($request->tagsId)){
            $tagsId = $this->makeTagsArrayToString();
        }

        $giftTypeId = null;
        if(isset($request->giftTypeId)){
            $giftTypeId = $this->makeProductGiftTypeIdArrayToString($request->giftTypeId);
        }


        //Make Primary Color Id Array To String And Separated By Coma
        $primaryColors = null;
        if(isset($request->priColorId)){
            $primaryColors = $this->makePrimaryColorsArrayToString($request->priColorId);
        }


        //Make Secanday Coler Id Array To String And Separated By Coma
        $secondaryColors = null;
        if(isset($request->secColorId)){
            $secondaryColors = $this->makeSecondaryColorsArrayToString($request->secColorId);
        }


        //Make Product Size Value Array  To String And Separated By Coma

        $materials = $this->makeProductMaterialArrayToString($request->materialsIds);

        if(isset($request->owner) && $request->owner == 1){
            $ownerId = $request->supplierId;
        }else{
            $ownerId = $request->ownerId;
        }

        $productVideo = null;
        //check product video insert or not
        if(!is_null($request->productVideo)){
            //check this url is enabel link if yes
            if (strpos($request->productVideo, "embed") !== false) {
                $productVideo = $request->productVideo;
            } else {
                //make product video as enable
                $productVideo = $this->makeProductVideoEnable($request->productVideo);
            }


        }
        $productStore = Product::find($request->productId);
        $productStore->mainCatId = $request->mainCatId;
        //if has valid second Category Id than store
        if (isset($request->secondCatId)) {

            $productStore->secondCatId = $request->secondCatId;
            //if has valid Third Category Id than store
            if (isset($request->thirdCatId)) {
                $productStore->thirdCatId = $request->thirdCatId;
            }
        }
        $productStore->productName  = $request->productName;
        $productStore->slugs = $request->productName;
        $productStore->productWeight = $request->productWeight;
        //Check Current Loging User is Admin Or Artisan
        //if Artisan than Pulication will 0 And Owner id is ShopId Or  Publication is 1 And owner Id will 0
        if (Auth::guard('merchantile')->check()) {
            $productStore->ownerId = Auth::user()->shopId;
        }else{
            if(isset($request->owner)){
                if($request->owner == 0){ // When Admin Insert Product For Supplier
                    $productStore->supplierId = $request->supplierId;
                    $productStore->ownerId = '0';
                    $productStore->status = $request->status;
                }else{ //When Admin Insert Product For Shop
                    $productStore->ownerId = $request->supplierId;
                    $productStore->supplierId = 0;
                    $productStore->status = $request->status;
                }
            }

        }

        $productStore->discount  = $request->discount;
        $productStore->margin  = $request->margin;
        $productStore->costPrice = $request->costPrice;
        $productStore->sellPrice = $request->sellPrice;
        $productStore->finalPrice = $request->finalPrice;
        $productStore->tagsId = $tagsId;
        $productStore->priColorId = $primaryColors;
        $productStore->secColorId = $secondaryColors;
        $productStore->productVideo = $productVideo;
        $productStore->materialsIds = $materials;
        $productStore->shortDes = ucfirst($request->shortDes);
        $productStore->details = ucfirst($request->details);
        $productStore->giftTypeId = $giftTypeId;
        $productStore->feature = $request->feature;
        $productStore->customeStatus = $request->customeStatus;
        $productStore->customeMessage = $request->customeMessage;
        $productStore->thumbImage = $thumbImage;
        $productStore->viewStyle = $request->viewStyle;
        $productStore->save();



        // $productStore = Product::find($request->productId) ;
        // $oldStatus = $productStore->status;

        if (Auth::guard('admin')->check() && $productStore->ownerId != 0 ) {

            //send notification in database notification
            $artisans = Merchantile::where('shopId',$productStore->ownerId)->select('id','name', 'authority')->get();
            $product = Product::where('id',$productStore->id)->select('id', 'productName','status', 'thumbImage')->first();

            foreach ($artisans as $artisan) {
                $artisan->notify(new ProductStatus($product));
            }

        }

    }

    public function destroy($productId)
    {
        
        $qutyDelete = ProductQuentity::where('productId', $productId)->select('id')->get();
         
        
        foreach($qutyDelete as $quty){
            
            ProductQuentity::find($quty->id)->delete();
        }
        //send product id to multiImageDelete function and delete all images
        $this->multiImageDelete($productId);

        //find the product information match with given id and delete
        $productDelete = Product::find($productId)->delete();
        
        //flash Session message with succeessFully delete message
        Session::flash('success', 'Product Deleted SuccessFully..!');

        //return Rediretc back
        $routeName = 'products';
        //check where Request was come from
        if(Auth::guard('merchantile')->check()){
            $routeName = 'items';
        }
        return redirect()->route($routeName);
    }


    public function productStatusChange($productId, $status)
    {
        //chech status is 0 or 1
        //if status is 1 than make it unpublish
        if ($status == 1) {

            //find the product amd make it unpulish
            $productstatus = Product::find($productId);
            $productstatus->status = '0';
            $productstatus->save();

            //make a Success message for admin that product SuccessFully Unpublish
            $message = 'Product Make Unpublish SuccessFully..!';

            //take product Owner id
            $ownerId = $productstatus->ownerId;

        } else {
            //else make product Publish

            //find the product amd make it unpulish
            $productstatus = Product::find($productId);
            $productstatus->status = '1';
            $productstatus->save();

            //make a Success message for admin that product SuccessFully Unpublish
            $message = 'Product Make Publish SuccessFully..!';

            //take product Owner id
            $ownerId = $productstatus->ownerId;
        }

        //check Product owner Information
        if($ownerId != 0){
            //if owner id is not 0 means admin is not the owner of this product
            //send notification in database notification
            $artisans = Merchantile::where('shopId',$ownerId)->select('id','name', 'authority')->get();
            $product = DB::table('products')
                ->join('product_images', 'products.id', '=', 'product_images.productId')
                ->select('products.id', 'products.productName','products.status', 'product_images.image')
                ->where('products.id',$productId)
                ->first();

            foreach ($artisans as $artisan) {
                $artisan->notify(new ProductStatus($product));
            }
        }

        //Flash a Seccion SuccessMessage  message  that Crated before
        Session::flash('success', $message);

        //return back
        $routeName = 'products';
        //check where Request was come from
        if(Auth::guard('merchantile')->check()){
            $routeName = 'items';
        }
        return redirect()->route($routeName);
    }

    private function productCodemake($ownerId, $mainCatId){


        if(Auth::guard('merchantile')->check()){
            $shopCode = Shop::where('id', Auth::user()->shopId)->value('shopViewId');
            $productCount = Product::where('mainCatId',$mainCatId)->where('ownerId', Auth::user()->shopId)->count();
        }elseif ($ownerId != 0){
            $shopCode = Shop::where('id',$ownerId)->value('shopViewId');
            $productCount = Product::where('mainCatId',$mainCatId)->where('ownerId', $ownerId)->count();
        }
        else{
            $shopCode = 'A000';
            $productCount = Product::where('mainCatId',$mainCatId)->where('ownerId', 0)->count();
        }
        $catCode = strtoupper(substr(Category::where('id',$mainCatId)->value('categoryName'), 0, 2));

        $productCount = $productCount+1;
        $productCode = $shopCode.'-'.$catCode.'-'.$productCount;
        return $productCode;


    }

    private function makeTagsArrayToString($tags)
    {
        return implode(',', $tags);
    }

    private function makePrimaryColorsArrayToString($primaryColors)
    {
        return implode(',', $primaryColors);
    }

    private function makeSecondaryColorsArrayToString($secondaryColors)
    {
        return implode(',', $secondaryColors);
    }

    private function makeProductMaterialArrayToString($materials)
    {
        return implode(',', $materials);
    }
    private function makeProductGiftTypeIdArrayToString($giftTypeId)
    {

        return implode(',', $giftTypeId);
    }

    private function makeProductVideoEnable($videoLink)
    {
        $videoVId = substr($videoLink, strrpos($videoLink, '=') +1);
        $enablePath = 'https://www.youtube.com/embed/'.$videoVId ;
        return $enablePath;
    }

    private  function productSizeAndQtyStore($productId,$size, $qty){

        for($i =0; $i < count($size); $i++){

            $productSize = new ProductQuentity;
            $productSize->productId = $productId;
            $productSize->sizeId = $size[$i];
            $productSize->quantity = $qty[$i];
            $productSize->save();

        }
    }

    private  function productSizeAndQtyUpdate($productId,$size, $qty){

        for($i =0; $i < count($size); $i++){

            ProductQuentity::updateOrCreate(['productId'=>$productId , 'sizeId'=>$size[$i]], ['quantity'=>$qty[$i]]);
        }
        return;
    }

}
