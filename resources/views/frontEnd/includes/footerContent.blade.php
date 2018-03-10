<section class="we-are-different">
    <section class="what-is-dorpon parallax">
        <h2>What is DORPON?</h2>
        <p>We are more than a Marketplace. Dorpon (দর্পণ means 'Mirror' in Bangla) provides tools and platform to inspire creative reflections of our artisans. Contributing to our collection are artisans & designers from across the country. We work together to curate a collection of handcrafted products.</p>
        <a href="https://mydorpon.com/dorpon/page/about/1">Read about us ...&nbsp;</a>
        <a href="https://mydorpon.com/dorpon/page/about/1">Read our blogs ...&nbsp;</a>
    </section>
    <!-- / what-is-dorpon -->
</section>

<section class="stay-in-touch">
    <div class="container">
        <div class="row">
    <!--        	<div class="separator">	-->
    <!--<img class="img-responsive" src="{{ asset('public/images/default/separator.png')  }}" alt="">-->
    
    <!--</div>-->

            <div class="stay-touch">
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <div class="ftop-left">
                        <h1>Stay in touch with the artisans</h1>
                        <div class="searchh-container">
                            <form action="{{'subcribe'}}" method="POST"> {{ csrf_field()}}
                                <input type="email" name="subcriber_email" placeholder="Enter your email address & press 'Subscribe'" name="search">
                                <button type="submit">Subscribe</button>
                            </form>
                        </div>
                        <p>Receive exclusive offers and updates</p>
                        <div class="brand">
                            <a href="">Explore, Empower, Impact</a>
                        </div>
                        <p>Every purchase supports DORPON's mission to empower artisans and creative entrepreneurs</p>
                    </div>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <div class="ftop-right">
                        <div class="ftop-icons">
                            <a href="https://www.facebook.com/Dorpon-284702818689883/" title="Facebook" onclick="javascript:window.open(https://www.facebook.com/Dorpon-284702818689883/'); return false;">
                                <i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="https://www.instagram.com/dorpon_15/" title="Instagram" onclick="javascript:window.open('https://www.instagram.com/dorpon_15/'); return false;">
                                <i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="https://www.youtube.com/channel/UCt3i0SgQ-1oXcmczABMh27A?view_as=subscriber" title="YouTube" onclick="javascript:window.open('https://www.youtube.com/channel/UCt3i0SgQ-1oXcmczABMh27A?view_as=subscriber'); return false;">
                                <i class="fa fa-youtube" aria-hidden="true"></i></a>
                            <a href=https://www.pinterest.com/dorpon0813/pins/" title="Pinterest" onclick="javascript:window.open('https://www.pinterest.com/dorpon0813/pins/'); return false;">
                                <i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
                            <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href=""></a>

                        </div>
                        <div class="ftop-img">
                            <img src="{{ asset('public/images/default/Smiling-Woman2.png')  }}" alt="">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<section class="footer-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="footer-text">
                    <p>"Could anything be better than this? Waking up everyday knowing that lots of people are smiling because you chose to impact lives, making the world a better place."  ~ Anyaele Sam Chiyson</p>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="footer-cont">
    <div class="container">
        <div class="main-cont">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info">
                        <h2>Info</h2>
                        <ul>
                            <li><a href="{{ route('about',1) }}">About Us</a></li>
                            <li><a href="{{ route('about',2) }}">Our Mission & Values</a></li>
                            <li><a href="{{ route('about',3) }}">Our People</a></li>
                            <li><a href="{{ route('about',4) }}">Testimonials</a></li>
                            <li><a href="{{ route('about',5) }}">News & Events</a></li>
                            <li><a href="{{ route('about',6) }}">Our Artisans</a></li>
                            <li><a href="{{ route('about',7) }}">Photos & Videos Gallery</a></li>
                            <li><a href="{{ route('about',8) }}">Career</a></li>
                            <li><a href="{{ route('about',9) }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info">
                        <h2>Help Center</h2>
                        <ul>
                            <li><a href="{{ route('helpCenter',1) }}">Order Information</a></li>
                            <li><a href="{{ route('helpCenter',2) }}">Shipping & Delivery</a></li>
                            <li><a href="{{ route('helpCenter',3) }}">Billing & Payments</a></li>
                            <li><a href="{{ route('helpCenter',4) }}">Return & Refund Policy</a></li>
                            <li><a href="{{ route('helpCenter',5) }}">Product Warranty</a></li>
                            <li><a href="{{ route('helpCenter',6) }}">Product Size Charts</a></li>
                            <li><a href="{{ route('helpCenter',7) }}">Export</a></li>
                            <li><a href="{{ route('helpCenter',8) }}">FAQ</a></li>
                            <li><a href="{{ route('helpCenter',9) }}">Download Center</a></li>
                        </ul>
                        <!--<div class="help-img">-->
                        <!--    <div class="img1">-->
                        <!--        <img src="{{ asset('public/images/default/1.png') }}" alt="">-->
                        <!--        <img src="{{ asset('public/images/default/2.png') }}" alt="">-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info">
                        <h2>Featured Shops</h2>
                        <div class="featured-cont">
                            @forelse($featureShops as $featureShop)
                            <div class="fearured-first">
                                <div class="featur-img">
                                    <?php $shopLogo = $featureShop->shopLogo; if(!file_exists($shopLogo)){$shopLogo='public/images/default/user-icon.png';} $shopAddress = App\ShopAddress::where('shopId',$featureShop->id)->select('areaId','districtId')->first(); if(!is_null($shopAddress)){  $areaName = App\TransportLocation::where('id', $featureShop->areaId)->value('areaName'); $disName=App\TransportLocation::where('id', $featureShop->districtId)->value('areaName'); } ?>
                                    <img src="{{ asset($shopLogo) }}" alt="{{ $featureShop->shopName }}">
                                </div>
                                <div class="featur-text">
                                    <h4>{{ ucfirst($featureShop->shopName) }}</h4>
                                    <span><i class="fa fa-pencil" aria-hidden="true"></i>{{ ucfirst($featureShop->shopSkills) }}</span>
                                    @if($shopAddress)
                                    <span><i class="fa fa-map-marker" aria-hidden="true"></i>{{ucfirst($areaName).', '.ucfirst($disName) }}</span>
                                    @endif
                                </div>
                            </div>
                            @empty

                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="partners">
                        <h2>Our Partners</h2>
                        <div class="partner-cont">
                            <div class="partner-img">
                                <img src="{{ asset('public/images/default/city.png')  }}" alt="">
                                <img src="{{ asset('public/images/default/idlc.png')  }}" alt="">
                                <img src="{{ asset('public/images/default/smef.png')  }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="footer-bottom">
    <div class="container">
        <div class="footer-btm">
            <p>Copyright <i class="fa fa-copyright" aria-hidden="true"></i> 2017 - 2018, Finova Technologies Limited. All rights reserved | </p>
            <div class="policy">
                <a href="{{ route('helpCenter',10) }}">Terms of Services</a><p> | </p>
                <a href="{{ route('helpCenter',11) }}">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>
