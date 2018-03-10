<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Menufacture;

class MenufactureController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    	$menufactures = Menufacture::all();
        return view('admin.menufacture.menufactureContent', ['menufactures'=>$menufactures]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    	//Validate the incomming data
	    $validationReport = $this->checkValidateData( $request );

        if ($validationReport->passes()) {
            //if validation pass Store data
            //if validation pass,than chack image validation
	            $imageInfo=$request->file('image');

	            $imageVallidation=$this->checkImageValidaction( $imageInfo);
	            
	            if (is_null( $imageVallidation )) {
	                //if validation pass call moveUplodeImage for move image to folder and get Image url 
	                $imageUrl =$this->moveUplodeImage($imageInfo);

	                //If validation pass then Save data 
	                $manufacturer = new Menufacture;
	                $manufacturer->manufactureName = $request->manufactureName;
	                $manufacturer->image = $imageUrl;
	                $manufacturer->publicationStatus = $request->publicationStatus;
	                $manufacturer->save();
	                return redirect()->route('menufacture')->with('success', ' Menufacture Information Save SuccessFully !');

	            } else {
	                //if fvalidation fails than redirect back with input and massage
	                return redirect()->back()->withInput( $request->all())->with('unsuccess', 'Uplode up to 1.5mb image size and only .jpg and png format !');
	            }
        }else{
            //if Validation not pass/fails backe to the page with old data 
            //also with error message
            return redirect()->back()
                    ->withErrors($validationReport)
                    ->withInput( $request->all());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //Find Details by id
        $menufactureById = Menufacture::find($id);
        //return view with data
        return view('admin.menufacture.editMenufactureContent', ['menufactureById'=> $menufactureById ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){

           //Validate the incomming data
	    $validationReport = $this->checkValidateData( $request );

        if ($validationReport->passes()) {
            //if validation pass Store data

	            $imageUrl=$this->uplodeNewImage( $request);
	            
	            if (!is_null( $imageUrl )) {
	                //if validation pass 

	                //If validation pass then Save data 
	                $manufacturer = Menufacture::find( $request->menufactureId );
	                $manufacturer->manufactureName = $request->manufactureName;
	                $manufacturer->image = $imageUrl;
	                $manufacturer->publicationStatus = $request->publicationStatus;
	                $manufacturer->save();
	                return redirect()->route('menufacture')->with('success', ' Menufacture Information Update SuccessFully !');

	            } else {
	                //if fvalidation fails than redirect back with input and massage
	                return redirect()->back()->withInput( $request->all())->with('unsuccess', 'Uplode up to 1.5mb image size and only .jpg and png format !');
	            }
        }else{
            //if Validation not pass/fails backe to the page with old data 
            //also with error message
            return redirect()->back()
                    ->withErrors($validationReport)
                    ->withInput( $request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){  

        //find manufacturer Info By $id
        $manufacturerById = Menufacture::find($id);

        //Call destroyPvesImage to Delete Image
        $res = $this->destroyPvesImage($manufacturerById);

        // If delete  Enter If Condition
        if(!$res){

            //Again Find and Get manufacturer by Id And Delete All info 
            $manufacturerById = Menufacture::find($id);
            $manufacturerById->delete();
        }
        //If Can not Delete Enter Else Condition 
        else{
            //return back With message
             return redirect()->back()->with('unsuccess', 'Oops Something Wrong !');
        }

        //Return Manage page With Success message
        return redirect()->route('menufacture')->with('success', 'Menufacture Information Delete SuccessFully !');
    }

    /**
     * Construct the valudation.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkValidateData($request)
    {
        //Create validation
        $validation=Validator::make($request->all(), [
        'manufactureName' => 'required',
        'image' => 'required|image',
        'publicationStatus' => 'required',

        ]);

    	//return report
        return $validation;
            
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
            return redirect()->route('manufacture')->with('unsuccess', 'valid Image File !');
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
        return redirect()->route('manufacture')->with('unsuccess', ' Use jpg or png Image File');
        }
        
    }

    private function checkImageSize($imageInfos){
        //get image Size 
        $imageSize = filesize($imageInfos);

        //Check Image Size is it getter then 50000 bit or not
        if($imageSize > 1700000){
            
             //If imageSize is getter then 50000 bit then back to Previous page with status message 
        return redirect()->route('manufacture')->with('unsuccess', 'Image  are too large File');
        }

    }

    private function moveUplodeImage($imageInfos){
        //Get Image name
        $imageName =$imageInfos->getClientOriginalName();

        //Define Uplode path 
        $uploadPath = 'public/images/manufacture/';

        //move to Define folder
        $imageInfos->move($uploadPath, $imageName);

        //return totel url to join uplodepath and imageName
        return $imageUrl = $uploadPath . $imageName;

    }

    private function uplodeNewImage($request){

        //get Previous Image Information (must be change model name and colame Id)
        $imageinfoById = Menufacture::find($request->menufactureId);

        //check has new file or not  ...? If has new file the Enter into If Condition
        if($request->hasFile('image')){
            //Get all Infomation About new image
            $newimageInfos=$request->file('image');

            //check Images validation If pass Validation go forward
            if(!$this->checkImageValidaction($newimageInfos)){

                //Distroy Previous Image
                $destryOldImage = $this->destroyPvesImage($imageinfoById);

                //check can Destroy Previous or not
                if(!$destryOldImage){

                    //If Destroy Previous images then move to folder call moveUplodeImages function
                    $imageUrl= $this->moveUplodeImage($newimageInfos);
                }else{
                    //If Can not delete Image then back to previous page with message
                    return redirect()->back()->with('message', 'Can Not Delete Previous Images !');
                }
            }
        }
        //If has no new file then Enter into Else Condition
        else{
            //get previous image url 
            $imageUrl= $imageinfoById->image;
        }

        //return Images url 
        return $imageUrl;

    }

    private function destroyPvesImage($imageinfoById){
        //Destroy Image
        unlink($imageinfoById->image);
    }
}
