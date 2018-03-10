@extends('admin.master')

@section('title')
	Product Edit
@endsection

@section('asset')
	{{-- input Type custom --}}
	<script type="text/javascript" src="{{ asset('public/artisan/ckeditor/ckeditor.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/pickers/color/spectrum.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/libraries/jasny_bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/inputs/maxlength.min.js') }}"></script>

	{{-- File Uplode --}}
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/uploader_bootstrap.js') }}"></script>

	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/editors/wysihtml5/wysihtml5.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/editors/wysihtml5/toolbar.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/editors/wysihtml5/parsers.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js') }}"></script>


	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/inputs/touchspin.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/styling/switch.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/styling/switchery.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/picker_color.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/form_layouts.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/editor_wysihtml5.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/ripple.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/editor_ckeditor.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/form_controls_extended.js') }}"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">


	<!-- /theme JS files -->
@endsection

@section('content')

	<!-- Content area -->
	<div class="content">
		@include('admin.includes.message')
		<form action="{{ route('product.update')}}" method="POST" enctype="multipart/form-data"> {{csrf_field()}}
			<div class="row">
				<div class="col-md-9 col-lg-9 col-sm-12">
					<!-- Form validation -->

					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Product Update Form</h5>
							<div class="heading-elements">
								<ul class="icons-list">
									<li><a data-action="collapse"></a></li>
									<li><a data-action="reload"></a></li>
									{{-- <li><a data-action="close"></a></li> --}}
								</ul>
							</div>
						</div><hr>

						<div class="panel-body">
							<input type="hidden" name="ownerId" value="{{ $productById->ownerId }}" />
							<input type="hidden" name="productId" value="{{ $productById->id }}" />
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Select Main Category: <span class="text-danger">*</span></label>
										<select name="mainCatId" id="mainCatId"  required  class="select">
											<option value="">Select A Main Category</option>
											@forelse($mainCategoris as $mainCategory)
												@if($productById->mainCatId == $mainCategory->id)
													<option  value="{{ $mainCategory->id }}" selected>{{ $mainCategory->categoryName}}</option>
                                                    <?php $secCategories = App\Category::where('mainCatId', $mainCategory->id)->whereNull('secondCatId')->select('id', 'categoryName')->get(); ?>
												@else
													<option  value="{{ $mainCategory->id }}">{{ $mainCategory->categoryName}}</option>
												@endif
											@empty
											@endforelse
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Sub Category Name:</label>
										<select name="secondCatId" id="secondCatId" data-placeholder="Select Sub Category Name"  class="select">
											<option value="">Select A Seccond Category</option>
											@if(isset($secCategories) && !is_null($secCategories) || !empty($secCategory))
												@foreach($secCategories as $secCategory)
													@if( isset($productById->secondCatId) && $productById->secondCatId == $secCategory->id)
														<option  value="{{ $secCategory->id }}" selected>{{ $secCategory->categoryName}}</option>
                                                        <?php $thirdCategories = App\Category::where('mainCatId', $productById->mainCatId)->where('secondCatId',$secCategory->id)->whereNull('thirdCatId')->select('id', 'categoryName')->get(); ?>
													@else
														<option  value="{{ $secCategory->id }}">{{ $secCategory->categoryName}}</option>
													@endif
												@endforeach
											@endif
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Select 3rd Category:</label>
										<select data-placeholder="Select 3rd Category" id="thirdCatId" name="thirdCatId" class="select">
											@if(isset($thirdCategories) && !is_null($thirdCategories) || !empty($thirdCategories))
												@foreach($thirdCategories as $thirdCategory)
													@if( isset($productById->thirdCatId) && $productById->thirdCatId == $thirdCategory->id)
														<option  value="{{ $thirdCategory->id }}" selected>{{ $thirdCategory->categoryName}}</option>
													@else
														<option  value="{{ $thirdCategory->id }}">{{ $thirdCategory->categoryName}}</option>
													@endif
												@endforeach
											@endif
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="content-group">
										<label>Enter Product Name:<span class="text-danger">*</span></label>
										<input type="text" name="productName" value="{{ $productById->productName }}" required class="form-control maxlength-options" maxlength="70" placeholder="Enter Product Name">
										<span class="help-block">Product Name (Max 70 characters)</span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Product Weight: <span class="text-danger">*</span></label>
										<input type="number" value="{{ $productById->productWeight }}" name="productWeight" required class="form-control maxlength-options" step="0.01"  placeholder="Product Weight">
										<span class="help-block">Insert Product Weight (Kg)</span>
									</div>
								</div>
							</div>

							<div class="row">
								@if(is_null($productById->supplierId))

									<div class="col-md-3">
										<div class="form-group">
											<label>Sell Price: <span class="text-danger">*</span></label>
											<input type="number" value="{{ $productById->sellPrice }}" class="form-control" name="sellPrice"  placeholder="Product Selling Price">
											<span class="help-block">Product Selling Price</span>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Discount: </label>
											<input type="text" value="{{ $productById->discount }}" class="form-control" name="discount"  placeholder="Enter Discount in %">
											<span class="help-block discount">How Much Discount Percent You want to give</span>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Final Price: </label>
											<input type="number" value="{{ $productById->finalPrice }}" name="finalPrice" disabled class="form-control"   required placeholder="Final Price that Cunstomer Show">
											<span class="help-block">Final Price that Cunstomer Pays excl. Delivery Cost</span>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Artisan Price: <span class="text-danger">*</span></label>
											<input type="number" value="{{ $productById->costPrice }}" disabled name="costPrice" class="form-control"   required placeholder="Artisan Price">
											<span class="help-block">Price Artisan will Get</span>
										</div>
									</div>

								@else
									<div class="col-md-3">
										<div class="form-group">
											<label>Cost Price: <span class="text-danger">*</span></label>
											<input type="number" value="{{ $productById->costPrice }}" class="form-control" name="costPrice"  placeholder="Enter Product Cost Price ">
											<span class="help-block">If Supplier's Product then Cost Price else Artisan Price</span>
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label>Margin: </label>
											<input type="number" value="{{ $productById->margin }}" class="form-control" name="margin" placeholder="Enter profit percentage in %">
											<span class="help-block discount">How much do you want to Profit in percentage %</span>
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label>Sell Price : <span class="text-danger">*</span></label>
											<input type="number" value="{{ $productById->sellPrice }}" name="sellPrice" disabled class="form-control"   required placeholder="Enter Selling Price">
											<span class="help-block">Product Selling Price</span>
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label>Discount: </label>
											<input type="number" value="{{ $productById->discount }}" class="form-control" name="discount" placeholder="Enter Discount in %">
											<span class="help-block discount">How mouch You want to give discount in %</span>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>Final Price: </label>
											<input type="number" value="{{ $productById->finalPrice }}" class="form-control" disabled name="finalPrice"  placeholder="Product Final Price ">
											<span class="help-block">Final Price of Product that User Show</span>
										</div>
									</div>
								@endif
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Short Description: <span class="text-danger">*</span></label>
										<textarea name="shortDes" cols="3" rows="3" class="wysihtml5 wysihtml5-default form-control"  placeholder="Short Description (Max 150 characters)">{{ $productById->shortDes }}</textarea>
										<span class="help-block">Short Description (Max 150 characters) </span>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label>Product Description: <span class="text-danger">*</span></label>
										<textarea name="details" id="editor-full" rows="4" cols="4" minlength="20" maxlength="2500" placeholder="Product Details (Max 2500 characters)">{{ $productById->details }}</textarea>
										<span class="help-block">Product Details (Max 2500 characters)</span>
									</div>
								</div>


							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Material Name: <span class="text-danger">*</span></label>
										<select multiple data-placeholder="Select Product Materials Name"  name="materialsIds[]" required class="select">
											<option value="">Select Product Materials </option>
                                            <?php $materialArray = array(); if(!is_null($productById->materialsIds)){ $materialArray=explode(',', $productById->materialsIds); } ?>
											@foreach($materials as $material)
												@if(in_array($material->id,$materialArray ))
													<option  value="{{ $material->id }}" selected >{{ $material->materialName }} </option>
												@else
													<option  value="{{ $material->id }}">{{ $material->materialName }} </option>
												@endif

											@endforeach
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<!-- Size  -->
									<label class="size-title">Image View Style <span class="pull-right text-danger text-bold">*</span> </label>
									<div class="form-group">
										<div class="col-lg-4" >
											<div class="checkbox">
												<label>
													<input type="radio" name="viewStyle"  value="1" {{ ($productById->viewStyle == 1)?'checked': ' '  }} class="styled"> Square</label>
											</div>
										</div>
										<div class="col-lg-4" >
											<div class="checkbox">
												<label>
													<input type="radio" name="viewStyle"  {{ ($productById->viewStyle == 2)?'checked': ' '  }}  value="2" class="styled"> Portrait</label>
											</div>
										</div>
										<div class="col-lg-4" >
											<div class="checkbox">
												<label>
													<input type="radio" name="viewStyle" {{ ($productById->viewStyle == 3)?'checked': ' '  }}  value="3" class="styled"> Landscape</label>
											</div>
										</div>
										<span class="help-block">Select Your Product Images View Style</span>
									</div>
								</div>
								<div class="col-md-6">

									<div class="thumbnail ">
										<div class="thumb">
                                            <?php $thumbImage = $productById->thumbImage; if(!file_exists($thumbImage)){ $thumbImage = 'public/artisan/assets/images/placeholder.jpg'; } ?>
											<img src="{{ asset($thumbImage)}}"  alt="{{ $thumbImage }}">

										</div>
									</div>

								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Thumb Image: <span class="text-danger">*</span></label>
										<input type="file" name="thumbImage" accept="image/*"  maxlength="1" class="file-input" data-browse-class="btn btn-primary btn-block" data-show-remove="false" data-show-caption="false" data-show-upload="false">
										<span class="help-block">Upload Thumb Image In Square Shape</span>
									</div>
								</div>

								<div class="col-md-12">

									@foreach($productImages as $productImage)

										<div class="col-md-4">
											<div class="thumbnail ">
												<div class="thumb">
                                                    <?php
                                                    $image = $productImage->image;
                                                    if(!file_exists($image)){
                                                        $image = 'public/artisan/assets/images/placeholder.jpg';
                                                    }
                                                    ?>
													<img src="{{ asset($image)}}"  alt="">
													<div class="caption-overflow">
													<span>
														<a href="{{route('product.image.delete',$productImage->id)}}"  class="btn btn-flat btn-danger text-white btn-sm image-delete" onclick="return confirm('Are You Sure You Want to Delete This Image'); ">Delete</a>
													</span>
													</div>
												</div>
											</div>
										</div>

									@endforeach
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label>Product Images: <span class="text-danger">*</span></label>
										<input type="file" name="image[]" accept="image/*"  maxlength="4" multiple class="file-input" data-browse-class="btn btn-primary btn-block" data-show-remove="false" data-show-caption="false" data-show-upload="false">
										<span class="help-block">Upload Product Images (Max 4 Images)</span>
									</div>
								</div>
							</div>

						</div>
					</div>
					<!-- /form validation -->
				</div>


				<div class="col-md-3 col-lg-3 col-sm-12 ">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Modify Your Product</h5>
							<div class="heading-elements">
								<ul class="icons-list">
									<li><a data-action="collapse"></a></li>
									<li><a data-action="reload"></a></li>
									{{-- <li><a data-action="close"></a></li> --}}
								</ul>
							</div>

						</div><hr/>


						<div class="panel-body">
							@if(!is_null($productById->supplierId))
								<div class="row">
									<div class="col-md-12">
										<!-- Size  -->
										<label class="size-title">Product Source<span class="pull-right text-danger text-bold">*</span> </label>
										<div class="form-group">
											<div class="col-lg-6" >
												<div class="checkbox">
													<label><input type="radio" name="owner" {{ ($productById->ownerId != 0)?'checked': ' '  }}  value="1"  class="styled"> Shop </label>
												</div>
											</div>
											<div class="col-lg-6" >
												<div class="checkbox">
													<label><input type="radio" name="owner"  value="0" {{ ($productById->ownerId == 0)?'checked': ' '  }} class="styled"> Supplier</label>
												</div>
											</div>

										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label>Source Name: <span class="text-danger">*</span></label>
											@if($productById->supplierId == 0)
                                                <?php  $productSources = App\Shop::where('status', 1)->select('id', 'shopName')->latest()->get(); ?>
												<select data-placeholder="Selete Product Source Name"  name="supplierId" required class="select">
													@foreach($productSources as $sources)
														@if($productById->ownerId == $sources->id)
															<option value="{{ $sources->id }}" selected> {{ $sources->shopName }}</option>
														@else
															<option value="{{ $sources->id }}" > {{ $sources->shopName }}</option>
														@endif
													@endforeach
												</select>

											@else
                                                <?php $productSources = App\DorponSupplyer::where('status', 1)->select('id', 'supplier')->latest()->get();?>

												<select data-placeholder="Selete Product Source Name"  name="supplierId" required class="select">
													@foreach($productSources as $sources)
														@if($productById->supplierId  == $sources->id)
															<option value="{{ $sources->id }}" selected> {{ $sources->supplier }}</option>
														@else
															<option value="{{ $sources->id }}" > {{ $sources->supplier }}</option>
														@endif
													@endforeach
												</select>
											@endif
										</div>
									</div>
								</div>
							@endif

							<div class="row">
								<div class="col-md-12">
									<!-- Size  -->
									<div class="form-group">
										<label class="size-title">Sizes:<span class="pull-right text-danger text-bold">*</span> </label>
										<div class="col-lg-12" id="productSize">

											@foreach($catSizes as $catSize)
												<div class="checkbox">
													<label>
														@if($productQty->count() >1 && in_array($catSize->id, $productQty->pluck('sizeId')->toArray()))
															<input  type="checkbox" name="size[]"  value="{{ $catSize->id }}" checked class="styled size">{{ ucfirst($catSize->sizeTitle) }}
                                                            <?php  $qty = $productQty->where('sizeId', $catSize->id); ?>
															<input type="number" value="{{  $qty->pluck('quantity')[0] }}" name="qty[]"  id="qty{{ $catSize->id }}" class="form-control">
														@elseif(array_first($productQty->pluck('sizeId')) == $catSize->id)
															<input  type="checkbox" name="size[]"  value="{{ $catSize->id }}" checked class="styled size">{{ ucfirst($catSize->sizeTitle) }}
															<input type="number" value="{{ array_first($productQty->pluck('quantity')) }}" name="qty[]"  id="qty{{ $catSize->id }}" class="form-control">
														@else
															<input  type="checkbox" name="size[]"  value="{{ $catSize->id }}" class="styled size">{{ ucfirst($catSize->sizeTitle) }}
															<input type="number" value="1" name="qty[]"  id="qty{{ $catSize->id }}"  class="form-control">
														@endif
													</label>
												</div>
											@endforeach
										</div>
									</div>
									<span class="help-block size-alert"></span>

								</div>
								<!-- /Size -->

								<!-- Tags -->
								<div class="col-md-12">
									<div class="form-group" >
										<br/><label>Tags:</label>
										<a title="Create New Tag" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#insert_tag_modal"><i class="icon-plus-circle2"></i></a>
										<select multiple data-placeholder="Select Product Tags" id="tagsId" name="tagsId[]" class="select">
											@if(!is_null($productById->tagsId))
                                                <?php $productTag = explode(',', $productById->tagsId);?>
												@forelse($tags as $tag)
													@if(in_array($tag->id, $productTag))
														<option value="{{ $tag->id }}" selected >{{ $tag->tagTitle }}</option>
													@else
														<option value="{{ $tag->id }}">{{ $tag->tagTitle }}</option>
													@endif
												@empty

												@endforelse
											@else
												@forelse($tags as $tag)
													<option value="{{ $tag->id }}">{{ $tag->tagTitle }}</option>
												@empty

												@endforelse
											@endif
										</select>
									</div>
								</div>
								<!-- /Tags -->
							</div>
							<div class="row">

								<div class="col-md-12">
									<div class="form-group">
										<br/><label>Primary Colors: <span class="pull-right text-danger text-bold">*</span></label>
										<button title="Create Primary Color"  data-toggle="modal" data-target="#insert_color_modal" class="btn btn-sm btn-success btn-round pull-right"><i class="icon-plus-circle2"></i></button>
										<select multiple data-placeholder="Select Product Primary Colors" id="priColorId" name="priColorId[]" required class="select">
                                            <?php $productPriColor = explode(',', $productById->priColorId); ?>
											@forelse($primaryColors as $color)
												@if(in_array($color->id, $productPriColor))
													<option  value="{{ $color->id }}" selected>{{ $color->colorName }} </option>
												@else
													<option  value="{{ $color->id }}">{{ $color->colorName }} </option>
												@endif
											@empty

											@endforelse
										</select>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<br/><label>Secondary Colors:</label>
										<button type="button" title="Create Seconday Color" class="btn btn-sm btn-success btn-round pull-right" data-toggle="modal" data-target="#insert_secColor_modal"><i class="icon-plus-circle2"></i></button>
										<select multiple data-placeholder="Select Product Secondary Colors" id="secColorId" name="secColorId[]" class="select">
											@if(!is_null($productById->secColorId))
                                                <?php $productSecColor = explode(',', $productById->secColorId);?>
												@forelse($secondaryColors as $color)
													@if(in_array($color->id, $productSecColor))
														<option value="{{ $color->id }}" selected >{{ $color->colorName }}</option>
													@else
														<option value="{{ $color->id }}">{{ $color->colorName }}</option>
													@endif
												@empty

												@endforelse
											@else
												@forelse($secondaryColors as $color)
													<option value="{{ $color->id }}">{{ $color->colorName }}</option>
												@empty

												@endforelse
											@endif

										</select>
									</div>
								</div>
							</div>
							<div class="row">
								@if($productById->productVideo)
									<div class="col-sm-12">
										<div class="thumbnail">
											<div class="thumb">
												<div class="content-group-lg">
													<div class="embed-responsive embed-responsive-16by9">
														<iframe class="embed-responsive-item no-margin-bottom" src="{{ $productById->productVideo }}" frameborder="0" allowfullscreen></iframe>
													</div>
												</div>
											</div>
										</div>
									</div>
								@endif



								<div class="col-md-12">
									<div class="form-group">
										<label>Product Video: </label>
										<input type="url" value="{{ $productById->productVideo }}" name="productVideo"  class="form-control maxlength-options"  placeholder="https://www.youtube.com/watch?v=duhmbv1VCAo">
										<span class="help-block">Enter Youtube Video Link Only</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6" >
									<div class="checkbox">
										<label>
											<input type="checkbox" name="feature" {{ ($productById->feature == 1)?'checked': ' '  }}  value="1" class="styled">Featured Product</label>
									</div>
								</div>
								<div class="col-lg-6" >
									<div class="checkbox">
										<label>
											<input type="checkbox" name="customeStatus" {{ ($productById->customeStatus == 1)?'checked': ' '  }}  value="1" class="styled customeStatus">Customized Product</label>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Customized Product Note: </label>
										<textarea rows="3" cols="3" name="customeMessage"  disabled maxlength="150" class="form-control maxlength-textarea" placeholder="Write Customized Product Note (Max 150 characters)">{{ $productById->customeMessage }}</textarea>
										<span class="help-block">Write Customized Product Note (Max 150 characters)</span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6 col-md-12 col-lg-12">
									<div class="form-group">
										<br/><label>Gift Type:</label>
										<select multiple data-placeholder="Select Gift Type" name="giftTypeId[]" class="select">
											@if(!is_null($productById->giftTypeId))
                                                <?php $productGift = explode(',', $productById->giftTypeId);?>
												@forelse($giftTypes as $gift)
													@if(in_array($gift->id, $productGift))
														<option  value="{{ $gift->id }}" selected>{{ $gift->giftTitle }} </option>
													@else
														<option  value="{{ $gift->id }}">{{ $gift->giftTitle }} </option>
													@endif
												@empty

												@endforelse
											@else
												@forelse($giftTypes as $gift)
													<option  value="{{ $gift->id }}">{{ $gift->giftTitle }} </option>
												@empty

												@endforelse
											@endif

										</select>
										<span class="help-block">If you Want to Make it as Gift then select Gift Name </span>
									</div>
								</div>

								<div class="col-sm-6 col-md-12 col-lg-12">
									<div class="form-group">
										<br/><label>Publication:</label>
										<select  data-placeholder="Select Product Status" name="status" required class="select">
											<option value="1">Published</option>
											<option value="0">Un-Published</option>

										</select>
									</div>
								</div>

								<div class="col-sm-6 col-md-12 col-lg-12">
									<div class="text-right">
										<button type="button"  class="btn btn-primary btn-block data-check" data-toggle="modal" data-target="#confirm_modal">Submit form<i class="icon-arrow-right14 position-right"></i></button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Product Submit Confirm Item Model -->
					<div id="confirm_modal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header bg-success-800">
									<button type="button" class="close" >&times;</button>
									<h5 class="modal-title">Product Insert From</h5>
								</div>

								<div class="modal-body">
									<div class="alert alert-info" role="alert">
										Are You Sure You Want to Upload This Product.
									</div>
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-link " id="cancle" >Close</button>
									<button type="submit" class="btn btn-success">Store</button>
								</div>

							</div>
						</div>
					</div>
					<!-- /Product Submit Confirm Item Model -->
				</div>
			</div>
		</form>
	</div>


	@include('admin.model.productModel')
	<script>
        var shopId = 0;
        var ownerFound = '/edit';

        {{--$('.image-delete').on('click', function(e){--}}

            {{--var imageId = $(this).attr('id');--}}
            {{--var link = '{{ url("image/delete/+imageId+")}}';--}}

            {{--$("#image_delete_modal").find('#imageDelete').attr("href", link);--}}

        {{--});--}}
	</script>
	<script type="text/javascript" src="{{ asset('public/artisan/ajex/productOverview.js') }}"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


@endsection



