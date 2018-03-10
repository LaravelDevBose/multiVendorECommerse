@extends('frontEnd.master')

@section('title')
Dorpon | Consumer Sign In
@endsection

@section('headasset')
<link href="{{asset('public/frontEnd/css/style.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/bootstrap.min.css')}}" rel="stylesheet">
<!--<link href="{{asset('public/frontEnd/css/main.css')}}" rel="stylesheet">-->
<link href="{{ asset('public/frontEnd/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{asset('public/frontEnd/css/header.css')}}" rel="stylesheet">

        
@endsection

@section('content')
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5>We are Here for Your Biggest Happiness </h5>
                <h1>Sign in with <span>DORPON</span></h1>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#as-user" id="as-user-tab" aria-controls="as-user" role="tab" data-toggle="tab">Sign in as an User</a>
                    </li>
                    <li role="presentation" class="hide">
                        <a href="#as-artisian" id="as-artisian-tab" aria-controls="as-artisian" role="tab" data-toggle="tab">Sign in as an Artisan</a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <div>
                    <div class="text-center">
                        <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                        @if(Session::get('success'))
                            <h3 class="text-center text-success">{{ Session::get('success') }}</h3>
                        @elseif(Session::get('unsuccess'))
                            <h3 class="text-center text-danger">{{ Session::get('unsuccess') }}</h3>
                        @elseif($errors->any())
                            <h3 class="text-center text-danger">Email Address And Password Not Match</h3>
                        @endif
                    </div>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="as-user">
                            <form name="" method="post" action="{{ route('login') }}" class="ui loadable form" novalidate="novalidate">{{ csrf_field() }}
                                <div class="form-group">
                                    <div class="required field">
                                        <label for="email" class="required">Email Address</label>
                                        <input type="email" id="email" name="email" required="required" class="form-control" placeholder="you@example.com" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="required field">
                                        <label for="password" class="required">Password</label>
                                        <input type="password" id="password" name="password" required="required" class="form-control" placeholder="******" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="field">

                                        <div>
                                            <input type="checkbox" id="remember" name="remember" value="1"  />
                                            <label for="remember">Remember Me</label>
                                        </div>
                                        <div class="forget">
                                            <a href="{{ route('password.request') }}" class="pull-right">Forgot Password?</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <button type="submit" class="btn btn-success btn-block">Sign in</button>
                                </div>

                            </form>
                            <div class="clearfix u-account">
                                
                                <label>Don't have an Account?</label><a href="{{ route('register') }}" >Sign Up</a>
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>
            <div class="modal-footer">
            	<label>Sign In with</label>
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-google-plus"></i></a>
            </div>
        </div>
    </div>

@endsection