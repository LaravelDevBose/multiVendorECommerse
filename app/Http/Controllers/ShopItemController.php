<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Category;
use App\Menufacture;
use App\Product;
use App\GiftType;
use App\ProductImage;
use App\ProductOverview;
use App\ProductFavourite;
use App\Shop;
use Auth;
use DB;

class ShopItemController extends Controller
{
    
    public function insert(){
        $siteMap=15;
    	$categories = Category::select('id', 'categoryName')->where('publicationStatus', 1)->where('categoryType', 1)->get();
        $giftTypes = GiftType::where('publicationStatus', 1)->select('id', 'giftHeadding')->orderBy('position', 'asc')->get();
    	return view('frontEnd.shops.product.insertProductContent', ['siteMap'=>$siteMap,'categories'=>$categories, 'giftTypes'=>$giftTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        
        //check Valodation Input Data
        $validator = $this->chakeValidation($request);
        if($validator->passes()){
            //move Information Supergobel $File to local $files variable
            $imagesInfos=$request->file('image');

            //couent total file 
            $totalcount= count($imagesInfos);
            if( $totalcount <= '3'){
            	//Check Images validation (via function checkImages($imageInfos) )
	            $validatecount=$this->checkImages($imagesInfos );

	                if ($totalcount == $validatecount) {

	                    //If validation Pass Store data (Vie function produtStore($reuest) ) and get product Id
	                    //Get product Id Form  function 
	                    $productTableId = $this->produtStore($request);

                        $this->ProductOverViewStore($request, $productTableId);
	                    //Move Images In Directory Folder(via function storeImagesInFolder($files) ) 
	                    //And get $imagesUrl array
	                    $imagesUrl = $this->storeImagesInFolder($imagesInfos );

	                    $this->storeProductImages($imagesInfos ,$imagesUrl, $productTableId);

	                        //return Previous pages with Success mesages
	                    return redirect()->back()->with('success', 'Product Information Store SuccessFully !');
	                }
	                else{
	                    //If Validation Fails Back to Previous pages with Erros Messages
	                    return redirect()->back()->withInput( $request->all())->with('unsuccess', 'Pleass Uplode Valid Image !');
	                }

            }else{
            	return redirect()->back()->withInput( $request->all())->with('unsuccess', 'Pleass Uplode Less then 4 Image!');
            }
            
        }else{
            return redirect()->back()->withErrors($validator)->withInput( $request->all());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $siteMap=16;
        //Retrive data where $id
        $categories= Category::select('id', 'categoryName')->where('publicationStatus', 1)->where('categoryType', 1)->get();
        $giftTypes = GiftType::where('publicationStatus', 1)->select('id', 'giftHeadding')->orderBy('position', 'asc')->get();
        $productById = DB::table('products')
                        ->join('product_overviews', 'products.id', '=', 'product_overviews.productTableId')
                        ->select('products.*', 'product_overviews.small','product_overviews.mediam','product_overviews.large','product_overviews.mLarge',
                            'product_overviews.eLarge','product_overviews.allSize','product_overviews.primaryColor','product_overviews.secondaryColor', 'product_overviews.materialsDiscription')
                        ->where('products.id', $id)->first();
        $productImages = ProductImage::where('productTableId', $id)->get();

        return view('frontEnd.shops.product.editProductContent',['siteMap'=>$siteMap,'categories'=>$categories,'productById'=>$productById, 'productImages'=>$productImages,'giftTypes'=>$giftTypes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        //check Valodation Input Data
        $validator = $this->chakeValidation($request); 
        if($validator->passes()){
            //if Validation pass then chack has new image or not
            if($request->hasFile('image')){
                //if has Image than count total image Ans Chaeck is image more then 3 or not
                $imagesInfos=$request->file('image');
                //couent total file 
                $totalcount= count($imagesInfos);
                if ($totalcount <= '3') {
                    //if image count is less then or equel to 3 than chack validation 
                    //Check Images validation (via function checkImages($imageInfos) )
                    $validatecount=$this->checkImages($imagesInfos );

                    if ($totalcount == $validatecount) {

                        //If validation Pass Update data (Vie function produtStore($reuest) ) and get product Id
                        //Get product Id Form  function 
                        $productId = $this->productUpdate($request);
                        $this->ProductOverViewUpdate($request, $productId);
                        //Move Images In Directory Folder(via function storeImagesInFolder($files) ) 
                        //And get $imagesUrl array
                        $imagesUrl = $this->storeImagesInFolder($imagesInfos );

                        $this->storeProductImages($imagesInfos ,$imagesUrl, $productId);

                            //return Previous pages with Success mesages
                        return redirect()->route('merchantile.dashboard')->with('success', 'Product Information Update SuccessFully !');
                    }
                    else{
                        //If Validation Fails Back to Previous pages with Erros Messages
                        return redirect()->back()->with('unsuccess', 'Pleass Uplode Valid Image Size And Type..!');
                    }

                } else {
                    return redirect()->back()->with('unsuccess', 'Pleass Uplode less then 4 image ...!');
                }

            }else{
                //Update Product Information
                $productId = $this->productUpdate($request);
                $this->ProductOverViewUpdate($request, $productId);

                //return Previous pages with Success mesages
                return redirect()->route('merchantile.dashboard')->with('success', 'Product Information Update SuccessFully !');
            }
        }else{
            return redirect()
                ->back()
                ->withErrors($validator) 
                ->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){  

        //Call destroyImages to Delete Image
        $result = $this->destroyProductImages($id);
        // If delete  Enter If Condition
        if(!$result){

            //Again Find and Get product.insertr by Id And Delete All info 
            $productById = Product::find($id);
            $productById->delete();

            $pOid = ProductOverview::where('productTableId', $id)->select('id')->first();
            $productOverview = ProductOverview::find($pOid->id);
            $productOverview->delete();
            $this->productFavarateDelete($id);
        }
        //If Can not Delete Enter Else Condition 
        else{
            //return back With message
             return redirect()->back()->with('unsuccess', 'Oops Something Wrong !');
        }

        //Return Manage page With Success message
        return redirect()->route('merchantile.dashboard')->with('success', 'Product Information Delete SuccessFully !');
    
    }

    /*
    *Delete Product Favarate  Function
    */
    public function productFavarateDelete($productId)
    {
        $allFavarates = ProductFavourite::where('productId', $productId)->select('id')->get();

        if( count($allFavarates) != 0){

            foreach ($allFavarates as $favarate => $id) {
                
                $deleteFavert = ProductFavourite::find($id->id);
                $deleteFavert->delete();
            }
        }
    }

    private function produtStore($request){

        //Store Data via Model file 
        $product = new Product;
        $product->categoryId = $request->categoryId;
        $product->menufactureId = $request->uploderId;
        $product->UploderType = $request->UploderType;
        $product->uploderId = $request->uploderId;
        $product->giftTypeId = $request->giftTypeId;
        $product->productName = $request->productName;
        $product->productCode = $request->productCode;
        $product->discount = $request->discount;
        $product->oldPrice = $request->oldPrice;
        $product->newPrice = $request->newPrice;
        $product->shortDiscription = $request->shortDiscription;
        $product->details = $request->details;
        $product->publicationStatus = $request->publicationStatus;
        $product->save();

        //get Product id 
        $productTableIdId = $product->id;
        // $this->ProductIdStore($tableId, $deptCode);
        //return Product Id
        return $productTableIdId;
        
    }

    private function ProductOverViewStore($request, $productId)
    {
        $product = new ProductOverview;
        $product->productTableId = $productId;
        if($request->small){
            $product->small = $request->small;
        }
        if($request->mediam){
            $product->mediam = $request->mediam;
        }
        if($request->large){
            $product->large = $request->large;
        }
        if($request->mLarge){
            $product->mLarge = $request->mLarge;
        }
        if($request->eLarge){
            $product->eLarge = $request->eLarge;
        }
        if($request->allSize){
            $product->allSize = '6';

            
        }else{
            $product->mediam = '2';
        }
        $product->primaryColor = $request->primaryColor;
        $product->secondaryColor = $request->secondaryColor;
        $product->materialsDiscription = $request->materialsDiscription;
        $product->save();
    }

    private function productUpdate($request){
        //Store Data via Model file 
        $product = Product::find($request->productId);
        $product->categoryId = $request->categoryId;
        $product->giftTypeId = $request->giftTypeId;
        $product->productName = $request->productName;
        $product->productCode = $request->productCode;
        $product->oldPrice = $request->oldPrice;
        $product->newPrice = $request->newPrice;
        $product->shortDiscription = $request->shortDiscription;
        $product->details = $request->details;
        $product->publicationStatus = $request->publicationStatus;
        $product->save();

        //get Product id 
        $productId = $product->id;
        //return Product Id
        return $productId;
    
    }

    public function ProductOverViewUpdate($request, $productId)
    {   
        $productOVId = ProductOverview::where('productTableId', $productId)->select('id')->first();
        
        $product = ProductOverview::find($productOVId->id);
        $product->productTableId = $productId;
        if($request->small){
            $product->small = $request->small;
        }
        if($request->mediam){
            $product->mediam = $request->mediam;
        }
        if($request->large){
            $product->large = $request->large;
        }
        if($request->mLarge){
            $product->mLarge = $request->mLarge;
        }
        if($request->eLarge){
            $product->eLarge = $request->eLarge;
        }
        if($request->allSize){
            $product->allSize = '6';
        }else{
            $product->mediam = '2';
        }

        $product->primaryColor = $request->primaryColor;
        $product->secondaryColor = $request->secondaryColor;
        $product->materialsDiscription = $request->materialsDiscription;
        $product->save();
    }

    private function storeImagesInFolder($imagesInfos){ 

        $totalcount= count($imagesInfos);
        //declear $count and $i variable
        $i=0;

        //make $imagesUrl array variable 
        $imagesUrl = array();

        //make foreach loop 
        foreach ($imagesInfos as $imageInfos) {
            //call function moveUplodeImage() move image to folder 
            //And get image url And put In $imagesUrl arrey via Index
            $imageUrl = $this->moveUplodeImage($imageInfos);

            //Ckeck its Success to move
            if (!empty($imageUrl)) {
                //move imageUrl to ImagesUrl Array
                $imagesUrl[$i]= $imageUrl;

                //Count variable incress
                $i++;
            }    
        }

        //If totalFiles == $count 
        if ($totalcount == $i) {
            //return $imagesUrl array
            return $imagesUrl;
        }else{
            
            //return Previous Page with Unsuccess message
            return redirect()->back()->with('unsuccess', 'Oops All Images Are Not valid to Store. Plz Check ! ');
        }

    }

    private function storeProductImages($imagesInfos ,$imagesUrl, $productTableId){
        //Declear $i
        $i= 0;

        //Start foreach Loop 
        foreach ($imagesInfos as $imageInfos) {
            //get Original Name Form $file as $imageName
            //get Image Url form $imageUrl[$i] as $imageUrl
            //store data Via ProductImage Model
            $productsImage = new ProductImage ;
            $productsImage->productTableId = $productTableId;
            $productsImage->image = $imagesUrl[$i];
            $productsImage->save();

            //Incress $i
            $i++;
        }    
    }

   

    public function imageDestroy($id){

        $imageById = ProductImage::find($id);
        $this->destroyPvesImage($imageById);

        $imageById = ProductImage::find($id);
        $imageById->delete();

        return redirect()->back()->with('success', 'Image Delete SuccessFully !');
    }


    private function destroyProductImages($productId){
        //find product Info By $id
        $productImagesById = ProductImage::where('productTableId', $productId)->get();

        //Create Forecah Loop 
        foreach ($productImagesById as $productImageById) {
            $this->destroyPvesImage($productImageById);
            $productImage = ProductImage::find( $productImageById->id );
            $productImage->delete();
        }  
    }


  /**
     * Construct the valudation.
     *
     * @return \Illuminate\Http\Response
     */
    public function chakeValidation($request){
        //Create validation
        $validation=Validator::make($request->all(),[
        'categoryId' => 'required',
        'productName' => 'required|max:255',
        'productCode' => 'required|max:255',
        'newPrice' => 'required',
        'shortDiscription' => 'required',
        'details' => 'required',
        // 'image' => 'required',
        'publicationStatus' => 'required',
        'primaryColor' => 'required',
        'materialsDiscription' => 'required',

        ]);

        //return $validation Result
        return $validation ;        
    }

    private function checkImages($imagesInfos){

        //decler a veriable validatecount = 0
        $validatecount = '0';
        
            //check Real product Images Validation
            foreach($imagesInfos as $imageInfos) {
                //Call checkImageValidation one by one
                $validation=$this->checkImageValidaction($imageInfos);
                if(!$validation){
                    //cout incress
                    $validatecount++;
                }
            }

        //return $validatecount
        return $validatecount;
    }

    private function checkImageValidaction($imageInfos){
        //check Image File type 
        $this->checkFileType($imageInfos);
    }

    private function checkFileType($imageInfos){
        //get file type form imageInfos 
        $FileType = $imageInfos->getClientMimeType();

        //check Images file type
        if($FileType){

             //If pass then Forward to checkFileExtention function
            $this->checkFileExtention($imageInfos);

        }else{
             //If fails return back with status messages
            return redirect()->route('item.insert')->with('unsuccess', 'valid Image File !');
        }
     
    }

    private function checkFileExtention($imageInfos){

        //get imageExtention form imageInfos
        $imageExtention =$imageInfos->getClientOriginalExtension();

        //check image jpg or png...
        if($imageExtention =='jpg'|| $imageExtention =='png'){
           
            //If image is png or jpg then Forward to checkImageSize function
            $this->checkImageSize($imageInfos);
        }else{
            
        //If image not jpg or png then back to previous page with status message
        return redirect()->route('item.insert')->with('unsuccess', ' Use jpg or png Image File');
        }
        
    }

    private function checkImageSize($imageInfos){
        //get image Size 
        $imageSize = filesize($imageInfos);

        //Check Image Size is it getter then 50000 bit or not
        if($imageSize > 1700000){
            
             //If imageSize is getter then 50000 bit then back to Previous page with status message 
        return redirect()->route('item.insert')->with('unsuccess', 'Image  are too large File');
        }

    }

    private function moveUplodeImage($imageInfos){
        //Get Image name
        // $imageName =$imageInfos->getClientOriginalName();
        $imageName =$this->createNewImageName($imageInfos);

        $shopName = Shop::where('id', Auth::user()->shopId)->select('shopName')->first();
        //Define Uplode path 
        $uploadPath = 'public/images/'.$shopName->shopName.'/';

        //move to Define folder
        $imageInfos->move($uploadPath, $imageName);

        //return totel url to join uplodepath and imageName
        return $imageUrl = $uploadPath . $imageName;

    }

    
    private function destroyPvesImage($imageinfoById){
        //Destroy Image
        unlink($imageinfoById->image);

    }

    private function createNewImageName($imageInfos)
    {
        $imageName =$imageInfos->getClientOriginalName();
        $date = date('Ymdhis');
        $newName = $date.'_'.$imageName;

        return $newName;
    }
}
