@extends('admin.master')

@section('title')
Promotion-View
@endsection

@section('asset')
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
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
					<h5 class="panel-title">Products Size Information</h5>
					<div class="heading-elements">
						<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#size_insert_modal"><i class=" icon-plus2 position-left"></i>Insert Product Size</button>
                	</div>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead >
							<tr>
								<th>Title</th>
								<th>Description</th>
								<th class="col-md-2">Action</th>
							</tr>
						</thead>

						<tbody>
							@forelse($promotions as $promotion)
								<tr>
									<td>{{ $size->title }}</td>
									<td>{{ $size->description }}</td>
									<td data-id="{{ $size->id }}">
										<button data-toggle="modal" data-target="#size_edit_modal" class="btn btn-primary btn-sm edit-item">Edit</button>
										<button data-toggle="modal" data-target="#size_delete_modal" class="btn btn-danger btn-sm remove-item">Delete</button>
									</td>
								</tr>
							@empty
								<tr>
									<th colspan="3" class="text-center text-info-600">No Size Inserted</th>
								</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
			
		</div>
		</div>

	</div>
	
</div>

@include('admin.model.sizeModel')

<script src="{{ asset('public/artisan/ajex/productSizeCrud.js') }}"></script>
@endsection