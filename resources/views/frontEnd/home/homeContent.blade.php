@extends('frontEnd.master')

@section('title')
Dorpon | Empowering Creative Entrepreneurs
@endsection

@section('headasset')

<!--<link href="{{asset('public/frontEnd/css/style.css')}}" rel="stylesheet">-->
<link href="{{asset('public/frontEnd/css/bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/homepage.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/header.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/footer.css')}}" rel="stylesheet">
<link href="{{ asset('public/frontEnd/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        
@endsection

@section('content')

@if(count($slidersInfo)>0 && !empty($slidersInfo))
<div class="sliders">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-p">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
		 <!--Indicators -->
			<ol class="carousel-indicators"><?php $i=1; ?> 
            @foreach($slidersInfo as $slider)

                @if($i==1)
                    <li class="item{{$i}} active"></li>
                @else
                    <li class="item{{$i}}"></li>
                @endif
            <?php $i++;?>
            @endforeach
			</ol>

			<div class="carousel-inner" role="listbox">
            <?php $i=1;?>
            @foreach($slidersInfo as $slider)
                @if($i==1)
				<div class="item active">
                @else
                <div class="item">
                @endif
					<img src="{{ asset( $slider->image )}}" alt="">
					 <div class="carousel-captionn">
                         <div class="banner-overlay">
					   <h2>{{ ucwords($slider->sliderTitle) }}</h2>
                       <p>{{ $slider->shortNote }}</p>
					   <a class="buy-now-btn" href="{{ $slider->url }}">{{ $slider->buttonTitle }}</a>
					</div>
					</div>
				</div>
                <?php $i++;?>
            @endforeach

			</div>
		</div>
	</div>
</div>

@endif


<!---/choose-style-->
@include('frontEnd.includes.message')
    <section>
        <div class="container ">
            <div class="choose-style-title text-center">
                <h2>Spread some happiness, shop today</h2>
                <!--<p>Here are a few of our most popular items this week</p>-->
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="tabh">
                        <!--<h4>Choose your style</h4>-->
                        <ul class="nav nav-tabsh">
                            @foreach($mainCategories as $mainCategory)
                                @if($loop->first)
                                    <li class="active"><a data-toggle="tab" href="#arup{{$loop->index}}">{{ ucwords($mainCategory->categoryName) }}</a></li>
                                @else
                                    <li><a data-toggle="tab" href="#arup{{$loop->index}}">{{ ucwords($mainCategory->categoryName) }}</a></li>
                                @endif
                            @endforeach
                        </ul>

                        <div class="tab-content">
                            @foreach($mainCategories as $mainCategory)

                                <div id="arup{{$loop->index}}" class="tab-pane fade {{ ($loop->first)?" in active": " " }}">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                          <div class="tabh-img-shoptext">
                                                <div class="tabh-img">
                                                    <?php $catImage =$mainCategory->image; if(!file_exists($catImage)){ $catImage='public/artisan/assets/images/placeholder.jpg'; } ?>
                                                    <a href="{{ route('category.products',$mainCategory->id) }}"><img src="{{ asset($catImage) }}" alt="{{ $mainCategory->categoryName }}"></a>
                                                </div>
                                                <a href="{{ route('category.products',$mainCategory->id) }}" class="tabh-img-btn">Shop all <span> <i class="fa fa-angle-double-right"></i></span></a>
                                        </div>
                                         </div>

                                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <?php $catProducts = App\Product::where('mainCatId', $mainCategory->id)->where('status', 1)->select('id', 'productName', 'finalPrice', 'thumbImage')->latest()->take(12)->get(); ?>
                                                    @forelse($catProducts as $product)
                                                        @if($loop->first || $loop->iteration ==7)
                                                            <div class="item {{ ($loop->first) ? "active":" " }}">
                                                        @endif
                                                                <div class="tabh-thm-img">
                                                                    <a href="{{ route('product', $product->id) }}" title="{{ ucfirst($product->productName) }}">
                                                                        <?php $thumbImage =$product->thumbImage; if(!file_exists($thumbImage)){ $thumbImage='public/artisan/assets/images/placeholder.jpg'; } ?>
                                                                        <img src="{{ asset($thumbImage) }}" alt="{{ ucfirst($product->productName) }}">
                                                                        <div class="tabh-thm-text">
                                                                            <h2 >{{ ucfirst($product->productName) }}</h2>
                                                                            <p>Tk. {{ number_format($product->finalPrice) }}</p>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                        @if($loop->last || $loop->iteration == 6)
                                                            </div>
                                                        @endif

                                                    @empty

                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- / products -->    
<section class="feature-products container-fluid">
    <div class="clearfix">
        <div class="text-center fetureproduct-title">
            <h2>Featured Products</h2>
            <p class="sub-heading">This is the house of handmade Bangladeshi products</p>
        </div>
    </div>
	<div id="feature-products-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner" role="listbox">
            @foreach($featureProducts as $featureProduct)

                @if($loop->first || $loop->index % 4 == 0)
                    <div class="item {{ ($loop->first) ?'active':' ' }}">
                        <div class="row">
                @endif
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="releted-product">
                                    <?php $productImage = $featureProduct->thumbImage;  if(!file_exists($productImage)){ $productImage='public/artisan/assets/images/placeholder.jpg'; }?>

                                        <div class="slideImages-hover">
                                            <img src="{{ asset( $productImage )}}" alt="{{ $featureProduct->productName }}" class="img-responsive zoom-img" alt=""/>
                                            <div class="view-caption">
                                                <!--<a href="{{ route('product',$featureProduct->id) }}"><span class=""><i class="fa fa-eye" aria-hidden="true"></i></span></a>-->
                                                <a href="{{ route('product',$featureProduct->id) }}"><span class=""><i class="fa fa-eye" aria-hidden="true"></i><p>View product</p></span></a>

                                                @if (Auth::guest())
                                                    <!--<a href="" title="Login Please"  data-toggle="modal" data-target="#userLogin" style="color: #63c6a7; font-size: 18px;"><span class=""><i class="fa fa-heart" aria-hidden="true"></i></span></a>-->
                                                    <a href="" title="Login Please"  data-toggle="modal" data-target="#userLogin" style="color: #63c6a7; font-size: 14px;"><span class=""><i class="fa fa-heart" aria-hidden="true"></i><p>Add to favourites</p></span></a>
                                                @else
                                                    @php
                                                        $allUserId = App\ProductFavourite::where('productId', $featureProduct->id)->value('userId');
                                                        $userIds = explode(",", $allUserId);
                                                    @endphp
                                                    @if (!in_array(Auth::User()->id, $userIds)|| empty($userIds))
                                                        <a title="Not Favorite" style="color: #63c6a7; font-size: 18px;" href="{{ route('favorite', array('id'=>$featureProduct->id, 'action'=>0)) }}" ><span class=""><i class="fa fa-heart" aria-hidden="true"></i></span></a>
                                                    @else
                                                        <a title="Favorited"  style="color: red; font-size: 20px;" href="{{ route('favorite', array('id'=>$featureProduct->id, 'action'=>Auth::User()->id)) }}" ><span class=""><i class="fa fa-heart" aria-hidden="true"></i></span></a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    <h4 ><a title="{{ ucfirst($featureProduct->productName) }}" href="{{ route('product',$featureProduct->id) }}">{{ ucfirst($featureProduct->productName) }}</a></h4>
                                    <p>Tk. {{number_format($featureProduct->finalPrice )}}</p>
                                </div>
                            </div>

                @if($loop->last || $loop->iteration % 4 == 0)
                        </div>
                    </div>
                @endif
            @endforeach
		</div>
        <!-- Controls -->
        <a class="myleft-btn carousel-control hidden-xs" href="#feature-products-carousel" role="button" data-slide="prev">
            <span class="fa fa-angle-double-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="myright-btn carousel-control hidden-xs" href="#feature-products-carousel" role="button" data-slide="next">
            <span class="fa fa-angle-double-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <a class="more-products btn-circle" href="{{ route('feature.products') }}">More products ...</a>
    </div>
</section>
<!-- / feature-products -->
@if(count($giftTypeInfos) > 0)
<div class="category">
    <section class="container">
        <h2>Explore the Dorpon Marketplace</h2>
        <p class="sub-heading">Your hunt for local treasures starts here!</p>
    <?php $row = 1; ?>
        @foreach($giftTypeInfos as $giftTypeInfo)
        @if($row == 1)
		<div class="row">
        @endif

			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="cat-box">
                    <a href="{{ route('giftType.products', $giftTypeInfo->id) }}" title="{{ ucwords($giftTypeInfo->giftTitle) }}">
					    <img class="img-responsive explore-dorpon-img" src="{{ asset($giftTypeInfo->image) }}" alt="{{ ucwords($giftTypeInfo->giftHeadding) }}" />
                    </a>
					<div class="caption">
						<a href="{{ route('giftType.products', $giftTypeInfo->id) }}" title="{{ ucwords($giftTypeInfo->giftTitle) }}"><h3>{{ ucwords($giftTypeInfo->giftTitle) }}</h3></a>
						<div class="clearfix">
            <?php $pos=1; $round=1;  $giftProducts = DB::table('products')->where('giftTypeId', $giftTypeInfo->id)->orderby('id', 'desc')->select('id', 'productName')->get(); $total = count($giftProducts);?>
                        @foreach($giftProducts as $giftProduct)

                            @if($round ==1)
                                @if($pos ==1)
                                <div class="pull-left" id="gift">
                                @else
                                <div class="pull-right" id="gift">
                                @endif
								<ul class="list-unstyled">
                            @endif

									<li><a href="{{ route('product', array('id'=>$giftProduct->id))}}" title="{{ucwords($giftProduct->productName) }}">{{ucwords($giftProduct->productName) }}</a></li>
							
                            @if($pos==1)
                                @if($round==3 || $round==count($giftProducts))	
								</ul>
							</div>
                                @endif
                            @elseif($pos==2)

                                @if($round==3 || $round==count($giftProducts)-3 )  
                                </ul>
                            </div>
                                @endif
                            @endif
                            <?php $round++; if($round==4){$pos=2; $round=1;} ?>
                        @endforeach

                            
						</div>
				<div class="pull-right">
                                <a class="see-more" href="{{ route('giftType.products', $giftTypeInfo->id) }}">See more ...</a>
                            </div>
                    </div>
                    
                    
				</div>
			</div>
			
        @if($row==3)
		</div>
        @endif
        <?php $row++; if($row==4){$row=1;}?>
    @endforeach

    </section>
    <a class="see-all-cat btn-circle" href="{{ route('gift.products') }}">All gift items ...</i></a>
</div>
<!-- / category -->
@endif

@if(count($featureArtisans) >0 &&  isset($featureArtisans))
<!-- / feature-artisans -->
<section class="feature-artisans">
    <div class="container">
        <div class="feature-artisans-title text-center">
            <h2>Meet The Artisans</h2>
            <p class="sub-heading">The caliber of and thoughtfulness about the products at Dorpon is demonstrably outstanding in its joyful intensity and creativity. The shops, and thereby our artisans, remain at the heart of our enterprise.</p>
        </div>
        <div id="feature-artisans-carousel" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php $count=1; $round = 1; ?>
                @foreach($featureArtisans as $featureArtisan )
                
                    @if($count==1)
                        @if($round== 1)
                        <div class="item active">
                        @else
                        <div class="item">
                        @endif
                            <div class="row">
                    @endif

                                <div class="feature-artisans-box-wrapper col-xs-12 col-sm-3 col-xs-12 col-md-3 col-lg-3">
                                    <div class="feature-artisans-box">
                                    <?php
                                        $artisanImage = $featureArtisan->avater;  if(!file_exists($artisanImage)){ $artisanImage='public/artisan/assets/images/placeholder.jpg'; }
                                    ?>
                                        <div class="slideImages-hover">
                                            <img class="img-responsive"  src="{{ asset($artisanImage) }}" alt="{{ $featureArtisan->name }}">
                                            <div class="view-caption">
                                                <a href="{{ route('shop.view', $featureArtisan->id) }}"><span class=""><i class="fa fa-eye" aria-hidden="true"></i><p>View shop</p></span></a>
                                                <a href="" title="Read artisan's story"><span class=""><i class="fa fa-book" aria-hidden="true"></i><p>Read story</p></span></a>
                                                
                                            </div>
                                         </div>  
                                        <div class="caption text-center">
                                            @if(!is_null($featureArtisan->shopDetailsFour))
                                            <h3>{{ ucwords($featureArtisan->shopDetailsFour) }}</h3>
                                            @else
                                            <h3>{{ ucwords($featureArtisan->name) }}</h3>
                                            @endif
                                        </div>
                                        <!--<a href="{{ route('shop.view',$product->ownerId) }}"></a>-->
                                    </div>
                                </div>
                        
                    @if($count==4)
                            </div>
                        </div>
                    @endif

                <?php $count++; if($count==5){ $round=2; $count=1;} ?>
                @endforeach
            </div>            
        </div>
        <!-- Controls -->
        <a class="myleft-btn carousel-control hidden-xs" href="#feature-artisans-carousel" role="button" data-slide="prev">
            <span class="fa fa-angle-double-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="myright-btn carousel-control hidden-xs" href="#feature-artisans-carousel" role="button" data-slide="next">
            <span class="fa fa-angle-double-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <a class="meet-more-artisan btn-circle" href="#">More artisans ...</a>
    </div>
</section>
@endif

<section class="vedio-wrap">
    <div class="container">
        <div id="vedio-wrap-carousel" class="carousel slide" data-ride="carousel">
           <ol class="carousel-indicators">
              <li class="item1 active"></li>
              <li class="item2"></li>
              <li class="item3"></li>
              <li class="item4"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
            @for($i=0; $i<'4'; $i++)
                @if($i==0)
                <div class="item active">
                @else
                <div class="item">
                @endif
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="vedio-wrap">
                                <iframe src="https://www.youtube.com/embed/AIROuMdWNxY" frameborder="0" height="270" width="100%" allowfullscreen></iframe>
                            </div>
                            
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <div class="vedio-content">
                                <h2>Sanjana Malik</h2>
                                <P>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.</P> 
                            </div>
                            <a class="btn-circle view-btn pull-right"  href="#">View Profile<span class="fa fa-angle-right" aria-hidden="true"></span></a> 
                        </div>
                    </div>
                </div>
                
            @endfor
                
            </div>
             
        </div>
    
    </div>
</section> 
@if(count($reviewsComments) != 0)     
<section class="testimonial">
    <div class="container">
        <div class="text-center">
            <h2>Testimonials</h2>
            <p>{{ strtoupper('View what our customers say about us.') }}</p>
        </div>
        <div id="testimonial-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
            <?php $count=1; $round = 1; ?>
            @foreach($reviewsComments as $reviewsComment )
                
                @if($count==1)
                    @if($round== 1)
                    <div class="item active">
                    @else
                    <div class="item ">
                    @endif
                        <div class="row">
                @endif

                        <div class="col-lg-3 col-md-3  col-sm-3 col-xs-6">
                            <div class="clearfix">
                                <div class="mytestimonial-box text-center">
                                @if(is_null($reviewsComment->avater) || empty($reviewsComment->avater))
                                    <img class="img-circle img-responsive" src="{{ asset('public/images/default/user_default_avatar.png')}}" alt="">
                                @else
                                    <img class="img-circle" src="{{ asset($reviewsComment->avater)}}" alt="">
                                @endif
                                    <div class="caption">
                                        <a href="{{ route('product', array('id'=>$reviewsComment->productId)) }}" style="color:#000;"><h3>{{ strtoupper($reviewsComment->name) }}</h3></a>
                                        <p>{{ substr(ucwords($reviewsComment->comment),0,100) }}..</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                @if($count==4)
                        </div>
                    </div>
                @endif
            <?php $count++; if($count==5){ $round=0; $count=1;} ?>
            @endforeach
            </div>
            <a class="carousel-control left-btn hidden-xs hidden-md" href="#testimonial-carousel" role="button" data-slide="prev">
            <span class="fa fa-angle-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control right-btn hidden-xs hidden-md" href="#testimonial-carousel" role="button" data-slide="next">
            <span class="fa fa-angle-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
        </div>

    </div>
    
</section>
<!-- / testimonial --> 
@endif

@endsection
@section('footerLink')
    <script src="{{asset('public/frontEnd/js/main.js')}}"></script>
@endsection

