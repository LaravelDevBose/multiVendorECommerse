<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\TransportLocation;
use App\ProductTransport;


class TransportController extends Controller
{
    public function locationView(){

        $divisions = TransportLocation::where('divisionId', null)->get();
        return view('admin.productTransport.locationContent',['divisions'=>$divisions]);
    }


    public function divisionList()
    {
        $divisions = TransportLocation::where('divisionId', NULL)->latest()->pluck("areaName","id")->all();
        return Response()->json($divisions);
    }

    public function locationStore(Request $request){
        $report = Validator::make($request->all() ,[
            'areaName'=>'required|string|max:20',
        ]);

        if($report->passes()) {
            $location = new TransportLocation;

            if ($request->divisionId != 0) {
                $location->divisionId = $request->divisionId;
            }
            if ($request->districtId != 0) {
                $location->districtId = $request->districtId;
            }
            $location->areaName = ucfirst($request->areaName);
            $location->save();

            Session::flash('success', 'New Location Created Successfully..!');
            return redirect()->route('locations');
        }
        return redirect()->back()->withErrors($report);

    }

    public function locationUpdate(Request $request){
        $report = Validator::make($request->all() ,[
            'areaName'=>'required|string|max:20',
        ]);

        if($report->passes()) {
            $location = TransportLocation::find($request->locationId);

            if ($request->divisionId != 0) {
                $location->divisionId = $request->divisionId;
            }
            if ($request->districtId != 0) {
                $location->districtId = $request->districtId;
            }
            $location->areaName = ucfirst($request->areaName);
            $location->save();

            Session::flash('success', 'Location Information Updated Successfully..!');
            return redirect()->route('locations');
        }
        return redirect()->back()->withErrors($report);
    }


    public function deliveryView(Request $request){
        if($request->ajax()){
            $locations = TransportLocation::where('divisionId', '!=', null)->where('districtId', '!=', null)->pluck('areaName','id')->all();
            return response()->json($locations);
        }else{
            $deliverys =ProductTransport::where('transportType', 1)->latest()->get();
            $locations = TransportLocation::where('divisionId', '!=', null)->where('districtId', '!=', null)->get();
            return view('admin.productTransport.deliveryContent', ['deliverys'=>$deliverys,'locations'=>$locations]);
        }

    }

    public function pickUpView(Request $request)
    {

        if ($request->ajax()) {
            $locations = TransportLocation::where('divisionId', '!=', null)->where('districtId', '!=', null)->pluck('areaName','id')->all();
            return response()->json($locations);

        } else {
            $pickUps = ProductTransport::where('transportType', 0)->latest()->get();
            $locations = TransportLocation::where('divisionId', '!=', null)->where('districtId', '!=', null)->get();
            return view('admin.productTransport.pickUpContent', ['pickUps' => $pickUps, 'locations' => $locations]);

        }
    }

    public function transportStore(Request $request){
        $report = Validator::make($request->all() ,[
            'transportType'=>'required|boolean',
            'transportTitle'=>'required|max:80',
            'cartWeight'=>'required',
            'price'=>'required',
            'transportTime'=>'required',
            'timePeriod'=>'required',
            'areaIds'=>'required',
            'details'=>'required|max:250',
            'zoneType'=>'required|boolean',
            'status'=>'required|boolean',
        ]);


        if($report->passes()){
            if($request->cartWeight > 0 && $request->price >=0 && $request->transportTime >0){

                $transport = new ProductTransport;
                $transport->transportType = $request->transportType;
                $transport->transportTitle = $request->transportTitle;
                $transport->details = $request->details;
                $transport->transportTime = $request->transportTime;
                $transport->timePeriod = $request->timePeriod;
                $transport->cartWeight = $request->cartWeight;
                $transport->areaIds = implode(',', $request->areaIds);
                $transport->price = $request->price;
                $transport->status = $request->status;
                $transport->zoneType = $request->zoneType;
                $transport->save();

                Session::flash('success', 'Transport Criteria Saved SuccessFully..!');
                return redirect()->back();

            }elseif($request->cartWeight < 0){
                Session::flash('warning', 'Cart Weight Negative Value Not Allow !');
                return redirect()->back();
            }elseif ($request->price <0){
                Session::flash('warning', 'Transport Charge Negative Value Not Allow !');
                return redirect()->back();
            }elseif ($request->transportTime < 0){
                Session::flash('warning', 'Transport Time Negative Value Not Allow !');
                return redirect()->back();
            }
        }
        return redirect()->back()->withErrors($report);
    }

    public function transportUpdate(Request $request){
        $report = Validator::make($request->all() ,[
            'transportTitle'=>'required|max:80',
            'cartWeight'=>'required',
            'price'=>'required',
            'transportTime'=>'required',
            'timePeriod'=>'required',
            'areaIds'=>'required',
            'details'=>'required|max:250',
            'zoneType'=>'required|boolean',
            'status'=>'required|boolean',
        ]);


        if($report->passes()){
            if($request->cartWeight > 0 && $request->price >=0 && $request->transportTime >0){

                $transport = ProductTransport::find($request->transportId);
                $transport->transportTitle = $request->transportTitle;
                $transport->details = $request->details;
                $transport->transportTime = $request->transportTime;
                $transport->timePeriod = $request->timePeriod;
                $transport->cartWeight = $request->cartWeight;
                $transport->areaIds = implode(',', $request->areaIds);
                $transport->price = $request->price;
                $transport->status = $request->status;
                $transport->zoneType = $request->zoneType;
                $transport->save();

                Session::flash('success', 'Transport Criteria Updated SuccessFully..!');
                return redirect()->back();

            }elseif($request->cartWeight < 0){
                Session::flash('warning', 'Cart Weight Negative Value Not Allow !');
                return redirect()->back();
            }elseif ($request->price <0){
                Session::flash('warning', 'Transport Charge Negative Value Not Allow !');
                return redirect()->back();
            }elseif ($request->transportTime < 0){
                Session::flash('warning', 'Transport Time Negative Value Not Allow !');
                return redirect()->back();
            }
        }
        return redirect()->back()->withErrors($report);
    }

    public function transportDestroy(Request $request){
        ProductTransport::find($request->transportId)->delete();

        Session::flash('success', 'Transport Criteria Deleted SuccessFully..!');
        return redirect()->back();
    }





}
