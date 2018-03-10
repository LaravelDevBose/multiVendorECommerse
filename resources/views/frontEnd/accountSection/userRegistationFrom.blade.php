@extends('frontEnd.master')

@section('title')
Dorpon | New User Sign Up
@endsection

@section('headasset')
<!--<link href="{{asset('public/frontEnd/css/bootstrap.min.css')}}" rel="stylesheet">-->
<link href="{{asset('public/frontEnd/css/bootstrap.css')}}" rel="stylesheet">
<!--<link href="{{asset('public/frontEnd/css/main.css')}}" rel="stylesheet">-->
<link href="{{ asset('public/frontEnd/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{asset('public/frontEnd/css/header.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/footer.css')}}" rel="stylesheet">

        
@endsection

@section('content')
<div class="welcome-sign">
    <div class="wel-top">
        <!--<div class="wel-top-left">-->
            <p>Join the Dorpon Community</p>
            <h1>Welcome!</h1>
        <!--</div>-->
        <!--<div class="wel-top-right">-->
        <!--    <P>Explore, Empower, Impact</P>-->
        <!--</div>-->
    </div>
    <div class="wel-content">
        <div class="all-formm">
            @include('frontEnd.includes.message')
            <div class="row">
                <div class="col-md-6">
                    <div class="wel-content-left">
                        <form action="{{ route('register')}}" method="POST">{{ csrf_field() }}
                            <div class="name">
                                <p>Username*</p>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Write a usename" required>
                            </div>
                            <div class="check-boxx">
                                <p>Gender</p>
                                 
                                  <input type="radio" name="gender" value="1"> Female
                                  <input type="radio" name="gender" value="2" checked> Male
                                  <input type="radio" name="gender" value="3" > Other
                                        
                            </div>
                            <div class="name">
                                <p>First Name*</p>
                                <input type="text" name="firstName" value="{{ old('firstName') }}" placeholder="write your first name" required>
                            </div>
                            <div class="name">
                                <p>Last Name*</p>
                                <input type="text" name="lastName" value="{{ old('lastName') }}"  placeholder="write your last name" required>
                            </div>
                            <div class="email">
                                <p>Email Adderss*</p>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="write your email address" required>
                            </div>
                            <div class="name">
                                <p>Phone Numner*</p>
                                <input type="number" name="phoneNo" value="{{ old('phoneNo') }}" placeholder="write your phone number" required>
                            </div>
                            <div class="name">
                                <p>Date of Birth*</p>
                                <input type="date" name="birthDate" value="{{ old('birthDate') }}" placeholder="write your date of birth (dd/mm/yyyy)" required>
                            </div>
                            <div class="name">
                                <p>Password*</p>
                                <input type="password" name="password" placeholder="Write your password" required>
                            </div>
                            <div class="name">
                                <p>Re-type Password*</p>
                                <input type="password" name="password_confirmation" placeholder="Re-write your password" required>
                            </div>
                            <div class="name" placeholder="write some thing">

                            
                                <div class="name">
                                    <p>Captcha <span class="reqired">*</span></p>
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                </div>
                            </div>
                            <div class="usersubmit-btn">
                                <button type="submit" class="custom-btn">Sumbit</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wel-im">
                        <img class="img-responsive" src=//mydorpon.com/dorpon/public/images/default/happyness.png alt="">
                        <img class="img-responsive" src=//mydorpon.com/dorpon/public/images/default/homemade.png alt="">
                        <img class="img-responsive" src=//mydorpon.com/dorpon/public/images/default/beautyfull.png alt="">
                    </div>
                    <div class="account-texxt">
                        <p>Already have an account?</p>
                        <h4><a href="#" data-toggle="modal" data-target="#userLogin">Sign in</a></h4>
                    </div>
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
                    <div class="wel-ad">
                        <img class="img-responsive" src=//mydorpon.com/dorpon/public/images/default/modelwanted.jpg alt="">
                    </div>
                </div>

            </div>
            <div class="wlcome-footer">
                <p>By joining Dorpon, you agree to our <a href="{{ route('helpCenter',10) }}">Terms of Services</a> and <a href="{{ route('helpCenter',11) }}">Privacy Policy</a></p>
            </div>
        </div>
    </div>
</div>
@endsection