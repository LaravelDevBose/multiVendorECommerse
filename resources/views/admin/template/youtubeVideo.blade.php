@extends('admin.master')

@section('title')
YouTube-Videos
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
					<h5 class="panel-title">Youtube Videos Informtaion</h5>
					<div class="heading-elements">
						<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#video_insert_modal"><i class=" icon-plus2 position-left"></i>Insert Video</button>
                	</div>
				</div>
				
			</div>
			<div class="row">
				@forelse($videos as $video)
				<div class="col-sm-6">
					<div class="thumbnail">
						<div class="thumb">
							<div class="content-group-lg">
								<div class="embed-responsive embed-responsive-16by9">
									<iframe class="embed-responsive-item no-margin-bottom" src="{{ $video->videoPath }}" frameborder="0" allowfullscreen></iframe>
								</div>
							</div>
						</div>

						<div class="caption">
							<div class="content-group-sm media">
								<div class="media-body">
									<h6 class="text-semibold no-margin">{{ $video->videoTitle }}</h6>
									@if($video->ownerId == 0)
									<small id="0" class="text-muted"><a href="#">Eugene Kopyov</a></small>
									@else
									<?php $shopName = App\Shop::where('id', $video->ownerId)->value('shopName'); ?>
									<small id="{{ $video->ownerId }}" class="text-muted"><a href="{{ route('shop.singel.view',$video->ownerId) }}">{{ ucfirst($shopName) }}</a></small>
									@endif
								</div>

								@if($video->status == 1)
								<h6 id="1" class="text-success media-right no-margin-bottom text-semibold">Publish</h6>
								@else
								<h6 id="0" class="text-danger media-right no-margin-bottom text-semibold">Un-Publish</h6>
								@endif
							</div>

							<p>{{ $video->shortNote }}</p>
						</div>

						<div class="panel-footer panel-footer-transparent">
							<div class="heading-elements pull-right">
								<span>
									<button type="button" class="btn btn-info text-white btn-sm" id="{{ $video->id }}" onclick="videoEdit(this);" data-toggle="modal" data-target="#video_edit_modal" >Edit</button>
									<button type="button" class="btn btn-danger text-white btn-sm" id="{{ $video->id }}" onclick="videoDelete(this.id);"  data-toggle="modal" data-target="#video_delete_modal">Delete</button>
								</span>
							</div>
						</div>
					</div>
				</div>

				@empty


				@endforelse
			</div>
			<!-- /video options -->
		</div>

	</div>
	
</div>

@include('admin.model.videoModel')


<script>
	

	function videoEdit(button) {
		var videoId = button.id;
		var videoPath = button.parentElement.parentElement.parentElement.parentElement.children[0].children[0].children[0].children[0].src;
		var videoTitle = button.parentElement.parentElement.parentElement.parentElement.children[1].children[0].children[0].children[0].innerHTML;	
		var ownerId = button.parentElement.parentElement.parentElement.parentElement.children[1].children[0].children[0].children[1].id;	
		var status = button.parentElement.parentElement.parentElement.parentElement.children[1].children[0].children[1].id;	
		var shortNote = button.parentElement.parentElement.parentElement.parentElement.children[1].children[1].innerHTML;	
		
		document.getElementById('videoId').value = videoId;
		document.getElementById('videoTitle').value = videoTitle;
		document.getElementById('videoPath').value= videoPath;
		document.getElementById('shortNote').value = shortNote;

		
		if(ownerId == 0){
			document.getElementById('ownerId').children[0].setAttribute('selected','selected');
		}else{
			for (var i = 1; i <= {{count($shops)}}; i++ ) {
				
				document.getElementById('ownerId').children[i].setAttribute('selected','selected');
			}
			
		}

		if(status == 1){
			document.getElementById('status').children[0].setAttribute('selected','selected');
		}else{
			document.getElementById('status').children[1].setAttribute('selected','selected');
		}
		
	}

	function videoDelete(videoID){

		document.getElementById('videoID').value = videoID;
	}
		
</script>
@endsection