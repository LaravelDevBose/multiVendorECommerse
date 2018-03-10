@extends('frontEnd.master')

@section('title')
Dorpon | Products
@endsection

@section('headasset')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="{{asset('public/frontEnd/css/bootstrap.css')}}">
    <link href="{{ asset('public/frontEnd/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontEnd/css/simplePagination.css')}}">

    <link rel="stylesheet" href="{{asset('public/frontEnd/css/star-rating.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontEnd/css/products.css')}}">
    <script src="{{asset('public/frontEnd/js/jquery.simplePagination.js')}}"></script>
    <script>
        $( function() {
            $( "#slider-range" ).slider({
                range: true,
                min: 10,
                max: "{{ $products->max('finalPrice') }}",
                values: [ {{ $products->min('finalPrice') }} , {{ $products->max('finalPrice') }} ],
                slide: function( event, ui ) {

                    $("#amount_start").val(ui.values[ 0 ]);
                    $("#amount_end").val(ui.values[ 1 ]);
                    var start = $('#amount_start').val();
                    var end = $('#amount_end').val();
                    $.ajax({
                        type: 'get',
                        dataType: 'html',
                        url: '',
                        data: "start=" + start + "&end=" + end,
                        success: function (response) {
                            console.log(response);
                            $('#sortedProduct').empty();
                            $('#sortedProduct').html(response);
                        }
                    });
                }
            });
            $("#amount_start").val($( "#slider-range" ).slider( "values", 0 ));
            $("#amount_end").val($( "#slider-range" ).slider( "values", 1 ));

        } );
    </script>
@endsection

@section('content')
<section class="content-area">
    <div class="container-fluid product_cat">
        <div class="content_top">
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="categories">
                        <div class="category-menu">
                            <ul>
                                <li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>All Categories</a></li>
                                <li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>Jewelry</a></li>
                                <li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>Necklaces</a></li>
                                <li><a class="pendent" href="#">Pendents</a></li>
                            </ul>
                        </div>
                        <div class="checkbox2">
                            <h5>Colour</h5>
                            <?php $k=0; ?>
                            @foreach($colors as $color)
                                @if($k <10)
                                <label class="containerr">
                                    <input type="checkbox" name="colorId" value="{{ $color->id }}">{{ $color->colorName }}
                                    <span class="checkmarks" title="{{ $color->colorName }}" style="background-color:{{ $color->colorCode }};  border: .1px solid #908b8b;"></span>
                                </label>

                                @else

                                    @if($k == 10)
                                        <div class="panel single-accordion">
                                            <div id="two" class="accor-content collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    @endif
                                                <label class="containerr">
                                                    <input type="checkbox" name="colorId" value="{{ $color->id }}">{{ $color->colorName }}
                                                    <span class="checkmarks" title="{{ $color->colorName }}" style="background-color:{{ $color->colorCode }};  border: .1px solid #908b8b;"></span>
                                                </label>

                                    @if(count($colors)-1 == $k)
                                            </div>
                                            <div class="accor-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseThree" href="#two">+Show more</a>
                                            </div>
                                        </div>
                                    @endif

                                @endif

                                <?php $k++;?>
                            @endforeach
                        </div>
                        <div class="checkbox2">
                            <p>
                                <label for="amount" class="price-r">Price range:</label>
                            </p>
                             <h6> From: Tk.  <input type="text" id="amount_start"  size="2"> <span>To: Tk.</span>
                                 <input type="text" id="amount_end" size="2"></h6>
                            <div id="slider-range"></div>
                        </div>
                        <div class="checkbox2">
                            <label class="containerr">
                                <input type="checkbox" name="discount" value="1">On Sale
                                <span class="checkmarks" ></span>
                            </label>

                        </div>
                        <div class="checkbox2">
                            <h5>Shop Name</h5>
                            <?php $y=0; ?>
                            @forelse($sellerList as $sellerId => $sellerName)
                                @if($y <10)
                                    <label class="containerr">
                                        <input type="checkbox" name="shopId" value="{{ $sellerId }}">{{ $sellerName }}
                                        <span class="checkmarks" title="{{ $sellerName }}"></span>
                                    </label>

                                @else

                                    @if($y == 10)
                                    <div class="panel single-accordion">
                                        <div id="two" class="accor-content collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    @endif
                                            <label class="containerr">
                                                <input type="checkbox" name="shopId" value="{{ $sellerId }}">{{ $sellerName }}
                                                <span class="checkmarks" title="{{ $sellerName }}" ></span>
                                            </label>

                                    @if(count($sellerList)-1 == $y)
                                        </div>
                                        <div class="accor-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseThree" href="#two">+Show more</a>
                                        </div>
                                    </div>
                                    @endif

                                @endif

                            @empty
                                <?php $y++ ;?>
                            @endforelse

                        </div>


                    </div>
                </div>
                <div class="col-md-9 col-sm-8 col-xs-12" id="sortedProduct">
                    <div class="row">
                        
                        @foreach($products as $product)
                        <div class="col-md-4 col-sm-4 col-xs-6 paginate">
                            <div class="box_inner">
                                <div class="box-image">
                                    <?php $productImage = $product->thumbImage; if(!file_exists($productImage)){$productImage='public/artisan/assets/images/placeholder.jpg';}?>
                                    <a href="{{ route('product', $product->id) }}"><img src="{{ asset($productImage) }}" class="img-responsive" alt="{{ $product->productName }}"/></a>
                                </div>
                                <div class="sale-box">
                                    @if (Auth::guest())
                                        <a href="#" title="Login Pleases"  data-toggle="modal" data-target="#userLogin" style="color: #63c6a7; font-size: 18px;"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                    @else
                                        @php
                                            $allUserId = App\ProductFavourite::where('productId', $product->id)->value('userId');
                                            $userIds = explode(",", $allUserId);
                                        @endphp
                                        @if (!in_array(Auth::User()->id, $userIds)|| empty($userIds))
                                            <a title="Not Favorite" style="color: #63c6a7; font-size: 18px;" href="{{ route('favorite', array('id'=>$product->id, 'action'=>0)) }}"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                        @else
                                            <a  title="Favorited"  style="color: red; font-size: 20px;" href="{{ route('favorite', array('id'=>$product->id, 'action'=>Auth::User()->id)) }}"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                        @endif

                                    @endif

                                </div>
                                <div class="desc">
                                    <a href="{{ route('product', $product->id) }}"><h3>{{ ucfirst($product->productName) }}</h3></a>

                                    <a href="{{ route('shop.view',$product->ownerId) }}">
                                        @if($product->ownerId ==0)
                                        <p>Dorpon</p>
                                        @else
                                            <?php $shopName = App\Shop::where('id', $product->ownerId)->value('shopName');?>
                                                <p>{{ ucfirst($shopName) }}</p>
                                        @endif
                                    </a>
                                    <div class="review-icon">
                                        <input  class="rating rating-loading"  value="{{ $product->averageRating }}" data-size="xs" readonly>
                                        <span>({{ number_format($product->countRating($product->id)) }})</span>
                                    </div>
                                    <h4>Tk. {{ number_format($product->finalPrice) }}</h4>
                                    @if(isset($product->discount) )
                                    <div class="del-item"><del>Tk. {{ $product->sellPrice }}</del>({{ $product->discount }}%)</div>
                                    @endif
                                    {{--<h5>Eligible order get 10% off</h5>--}}
                                </div>
                            </div>
                        </div>

                        

                        @endforeach

                    </div>
                    <div class="row">
                        <div id="page-nav"></div>

                        <script>
                            $(function($) {
                                    
                                    var pageParts = $(".paginate");

                                    
                                    var numPages = pageParts.length;
                                    
                                    var perPage = 5;

                                    
                                    pageParts.slice(perPage).hide();
                                    
                                    if(numPages > perPage){
                                        $("#page-nav").pagination({
                                            items: numPages,
                                            itemsOnPage: perPage,
                                            cssStyle: "light-theme",
                                            
                                            onPageClick: function(pageNum) {
                                                
                                                var start = perPage * (pageNum - 1);
                                                var end = start + perPage;

                                            
                                                pageParts.hide()
                                                         .slice(start, end).show();
                                            }
                                        });
                                    }
                                });
                            
                        </script>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>



@endsection
@section('footerLink')
    
    <script src="{{asset('public/frontEnd/js/productShorted.js')}}"></script>
    <script src="{{asset('public/frontEnd/js/star-rating.js')}}"></script>
    <script type="text/javascript">

        $("#input-id").rating();

    </script>

@endsection
