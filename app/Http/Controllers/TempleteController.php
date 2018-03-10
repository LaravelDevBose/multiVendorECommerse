<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Traits\TemplatImage;
use App\YoutubeVideo;
use App\Slider;
use App\logo;
use App\Shop;
use Session;
use Auth;

class TempleteController extends Controller
{

    use TemplatImage;
    
    //view logo list
    public function viewLogos()
    {   
        $logoImages = logo::latest()->get();
        return view('admin.template.logo',['logoImages'=>$logoImages]);
    }

    //Store Logo Images

    public function storeLogo(Request $request)
    {
        $report = Validator::make( $request->all(),[
            'tagLine'=>'required|string|max:50',
            'logo'=>'required|image|mimes:jpeg,png',
            'publicationStatus'=>'required|boolean',
        ]);

        if($report->passes()){
            //cheak logo Status
            if($request->publicationStatus == 1){
                //make all previous logo as unpublish

                $oldStatus = Logo::where('publicationStatus', 1)->select('id', 'publicationStatus')->get();

                if(count($oldStatus) > 0){

                    foreach ($oldStatus as $status) {
                        Logo::where('id', $status->id)->update(['publicationStatus' => '0']);
                    }
                }

            }

            $logoInfo = $request->file('logo');

            $logoUrl = $this->logoImageUplodeAndResize($logoInfo);

            Logo::insert([
                'tagLine' => $request->tagLine,
                'logo' => $logoUrl,
                'publicationStatus' => $request->publicationStatus,
            ]);

            Session::flash('success', 'Logo Information was SuccessFully Uploded..!');

            return redirect()->back();
        }

        return redirect()->back()->withErrors($report);
    }

    //update Logo Image 

    public function updateLogo(Request $request)
    {
        $report = Validator::make( $request->all(),[
            'tagLine'=>'required|string|max:50',
            'publicationStatus'=>'required|boolean',
        ]);

        if($report->passes()){

             //cheak logo Status
            if($request->publicationStatus == 1){
                //make all previous logo as unpublish

                $oldStatus = Logo::where('publicationStatus', 1)->select('id', 'publicationStatus')->get();

                if(count($oldStatus) > 0){

                    foreach ($oldStatus as $status) {
                        Logo::where('id', $status->id)->update(['publicationStatus' => '0']);
                    }
                }

            }

            if(file_exists($request->logo)){

                $logoInfo = $request->file('logo');
                $logoUrl = $this->logoImageUplodeAndResize($logoInfo);

                $oldLogo = Logo::where('id', $request->logoId)->value('logo');
                Logo::where('id', $request->logoId)
                    ->update([
                        'tagLine' => $request->tagLine,
                        'logo' => $logoUrl,
                        'publicationStatus' => $request->publicationStatus,
                    ]);



                if(file_exists($oldLogo)){
                    unlink($oldLogo);
                }

            }else{

                Logo::where('id', $request->logoId)
                    ->update([
                        'tagLine' => $request->tagLine,
                        'publicationStatus' => $request->publicationStatus,
                    ]);
                
            }

            Session::flash('success', 'Logo Information was SuccessFully Uploded..!');

            return redirect()->back();
        }

        return redirect()->back()->withErrors($report);
    }


    //delete Logo Images

    public function deleteLogo(Request $request)
    {
        $report = Validator::make($request->all(), [
                    'password' => 'required|min:6',
                ]);
        $credentials = [
            'email'=>Auth::User()->email,
            'password'=>$request->password,
        ];

        if($report->passes()){
            if(Auth::guard('admin')->once($credentials)){
                
                $logoInfo = Logo::find($request->logoId);
                $publicationStatus = $logoInfo->publicationStatus;
                if(file_exists($logoInfo->logo)){
                    unlink($logoInfo->logo);
                }
                $logoInfo->delete();

                //cheak is this status publish
                if($publicationStatus == 1){
                    //if yes than make last uplode image as publish
                    //get all logo id
                    $lastLogoId = Logo::latest()->select('id')->first();
                    Logo::where('id',$lastLogoId->id)->update(['publicationStatus'=> '1']);
                }

                Session::flash('success', 'Logo Information was Delete SuccessFully!');
                return redirect()->back();
            }else{
                return redirect()->back()->with('unsuccess', 'Password Will Not Match..!');
            }
        }

        return redirect()->back()->withErrors($report);
    }

    //view Slider list
    public function viewSliders()
    {   
        $sliders = Slider::latest()->latest()->get();
        return view('admin.template.slider',['sliders'=>$sliders]);
    }

    //Store Slider Images

    public function storeSlider(Request $request)
    {
        
        $report = Validator::make( $request->all(),[
            'sliderTitle'=>'required|string|max:50',
            'shortNote'=>'required|string|max:50',
            'buttonTitle'=>'required|string|max:15',
            'url'=>'required',
            'image'=>'required|image|mimes:jpeg,png',
            'publicationStatus'=>'required|boolean',
        ]);

        if($report->passes()){

            $imageInfo = $request->file('image');

            $imageUrl = $this->sliderImageUplodeAndResize($imageInfo);

            Slider::insert([
                'sliderTitle' => $request->sliderTitle,
                'shortNote' => $request->shortNote,
                'buttonTitle' => $request->buttonTitle,
                'url' => $request->url,
                'image' => $imageUrl,
                'publicationStatus' => $request->publicationStatus,
            ]);

            Session::flash('success', 'Slider Information was SuccessFully Uploded..!');

            return redirect()->back();
        }

        return redirect()->back()->withErrors($report);
    }

    //update Slider Image 

    public function updateSlider(Request $request)
    {
        $report = Validator::make( $request->all(),[
            'sliderTitle'=>'required|string|max:50',
            'shortNote'=>'required|string|max:50',
            'buttonTitle'=>'required|string|max:15',
            'url'=>'required',
            'publicationStatus'=>'required|boolean',
        ]);

        if($report->passes()){

            if(file_exists($request->image)){

                $imageInfo = $request->file('image');
                $imageUrl = $this->sliderImageUplodeAndResize($imageInfo);

                $oldimage = Slider::where('id', $request->sliderId)->value('image');
                Slider::where('id', $request->sliderId)
                    ->update([
                        'sliderTitle' => $request->sliderTitle,
                        'shortNote' => $request->shortNote,
                        'buttonTitle' => $request->buttonTitle,
                        'url' => $request->url,
                        'image' => $imageUrl,
                        'publicationStatus' => $request->publicationStatus,
                    ]);



                if(file_exists($oldimage)){
                    unlink($oldimage);
                }

            }else{

                Slider::where('id', $request->sliderId)
                    ->update([
                        'sliderTitle' => $request->sliderTitle,
                        'shortNote' => $request->shortNote,
                        'buttonTitle' => $request->buttonTitle,
                        'url' => $request->url,
                        'publicationStatus' => $request->publicationStatus,
                    ]);
                
            }

            Session::flash('success', 'Slider Information was SuccessFully Uploded..!');

            return redirect()->back();
        }

        return redirect()->back()->withErrors($report);
    }


    //delete Slider Images

    public function deleteSlider(Request $request)
    {
        $report = Validator::make($request->all(), [
                    'password' => 'required|min:6',
                ]);
        $credentials = [
            'email'=>Auth::User()->email,
            'password'=>$request->password,
        ];

        if($report->passes()){
            if(Auth::guard('admin')->once($credentials)){
                
                $sliderInfo = Slider::find($request->sliderId);
                if(file_exists($sliderInfo->image)){
                    unlink($sliderInfo->image);
                }
                $sliderInfo->delete();

                Session::flash('success', 'Slider Information was Delete SuccessFully!');
                return redirect()->back();
            }else{
                return redirect()->back()->with('unsuccess', 'Password Will Not Match..!');
            }
        }

        return redirect()->back()->withErrors($report);
    }


    //view YouTube Video LisT
    public function viewVideos()
    {   
        $videos = YoutubeVideo::latest()->paginate(10);
        $shops = Shop::latest()->select('id','shopName')->get();
        return view('admin.template.youtubeVideo',['videos'=>$videos, 'shops'=>$shops]);
    }

    //Store YouTube Videos 

    public function storeVideo(Request $request)
    {   
       
        $report = Validator::make( $request->all(),[
            'videoTitle'=>'required|string|max:20',
            'ownerId'=>'required',
            'videoPath'=>'required|url',
            'shortNote'=>'required|string|max:1500',
            'status'=>'required|boolean',
        ]);

        if($report->passes()){

            $youtubeVId = substr($request->videoPath, strrpos($request->videoPath, '=') +1);
            $enablePath = 'https://www.youtube.com/embed/'.$youtubeVId ;

            YoutubeVideo::insert([
                'videoTitle' => $request->videoTitle,
                'ownerId' => $request->ownerId,
                'videoPath' => $enablePath,
                'shortNote' => $request->shortNote,
                'status' => $request->status,
            ]);

            Session::flash('success', 'Youtube Video Information was SuccessFully Uploded..!');

            return redirect()->back();
        }

        return redirect()->back()->withErrors($report);
    }

    //update Youtube Videos

    public function updateVideo(Request $request)
    {
        $report = Validator::make( $request->all(),[
            'videoTitle'=>'required|string|max:20',
            'ownerId'=>'required',
            'videoPath'=>'required|url',
            'shortNote'=>'required|string|max:1500',
            'status'=>'required|boolean',
        ]);

        if($report->passes()){

            $enablePath = $request->videoPath;
            
            if(strrpos($request->videoPath, '=') > 0){
                $youtubeVId = substr($request->videoPath, strrpos($request->videoPath, '=') +1);
                $enablePath = 'https://www.youtube.com/embed/'.$youtubeVId ;
            }
            

            YoutubeVideo::find($request->videoId)->update([
                'videoTitle' => $request->videoTitle,
                'ownerId' => $request->ownerId,
                'videoPath' => $enablePath,
                'shortNote' => $request->shortNote,
                'status' => $request->status,
            ]);

            Session::flash('success', 'Youtube Video Information was SuccessFully Uploded..!');

            return redirect()->back();
        }

        return redirect()->back()->withErrors($report);
    }


    //delete YouTube Video 

    public function deleteVideo(Request $request)
    {
        $report = Validator::make($request->all(), [
                    'password' => 'required|min:6',
                ]);
        $credentials = [
            'email'=>Auth::User()->email,
            'password'=>$request->password,
        ];

        if($report->passes()){
            if(Auth::guard('admin')->once($credentials)){
                
                YoutubeVideo::find($request->videoId)->delete();
                

                Session::flash('success', 'Youtube Video Information was Delete SuccessFully!');
                return redirect()->back();
            }else{
                return redirect()->back()->with('unsuccess', 'Password Will Not Match..!');
            }
        }

        return redirect()->back()->withErrors($report);
    }
}
