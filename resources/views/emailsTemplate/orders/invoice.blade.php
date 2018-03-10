<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,400i,700,700i|Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Mr+Bedfort|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/bootstrap.min.css') }}">
    <link href="{{ asset('public/frontEnd/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/invoice.css') }}">
    <script src="{{ asset('public/frontEnd/js/jquery-3.2.1.min%20(1).js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/bootstrap.min.js') }}"></script>
</head>
<body>
<div class="email-wrapper" style="background: url(../../images/default/userMailBG.jpg);">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="email-con-toptx">
                        <div class="email-con-logo">
                            <a href="{{ route('index') }}"><img src="{{ asset($logo) }}" alt="Dorpon"></a>
                        </div>
                        <div class="email-con-text">
                            <h2><a href="">TRACK YOUR ORDER <span><i class="fa fa-chevron-right" aria-hidden="true"></i><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="thank-you-sec">
                <div class="thank-you-top">
                    <h1>Thank You!</h1>
                    <h4>Your Dorpon order is confirmed.</h4>
                    <p>And we're just as excited as you are.</p>
                </div>
                <div class="email-main-con">
                    <div class="main-con-top">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="email-addre">
                                    <div class="date-ord">
                                        <p>Date Ordered:</p>
                                        <?php
                                        $date = new DateTime($order->created_at);
                                        $orderDate = date_format($date, 'd F Y');
                                        ?>
                                        <h5>{{ $orderDate }}</h5>
                                    </div>
                                    <div class="ord-no">
                                        <p>Order No:</p>
                                        <h5>{{ $order->invoiceId }}</h5>
                                    </div>
                                    <div class="paym-metd">
                                        <p>Payment Method:</p>
                                        <h5>Cash on delivery</h5>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="email-addre">
                                    <div class="ord-by">
                                        <p>Ordered-By:</p>
                                        <h5>{{ ucfirst($userInfo->name) }}</h5>
                                        <div class="address">
                                            @if(isset($userInfo->areaId) || !is_null($userInfo->areaId))
                                            <?php
                                            $areaName = App\TransportLocation::where('id',$userInfo->areaId )->value('areaName');
                                            $disName = App\TransportLocation::where('id',$userInfo->districtId )->value('areaName');
                                            $divName = App\TransportLocation::where('id',$userInfo->divisionId )->value('areaName');
                                            ?>
                                            <p>House-{{ ($userInfo->houseNo)? $userInfo->houseNo.',' : ''}} Road No-{{ ($userInfo->roadNo)? $userInfo->roadNo : ''}} <br>Block- {{ ($userInfo->block)? $userInfo->block.',' : ''}} {{ ($userInfo->areaName)?$userInfo->areaName : ''}}
                                                <br>{{ $areaName }}-{{ $userInfo->zipCode }}, {{ $disName.",".$divName }}.</p>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="email-addre">
                                    <div class="shipp-to">
                                        <p>Shipped-to:</p>
                                        <h5>{{ ucfirst($userInfo->name) }}</h5>
                                        <div class="address">
                                            <?php
                                            $areaName = App\TransportLocation::where('id',$shippingInfo->areaId )->value('areaName');
                                            $disName = App\TransportLocation::where('id',$shippingInfo->districtId )->value('areaName');
                                            $divName = App\TransportLocation::where('id',$shippingInfo->divisionId )->value('areaName');
                                            ?>
                                            <p>House-{{ ($shippingInfo->houseNo)? $shippingInfo->houseNo.',' : ''}} Road No-{{ ($shippingInfo->roadNo)? $shippingInfo->roadNo : ''}} <br>Block- {{ ($shippingInfo->block)? $shippingInfo->block : ''}},{{ ($shippingInfo->areaName)?$shippingInfo->areaName : ''}}
                                                <br>{{ $areaName }}-{{ $shippingInfo->zipCode }}, {{ $disName.",".$divName }}.</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="produc-list">
                                <?php $orderDetails = DB::table('order_details')->join('products', 'order_details.productId', '=','products.id')->select('order_details.*','products.thumbImage')->where('order_details.orderId', $order->id)->get(); ?>
                                <h1>Here's what you ordered:</h1>
                                @foreach($orderDetails as $orderProduct)

                                <div class="first-itm-emil">
                                    <span>{{ $orderProduct->productQuantity }}         x   <img src="{{ asset($orderProduct->thumbImage) }}" alt="{{ $orderProduct->productName }}"></span>
                                    <p title="{{ ucfirst($orderProduct->productName) }}">{{ ucfirst($orderProduct->productName) }}</p>
                                    <p>Size: <span>{{ App\Size::where('id',$orderProduct->sizes)->value('sizeTitle') }}</span>
                                        <br>Color: <span>{{ App\PrimaryColor::where('id',$orderProduct->priColor)->value('colorName') }}</span></p>
                                    <div class="price-emai">
                                        <h4>Tk. {{ number_format($orderProduct->productPrice) }}</h4>
                                    </div>
                                </div>
                                @endforeach

                                <div class="sub-total">
                                    <p>Subtotal: <span>Tk. {{ number_format($order->totalAmmount - $order->deliveryPrice) }}</span></p>
                                    <p>Standard Shipping: <span>Tk. {{ number_format($order->deliveryPrice) }}</span></p>
                                </div>
                                <div class="total-order-email">
                                    <h5>Order Total</h5>
                                    <h1>Tk. {{ number_format($order->totalAmmount) }}</h1>
                                </div>
                                <div class="email-ques">
                                    <p>Questions? Suggestion? Insightful Thoughts? <a href="mailto: mail.finova@gmail.com">Send us an email</a></p>
                                    <p>Thank you for shopping at: <a href="https://www.mydorpon.com/" target="_blank">www.mydorpon.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="container">
            <div class="email-con-footer">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="footer-top-email">
                            <form action="">
                                <button> <a href="https://www.mydorpon.com/dorpon/product/category/all" target="_blank">BACK TO SHOP</a></button>
                            </form>
                            <h1>Stay in Touch</h1>
                            <div class="fonts">
                                <a href="https://www.facebook.com/Dorpon-284702818689883/" title="Facebook" target="_blank" onclick="javascript:window.open(https://www.facebook.com/Dorpon-284702818689883/'); return false;"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="https://www.instagram.com/dorpon_15/" title="Instagram" target="_blank" onclick="javascript:window.open('https://www.instagram.com/dorpon_15/'); return false;">
                                    <i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="https://www.youtube.com/channel/UCt3i0SgQ-1oXcmczABMh27A?view_as=subscriber" title="YouTube" target="_blank" onclick="javascript:window.open('https://www.youtube.com/channel/UCt3i0SgQ-1oXcmczABMh27A?view_as=subscriber'); return false;">
                                    <i class="fa fa-youtube" aria-hidden="true"></i></a>
                                <a href=https://www.pinterest.com/dorpon0813/pins/" title="Pinterest" target="_blank" onclick="javascript:window.open('https://www.pinterest.com/dorpon0813/pins/'); return false;"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href=""><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="footer-tx">
                            <p>Email sent by Dorpon</p>
                            <p>2018 Finova Techonologies Ltd. All rights reserved</p>
                            <p> <a href="">Unsubscribe | </a> <a href="{{ route('helpCenter',10) }}">Terms of Service | </a> <a href="{{ route('helpCenter',11) }}">Privacy Policy</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>