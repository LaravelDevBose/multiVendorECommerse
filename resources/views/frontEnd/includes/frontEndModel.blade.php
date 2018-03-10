

{{--shop Login Model--}}
<div id="shopLogin" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="wel-topp">
                    <p>Welcome Back</p>
                </div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="pop-welcome">
                            <!--<div class="wel-topp">-->
                            <!--    <p>Welcome Back</p>-->
                            <!--</div>-->
                            <div class="wel-body">
                                <div class="wel-contt">
                                    <div class="row">
                                        <form  method="post" action="{{ route('merchantile.login') }}" >{{ csrf_field() }}
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="Email-adderss">
                                                    <p>Email Address*</p>
                                                    <input type="email" name="email" required>
                                                </div>
                                                <div class="pass">
                                                    <p>Password*</p>
                                                    <input type="password" name="password" required min="6">
                                                </div>
                                                    <input type="checkbox" name="remember" value="1">Remember me
                                                <div class="submit-btn">
                                                    <!--<a href="" class="custom-btn">Sign In</a>-->
                                                    <button type="submit" class="custom-btn">Sign In</button>
                                                </div>
                                                <span><a href="{{ route('merchantile.password.request') }}">Forgot password?</a></span>
                                            </div>
                                        </form>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="right-bottom2">
                                                <img src="//mydorpon.com/dorpon/public/images/default/baby.png" alt="">
                                                <div class="noaccount">
                                                <p>Don't have an account!</p>
                                                <a href="{{ route('shop.register') }}">Sign Up</a>
                                                </div>
                                                
                                            </div>

                                        </div>

                                    </div>
                                    <div class="wlcome-footer">
                                        <p>By joining Dorpon, you agree to our <a href="{{ route('helpCenter',10) }}">Terms of Services</a> and <a href="{{ route('helpCenter',11) }}">Privacy Policy</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{--shop Login Model--}}

{{--user login model--}}
<div id="userLogin" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="wel-topp">
                    <p>Welcome Back</p>
                </div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="pop-welcome">
                            <!--<div class="wel-topp">-->
                            <!--    <p>Welcome Back</p>-->
                            <!--</div>-->
                            <div class="wel-body">
                                <div class="wel-contt">
                                    <div class="row">
                                        <form method="post" action="{{ route('login') }}" >{{ csrf_field() }}
                                            <div class="col-md-6 col-sm-6">
                                                <div class="Email-adderss">
                                                    <p>Email Address*</p>
                                                    <input type="email" name="email" required>
                                                </div>
                                                <div class="pass">
                                                    <p>Password*</p>
                                                    <input type="password" name="password" required min="6">
                                                </div>
                                                <form action="">
                                                    <input type="checkbox" name="remember" value="1">Remember me
                                                </form>
                                                <div class="submit-btn">
                                                    <button type="submit" class="custom-btn">Sign In</button>
                                                </div>
                                                <span><a href="{{ route('password.request') }}">Forgot password?</a></span>
                                            </div>
                                        </form>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="right-bottom">
                                                <p>Or</p>
                                                <div class="fb-btn">
                                                    <a href="{{ url('login/facebook') }}">
                                                        <div class="fb-icon"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                                                        <div class="btn-text">Sign-in with Facebook</div>
                                                    </a>
                                                </div>
                                                <div class="gl-btn">
                                                    <a href="{{ url('login/google') }}">
                                                        <div class="fb-icon"><i class="fa fa-google" aria-hidden="true"></i></div>
                                                        <div class="btn-text">Sign-in with Gmail</div>
                                                    </a>
                                                </div>
                                                <div class="tw-btn">
                                                    <a href="{{ url('login/twitter') }}">
                                                        <div class="fb-icon"> <i class="fa fa-twitter" aria-hidden="true"></i></div>
                                                        <div class="btn-text">Sign-in with Twitter</div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="noaccount">
                                                <p>Don't have an account!</p>
                                                <a href="{{ route('register') }}" ">Sign Up</a>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="wlcome-footer">
                                        <p>By joining Dorpon, you agree to our <a href="{{ route('helpCenter',10) }}">Terms of Services</a> and <a href="{{ route('helpCenter',11) }}">Privacy Policy</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{--user login Model--}}

{{--Customer Class Modal--}}
<div id="custClass" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="wel-topp">
                    <p>Customer Classification</p>
                </div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <p>Text</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{--shop Login Model--}}




