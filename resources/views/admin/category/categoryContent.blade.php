@extends('admin.master')

@section('title')
	Category
@endsection

@section('asset')
	{{-- File Uplode --}}
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/uploader_bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/form_select2.js') }}"></script>
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
						<h5 class="panel-title">Category Information</h5>
						<div class="heading-elements">
							<button type="button" class="btn btn-success btn-sm transport-model" data-toggle="modal"  data-target="#category_insert_modal"><i class=" icon-plus2 position-left"></i>Insert New Category</button>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead >
							<tr>
								<th>Sl No</th>
								<th>Category Name</th>
								<th>Main Category Name</th>
								<th>Second Category Name</th>
								<th>Position</th>
								<th>Status</th>
								<th class="col-md-2">Action</th>
							</tr>
							</thead>
							<tbody>
                            <?php $i = 1;?>
							@forelse($mainCategoris as $mainCategory)
								<tr>
									<td>{{ $i }}</td>
									<td>{{ $mainCategory->categoryName }}</td>
									<td><img src="{{asset($mainCategory->image) }}" style="width: 100px; height: 50px;"></td>
									<td> </td>
									<td>{{ $mainCategory->position }}</td>
									<td>
										@if($mainCategory->publicationStatus == 1)
											<span id="1" class="label bg-success-600">Publish</span>
										@else
											<span id="0" class="label bg-danger-600">UnPublish</span>
										@endif
									</td>
									<td data-id="{{ $mainCategory->id }}">
										<button data-toggle="modal" data-target="#category_edit_modal"  class="btn btn-primary btn-sm edit-mainCat"><i class="icon-pencil7"></i></button>
										<button data-toggle="modal" data-target="#category_delete_modal"  class="btn btn-danger btn-sm delate-cat"><i class="icon-trash"></i></button>

									</td>
								</tr>
                                <?php $secCategories = App\Category::where('mainCatId',$mainCategory->id)->where('secondCatId', null)->orderBy('position', 'asc')->get(); $j=1;?>
								@forelse($secCategories as $secCategory)
									<tr>
										<td>{{ $i .'.'. $j }}</td>
										<td>{{ $secCategory->categoryName }}</td>
										<td id="{{ $mainCategory->id }}">{{ $mainCategory->categoryName }} </td>
										<td> </td>
										<td>{{ $secCategory->position }}</td>

										<td>
											@if($secCategory->publicationStatus == 1)
												<span id="1" class="label bg-success-600">Publish</span>
											@else
												<span id="0" class="label bg-danger-600">UnPublish</span>
											@endif
										</td>
										<td data-id="{{ $secCategory->id }}">
											<button data-toggle="modal" data-target="#category_edit_modal"  class="btn btn-primary btn-sm edit-secondCat"><i class="icon-pencil7"></i></button>
											<button data-toggle="modal" data-target="#category_delete_modal"  class="btn btn-danger btn-sm delate-cat"><i class="icon-trash"></i></button>
										</td>
									</tr>
                                    <?php $thirdCategories  = App\Category::where('mainCatId',$mainCategory->id)->where('secondCatId', $secCategory->id)->where('thirdCatId', null)->orderBy('position', 'asc')->get(); $k=1;?>
									@forelse($thirdCategories as $thirdCategory)
										<tr>
											<td>{{ $i .'.'. $j.'.'.$k++ }}</td>
											<td>{{ $thirdCategory->categoryName }}</td>
											<td id="{{ $mainCategory->id }}">{{ $mainCategory->categoryName }} </td>
											<td id="{{ $secCategory->id }}">{{ $secCategory->categoryName }}</td>
											<td>{{ $thirdCategory->position }}</td>
											<td>
												@if($thirdCategory->publicationStatus == 1)
													<span id="1" class="label bg-success-600">Publish</span>
												@else
													<span id="0" class="label bg-danger-600">UnPublish</span>
												@endif
											</td>
											<td data-id="{{ $thirdCategory->id }}">
												<button data-toggle="modal" data-target="#category_edit_modal"  class="btn btn-primary btn-sm edit-third"><i class="icon-pencil7"></i></button>
												<button data-toggle="modal" data-target="#category_delete_modal"  class="btn btn-danger btn-sm delate-cat"><i class="icon-trash"></i></button>
											</td>
										</tr>
									@empty
										<tr>
											<th colspan="7" class="text-center text-info-600">This Second Category have no Third Category</th>
										</tr>
									@endforelse

                                    <?php $j++ ;?>
								@empty
									<tr>
										<th colspan="7" class="text-center text-info-600">This Main Category have no Second And Third Category</th>
									</tr>
								@endforelse
                                <?php $i++ ;?>
							@empty
								<tr>
									<th colspan="7" class="text-center text-info-600">Category Not Inserted </th>
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

	@include('admin.model.categoryModel')
	<script src="{{ asset('public/artisan/ajex/categoryCrud.js') }}"></script>



@endsection