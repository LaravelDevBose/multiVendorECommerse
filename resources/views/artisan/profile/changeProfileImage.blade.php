@extends('artisan.master')

@section('title')
Profile Image Change
@endsection

@section('asset')
<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/uploader_bootstrap.js') }}"></script>

	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/dashboard.js') }}"></script>


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
					<h6 class="panel-title">Change Profile Image</h6>
					<div class="heading-elements">
						
					</div>
				</div>

				<div class="panel-body">
					<form action="{{ route('profile.image.change') }}" method="POST" enctype="multipart/form-data" >{{ csrf_field() }} 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									
									<input type="file" name="avater" class="file-input-ajax" accept="image/*">
									<span class="help-block">Uplode Profile Image</span>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-12 col-lg-12">
							<div class="text-right">
								<button type="submit" class="btn btn-primary btn-block">Change Image <i class="icon-arrow-right14 position-right"></i></button>
							</div>
						</div>
					</form>
				</div>

				
			</div>
			<!-- /traffic sources -->

		</div>
	</div>
</div>

@endsection

