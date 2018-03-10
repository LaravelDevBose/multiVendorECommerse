@extends('frontEnd.master')

@section('title')
    Dorpon | About
@endsection

@section('headasset')
    <link href="{{asset('public/frontEnd/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{ asset('public/frontEnd/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontEnd/css/about.css')}}">
    <!--<link href="{{asset('public/frontEnd/css/homepage.css')}}" rel="stylesheet">-->
    <link href="{{asset('public/frontEnd/css/footer.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontEnd/css/header.css')}}" rel="stylesheet">

@endsection

@section('content')

<section class="top-bg">
    <nav id="navbar-invers" class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="{{ ($page==1)?'active':'' }}"><a href="#">About</a></li>
                    <li class="{{ ($page==2)?'active':'' }}"><a href="#">Mission</a></li>
                    <li class="{{ ($page==3)?'active':'' }}"><a href="#">Team</a></li>
                    <li class="{{ ($page==4)?'active':'' }}"><a href="#">Testimonials</a></li>
                    <li class="{{ ($page==5)?'active':'' }}"><a href="#">Media</a></li>
                    <li class="{{ ($page==6)?'active':'' }}"><a href="#">Artisans</a></li>
                    <li class="{{ ($page==7)?'active':'' }}"><a href="#">Gallery</a></li>
                    <li class="{{ ($page==8)?'active':'' }}"><a href="#">Career</a></li>
                    <li class="{{ ($page==9)?'active':'' }}"><a href="#">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1><a href="">About Dorpon</a></h1>
    </div>
</section>
<section class="">
    <div class="container">
        <div class="cont-text">
            <h3>Dorpon is the marketplace for unique and creative handmade goods</h3>
            <p>Within our markets, people around the country connect, both online and offline, to make, sell and buy unique goods. We also offer a wide range of seller services and tools that help creative entrepreneurs start, manage and scale their businesses. Our mission is to keep Commerce Human.</p>
        </div>
    </div>
</section>
<section class="artisan">
    <div class="arti-img">
        <img src="{{ asset('public/images/default/icon-artisan.png') }} " alt="">
    </div>
</section>
<section>
    <div class="container">
        <div class="shop-item">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="shop-item-left">
                        <div class="uni-img">
                            <img src="{{ asset('public/images/default/baby.png') }}" alt="">
                        </div>
                        <h3>Shop for unique items</h3>
                        <p>Discover handmade items, vintage goods and craft supplies you possibly can't find anywhere else at affordable price.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="uni-right">
                        <img src="{{ asset('public/images/default/unique1.jpg') }}" alt="">
                        <img src="{{ asset('public/images/default/unique2.jpg') }}" alt="">
                        <img src="{{ asset('public/images/default/unique3.jpg') }}" alt="">
                        <img src="{{ asset('public/images/default/unique4.jpg') }}" alt="">


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="sell-crt">
    <div class="container">
        <div class="sell-crt-cont">
            <h1>Sell creative goods</h1>
            <div class="sell-crt-img">
                <img src="{{ asset('public/images/default/About_maciphone.png') }}" alt="">
            </div>
            <div class="crative-ul">
                <ul>
                    <li><p>Open a Dorpon shop-with your imagination and absolutely free of cost</p></li>
                    <li><p>Grow a creative business on your terms</p></li>
                    <li><p>Reach customers all over the country</p></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="comunity">
    <div class="container">
        <div class="row">
            <h1>Join a creative community</h1>
            <div class="col-lg-6 col-md-6 col sm-12 col-xs-12">
                <div class="join-left">
                    <img src="{{ asset('public/images/default/community_main.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col sm-12 col-xs-12">
                <div class="join-right">
                    <div class="join-right-img">
                        <img src="{{ asset('public/images/default/community2.jpg') }}" alt="">
                        <img src="{{ asset('public/images/default/community3.jpg') }}" alt="">
                    </div>
                    <div class="join-menu">
                        <ul>
                            <li><p>Connect directly with thoughtful buyers and creative entrepreneurs</p></li>
                            <li><p>Join a Dorpon Team to collaborate with local or like-minded Dorpon members.</p></li>
                            <li><p>Learn the stories of makers, designers and curators around the country.</p></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('footerLink')
    <script>
        window.onscroll = function() {myFunction()};

        var navbar = document.getElementById("navbar-invers");
        var sticky = navbar.offsetTop;

        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script>
@endsection