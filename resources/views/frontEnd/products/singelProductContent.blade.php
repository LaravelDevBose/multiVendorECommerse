@extends('frontEnd.master')

@section('title')
{{ ucwords($singelProduct->productName)}}
@endsection

@section('metaTag')
<meta name="description" content="{!! $singelProduct->shortDes !!}">
<meta property="og:description" content="{!! $singelProduct->shortDes !!}">
<meta property="og:type" content="website">
<meta property="og:locale" content="en_US">
<meta property="og:title" content="{!! ucwords($singelProduct->productName) !!}">
<meta property="og:site_name" content="Dorpon">
<!--<meta property="og:url" content="{{ route('product', $singelProduct->id) }}">-->
<meta property="og:image" content="{!! asset($singelProduct->thumbImage) !!}">
<meta property="og:image:secure_url" content="{!! asset($singelProduct->thumbImage) !!}">
<meta property="og:image:width" content="300">
<meta property="og:image:height" content="300">
<meta property="og:url" content="{{ route('product',$singelProduct->id) }}" />

@endsection

@section('headasset')
    
    <link rel="stylesheet" href="{{asset('public/frontEnd/css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontEnd/css/bootstrap.css')}}">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="{{ asset('public/frontEnd/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontEnd/css/star-rating.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontEnd/css/singleProduct.css')}}">
    <link href="{{asset('public/frontEnd/css/header.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontEnd/css/footer.css')}}" rel="stylesheet">
    <!--<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5a8d8398e3b02a00133b2dd5&product=inline-share-buttons' async='async'></script>-->

@endsection

@section('content')
<div class="lira">
    <section class="pat-design">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="atop-left-text">
                        @if($singelProduct->ownerId == 0)
                            <div class="atop-left-tximg">
                                <a href="{{ route('shop.view',0) }}">
                                    <?php
                                    $logo = App\Logo::where('publicationStatus', 1)->value('logo');
                                    if(!file_exists($logo)){ $logo='public/images/default/dorpon_logo.png'; }
                                    ?>
                                    <img src="{{ asset($logo) }}" alt="Dorpon">
                                </a>
                            </div>
                            <div class="icon-fav">
                                <a href="{{ route('shop.view',0) }}"><h1>Dorpon</h1></a>
                                <p><a href=""><i class="fa fa-heart" aria-hidden="true"></i>Favourite Shop</a></p>
                            </div>
                        @else
                            <div class="atop-left-tximg">
                                <a href="{{ route('shop.view',$singelProduct->ownerId) }}">
                                    <?php
                                    $shopInfo = App\Shop::where('id', $singelProduct->ownerId)->select('shopLogo', 'shopName')->first();
                                    $logo = $shopInfo->shopLogo;
                                    if(!file_exists($logo)){ $logo='public/artisan/assets/images/placeholder.jpg'; }
                                    ?>
                                    <img src="{{ asset($logo) }}" alt="{{ ucwords($shopInfo->shopName) }}">
                                </a>
                            </div>
                            <div class="icon-fav">
                                <a href="{{ route('shop.view',$singelProduct->ownerId) }}"><h1>{{ ucwords($shopInfo->shopName) }}</h1></a>
                                <p><a href=""><i class="fa fa-heart" aria-hidden="true"></i>Favourite Shop</a></p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="atop-right-img-tx">
                        <div class="atop-right-img">
                            @forelse($shopLatestProducts as $shopLatestProduct)
                                <?php
                                $thumbImage = $shopLatestProduct->thumbImage;
                                if(!file_exists($thumbImage)){ $thumbImage='public/artisan/assets/images/placeholder.jpg'; }
                                ?>
                                <a href="{{ route('product',$shopLatestProduct->id ) }}" title="{{ ucwords($shopLatestProduct->productName) }}"> <img src="{{ asset($thumbImage) }}" alt="{{ ucwords($shopLatestProduct->productName) }}"></a>
                                @empty
                            @endforelse
                        </div>
                        <div class="O6-items">

                            <a href="{{ route('shop.view',$singelProduct->ownerId) }}">
                                <span>{{ App\Product::where('ownerId',$singelProduct->ownerId)->where('status', 1)->count() }}</span>
                                <p>{{ ($shopLatestProducts->count() >=2 )?'items':'item' }}</p></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontEnd.includes.message')
      <section class="pat-design-slider">
          <div class="container">
              <div class="pat-design-slide">
                  <div class="row">
                      <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                          <div class="slider-main-cont">
                              <div class="slide-top-text">
                                  <div class="slide-top-text-1">
                                      @if (Auth::guest())
                                          <a href="#"  title="Login Pleases" data-toggle="modal" data-target="#userLogin" ><i style="color: #63c6a7;" class="fa fa-heart" aria-hidden="true"></i><p>Favourite item</p></a>
                                      @else
                                          @php
                                              $allUserId = App\ProductFavourite::where('productId', $singelProduct->id)->value('userId');
                                              $userIds = explode(",", $allUserId);
                                          @endphp
                                          @if (!in_array(Auth::User()->id, $userIds)|| empty($userIds))
                                              <a title="Not Favorite"  href="{{ route('favorite', array('id'=>$singelProduct->id, 'action'=>0)) }}"><i style="color: #63c6a7;" class="fa fa-heart" aria-hidden="true"></i><p>Favourite item</p></a>
                                          @else
                                              <a title="Favorited" style="color: red;" href="{{ route('favorite', array('id'=>$singelProduct->id, 'action'=>Auth::User()->id)) }}"><i class="fa fa-heart" aria-hidden="true"></i><p>Favourite item</p></a>
                                          @endif

                                      @endif

                                  </div>
                                  <div class="slide-top-text-2">
                                      <h4>Like this item?</h4>
                                      <p>Add it to your favorites to revisit later</p>
                                      <div class="share-icon">
                                  <div class="share">
                                      <h4>Share on:</h4>
                                  </div>
                                  <div class="fttop-icons">
                                      <!--<div class="sharethis-inline-share-buttons"></div>-->
                                      <!-- AddToAny BEGIN -->
                                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                        <!--<a class="a2a_dd" href="https://www.addtoany.com/share"></a>-->
                                        <a title="Share on Facebook" class="a2a_button_facebook" ><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        <a  title="Share on Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                        <a  title="Save on Pinterest" class="a2a_button_pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
                                        <a  title="Tweet on Twitter" class="a2a_button_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        <a class="a2a_button_google_plus"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                        <a class="a2a_button_linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        <a class="a2a_button_whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                                        </div>
                                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                                         <!--AddToAny END -->
                                      
                                  </div>
                              </div>
                                  </div>
                              </div>
                              <div class="section-body">
                                  <div id="myCarousel" class="carousel slide display-wraper" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                    <?php $count=0;?>
                                      @foreach($productImages as $productImage)
                                        @if($count==0)
                                          <li data-target="#myCarousel" data-slide-to="{{$count++}}" class="active"><img class="img-responsive" src="{{ asset($productImage->image) }}"></li>
                                        @else
                                          <li data-target="#myCarousel" data-slide-to="{{$count++}}"><img class="img-responsive" src="{{ asset($productImage->image) }}"></li>
                                        @endif
                                      @endforeach
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner ">
                                    <?php $count=0;?>
                                      @foreach($productImages as $productImage)
                                        @if($count==0)
                                          <div class="item active">
                                        @else
                                          <div class="item">
                                        @endif
                                        <div class="display-item text-center">
                                          <img src="{{ asset($productImage->image) }}">
                                        </div>
                                      </div>
                                      <?php $count++;?>
                                      @endforeach

                                    </div>

                                    <!-- Left and right controls -->
                                     <a class=" chev-left" href="#myCarousel" data-slide="prev">
                                      <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                      <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="  chev-rifgt" href="#myCarousel" data-slide="next">
                                      <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                      <span class="sr-only">Next</span>
                                    </a>
                                  </div>

                              </div>
                              
                              <div class="tabss">
                                  <ul class="tab-links">
                                      <li class="active"><a id="tabdetails" href="#tab1">Details</a></li>
                                      <li><a id="tabdetails" href="#tab2">Delivery</a></li>
                                      <li><a id="tabdetails" href="#tab3">Reviews</a></li>
                                      <li><a id="tabdetails" href="#tab4">Questions</a></li>
                                  </ul>
                                  <div class="tab-content">
                                      <div id="tab1" class="tabb active">
                                          {!!  $singelProduct->details !!}
                                      </div>

                                      <div id="tab2" class="tabb">

                                      </div>

                                      <div id="tab3" class="tabb">
                                          <p>Please put your rating below...</p>
                                    <div class="star-qust">
                                      <div class="review-icon">
                                          @if(Auth::guard('web')->user())
                                              <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step=".1"  value="{{ $singelProduct->userAverageRating }}" data-size="xs"  {{ (App\Rating::where('rateable_type', 'App\Product')->where('rateable_id', $singelProduct->id)->where('user_id', Auth::User()->id)->count() !=0 ) ? 'readonly':' ' }} >
                                          @elseif(Auth::guard('merchantile')->user())
                                              <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step=".1"  value="{{ $singelProduct->userAverageRating }}" data-size="xs"  readonly>
                                          @else
                                              <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step=".1"  value="{{ $singelProduct->userAverageRating }}" data-size="xs"  >
                                          @endif

                                      </div>
                                      <div class="review_title">
                                    <textarea class="comment-say" cols="60" rows="2" placeholder="Write review title here...."></textarea>  
                                  </div>
                                      <div class="review-text-area">
                                  <p>Please write your review below:</p>
                                  <textarea class="comment-say" cols="60" rows="6" placeholder="Write detail review here...."></textarea>
                                  
                              </div>
                                  </div>

                                      </div>

                                      <div id="tab4" class="tabb">
                                          <p>Black</p>

                                      </div>
                                  </div>
                              </div>

                          </div>
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                              <div class="slider-right-text">
                                  <div class="slide-top-text-code">
                                      <label>{{ ucwords($singelProduct->productName) }}</label>
                                      <p>Product Code: <span>{{ $singelProduct->productCode }}</span></p>
                                  </div>
                                  <div class="star-qust">
                                      <div class="review-icon">
                                          @if(Auth::guard('web')->user())
                                              <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step=".1"  value="{{ $singelProduct->userAverageRating }}" data-size="xs"  {{ (App\Rating::where('rateable_type', 'App\Product')->where('rateable_id', $singelProduct->id)->where('user_id', Auth::User()->id)->count() !=0 ) ? 'readonly':' ' }} >
                                          @elseif(Auth::guard('merchantile')->user())
                                              <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step=".1"  value="{{ $singelProduct->userAverageRating }}" data-size="xs"  readonly>
                                          @else
                                              <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step=".1"  value="{{ $singelProduct->userAverageRating }}" data-size="xs"  >
                                          @endif

                                      </div>
                                      <a href="" class="review">{{ $reviews->count() }} {{ ($reviews->count() > 1)?'Reviews':'Review(s)' }} <span> | </span></a>
                                      <a href="" class="qust">{{ $questions->count() }} {{ ($questions->count() > 1)?'Questions':'Question(s)' }} </a>
                                  </div>
                                  <div class="stock">
                                      @if($productSizes->sum('quantity') >0)
                                        <label>In Stock</label>
                                      @else
                                        <label>Out of Stock</label>
                                      @endif
                                      {{--<a href="">Pre-Order Now</a>--}}
                                  </div>
                                  @if(!empty($productSizes) && $productSizes->count() > 0)
                          <form action="{{ route('cart.add') }}" method="POST" enctype="multipart/form-data"> {{csrf_field()}}
                              <input type="hidden" name="productId" value="{{ $singelProduct->id }}">
                                  @if(!empty($productSizes) && $productSizes->count() > 1)
                                  <div class="size">
                                      <h4>Size:</h4>
                                      <select style="width: 50px;" class="form-control" id="sizeF" name="size" required>
                                          @forelse($productSizes as $productSize)
                                              <?php $size = App\Size::where('id', $productSize->sizeId)->select('sizeTitle', 'id')->first(); ?>
                                              @if($loop->first)
                                                <option class="dtop-itm" value="{{ $size->id }}" >{{ $size->sizeTitle }} <i class="fa fa-sort-desc" aria-hidden="true"></i></option>
                                              @else
                                                <option class="dtop-itm" value="{{ $size->id }}" >{{ $size->sizeTitle }}</option>
                                              @endif
                                          @empty

                                          @endforelse
                                      </select>
                                      <span>(See Size Chart in 'Details' section)</span>
                                  </div>
                                  @else
                                      <input type="hidden" name="size"  value="{{ $productSizes->pluck('sizeId')[0] }}">
                                  @endif

                                  @if(!empty($primaryColors) && $primaryColors->count() > 1)
                                  <div class="color">
                                      <h4>Color: </h4>

                                      <div class="tabs">

                                          <div class="tab-content">
                                              @foreach($primaryColors as $primaryColor)
                                              <div id="tab{{ $primaryColor->id }}"  class="tab {{ ($loop->first)?'active': ' ' }}">
                                                  <p>{{ ucfirst($primaryColor->colorName) }}</p>
                                              </div>
                                                @endforeach
                                          </div>


                                          <div class="all">
                                          @foreach($primaryColors as $primaryColor)

                                              <label class="color-container" style="display: unset;">
                                                  <a  href="#tab{{ $primaryColor->id }}">
                                                        <input type="radio" name="color" value="{{ $primaryColor->id }}"/>
                                                        <span class="p-color checkmark" style="position:unset; background-color: {{ $primaryColor->colorCode }}; "></span>
                                                  </a>
                                              </label>

                                          @endforeach
                                          </div>


                                      </div>

                                  </div>
                                  @else
                                  <input type="hidden" name="color" value="{{ $primaryColors->pluck('id')[0] }}"/>
                                  @endif
                              </div>

                              <div class="quantity">
                                  <h4>Quantity: </h4>
                                  <select id="all-cont" class="form-control" name="qty" required>
                                      @if($productSizes->count() > 1)
                                          <option class="dtop-itm" value=" " >Select Product Size First</option>
                                      @else
                                          @foreach($productSizes as $productSizes)
                                              @if($productSizes->quantity == 0)
                                                  <option class="dtop-itm" value="0" >0</option>
                                              @else
                                                  @for($i = 1; $i<=$productSizes->quantity; $i++)
                                                      <option class="dtop-itm" value="{{ $i }} " >{{ $i }}</option>
                                                  @endfor
                                              @endif
                                          @endforeach
                                      @endif
                                  </select>
                              </div>
                                @endif
                              <div class="seal-card">
                                  @if(!is_null($singelProduct->discount))
                                      <div class="sale-first-text">
                                          <p>Unit Price: <del>Tk. {{ number_format($singelProduct->sellPrice) }}</del><span>Tk. {{ number_format($singelProduct->finalPrice) }} <img src="{{ asset('public/images/default/sales_tag.png') }} " alt=""></span></p>
                                      </div>
                                      {{--<div class="sale-second-text">--}}
                                          {{--<p>Total Price: Tk. 1,600 + FREE Delivery</p>--}}
                                      {{--</div>--}}
                                      <div class="sale-third-text">
                                          <p>Your Save: Tk. {{ number_format($singelProduct->sellPrice - $singelProduct->finalPrice) }} ({{ $singelProduct->discount }}%)</p>
                                      </div>
                                  @else
                                      <div class="sale-first-text">
                                          <p>Unit Price: <span>Tk. {{ number_format($singelProduct->finalPrice) }}</span></p>
                                      </div>
                                  @endif
                              </div>
                      @if(!empty($productSizes) && $productSizes->count() > 0)
                          @if($singelProduct->customeStatus == 1)
                              <div class="comment-text-area">
                                  <p>Message for customizable product</p>
                                  <textarea class="comment-say" cols="60" rows="6" placeholder="Please write your preferred customization, we will try to accommodate your request. For print option, please upload your jpg file below the message box"></textarea>
                                  <div class="browse">
                                      <p>Browse: <span><input type="file" /></span> </p>
                                  </div>
                              </div>
                          @endif
                              <button type="submit" class="addto-cart"><i class="fa fa-shopping-bag" aria-hidden="true"></i>Add to Shopping Bag</button>
                              <!--<button type="submit" class="addto-cart"><i class="fa fa-credit-card"></i>Checkout</button>-->
                          </form>
                      @endif
                          <div class="slider-right-menu">
                              <h2>Overview:</h2>
                              <ul>

                                  <li>{!!  ucfirst($singelProduct->shortDes) !!}</li>
                                  @if(count($productSizes) == 1)
                                  <li>Size: {{ App\Size::where('id', $productSizes->sizeId)->value('sizeTitle') }}</li>
                                  @endif
                                  @if(count($primaryColors) == 1)
                                      <li>Color: <span >{{ $primaryColors->pluck('colorName')[0] }}</span></li>
                                  @endif
                                  <li>Main Material:
                                      <?php $material = explode(',', $singelProduct->materialsIds); ?>
                                      @for($i=0; $i<count($material); $i++)
                                          {{ App\ProductMaterial::where('id', $material[$i])->value('materialName') }}
                                          @if($i+1 == count($material))

                                          @else
                                              |
                                          @endif
                                      @endfor
                                  </li>
                                  <?php if($singelProduct->ownerId == 0){$shopAddress = 'Dhaka';}else{$shopAddress = DB::table('shop_addresses')->join('transport_locations', 'shop_addresses.districtId','=', 'transport_locations.id')
                                      ->where('shop_addresses.shopId', $singelProduct->ownerId)->value('transport_locations.areaName');} if(empty($shopAddress)){$shopAddress='Dhaka';}?>
                                  <li>Ships country wide from {{ $shopAddress }}</li>
                                  <li>Feedback: {{ number_format($reviews->count()) }} people</li>
                                  <li>Favorited by: {{ number_format($fvrtCount) }} people</li>
                              </ul>
                          </div>
                              @if($singelProduct->ownerId == 0)

                                  <div class="img-pdesign">
                                      <a href="{{ route('shop.view',0) }}">
                                          <?php
                                          $logo = App\Logo::where('publicationStatus', 1)->value('logo');
                                          if(!file_exists($logo)){ $logo='public/images/default/dorpon_logo.png'; }
                                          ?>
                                          <img src="{{ asset($logo) }}" alt="Dorpon">
                                      </a>
                                      <a href="{{ route('shop.view',0) }}"><h1>Dorpon</h1></a>
                                      <p>Banani, Dhaka</p>
                                  </div>
                              @else
                                  <div class="img-pdesign">

                                      <?php
                                      $shopInfo = App\Shop::where('id', $singelProduct->ownerId)->select('shopLogo', 'shopName')->first();
                                      $shopAddress = DB::table('shop_addresses')->join('transport_locations', 'shop_addresses.districtId','=', 'transport_locations.id')
                                          ->where('shop_addresses.shopId', $singelProduct->ownerId)->value('transport_locations.areaName');
                                      $logo = $shopInfo->shopLogo;
                                      if(!file_exists($logo)){ $logo='public/artisan/assets/images/placeholder.jpg'; }
                                      ?>
                                      <a href="{{ route('shop.view',$singelProduct->ownerId) }}"><img src="{{ asset($logo) }}" alt="{{ ucwords($shopInfo->shopName) }}"></a>
                                      <a href="{{ route('shop.view',$singelProduct->ownerId) }}"><h1>{{ ucfirst($shopInfo->shopName) }}</h1></a>
                                      <p>{{ ucfirst($shopAddress) }}</p>
                                  </div>
                              @endif

                              <div class="pat-design-item">
                                  @forelse($shopBestProducts as $shopBestProduct)
                                      <div class="pat-item-one">
                                          <a href="{{ route('product', $shopBestProduct->id) }}" title="{{ ucfirst($shopBestProduct->productName) }}">
                                              <?php $shopProductImage = $shopBestProduct->thumbImage; if(!file_exists($shopProductImage)){ $shopProductImage='public/artisan/assets/images/placeholder.jpg'; } ?>
                                              <img src="{{ asset($shopProductImage) }}" alt="{{ $shopBestProduct->productName }}">
                                              <div class="pat-item-one-tx">
                                                  <h6 >{{ ucfirst($shopBestProduct->productName) }}</h6>
                                                  <p>Tk. {{ number_format($shopBestProduct->finalPrice) }}<span>@if(isset($product->discount) )<del>Tk. {{ $product->sellPrice }} </del>({{ $product->discount }}%)</span>@endif</p>
                                              </div>
                                          </a>
                                      </div>
                                  @empty

                                  @endforelse
                              </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>

</div>
@endsection

@section('footerLink')

  <script src="{{asset('public/frontEnd/js/jquery-1.9.1.min.js')}}"></script>
  <script src="{{asset('public/frontEnd/js/swiper.min.js')}}"></script>
  <script src="{{asset('public/frontEnd/js/main.js')}}"></script>
  <script src="{{asset('public/frontEnd/js/star-rating.js')}}"></script>
  <script >$("#input-1").rating(); var check = 1; </script>
  <script src="{{asset('public/frontEnd/js/singelProductAjax.js')}}"></script>
  <script src="{{asset('public/frontEnd/js/ratting.js')}}"></script>
@endsection