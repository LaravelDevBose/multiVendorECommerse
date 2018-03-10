<?php

namespace App\Traits;
use App\ProductImage;
use Intervention\Image\ImageManagerStatic as Image;

trait ImageHandler{

    
    

    
    private function createMessages($report)
    {
    	//Create Message 

    	switch ($report) {
    		case '1':
    			$message = 'Image File Type is Not Valid  ..!';
    			break;

    		case '2':
    			$message = 'Image ar so large .Uplode Image less then 3 MB..!';
    			break;
    	}

    	return $message;
    }

}

