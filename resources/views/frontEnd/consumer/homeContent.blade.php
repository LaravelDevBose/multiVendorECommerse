@extends('frontEnd.master')

@section('title')
Dorpon | {{ ucwords(Auth::User()->name) }}

@endsection

@section('headasset') 
<link href="{{ asset('public/frontEnd/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/frontEnd/css/bootstrap.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/frontEnd/css/main.css') }}" rel="stylesheet">
<link href="{{ asset('public/frontEnd/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<!--<link href="{{ asset('public/frontEnd/css/style.css') }}" rel="stylesheet">-->
<link href="{{ asset('public/frontEnd/css/header.css') }}" rel="stylesheet">
<link href="{{ asset('public/frontEnd/css/footer.css') }}" rel="stylesheet">

@endsection

@section('content')


<!-- / sliders -->
<div class="shopping container">
   <div class="row">
       <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 wonner-demo pull-right">
            
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  text-center">
              <div class="shope-wonner ">
                  
                <a href="{{ route('profile.image') }}" title="Change Profile Image" >
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
				  <?php
				   $userImage = Auth::user()->avater; 
				   
                    if(!file_exists($userImage)){
    				   if(App\SocialProvider::where('user_id', Auth::User()->id) && !empty($userImage)){
    				   		$userImage = Auth::user()->avater; 
    				   }else{
    				   		$userImage = 'public/images/default/user-icon.png';
    				       
    				   }
				   }
				  
				   ?>

                  <img  src="{{ asset($userImage)}}" alt="{{ Auth::user()->name }}">

					<h3>{{ ucfirst(Auth::user()->name)}}</h3>
                @if(empty(Auth::User()->phoneNo)|| is_null(Auth::User()->phoneNo) )
                  <lable class="phn"><i class="fa fa-phone" aria-hidden="true"></i>Not Added</lable>
                @else
                  <lable class="phn"><i class="fa fa-phone" aria-hidden="true"></i>+88-{{ Auth::User()->phoneNo }}</lable>
                @endif
                
              </div>     
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                <div class="shope-inner">
                   
                   <h3>ACTIVITY SUMMARY</h3>
                    
                       <label>Products Purchased : {{ $totalProduct }}</label>
                       <label>Total Purchased Amount : Tk. {{ number_format($totalAmmount) }}</label>
                       <label>Total Likes : {{ count($totalLikes) }}</label>
                       <label>Total Reviews : {{ count($productsReviews) }}</label>
                   
                </div>
            </div>
            <div id="h-table" >
            	<div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shoppin-demo text-center">
                    <div class="history">
                        @include('frontEnd.includes.message')
	                <div class="row">
	                
	                  <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6  text-center ">
	                    <form action="#" method="POST">{{ csrf_field() }}
	                      <div class="form-group">
	                        <div class="input-group">
	                         <input type="text" class="form-control btn-circle"  name="productName" placeholder="SEARCH ITEM">
	                            <div class="input-group-addon btn-circle">
	                             <i class="fa fa-search" aria-hidden="true"></i>
	                            </div>
	                        </div>
	                      </div>
	                    </form>
	                  </div>

	                </div>
	                <div class="row">
	                    
	                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
	                      <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
	                        <thead>
	                        <tr>
	                          <th colspan="6">
	                              <h4 class="table-title">ORDER HISTORY </h4>
	                          </th>
	                        </tr>
	                          <tr>
	                            <th class="table-headding text-center">#</th>
	                            <th class="table-headding text-center">No. of Product</th>
	                            <th class="table-headding amount">Total Amount</th>
	                            <th class="table-headding text-center">Date</th>
	                          </tr>
	                        </thead>
	
	                        <tbody><?php $i=1;?>
	                        @foreach($ordersInfo as $orderInfo)
	                          <tr>
	                            <td>{{ $i++ }}</td>
	                            <td>{{ $orderInfo->totalProduct }}</td>
	                            <td class="amount">&#2547; {{ $orderInfo->totalAmmount }}</td>
	                            <?php 
	                               $date = new DateTime($orderInfo->created_at);
	                               $orderDate = date_format($date, 'd.m.y');
	                                
	                                ?>
	                            <td>{{ ucwords( $orderDate) }}</td>
	                          </tr>
	                        @endforeach
	                        </tbody>
	
	                        
	                      </table>
	                  </div>
	                </div>
	            </div>
	         </div>
            </div> 
        </div>
        @include('frontEnd.consumer.consumerLeftSidebarContent')

        </div>
   </div>
</div>
@include('frontEnd.consumer.consumerReviewContent')

@endsection
@section('footerLink')
    <script src="{{asset('public/frontEnd/js/jquery-3.2.1.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/fileinput.min.js"></script>
    <script>
        $("#file-1").fileinput({
        theme: 'fa',
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'png', 'gif'],
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFilesNum: 10,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });
    </script>
@endsection

