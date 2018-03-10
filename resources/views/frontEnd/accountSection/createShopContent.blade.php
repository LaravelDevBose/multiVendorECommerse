@extends('frontEnd.master')

@section('title')
Dorpon | Create Shop
@endsection

@section('headasset')
    <link href="{{ asset('public/frontEnd/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/frontEnd/css/bootstrap.css')}}" rel="stylesheet">
    <!--<link href="{{asset('public/frontEnd/css/homepage.css')}}" rel="stylesheet">-->
    <link href="{{asset('public/frontEnd/css/header.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontEnd/css/footer.css')}}" rel="stylesheet">

<style>
    .reqired{
        color: red;
    }
</style>
@endsection

@section('content')
<section>
    <div class="container">
        <div class="welcome-sign">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="wel-top">
                        <!--<div class="wel-top-left">-->
                            <p>Join the Dorpon Artisan Community</p>
                            <h1>Welcome!</h1>
                        <!--</div>-->
                        <!--<div class="wel-top-right">-->
                            <!--<P>Explore, Empower, Impact</P>-->
                        <!--</div>-->
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="wel-content">
                        <div class="all-form">
                            @include('frontEnd.includes.message')
                            <form action="{{ route('shop.register') }}" method="POST" enctype="multipart/form-data">{{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="wel-content-left">
                                            <div class="name">
                                                <p>Shop Name <span class="reqired">*</span></p>
                                                <input type="text" name="shopName" value="{{ old('shopName') }}" required placeholder="Name that buyer would use to search your products">
                                                @if ($errors->has('shopName'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('shopName') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="name">
                                                <p>Shop Owner's Name <span class="reqired">*</span></p>
                                                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Write your full name name">

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="name">
                                                <p>Seller's Skills <span class="reqired">*</span></p>
                                                <input type="text" name="shopTypeId" value="{{ old('shopTypeId') }}"  placeholder="Mention upto 5 skils from the list">
                                            </div>
                                            <div class="name">
                                                <p>Website/Online Adderss</p>
                                                <input type="text" name="onlineAddress" value="{{ old('onlineAddress') }}" placeholder="e.g.,http://www.example.com/">
                                            </div>
                                            <div class="name">
                                                <p>Upload Shop logo</p>
                                                <input type="text" value="{{ old('shopLogo') }}" placeholder="File Location" id="uploadFile">
                                                <label class="file-right">
                                                    <img src="{{ asset('public/images/default/fileUplode.png') }}">
                                                    <input id="uploadBtn" type="file" name="shopLogo" value="{{ old('shopLogo') }}" style="display: none;" />
                                                </label>
                                                <script type="text/javascript">
                                                    document.getElementById("uploadBtn").onchange = function () {
                                                        document.getElementById("uploadFile").value = this.value;
                                                    };
                                                </script>
                                            </div>
                                            <div class="name">
                                                <p>Upload Seller's Profile Photo</p>
                                                <input type="text" id="avater" placeholder="File Location">
                                                <label class="file-right">
                                                    <img src="{{ asset('public/images/default/fileUplode.png') }}">
                                                    <input id="avaterBtn" type="file" name="avater" value="{{ old('avater') }}" style="display: none;"/>
                                                </label>
                                                <script type="text/javascript">
                                                    document.getElementById("avaterBtn").onchange = function () {
                                                        document.getElementById("avater").value = this.value;
                                                    };
                                                </script>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="wel-content-right">
                                            <div class="name">
                                                <p>Mobile Phone Number <span class="reqired">*</span></p>
                                                <input type="number" name="phoneNo" value="{{ old('phoneNo') }}" required placeholder="Your Contact Phone No" >
                                            </div>

                                            <div class="check-box">
                                                <p>Gender <span class="reqired">*</span></p>
                                                <input type="radio" name="gender" value="1"> Female
                                                <input type="radio" name="gender" value="2" checked> Male
                                                <input type="radio" name="gender" value="3" > Other
													
                                            </div>
                                            <div class="name">
                                                <p>Email Adderss <span class="reqired">*</span></p>
                                                <input type="email" name="email" value="{{ old('email') }}" required placeholder="You will use this as your user ID" >
                                            </div>
                                            <div class="name">
                                                <p>Password <span class="reqired">*</span></p>
                                                <input type="password" name="password" required placeholder="min 6 characters" >
                                            </div>
                                            <div class="name">
                                                <p>Re-type Password <span class="reqired">*</span></p>
                                                <input type="password" name="password_confirmation" required placeholder="min 6 characters" >
                                            </div>
                                            <div class="name">
                                                <p>Captcha <span class="reqired">*</span></p>
                                                {!! NoCaptcha::renderJs() !!}
                                                {!! NoCaptcha::display() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-shop">
                                    <button class="custom-btn">Create Shop</button>
                                </div>
                            </form>

                            <div class="account-texxt">
                                <p>Already have an account?     </p>
                                <a href="#" data-toggle="modal" data-target="#shopLogin">Sign In Now</a>
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
</section>


@endsection