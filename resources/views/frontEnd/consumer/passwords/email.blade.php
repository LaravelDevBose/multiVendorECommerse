@extends('frontEnd.master')
@section('title')
Dorpon | Reset Password
@endsection

@section('headasset')
<!--<link href="{{asset('public/frontEnd/css/style.css')}}" rel="stylesheet">-->
<link href="{{asset('public/frontEnd/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/main.css')}}" rel="stylesheet">
<link href="{{ asset('public/frontEnd/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{asset('public/frontEnd/css/header.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/footer.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/bootstrap.css')}}" rel="stylesheet">
        
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 r-pass">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success"> 
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal forgot" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
			
			<p>Please Provide Your Email Below to Receive Password Reset Link.</p>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
