<?php

namespace App\Traits;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use File;

trait TemplatImage{

    private function giftTypeImageUplodeAndResize($imageInfo)
	{	

		$path = $this->distinationPath();
		$imageTypeName = 'giftType';
		$imageName = $this->createImageName($imageInfo, $imageTypeName);
		$imagePath = $path.$imageName;
		$image = Image::make($imageInfo->getRealPath());
		$image->save($imagePath);
		return $imagePath;
	}

    private function categoryImageUplodeAndResize($imageInfo)
    {

        $path = $this->distinationPath();
        $imageTypeName = 'category';
        $imageName = $this->createImageName($imageInfo, $imageTypeName);
        $imagePath = $path.$imageName;
        $image = Image::make($imageInfo->getRealPath());
        $image->save($imagePath);
        return $imagePath;
    }

	//make logo image Resize and Store in Folder

	private function logoImageUplodeAndResize($imageInfo)
	{	

		$path = $this->distinationPath();
		$imageTypeName = 'logo';
		$imageName = $this->createImageName($imageInfo, $imageTypeName);
		$imagePath = $path.$imageName;
		$image = Image::make($imageInfo->getRealPath());
		$image->save($imagePath);
		return $imagePath;
	}

	private function sliderImageUplodeAndResize($imageInfo)
	{	

		$path = $this->distinationPath();
		$imageTypeName = 'slider';
		$imageName = $this->createImageName($imageInfo, $imageTypeName);
		$imagePath = $path.$imageName;
		$image = Image::make($imageInfo->getRealPath());
		$image->save($imagePath);
		return $imagePath;
	}

	//make a Custom Banner Image Name
	private function createImageName($imageInfo, $imageTypeName)
    {	
    	
    	//get Image Mine Type
        $logoType =$imageInfo->getClientMimeType();
        $ext = substr($logoType, strrpos($logoType, '/') +1);
        //get Current Date time String
        $date = $this->currentTime();
        //concrite a new logo Name
        $newName = $date.'_'.$imageTypeName.'.'.$ext;

        //return logo name
        return $newName;
    }


    //Image Distination url
	private function distinationPath()
	{	

		//Create image Store Path
		$path = 'public/images/template/';
		
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

}