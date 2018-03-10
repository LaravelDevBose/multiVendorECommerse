@extends('frontEnd.master')

@section('title')
{{ $shopInfo->shopName }}

@endsection

@section('headasset')

<link href="{{ asset('public/frontEnd/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('public/frontEnd/css/bootstrap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('public/frontEnd/css/star-rating.css')}}">
<link href="{{ asset('public/frontEnd/css/main.css') }}" rel="stylesheet">
<link href="{{ asset('public/frontEnd/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{asset('public/frontEnd/css/font-awesome.min.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/header.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontEnd/css/footer.css')}}" rel="stylesheet">
@endsection

@section('content')

<div class="sliders">
     <div class="row">
         <?php
         $bannerImage =$shopDetails->bannerImage; if(!file_exists($bannerImage)|| is_null($bannerImage)){$bannerImage ='public/images/default/shop_cover_image.jpg'; }
         $shopLogo =$shopInfo->shopLogo; if(!file_exists($shopLogo)|| is_null($shopLogo)){$shopLogo ='public/artisan/assets/images/placeholder.jpg'; }
         $ownerImage =$ownerInfo->avater; if(!file_exists($ownerImage)|| is_null($ownerImage)){$ownerImage ='public/images/default/user-icon.png'; }
         ?>

         <img class="img-responsive banner-img"  src="{{ asset($bannerImage)}}" alt="{{ $shopInfo->shopName }}">

         <div class="company-logo text-center">
           <div class="logo-outer">
             <img src="{{ asset($shopLogo) }}" alt="{{ $shopInfo->shopName }}">
           </div> 
             <h1 class="shope-name">{{ ucfirst( $shopInfo->shopName) }}</h1>
             <ul class="shope-address">
                 @if(empty($shopAddress))
                     <li>Shop address not set yet</li>
                 @else
                    <?php
                         $upzila = App\TransportLocation::where('id', $shopAddress->areaId)->value('areaName');
                         $disName = App\TransportLocation::where('id', $shopAddress->districtId)->value('areaName');
                         $divName = App\TransportLocation::where('id', $shopAddress->divisionId)->value('areaName');
                    ?>
                     <li>{{ strtoupper ($upzila).' ,'.strtoupper($disName).' ,'.strtoupper($divName)}}</li>
                @endif
                 <span class="fa fa-vertical-line"></span>
                 <li>{{ $totalSales }} items sold</li>
                 <span class="fa fa-vertical-line"></span>
                 <?php 
                 $date = new DateTime($shopInfo->created_at);
                 $joiningDate = date_format($date, 'd F Y');
                  
                  ?>
                 <li>Joined Dorpon on {{ $joiningDate }}</li>
             </ul>
             <p class="shop-activity">
                 @if(Auth::guard('web')->user())
                    <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step=".1"  value="{{ $shopInfo->userAverageRating }}" data-size="xs"  {{ (App\Rating::where('rateable_type', 'App\Shop')->where('rateable_id', $shopInfo->id)->where('user_id', Auth::User()->id)->count() !=0 ) ? 'readonly':' ' }} >
                  @elseif(Auth::guard('merchantile')->user())
                     <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step=".1"  value="{{ $shopInfo->userAverageRating }}" data-size="xs"  readonly>
                 @else
                     <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step=".1"  value="{{ $shopInfo->userAverageRating }}" data-size="xs"   >
                 @endif
                     <span>({{ $shopReview = App\Rating::where('rateable_type', 'App\Shop')->where('rateable_id', $shopInfo->id)->count() }} {{ ($shopReview >1) ? 'REVIEWS' : 'REVIEW' }} )</span>
                 @if (Auth::guest())
                     <a title="Login Pleases" data-toggle="modal" data-target="#userLogin"  class="btn  btn-default btn-circle fvrt-btn"><i style="color: #63c6a7;" class="fa fa-heart-o" aria-hidden="true"></i>Favourite item</a>

                 @else
                     @if (!in_array(Auth::User()->id, $userIds)|| empty($userIds))
                         <a title="Not Favorite" href="{{ route('shop.favourite', array('id'=>$shopInfo->id, 'action'=>0)) }}"  class="btn  btn-default btn-circle fvrt-btn"><i style="color: #63c6a7;" class="fa fa-heart-o" aria-hidden="true"></i>Favourite item</a>
                     @else
                         <a title="Favorited" href="{{ route('shop.favourite', array('id'=>$shopInfo->id, 'action'=>Auth::User()->id)) }}"  class="btn  btn-default btn-circle fvrt-btn"><i style="color: red;" class="fa fa-heart-o" aria-hidden="true"></i>Favourite item</a>
                     @endif

                 @endif
                <span>{{ number_format((empty($userIds[0])) ? 0 :count($userIds)) }} liked</span></p>

         </div>
     </div>
</div>
<!-- / sliders -->
<div class="shopping container">
   <div class="row">
       <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 wonner-demo pull-right">
           <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                <div class="shop-short-info">
                   <h3>Shop Activities</h3>
                   <label> Total items: {{ $totalProducts }}</label>
                   <label> Items sold: Tk. {{ number_format($totalSalesAmount) }} </label>
                   <label> Total likes: {{ number_format((empty($userIds[0])) ? 0 :count($userIds)) }} </label>
                   <label> Total reviews: {{ number_format($shopReview) }}</label>

                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  text-center">
              <div class="shop-owner user-view">
                <h2>Shop owner details</h2>
                  <img src="{{ asset($ownerImage)}}" alt="{{ $ownerInfo->name }}">
                  <h3>{{ strtoupper($ownerInfo->name)}}</h3>
              </div>     
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shop-dassbord text-center">
               <div class="dassboard-inner">
                <div class="row shop-item">
                
                  @forelse($products as $product)
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 shop-product user-view-product">
                       <div class="product-item text-center ">
                        <?php $productImage =$product->thumbImage; if(!file_exists($productImage) || is_null($productImage)){ $productImage='public/artisan/assets/images/placeholder.jpg'; } ?>
                           <img class="img-responsive" src="{{ asset( $productImage)}}" alt="{{ $product->productName }}">
                           <h4><a title="{{ ucwords($product->productName ) }}" href="{{ route('product',$product->id) }}" style="color:#000; text-decoration: none;">{{ ucwords($product->productName ) }}</a></h4>
                            <p>{{ App\Category::where('id', $product->mainCatId)->value('categoryName') }}</p>
                           <h4 style="display: inline-block;">Tk. {{ number_format( $product->finalPrice)}}</h4>
                            @if(isset($product->discount) )
                                <div class="del-item"><del>Tk. {{ $product->sellPrice }}</del>({{ $product->discount }}%)</div>
                            @endif

                        </div>
                    </div>
                      @empty
                      <label>This Shop Has No Products for sales</label>
                  @endforelse
                  {{ $products->links() }}           
                </div>
             </div> 
           </div> 
        </div>
        @include('frontEnd.shopView.shopLeftSideBar')

        </div>
   </div>
</div>


@endsection

@section('footerLink')

    <script src="{{asset('public/frontEnd/js/jquery-1.9.1.min.js')}}"></script>
    <script src="{{asset('public/frontEnd/js/star-rating.js')}}"></script>
    <script > $("#input-1").rating(); var check = 0; </script>
    <script src="{{asset('public/frontEnd/js/ratting.js')}}"></script>
@endsection
