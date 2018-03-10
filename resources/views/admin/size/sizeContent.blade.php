@extends('admin.master')

@section('title')
	Size- View
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
							<a href="{{ route('size.insert') }}" class="btn btn-success btn-sm" ><i class=" icon-plus2 position-left"></i>Insert Product Size</a>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead >
							<tr>
								<th>Title</th>
								<th>Size Particular Info</th>
								<th>Size Category Info</th>
								<th>Publication</th>
								<th class="col-md-2">Action</th>
							</tr>
							</thead>

							<tbody>
							@forelse($sizes as $size)
								<tr>
									<td>{{ $size->sizeTitle }}</td>
									<td>
										<table>
											<tbody>
                                            <?php $sizePrtilrs = App\SizeCredential::where('sizeId', $size->id)->select('sizeFileName','sizeData')->get();?>
											@foreach($sizePrtilrs as $particular)
												<tr>
													<th>{{ ucfirst($particular->sizeFileName) }} </th>
													<td> {{ $particular->sizeData }}</td>
												</tr>
											@endforeach

											</tbody>
										</table>
									</td>
									<td>
                                        <?php $mainCatArray = explode(',',$size->mainCatId ); $secCatArray =explode(',', $size->secondCatId); $thirdCatArray = explode(',', $size->thirdCatId); ?>
										@for($i=0; $i<count($mainCatArray); $i++)
											<ul class="list-inline list-inline-separate mb-10">
                                                <?php
                                                $mainCat = App\Category::where('id', $mainCatArray[$i])->whereNull('mainCatId')->value('categoryName');
                                                $secCat = null;
                                                if(isset($secCatArray[$i])){
                                                    $secCat = App\Category::where('id', $secCatArray[$i])->where('mainCatId',$mainCatArray[$i] )->whereNull('secondCatId')->value('categoryName');
                                                }
                                                $thirdCat = null;
                                                if(isset($thirdCatArray[$i])){
                                                    $thirdCat = App\Category::where('id', $thirdCatArray[$i])->where('mainCatId',$mainCatArray[$i] )->where('secondCatId',$secCatArray[$i])->value('categoryName');
                                                }

                                                ?>
												<li><a href="#" class="text-muted">{{ ucfirst($mainCat) }}</a></li>
												@if($secCat)
													<li><a href="#" class="text-muted">{{ ucfirst($secCat) }}</a></li>
												@endif

												@if($thirdCat)
													<li><a href="#" class="text-muted">{{ ucfirst($thirdCat) }}</a></li>
												@endif
											</ul>
										@endfor
									</td>
									<td>
										@if($size->status == 1)
											<a title="Publish"  class="btn btn-success btn-sm" ><i class="icon-checkmark "></i></a>
										@else
											<a title="UnPublish"  class="btn btn-danger btn-sm"><i class="icon-blocked"></i> </a>
										@endif
									</td>
									<td data-id="{{ $size->id }}">
										<a href="{{ route('size.edit',$size->id) }}"  title="Edit" class="btn btn-primary btn-sm edit-item"><i class="icon-pencil7"></i></a>
										<button title="Delate" data-toggle="modal" data-target="#size_delete_modal" class="btn btn-danger btn-sm remove-size"><i class="icon-bin"></i></button>
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

	<!-- Delete Product Size Item Model -->
	<div id="size_delete_modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-danger">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Delete Product Size</h5>
				</div>

				<div class="modal-body">
					<div class="alert alert-warning" role="alert">
						This size will not be available anymore.
					</div>
					
					<div class="row">

						<div class="col-md-6 col-md-offset-3">
							<label>Current password <span class="text-danger">*</span></label>
							<input type="password" name="password" required class="form-control">
							<span class="help-block">For Security Purposa Enter Your Password</span>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger" id="size_delete">Delete</button>
				</div>

			</div>
		</div>
	</div>
	<!-- /Delete Product Size Item Model -->


	<script src="{{ asset('public/artisan/ajex/sizeCrud.js') }}"></script>
@endsection