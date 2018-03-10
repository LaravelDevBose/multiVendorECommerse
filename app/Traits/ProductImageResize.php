<?php

namespace App\Traits;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use File;
use App\ProductImage;
use Session;

trait ProductImageResize{

    //multi product image stroe
    private function multiImageStoreInFolder($imageInfos, $folderName){
//        dd($viewStyle);
        $imageUrl= array();
        $i = 0;
        $newfolderName = $this->createFolderName($folderName);
        $path = $this->distinationPath($newfolderName);
        $imageTypeName = 'product';

        foreach ($imageInfos as $imageInfo) {

            $imageType =$imageInfo->getClientMimeType();
            $imageName = $this->createImageName($i, $imageType, $newfolderName, $imageTypeName );
            $imagePath = $path.$imageName;

            $imageUrl[$i] = $this->singelproductImageStoreAndResize($imageInfo, $imagePath);
            $i++;
        }

        return $imageUrl;

    }

    //multi product image stroe
    private function thumblImageStore($imageInfo, $folderName){

        $newfolderName = $this->createFolderName($folderName);
        $path = $this->distinationPath($newfolderName);
        $imageTypeName = 'thimble';

        $imageType =$imageInfo->getClientMimeType();
        $imageName = $this->createImageName(0,$imageType, $newfolderName, $imageTypeName);
        $imagePath = $path.$imageName;
        $imageUrl= $this->singelproductImageStoreAndResize($imageInfo, $imagePath);

        return $imageUrl;

    }


    //product image Store in database
    private function multiImageStoreInDatabase($imageUrls, $productId)
    {

        $i = 0;
        //use foreach loop And Store Images With Product Image
        foreach ($imageUrls as $imageUrl) {

            $image = new ProductImage;
            $image->productId = $productId;
            $image->image = $imageUrl;
            $image->save();
        }
    }

    //Destroy image info Form folder and dataBase a seleted one
    public function singelImageDelete($imageId){

        $imageDelete = ProductImage::find($imageId);
        $this->unlinkImage($imageDelete->image);
        $imageDelete->delete();

        Session::flash('success', 'Image Deleted SuccessFully..!');
        return redirect()->back();
    }

    //destroy Images from folder one by one
    private function multiImageDelete($productId)
    {
        $imageUrls = ProductImage::where('productId', $productId)->get();
        foreach ($imageUrls as $imageUrl) {
            $this->unlinkImage($imageUrl->image);
        }
    }

    //Destroy Image From Folder
    private function unlinkImage($imageUrl){

        if(file_exists($imageUrl)){
            unlink($imageUrl);
        }

        return;
    }




    //Resize and Uplode Shop LOgo Image
    private function singelproductImageStoreAndResize($imageInfo, $imagePath)
    {

        $image = Image::make($imageInfo->getRealPath());
        $image->save($imagePath);
        return $imagePath;
    }


    //make a Custom Banner Image Name
    private function createImageName($i, $imageType, $folderName, $imageTypeName)
    {
        //get Image Mine Type
        $ext = substr($imageType, strrpos($imageType, '/') +1);

        //get Current Date time String
        $date = $this->currentTime();

        //concrite a new logo Name
        $newName = $date.'_'.$folderName.'_'.$imageTypeName.$i.'.'.$ext;

        //return logo name
        return $newName;
    }


    //Image Distination url
    private function distinationPath($folderName)
    {

        //Create image Store Path
        $path = 'public/images/'.$folderName.'/';

        //cheak Folder all ready Exits or not
        if(!File::exists($path)){
            //if no Folder Exits then Create new One
            File::makeDirectory($path);
        }

        //Return the folder path
        return $path;

    }


    // get Current Time Function

    private function currentTime()
    {
        return Carbon::now()->format('Ymdhis');
    }

    private function createFolderName($ownerName){


        $name = explode(' ', $ownerName);
        $foldername = '' ;
        for ($i=0; $i < count($name); $i++) {

            if($i==0){
                $part = lcfirst($name[$i]);
            }else{
                $part = ucfirst($name[$i]);
            }


            $foldername = $foldername.$part;
        }

        return $foldername;

    }



}