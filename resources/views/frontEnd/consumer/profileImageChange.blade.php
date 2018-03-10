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

  <div class="container wraper-null" style="padding-top: 2em;">
    @include('frontEnd.includes.message')
    <div class="row">

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10 col-lg-offset-3 col-md-offset-3 col-sm-offset-3" style="min-height: 200px;">
        <form method="POST" action="{{ route('profile.image') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div >
                <div class="form-group shop-form">
                    <label for="exampleInputEmail1">Change Profile Image</label>
                    <input type="file" name="avater" value="{{ old('avater') }}"  autofocus class="form-control btn-circle" required accept="image/*">
                </div>
            </div>
            
        
           <div class="row text-center shop-xs">
             <a class="btn  btn-danger cancel" href="{{ route('user.home') }}">Cancel</a>
            <button type="submit"  class="btn btn-success ">Upload Image</button>
          </div>

        </form>
          
      </div>
      
    </div>
  </div>

@endsection

@section('footerLink')


@endsection