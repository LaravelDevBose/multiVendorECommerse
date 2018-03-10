@extends('frontEnd.master')

@section('title')
Dorpon | Update Details
@endsection
@section('headasset')

<link href="{{ asset('public/frontEnd/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('public/frontEnd/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/frontEnd/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{asset('public/frontEnd/css/font-awesome.min.css')}}" rel="stylesheet">
<link href="{{ asset('public/frontEnd/css/header.css') }}" rel="stylesheet">
<link href="{{ asset('public/frontEnd/css/footer.css') }}" rel="stylesheet">
@endsection

@section('content')
<style type="text/css">

  .styled {
    color: #63c6a7;
    font-size: 16px;
    
  }
  .required{
    color: red;
    font-size: 16px;
    font-weight: 900;
  }
</style>

  <div class="container wraper-null">
    <h4>Update Details</h4>
    <p class="text text-primary">Dear customer, all your information will be used only for completing your order. Thanks you..!</p>
    <div class="row">

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
        <form method="POST" action="{{ route('deatils.add') }}">
        {{ csrf_field() }}

        <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
          
          <div class="form-group shop-form">
            <label for="exampleInputEmail1">NID Number :</label>
            <input type="text" name="nationalId" value="{{ $consumerDetails->nationalId }}"  autofocus class="form-control btn-circle" aria-describedby="emailHelp" placeholder="National Id Number">
          </div>

          
          <div class="form-group shop-form">
            <label for="exampleInputEmail1">Road No. :</label>
            <input type="text" name="roadNo" value="{{ $consumerDetails->roadNo }}" class="form-control btn-circle" aria-describedby="emailHelp" placeholder="road No.">
          </div>
          <div class="form-group shop-form">
            <label for="exampleInputEmail1">Area Name : </label>
            <input type="text" name="areaName" value="{{ $consumerDetails->areaName }}"  autofocus class="form-control btn-circle" aria-describedby="emailHelp" placeholder="Area Name">
          </div>
          
          <div class="form-group shop-form">
            <label for="exampleInputEmail1">Division </label>
            <select name="divisionId" autofocus class="form-control btn-circle" required >
                @foreach($divisions as $division)
                    <option value="{{ $division->id }}">{{ $division->areaName }}</option>
                @endforeach
            </select>
            
          </div>
          
          <div class="form-group shop-form">
            <label for="exampleInputEmail1">Thana/Upozila </label>
            <select name="areaId" autofocus class="form-control btn-circle" required >
                
            </select>
            
          </div>
          
          

      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">

          <div class="form-group shop-form">
            <label for="exampleInputEmail1">House No. : </label>
            <input type="text" name="houseNo" value="{{ $consumerDetails->houseNo }}"  autofocus class="form-control btn-circle" aria-describedby="emailHelp" placeholder="House No">
          </div>
        <div class="form-group shop-form">
            <label for="exampleInputEmail1">Block :</label>
            <input type="text" name="block" value="{{ $consumerDetails->block }}"  autofocus class="form-control btn-circle" aria-describedby="emailHelp" placeholder="Block Name">
          </div>
          
        <div class="form-group shop-form">
            <label for="exampleInputEmail1">Postal/ZIP Code :</label>
            <input type="number" name="zipCode" value="{{ $consumerDetails->zipCode }}"  autofocus class="form-control btn-circle" aria-describedby="emailHelp" placeholder="Area Zip Code">
          </div>
          
          <div class="form-group shop-form">
            <label for="exampleInputEmail1">District </label>
            <select name="districtId" autofocus class="form-control btn-circle" required >
                
            </select>
            
          </div>
          

          

      </div>
      <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">

          <div class="row text-center shop-xs">
             <a class="mybtn btn-circle cancel" href="{{ route('user.home') }}">Cancel</a>
            <button  class="mybtn btn-circle creat">Update Details</button>
          </div>

        </form>
      </div>
      
    </div>
  </div>

@endsection

@section('footerLink')
    <script src="{{ asset('public/frontEnd/js/productCartAjax.js') }}"></script>

@endsection