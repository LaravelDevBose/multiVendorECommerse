@extends('admin.master')

@section('title')
 Dorpon-Logo
@endsection

@section('asset')
<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/selects/bootstrap_select.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>
	
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/form_bootstrap_select.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/uploader_bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/general_widgets_content.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/ripple.min.js') }}"></script>
<!-- /theme JS files -->
@endsection

@section('content')

<div class="content">

	@include('admin.includes.message')
	<div class="row">
		
		<div class="col-md-12">
			
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">Logo Information</h5>
					<div class="heading-elements">
						<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#logo_insert_modal"><i class=" icon-plus2 position-left"></i>Insert Logo</button>
                	</div>
				</div>
				
			</div>
			<div class="row">
				<!-- gift widget -->
				@forelse($logoImages as $logo)
				<div class="col-md-4">
					<div class="thumbnail ">
						<div class="thumb">
							<?php
                        		$logoImage = $logo->logo;
		                        if(!file_exists($logoImage)){
		                          $logoImage = 'public/artisan/assets/images/placeholder.jpg'; 
		                        }
	                      	?>
							<img src="{{ asset($logoImage)}}"  alt="{{ $logo->tagLine }}">
							<div class="caption-overflow">
								<span>
									<button type="button" class="btn btn-flat btn-info text-white btn-sm" id="{{ $logo->id }}" onclick="logoEdit(this);" data-toggle="modal" data-target="#logo_edit_modal">Edit</button>
									<button type="button" class="btn btn-flat btn-danger text-white btn-sm" id="{{ $logo->id }}" onclick="logoDelete(this.id);"  data-toggle="modal" data-target="#logo_delete_modal">Delete</button>
								</span>
							</div>
						</div>

						<div class="caption">
							<div class="content-group-sm media">
								<div class="media-body">
									<h6 class="text-semibold no-margin text-primary">{{ $logo->tagLine }}</h6>
									@if($logo->publicationStatus == 1)
									<small class="text-semibold text-success" id="1">Published</small>
									@else
									<small class="text-semibold text-danger" id="0">Un-Published</small>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /gift widget -->
				@empty

				@endforelse

			</div>
		</div>

	</div>
	
</div>

@include('admin.model.logoModel')


<script>
	

	function logoEdit(button) {
		var logoId = button.id;
		var logoImage = button.parentElement.parentElement.parentElement.children[0].src;;
		var tagLine = button.parentElement.parentElement.parentElement.parentElement.children[1].children[0].children[0].children[0].innerHTML;	
		var status = button.parentElement.parentElement.parentElement.parentElement.children[1].children[0].children[0].children[1].id;
		
		document.getElementById('logoId').value = logoId;
		document.getElementById('logoImage').src= logoImage;
		document.getElementById('tagLine').value = tagLine;

		if(status == 0 ){
			document.getElementById('unpublish').setAttribute('selected','selected');
		}else{
			document.getElementById('publish').setAttribute('selected','selected');
		}
		
	}

	function logoDelete(logoId){
		document.getElementById('logoID').value = logoId;
	}
	
</script>
@endsection