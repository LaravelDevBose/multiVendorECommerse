@extends('admin.master')

@section('title')
 Gift-Info
@endsection

@section('asset')
<!-- Theme JS files -->
	{{-- input Type custom --}}
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
					<h5 class="panel-title">Gift Item Information</h5>
					<div class="heading-elements">
						<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#gift_insert_modal"><i class=" icon-plus2 position-left"></i>Insert Gift Type</button>
                	</div>
				</div>
				
			</div>
			<div class="row">
				<!-- gift widget -->
				@forelse($giftTypes as $giftType)
				<div class="col-md-4">
					<div class="thumbnail ">
						<div class="thumb">
							<?php
                        		$giftImage = $giftType->image;
		                        if(!file_exists($giftImage)){
		                          $giftImage = 'public/artisan/assets/images/placeholder.jpg'; 
		                        }
	                      	?>
							<img src="{{ asset($giftImage)}}"  alt="">
							<div class="caption-overflow">
								<span>
									<button type="button" class="btn btn-flat btn-info text-white btn-sm" id="{{ $giftType->id }}" onclick="giftEdit(this);" data-toggle="modal" data-target="#gift_edit_modal">Edit</button>
									<button type="button" class="btn btn-flat btn-danger text-white btn-sm" id="{{ $giftType->id }}" onclick="giftDelete(this.id);"  data-toggle="modal" data-target="#gift_delete_modal">Delete</button>
								</span>
							</div>
						</div>

						<div class="caption">
							<div class="content-group-sm media">
								<div class="media-body">
									<h6 class="text-semibold no-margin text-uppercase text-violet">{{ $giftType->giftTitle }}</h6>
									@if($giftType->publicationStatus == 1)
									<small class="text-semibold text-success" id="1">Publish</small>
									@else
									<small class="text-semibold text-danger" id="0">Un-Publish</small>
									@endif
								</div>
								<h6 class="text-warning-800 media-right no-margin-bottom text-semibold" id="{{ $giftType->position }}">{{ $giftType->position }}</h6>
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

@include('admin.model.giftModel')


<script>
	

	function giftEdit(button) {
		var giftId = button.id;
		var giftImage = button.parentElement.parentElement.parentElement.children[0].src;;
		var giftTitle = button.parentElement.parentElement.parentElement.parentElement.children[1].children[0].children[0].children[0].innerHTML;	
		var status = button.parentElement.parentElement.parentElement.parentElement.children[1].children[0].children[0].children[1].id;
		var position = button.parentElement.parentElement.parentElement.parentElement.children[1].children[0].children[1].id;
		
		document.getElementById('giftId').value = giftId;
		document.getElementById('giftImage').src= giftImage;
		document.getElementById('giftTitle').value = giftTitle;

		for (var i = 0; i < 10; i++) {
			if(document.getElementById('position').children[i].innerHTML == position){
				document.getElementById('position').children[i].setAttribute('selected','selected');
				
			}
		}

		if(document.getElementById('status').children[0].value == 0){
			document.getElementById('status').children[0].setAttribute('selected','selected');
		}else{
			document.getElementById('status').children[1].setAttribute('selected','selected');
		}
		
	}

	function giftDelete(giftId){
		document.getElementById('giftTypeId').value = giftId;
	}
	
</script>
@endsection