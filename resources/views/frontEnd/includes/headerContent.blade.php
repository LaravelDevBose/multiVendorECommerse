
<header class="header-area">
    <div class="header-top">
        <div  class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12 ">
                    <div class="toptext-left">
                        <p>{{ ucfirst($logo->tagLine) }}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    
                    <div class="live-chat">
                                <!--<div class="live-img">-->
                            <!--    <img src="{{asset('public/images/default/live-chat.png')}}" alt="">-->
                                <!--</div>-->
                                <div class="live-text">
                                    <p>FREE SHIPPING! on orders over Tk. 4,000</p>
                                </div>
                            </div>
                    
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="right-text">
                        <div class="col-md-6 col-sm-6">
                            <div class="toptext-right">
                        <span class="sell-on">Sell on Dorpon </span>
                        <ul>
                            <div class="toptext-hov">
                                <div class="sigh-btn">
                                    <a href="" data-toggle="modal" data-target="#shopLogin">Sign in</a>
                                </div>
                                <div class="toptext-custoer">
                                    <p>New Seller?</p>
                                    <a href="{{ route('shop.register') }}">Sign up now</a>
                                </div>
                            </div>
                        </ul>
                    </div> 
                            
                        </div>
                        <div class="col-md-6 col-sm-6">

                            <div class="call-number float-right">
                                <div class="call-icon">
                                    <i class="fa fa-phone-square" aria-hidden="true"></i><a href=""> (02) 5503 5760</a>
                                </div>
                                <!--<a href="">(02) 550 35760</a>-->
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <div class="logo">
                        <?php $dorponLogo = $logo->logo; if(!file_exists($dorponLogo)){ $dorponLogo='public/images/default/dorpon_logo.png'; }?>
                        <a href="{{route('index')}}"><img src="{{asset($dorponLogo)}}" alt="Dorpon"></a>
                    </div>
                    <div class="topnav">
                        
                        <div class="search-container">
                            <form action="">
                                <input type="text" id="main-search" placeholder="Explore Bangladesh's most beautiful handmade creations" name="search">
                                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
                            <div id="search-result"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <div class="hb-right float-right">
                        @if(Auth::guard('merchantile')->check())
                            <div class="user-detail">

                                <div class="a-logo">
                                    <?php  $astisanimage = Auth::guard('merchantile')->user()->avater; if(is_null($astisanimage)|| !file_exists($astisanimage)){ $astisanimage = 'public/images/default/user-icon.png';}?>
                                    <img src="{{ asset($astisanimage) }}" alt="{{ Auth::guard('merchantile')->user()->name }}">
                                </div>
                                <div class="a-text">
                                    <p>Hello, </p>
                                    <p>{{ ucfirst(Auth::guard('merchantile')->user()->name) }}</p>
                                    <p class="p2">Your Account<i class="fa fa-sort-desc" aria-hidden="true"></i></p>
                                    <ul>
                                        <div class="accout-hov">
                                            <div class="acount-section">
                                                <ul>
                                                    <li><a href="{{ route('merchantile.dashboard') }}">Shop Account</a></li>
                                                    <li><a href="{{ route('items') }}">Products</a></li>
                                                    <li><a href="{{ route('shop.orders') }}">Orders</a></li>
                                                    <li><a href="{{ route('shop.profile') }}">Manage Shop Profile</a></li>
                                                </ul>
                                            </div>
                                            <div class="sigh-btn">
                                                <a href="{{ route('merchantile.logout') }}" >Sign Out</a>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>

                        @elseif(Auth::guard('web')->check())
                            <div class="user-detail">

                                <div class="accout-class">
                                    <div class="class-img">
                                    <?php
                                        switch (Auth::user()->userStatus){
                                            case 0:
                                                $statusImage = 'public/images/default/classic.png';
                                                $statusName = 'Classic';
                                                break;
                                            case 1;
                                                $statusImage = 'public/images/default/silver.png';
                                                $statusName = 'Sliver';
                                                break;
                                            default:
                                                $statusImage = 'public/images/default/gold.png';
                                                $statusName = 'Gold';
                                                break;
                                        }

                                        $userImage = Auth::user()->avater; 
                   

                                        if(App\SocialProvider::where('user_id', Auth::User()->id) && !empty($userImage)){
                                            $userImage = Auth::user()->avater; 
                                        }else{
                                            if(strlen($userImage) < 0 || !file_exists($userImage)){
                                                $userImage = 'public/images/default/user-icon.png';
                                            }
                                        }

                                    ?>


                                        <img src="{{asset($statusImage)}}" alt="{{ $statusName }}">
                                    </div>
                                    <div class="class-text">
                                        <span>Dorpon</span>
                                        <p>{{ $statusName }}</p>
                                    </div>
                                </div>

                                <div class="a-logo">
                                    <img src="{{asset($userImage)}}" alt="{{ Auth::User()->name }}">
                                </div>
                                <div class="a-text">
                                    <p>Hello, </p>
                                    <p>{{ ucfirst(Auth::User()->name) }}</p>
                                    <p class="p2">Your Account<i class="fa fa-sort-desc" aria-hidden="true"></i></p>
                                    <ul>
                                        <div class="accout-hov">
                                            <div class="sigh-btn">
                                                <a href="{{ route('user.logout') }}" >Sign Out</a>
                                            </div>
                                            <div class="custoer">
                                                <p>You are a<a href="" data-toggle="modal" data-target="#custClass">Classic</a> customer</p>
                                            </div>
                                            <div class="acount-section">
                                                <ul>
                                                    <li><a href="{{ route('user.home') }}">Your Account</a></li>
                                                    <li><a href="">Your Orders</a></li>
                                                    <li><a href="">Manage Your Shipping Address</a></li>
                                                    <li><a href="">Manage your Payment Options</a></li>
                                                    <li><a href="">Your Loyalty Points</a></li>
                                                    <li><a href="">Your Gift Cards / Vouchers</a></li>
                                                </ul>
                                            </div>
                                            <!--<div class="sigh-btn">-->
                                            <!--    <a href="{{ route('user.logout') }}" >Sign Out</a>-->
                                            <!--</div>-->
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        @else
                            <div class="user-detail">

                                <div class="a-logo">
                                    <img src="{{ asset('public/images/default/user-icon.png') }}" alt="">
                                </div>
                                <div class="a-text">
                                    <p>Hello, </p>
                                    <p>Sign in</p>
                                    <p class="p2">Your Account<i class="fa fa-sort-desc" aria-hidden="true"></i></p>
                                    <ul>
                                        <div class="accout-hov">
                                            <div class="sigh-btn">
                                                <a href="#" data-toggle="modal" data-target="#userLogin">Sign in</a>
                                            </div>
                                            <div class="custoer">
                                                <p>New customer?</p>
                                                <a href="{{ route('register') }}">Sign up now</a>

                                            </div>
                                            <div class="acount-section">
                                                <ul>
                                                    <li><a href="">Your Account</a></li>
                                                    <li><a href="">Your Orders</a></li>
                                                    <li><a href="">Manage Your Shipping Address</a></li>
                                                    <li><a href="">Manage your Payment Options</a></li>
                                                    <li><a href="">Your Loyalty Points</a></li>
                                                    <li><a href="">Your Gift Cards / Vouchers</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>

                        @endif



                        <div class="heart-crad" >
                            <div class="top-heart">
                                <a href=""><i class="fa fa-heart" aria-hidden="true"></i></a>
                                <p>Favorites</p>
                            </div>
                            <div class="card" id="cartView">
                                @if(count($cartProducts) > 0 &&  !empty($cartProducts))
                                    <a href="" id="number" ><span class="badge">{{ $cartProducts->sum('qty') }}</span></a>
                                    <a href="#"><i id="cart" class="fa fa-shopping-bag" aria-hidden="true"></i><p>Shopping Bag</p> </a>

                                    <ul class="card-list">
                                        <h1>You have <span>{{ $cartProducts->sum('qty') }}</span> item(s) in your shopping bag</h1>
                                        <div class="all-itm">
                                            <?php $totalAmount= 0;?>
                                            @foreach($cartProducts as $cartProduct)
                                                <li>
                                                    <div class="item1">
                                                        <div class="item-photo">
                                                            <?php $productImage = App\Product::where('id', $cartProduct->id)->value('thumbImage'); if(!file_exists($productImage)){ $productImage='public/artisan/assets/images/placeholder.jpg'; }?>
                                                            <img src="{{asset($productImage)}}" alt="{{ $cartProduct->name }}">
                                                        </div>
                                                        <div class="item-text">
                                                            <a href="{{ route('product', $cartProduct->id) }}">{{ ucfirst($cartProduct->name) }}</a>
                                                            <?php 
                                                                if(Session::get($cartProduct->rowId)){
                                                                    $priCri = Session::get($cartProduct->rowId);
                                                                     $size = App\Size::where('id', $priCri['size'])->value('sizeTitle');
                                                                    
                                                                }
                                                            ?>
                                                            <p>size: <span>{{ (empty($size)) ? ' ' : $size }}</span></p>
                                                            <p class="ip2">Qty: <span>{{ $cartProduct->qty }}</span></p>
                                                            <a>Tk. {{ number_format($cartProduct->price) }}</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php $totalAmount = $totalAmount + ($cartProduct->qty * $cartProduct->price); ?>
                                            @endforeach

                                        </div>
                                        <h1>Order Subtotal <span>Tk. {{ number_format($totalAmount) }}</span> </h1>
                                        <div class="bttn">

                                            <a href="{{ route('cart.show') }}">View Bag</a>
                                        </div>
                                        <div class="bttn">
                                            @if(Auth::guard('web')->check())
                                                <a href="{{ route('shipping') }}">Checkout</a>
                                            @else
                                                <a href="{{ route('checkout') }}">Checkout</a>
                                            
                                            @endif
                                        </div>
                                    </ul>
                                @else
                                    <a href="" id="number" ><span class="badge">0</span></a>
                                    <a href="{{ route('index') }}" title="Empty Cart"><i id="cart" class="fa fa-shopping-bag" aria-hidden="true"></i><p>Shopping Bag</p> </a>
                                @endif

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
<section>
    <div class="container">

    </div>
</section>
<section class="menu-area">
    <div class="menu">
        <div class="container-fluid">
            <div class="menu_box">
                <ul class="megamenu skyblue">
                    <a href="{{ route('index') }}" class="home-i"><i class="fa fa-home home-con" aria-hidden="true"></i></a>
                    <?php $i=1;?>
                    @forelse($mainCatrories as $mainCategory)
                        <?php $secCategories = App\Category::where('mainCatId', $mainCategory->id)->where('secondCatId', null)->where('publicationStatus', 1)->orderBy('position', 'asc')->select('id', 'categoryName')->take(5)->get();?>

                        @if(count($secCategories) == 0)
                            <li><a class="color{{ $i }}" href="{{ route('category.products',$mainCategory->id) }}">{{ ucfirst($mainCategory->categoryName) }}</a></li>
                        @else

                            <li>
                                <a class="color{{ $i }}" href="{{ route('category.products',$mainCategory->id) }}">{{ ucfirst($mainCategory->categoryName) }}</a>
                                <div id="megapanel{{ $i }}" class="megapanel">
                                    <div class="row">
                                        @foreach($secCategories as $secCategory)
                                            <div class="col1">
                                                <div class="h_nav">
                                                    <div class="mega-sub">
                                                        <a href="{{ route('category.products',$secCategory->id) }}">{{ ucfirst($secCategory->categoryName) }}</a>
                                                    </div>
                                                    <?php $thirdCategories = App\Category::where('mainCatId', $mainCategory->id)->where('secondCatId', $secCategory->id)->where('thirdCatId', null)->where('publicationStatus', 1)->orderBy('position', 'asc')->select('id', 'categoryName')->get();?>
                                                    @if(count($thirdCategories) >0)
                                                        <ul>
                                                            @foreach($thirdCategories as $thirdCategory)
                                                                <li><a  href="{{ route('category.products', $thirdCategory->id) }}"><i class="fa fa-angle-right" aria-hidden="true"></i>{{ ucfirst($thirdCategory->categoryName) }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            </div>

                                        @endforeach
                                        <div class="col1">
                                            <div class="h_nav">

                                                <ul>
                                                    <li class>
                                                        <div class="p_left">
                                                            <img src="{{asset($mainCategory->image)}}" class="img-responsive" alt="{{ $mainCategory->categoryName }}"/>
                                                        </div>
                                                        <div class="p_right">
                                                            <h4><a href="{{ route('category.products',$mainCategory->id) }}">{{ $mainCategory->categoryName }}</a></h4>
                                                        </div>
                                                        <div class="clearfix"> </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif

                        <?php $i++;?>
                    @empty

                    @endforelse

                    <div class="clearfix"> </div>
                </ul>
            </div>
        </div>
    </div>
</section>