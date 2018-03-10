<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductReviewsComment;

class ProductReviewsController extends Controller
{
    public function productsReviewsCommentStore(Request $request)
    {
    	$comment = New ProductReviewsComment;
    	$comment->userId = $request->userId;
    	$comment->productId = $request->productId;
    	$comment->uploderId = $request->uploderId;
    	$comment->UploderType =$request->UploderType;
    	$comment->comment = $request->comment;
    	$comment->save();

    	return redirect()->route('singel.product.view', array('id'=>$request->productId));
    }
}
