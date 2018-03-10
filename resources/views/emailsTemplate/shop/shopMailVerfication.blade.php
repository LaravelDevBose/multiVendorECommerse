<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>email-2</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Mr+Bedfort|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/shopMailConfirm.css') }}">
    <link href="{{ asset('public/frontEnd/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('public/frontEnd/js/jquery-3.2.1.min%20(1).js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/bootstrap.min.js') }}"></script>
</head>
<body>
    <section class="body-bg">
       <div class="container">
           <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <div class="logo">
                       <a href="{{ route('index') }}"><img src="{{ asset($logo) }}" alt="Dorpon"></a>
                   </div>
               </div>
           </div> 
             <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="container">
                   <div class="email-cont">
                       <div class="cont-top">
                           <h2>Welcome to Dorpon!</h2>
                    <p>Thank you for joning Dorpon community of creative entrepreneurs who sell handmade unique items directly to their audience.</p>
                       </div>
                       <div class="cont-image">
                           <img src="{{ asset('public/images/default/shopMailBanner.png') }}" alt="Dorpon">
                       </div>
                       <div class="cont-text">
                          <h2>With Dorpon you can</h2>
                           <ul>
                               <li><p>Grow a creative business on your terms</p></li>
                               <li><p>Reach customers all over the country</p></li>
                           </ul>
                           <div class="Start-btn">
                               <a href="{{ route('shop.confirmation', $artisan->token) }}">Verify Email Address</a>
                           </div>
                       </div>
                   </div>
                 </div>
               </div>
           </div>
              <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="sig-fnt">
                        <div class="sign"> 
                           <a href="">Stay in Touch</a>
                       </div>
                       <div class="fonts">
                            <a href="https://www.facebook.com/Dorpon-284702818689883/" title="Facebook" target="_blank" onclick="javascript:window.open(https://www.facebook.com/Dorpon-284702818689883/'); return false;">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="https://www.instagram.com/dorpon_15/" title="Instagram" target="_blank" onclick="javascript:window.open('https://www.instagram.com/dorpon_15/'); return false;">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                            <a href="https://www.youtube.com/channel/UCt3i0SgQ-1oXcmczABMh27A?view_as=subscriber" title="YouTube" target="_blank" onclick="javascript:window.open('https://www.youtube.com/channel/UCt3i0SgQ-1oXcmczABMh27A?view_as=subscriber'); return false;">
                                <i class="fa fa-youtube" aria-hidden="true"></i>
                            </a>
                            <a href=https://www.pinterest.com/dorpon0813/pins/" title="Pinterest" target="_blank" onclick="javascript:window.open('https://www.pinterest.com/dorpon0813/pins/'); return false;">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="{{ route('index')}}"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
                       </div>
                       <img src="{{ asset('public/images/default/userMailbtom.png') }}" alt="Dorpon">
                  </div>
               </div>
           </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="footer-tx">
                    <h3>Email sent by Dorpon</h3>
                    <p>Copyright <i class="fa fa-copyright" aria-hidden="true"></i> 2018 Finova Technologies Ltd. All rights reserved.</p>
                    <div class="policy">
                        <a href="{{ route('helpCenter',10) }}">Terms of Services</a>
                        <a href="{{ route('helpCenter',11) }}">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </div>
       </div>
   </section>
</body>
</html>