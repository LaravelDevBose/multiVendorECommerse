@extends('admin.master')

@section('title')
Slider Info
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
					<h5 class="panel-title">Slider Informtaion</h5>
					<div class="heading-elements">
						<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#slider_insert_modal"><i class=" icon-plus2 position-left"></i>Insert Slider Image</button>
                	</div>
				</div>
				
			</div>
			<div class="row">
				<!-- gift widget -->
				@forelse($sliders as $slider)
				<div class="col-md-4">
					<div class="thumbnail ">
						<div class="thumb">
							<?php
                        		$sliderImage = $slider->image;
		                        if(!file_exists($sliderImage)){
		                          $sliderImage = 'public/artisan/assets/images/placeholder.jpg'; 
		                        }
	                      	?>
							<img src="{{ asset($sliderImage)}}"   alt="">
							<div class="caption-overflow">
								<span>
									<button type="button" class="btn btn-flat btn-info text-white btn-sm slider-edit" id="{{ $slider->id }}"  data-toggle="modal" data-target="#slider_edit_modal">Edit</button>
									<button type="button" class="btn btn-flat btn-danger text-white btn-sm slider-delete" id="{{ $slider->id }}"  data-toggle="modal" data-target="#slider_delete_modal">Delete</button>
								</span>
							</div>
						</div>

						<div class="caption">
							<div class="content-group-sm media">
								<div class="media-body">
									<div class="col-md-12">
										<h6 class="text-semibold no-margin text-uppercase text-violet">{{ $slider->sliderTitle }}</h6>

										<span class="text-semibold no-margin" >{{ $slider->shortNote }}</span>
									</div>

									<div class="col-md-12">
										<h6 class="btn btn-info  " >{{ $slider->buttonTitle }}</h6>
										<p class="text-semibold text-success" >URL:- <span>{{ $slider->url }}</span></p>
									</div>


									@if($slider->publicationStatus == 1)
									<span class="text-semibold text-success" id="1">Published</span>
									@else
									<span class="text-semibold text-danger" id="0">Un-Published</span>
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

@include('admin.model.sliderModel')
<script src="{{ asset('public/artisan/ajex/slider.js') }}"></script>


@endsection