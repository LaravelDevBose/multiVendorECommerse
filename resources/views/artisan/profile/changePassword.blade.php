@extends('artisan.master')

@section('title')
Change Password
@endsection

@section('asset')
<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/moment/moment.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/dashboard.js') }}"></script>

	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/ripple.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/general_widgets_stats.js') }}"></script>


<!-- /theme JS files -->
@endsection

@section('body')

<!-- Content area -->
<div class="content">
	@include('artisan.includes.message')
	<div class="row">
		<div class="col-lg-6 col-md-offset-3">

			<!-- Traffic sources -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">Change Password</h6>
					<div class="heading-elements">
						
					</div>
				</div>

				<div class="panel-body">
					<form action="{{ route('artisan.password.change') }}" method="POST"> {{csrf_field()}}
						<div class="form-group">
							<div class="row">

								<div class="col-md-12">
									<label>Current password</label>
									<input type="password" name="current_password" required class="form-control">
									<span class="help-block">Enter Your Current Password</span>
								</div>

								<div class="col-md-12">
									<label>New password</label>
									<input type="password" name="password" required minlength="6" placeholder="Enter new password" class="form-control">
									<span class="help-block">Enter Your New Password</span>
								</div>

								<div class="col-md-12">
									<label>Repeat password</label>
									<input type="password" name="password_confirmation" minlength="6" required placeholder="Repeat new password" class="form-control">
									<span class="help-block">Enter Your Repeat Password</span>
								</div>
							</div>
						</div>
						<div class="text-right">
                        	<button type="submit" class="btn btn-primary">Change Password <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
					</form>
				</div>

				
			</div>
			<!-- /traffic sources -->

		</div>
	</div>
</div>

@endsection