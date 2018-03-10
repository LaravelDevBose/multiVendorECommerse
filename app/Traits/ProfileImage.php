<?php

namespace App\Traits;
use App\Merchantile;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use File;
use Auth;


trait ProfileImage{


	//Resize and Uplode Shop LOgo Image
	private function shopLogoUplodeAndResize($imageInfo, $shopName)
	{	

		$path = $this->distinationPath($shopName);
		$imageTypeName = 'logo';
		$imageName = $this->createImageName($imageInfo, $shopName, $imageTypeName);
		$imagePath = $path.$imageName;
		$image = Image::make($imageInfo->getRealPath());
		$image->save($imagePath);
		return $imagePath;
	}

    //Resize and Uplode Shop Banner Image
	private function shopBannerUplodeAndResize($imageInfo, $shopName)
	{	
		$path = $this->distinationPath($shopName);
		$imageTypeName= 'banner';
		$imageName = $this->createImageName($imageInfo, $shopName,$imageTypeName);
		$imagePath = $path.$imageName;
		$image = Image::make($imageInfo->getRealPath());
		$image->save($imagePath);
		return $imagePath;
	}

    private function newShopArtisanProfileImage($imageInfo, $shopName)
    {

        $path = $this->distinationPath($shopName);
        $imageTypeName = 'ArtisanProfile';
        $imageName = $this->createImageName($imageInfo, $shopName, $imageTypeName);
        $imagePath = $path.$imageName;
        $image = Image::make($imageInfo->getRealPath());
        $image->save($imagePath);
        return $imagePath;
    }

	private function profileImageUplodeAndResize($imageInfo, $shopName)
	{	

		$path = $this->distinationPath($shopName);
		$imageTypeName = 'ArtisanProfile'.Auth::User()->id;
		$imageName = $this->createImageName($imageInfo, $shopName, $imageTypeName);
		$imagePath = $path.$imageName;
		$image = Image::make($imageInfo->getRealPath());
		$image->save($imagePath);
		return $imagePath;
	}
	
	private function userProfileImageUplodeAndResize($imageInfo)
	{	
        $folderName = 'users';
		$path = $this->distinationPath($folderName);
		$imageTypeName = 'userProfile'.'_'.Auth::User()->id;
		$imageName = $this->createImageName($imageInfo, $folderName, $imageTypeName);
		$imagePath = $path.$imageName;
		$image = Image::make($imageInfo->getRealPath());
		$image->save($imagePath);
		return $imagePath;
	}

	//make a Custom Banner Image Name
	private function createImageName($imageInfo, $shopName, $imageTypeName)
    {	
    	$folderName = $this->createFolderName($shopName);
    	//get Image Mine Type
        $logoType =$imageInfo->getClientMimeType();
        $ext = substr($logoType, strrpos($logoType, '/') +1);
        //get Current Date time String
        $date = $this->currentTime();
        //concrite a new logo Name
        $newName = $date.'_'.$folderName.$imageTypeName.'.'.$ext;

        //return logo name
        return $newName;
    }


    //Image Distination url
	private function distinationPath($shopName)
	{	

		$folderName = $this->createFolderName($shopName);

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

	private function createFolderName($shopName){


		$name = explode(' ', $shopName);
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