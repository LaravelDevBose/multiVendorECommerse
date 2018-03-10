<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\ConsumerQuestion;
use App\Product;
use App\Mail\UserQusen;
use Mail;
use DB;
use Auth;
use Session;

class ConsumerQuestionController extends Controller
{



    public function qusenList()
    {   
        
        $questions = DB::table('consumer_questions')
                    ->join('products', 'consumer_questions.productId', '=', 'products.id')
                    ->select('consumer_questions.*', 'products.productName')
                    ->latest()->get();

        $unRead = ConsumerQuestion::where('status',0)->count();
        return view('admin.question.questions',['questions'=>$questions, 'unRead'=>$unRead]);
    }


    // Artisan Answer The Consumer Question Function
    public function readQusen($qusenId)
    {   
        ConsumerQuestion::where('id', $qusenId)->where('status','=', '0')->update(['status'=>1]);

        $readQusen = ConsumerQuestion::where('id', $qusenId)->first();
        $answer = ConsumerQuestion::where('qusenId', $qusenId)->first();
        $productInfo= $this->productInfo($readQusen->productId);
        
        return view('artisan.question.questionAnswer',['readQusen'=>$readQusen, 'answer'=>$answer, 'productInfo'=>$productInfo]);
    }

    private function productInfo($productId)
    {
        return DB::table('products')
                ->join('categories', 'products.categoryId', '=', 'categories.id') 
                ->join('product_images', 'products.id', '=', 'product_images.productTableId') 
                ->join('product_overviews', 'products.id', '=', 'product_overviews.productTableId')
                ->select('products.productName', 'products.productCode', 'products.discount','products.oldPrice', 'products.newPrice','product_images.image', 'product_overviews.*', 'categories.categoryName') 
                ->where('products.id', $productId)->first();
    }

    public function answerQusen(Request $request)
    {
        $validation=Validator::make($request->all(), [
            'message' => 'required',
            ]);

        if($validation->passes()){

            $answer =ConsumerQuestion::insert(['qusenId'=>$request->qusenId, 'message'=> $request->message]);
            $qusenInfo = ConsumerQuestion::where('id', $request->qusenId)->first();

            $productInfo = Product::where('id', $qusenInfo->productId)->select('id', 'productName', 'productCode', 'newPrice')->first();

            //Send mail by mailable Calss

            Mail::to($qusenInfo->email)->send(new UserQusen($request->message, $qusenInfo, $productInfo));
           
           //make Status it as Answerd update
            $qusenInfo->update(['status'=>2]);
            //sestion Success message
            Session::flash('success', 'Answer Was SuccessFully Send To'.'<b>'.$qusenInfo->name.'</b>'." !" );
            return redirect()->route('artisan.qusen.view');
            
        }

        return redirect()->back()->withErrors($validation);
    }






    public function consumerQuestionStore(Request $request)
    {
    	$validation=Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'productId' => 'required',
            ]);

    	if($validation->passes()){

            $ownerId = Auth::User()->shopId;

            if (Auth::guard('admin')->check()) {
                $ownerId = 0;
            }

    		$question = New ConsumerQuestion;
            $question->ownerId=$ownerId;
    		$question->productId=$request->productId;
    		$question->name=$request->name;
    		$question->email=$request->email;
    		$question->message=$request->message;
    		$question->save();

    		//redirect to the intendent location with Success message
            return redirect()->back()->with('success','Thank Your. We will Answer Your question in 2 hour on your Mail. '); 
    	}else{
            
            return redirect()->back()
                    ->withErrors($validation)
                    ->withInput( $request->all());
        }
    }


    public function deleteQuestion($id)
    {
        $question = ConsumerQuestion::find($id);
        $replys = ConsumerQuestion::where('qusenId', $id)->select('id')->get();
        if(!is_null($replys) || !empty($replys)){
            foreach ($replys as $reply) {
                $replyDelete=ConsumerQuestion::find($reply->id);
                $replyDelete->delete();
            }
            
        }
        $question->delete();

         return redirect()->back()->with('success','Your Selected Question And Also its Reply Delete SuccessFully..!');
    }
}
