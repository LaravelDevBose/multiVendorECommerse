@extends('admin.master')

@section('title')
Products|Dorpon
@endsection

@section('asset')
<style> .displayNone{display: none;}</style>

<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/media/fancybox.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/selects/select2.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/ecommerce_product_list.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/ecommerce_orders_history.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/user_pages_profile.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/ripple.min.js') }}"></script>
	<script src="{{asset('public/frontEnd/js/jquery.simplePagination.js')}}"></script>

<!-- /theme JS files -->
@endsection

@section('content')

<!-- Toolbar -->
<div class="navbar navbar-default navbar-xs content-group">
	<ul class="nav navbar-nav visible-xs-block">
		<li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
	</ul>

	<div class="navbar-collapse collapse" id="navbar-filter">
		<ul class="nav navbar-nav">
			<li class="active"><a href="#list" data-toggle="tab"><i class="icon-menu7 position-left"></i>List view</a></li>
			<!-- <li><a href="#grid" data-toggle="tab"><i class="icon-address-book3 position-left"></i>Grid View</a></li> -->
			<li><a href="#table" data-toggle="tab"><i class="icon-table2 position-left"></i>Table View</a></li>
			<li></li>
		</ul>
		<a href="{{ route('product.insert') }}" class="btn btn-success pull-right"><i class="icon-add-to-list position-left"></i>Insert Product</a>
		
	</div>
</div>
<!-- /toolbar -->
<!-- Content area -->
<div class="content">
		<!-- Detached content -->
	<div class="container-detached">
		<div class="content-detached" >
			<div class="tabbable">
				<div class="tab-content" id="ajaxData">
					<div class="tab-pane fade in active" id="list">
					<!-- List -->
						<ul class="media-list">
						@forelse($products as $product)
							<li class="media panel panel-body stack-media-on-mobile">
                                <?php $productImage =$product->thumbImage;  if(!file_exists($productImage)){ $productImage='public/artisan/assets/images/placeholder.jpg'; }?>
								<a href="{{ asset($productImage) }}" class="media-left" data-popup="lightbox">
									<img src="{{ asset($productImage) }}" width="110"  alt="{{ $product->productName }}">
								</a>

								<div class="media-body">
									<h6 class="media-heading text-semibold">
										<a href="{{ route('singel.product', $product->id) }}">{{ $product->productName }}</a>
									</h6>

									<ul class="list-inline list-inline-separate mb-10">
										<?php 
											$mainCat = App\Category::where('id', $product->mainCatId)->value('categoryName');
											$secCat = App\Category::where('id', $product->secondCatId)->value('categoryName');
											$thirdCat = App\Category::where('id', $product->thirdCatId)->value('categoryName');
											
										?>
										<li><a href="#" class="text-muted">{{ ucfirst($mainCat) }}</a></li>
										@if($secCat)
										<li><a href="#" class="text-muted">{{ ucfirst($secCat) }}</a></li>
										@endif

										@if($thirdCat)
										<li><a href="#" class="text-muted">{{ ucfirst($thirdCat) }}</a></li>
										@endif
									</ul>

									<p class="content-group-sm">{!! $product->shortDes !!}</p>
									<p class="content-group-sm">
										<ul class="list-inline">
											<li style="padding-right: 5px;">Primary Color:</li>
											<?php $priColors = explode(',', $product->priColorId); ?>
											@forelse($priColors as $primaryColor)
												<?php $color = App\PrimaryColor::where('id',$primaryColor)->select('colorName', 'colorCode')->first();?>
												<li style="padding-right: 5px;"><span class="label" style="background-color: {{$color->colorCode}}" >{{ ucfirst($color->colorName) }}</span></li>
											@empty
												<li style="padding-right: 5px;"><span class="label ">No Color Inserted</span></li>
											@endforelse
										</ul>
									</p>
									<p class="content-group-sm">
										<ul class="list-inline">
											<li style="padding-right: 5px;">Secondary Color:</li>
										@if($product->secColorId)
											<?php $secColors = explode(',', $product->secColorId); ?>
											@forelse($secColors as $secondaryColor)
												<?php $color = App\SecondaryColor::where('id',$secondaryColor)->select('colorName', 'colorCode')->first();?>
												<li style="padding-right: 5px;"><span class="label" style="background-color: {{$color->colorCode}}" >{{ ucfirst($color->colorName) }}</span></li>
											@empty
												<li style="padding-right: 5px;"><span class="label ">No Color Inserted</span></li>
											@endforelse
										@endif
										</ul>
									</p>

									
								</div>

								<div class="media-right text-center">
									<h4 class="no-margin text-semibold">Tk. {{ number_format( $product->finalPrice, 2)}}</h4>
									<h6 class="no-margin text-semibold">Tk. {{ number_format( $product->costPrice, 2)}}</h6>
									@if($product->discount)
										<label class="no-margin text-warning-300 text-semibold"> {{ $product->discount}}</label>
									@endif
									
									@if($product->status == 1)
										<a title="Unpublish Product" href="{{ route('status.change',['id'=>$product->id, 'status'=>$product->status]) }}" class="btn bg-success-400 mt-15"><i class="icon-checkmark position-left"></i>Publish</a>
									@else
										<a title="Publish Product" href="{{ route('status.change',['id'=>$product->id, 'status'=>$product->status]) }}" class="btn bg-danger-400 mt-15"><i class="icon-blocked position-left"></i>UnPublish</a>
									@endif
								</div>
								<div class="media-footer">
									<div class="content-group-sm media-left">
										<ul class="list-inline ">
											<li style="padding-right: 5px;"><a href="{{ route('singel.product',$product->id) }}" title="Full View" class="btn bg-primary-800 mt-5 btn-xs"><i class="icon-book"></i></a></li>
											<li style="padding-right: 5px;" ><a href="{{ route('product.edit',$product->id) }}" title="Edit Product" class="btn bg-info-400 mt-5 btn-xs"><i class=" icon-pencil7"></i></a></li>
											<li style="padding-right: 5px;"><a href="{{ route('product.delete',$product->id) }}" title="Delete Product" class="btn bg-danger-400 mt-5 btn-xs"><i class="icon-cancel-square2"></i></a></li>
										</ul>
										
									</div>
									<div class="media-right">
										<ul class="list-inline list-inline-separate">

											<li><span class="text-semibold">Owner Name: </span>
												@if($product->ownerId != 0)
												<?php $shopName = App\Shop::where('id', $product->ownerId)->value('shopName');?>
												<a href="{{ route('shop.singel.view', $product->ownerId) }}"> {{ ucfirst($shopName) }}</a>
												@else

												<span> Admin</span>
												@endif
											</li>
											@if($product->supplierId != 0)
											<li>
												<span class="text-semibold">Owner Name: </span>
                                                <?php $supplierName = App\DorponSupplyer::where('id', $product->supplierId)->value('supplier');?>
												<label> {{ ucfirst($supplierName) }}</label>
											</li>
											@endif
											<li>
												<ul class="list-inline list-inline-separate mb-10">
													<li>Tag List: </li>
													<?php $tagIds = explode(',', $product->tagsId); ?>
												@forelse($tagIds as $tagId)
													<?php $tag = App\ProductTag::where('id',$tagId)->value('tagTitle');?>
													<li style="padding-right: 15px;"><a href=""> {{ ucfirst($tag) }}</a></li>
												@empty

													<li style="padding-right: 15px;">No Tag Inserted</li>
												@endforelse
												</ul>
											</li>
										</ul>
									</div>
								</div>
							</li>
						@empty

						@endforelse
						</ul>
						<!-- /list -->
					<!-- Pagination -->
						{{ $products->links() }}
					<!-- /pagination -->

					</div>

					<div class="tab-pane fade" id="table">
						<div class="panel panel-white">
							

							<table class="table table-responsive  text-nowrap">
								<thead>
									<tr>
										<th class="col-md-3">Product name</th>
										<th>Categorys</th>
										<th>Owner Info</th>
										<th>Sell Price (TK.)</th>
										<th>Shop Price (TK.)</th>
										<th>Status</th>
										<th class="text-center"><i class="icon-arrow-down12"></i></th>
									</tr>
								</thead>
								<tbody>
									@forelse($products as $product)
									<tr>
										
										<td>
											<div class="media">
                                                <?php $productImage = $product->thumbImage;  if(!file_exists($productImage)){ $productImage='public/artisan/assets/images/placeholder.jpg'; }?>

												<a href="{{ asset($productImage) }}" class="media-left" data-popup="lightbox">
													<img src="{{ asset($productImage) }}" height="60" class=""  alt="{{ $product->productName }}">
												</a>

												<div class="media-body media-middle">
													<a href="{{ route('singel.product', $product->id) }}" class="text-bold">{{ $product->productName }}</a>
													<div class="text-muted text-size-small">
														<span class="status-mark bg-grey position-left"></span>
														{{ $product->productCode }}
													</div>
												</div>
											</div>
										</td>
										<td>
											<?php 
												$mainCat = App\Category::where('id', $product->mainCatId)->value('categoryName');
												$secCat = App\Category::where('id', $product->secondCatId)->value('categoryName');
												$thirdCat = App\Category::where('id', $product->thirdCatId)->value('categoryName');

												$catLst = $mainCat; 
												if($secCat){$catLst =$catLst. '<i class="icon-arrow-right13"></i>'.'</br>' .$secCat ;}
												if($thirdCat){$catLst = $catLst.'<i class="icon-arrow-right13"></i>'.'</br>' .$thirdCat ;}
												echo $catLst;
											?>
										</td>
										<td>
											<?php $ownerName = "Admin"; if($product->ownerId !=0 ){$ownerName = App\Shop::where('id', $product->ownerId)->value('shopName');} echo ucfirst($ownerName);?>
										</td>
										<td>
											<h6 class="no-margin text-semibold">&#2547; {{ number_format($product->finalPrice , 2)}}</h6>
										</td>
										<td>

											<h6 class="no-margin text-semibold">&#2547; {{ number_format($product->costPrice , 2)}}</h6>
										</td>
										<td>
											@if($product->status == 1)
												<button title="Make UnPublish Product"  class="btn btn-success btn-sm" data-toggle="modal" data-target="#delete_shop"><i class="icon-checkmark "></i></button>
											@else
												<button title="Make Pubish Product"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_shop"><i class="icon-blocked"></i> </button>
											@endif
										</td>
										<td class="text-center">
											<ul class="icons-list">
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
													<ul class="dropdown-menu dropdown-menu-right">
														<li><a href="{{ route('singel.product', $product->id)}}"><i class="icon-book"></i> View Produt Details</a></li>
														@if($product->ownerId != 0)
														<li><a href="{{ route('shop.singel.view', $product->ownerId) }}"><i class="icon-store"></i>View Product</a></li>
														@endif
														<li class="divider"></li>
														<li><a href="{{ route('product.delete', $product->id) }}"><i class="icon-trash"></i> Delete Product</a></li>
													</ul>
												</li>
											</ul>
										</td>
									</tr>
									@empty
									<tr>
										<td colspan="6"><span>No Product Inserted</span></td>
									</tr>
									@endforelse
								</tbody>
							</table>
							
						</div>
						{{ $products->links() }}
					</div>
				</div>
			</div>	
		</div>
		<!-- /detached content -->
	</div>

	<!-- Detached sidebar -->
	<div class="sidebar-detached">
		<div class="sidebar sidebar-default sidebar-separate">
			<div class="sidebar-content">

				<!-- Categories -->
				<div class="sidebar-category">
					<div class="category-title">
						<span>Categories</span>
						<ul class="icons-list">
							<li><a href="#" data-action="collapse"></a></li>
						</ul>
					</div>

					<div class="category-content">
						<div class="has-feedback has-feedback-left form-group">
							<input type="search" class="form-control" placeholder="Search...">
							<div class="form-control-feedback">
								<i class="icon-search4 text-size-small text-muted"></i>
							</div>
						</div>
					</div>

					<div class="category-content no-padding">
						<ul class="navigation navigation-alt navigation-accordion navigation-sm no-padding-top">
							@forelse($mainCategoris as $mainCategory)
							<?php $secCategories = App\Category::where('mainCatId', $mainCategory->id)->where('secondCatId', null)->where('publicationStatus', 1)->orderBy('position', 'asc')->select("id","categoryName")->get(); ?>
								
								@if(count($secCategories) == 0)
									<li ><a name="category" id="{{ $mainCategory->id }}" class="category">{{ ucfirst($mainCategory->categoryName) }}</a></li>
								@else
									<li ><a  name="category" id="{{ $mainCategory->id }}" class="category">{{ ucfirst($mainCategory->categoryName) }}</a>
										<ul>
											@foreach($secCategories as $secCategory)
												<?php $thirdCategories = App\Category::where('mainCatId', $mainCategory->id)->where('secondCatId', $secCategory->id)->where('thirdCatId', null)->where('publicationStatus', 1)->orderBy('position', 'asc')->select("id","categoryName")->get(); ?>
												
												@if(count($thirdCategories) == 0)
													<li><a id="{{ $secCategory->id }}" name="secCategory">{{ ucfirst($secCategory->categoryName) }}</a></li>
												@else
													<li><a id="{{ $secCategory->id }}" name="secCategory">{{ ucfirst($secCategory->categoryName) }}</a>
														<ul>
															@foreach($thirdCategories as $thirdCategory)
																<li><a id="{{ $thirdCategory->id }}" name="thirdCategory">{{ ucfirst($thirdCategory->categoryName) }}</a></li>
															@endforeach
														</ul>
													</li>
												@endif
											@endforeach
										</ul>
									</li>
									
								@endif
							
							@empty

							@endforelse							
						</ul>
					</div>
				</div>
				<!-- /categories -->


				<!-- Filter -->
				<!-- <div class="sidebar-category">
					<div class="category-title">
						<span>Filter products</span>
						<ul class="icons-list">
							<li><a href="#" data-action="collapse"></a></li>
						</ul>
					</div>

					<div class="category-content">
						<form action="#">
							<div class="form-group">
								<legend class="text-size-mini text-muted no-border no-padding">Fit</legend>

								<div class="checkbox">
									<label class="display-block">
										<input type="checkbox" class="styled size" value="1">
										S
									</label>
								</div>

								<div class="checkbox">
									<label class="display-block">
										<input type="checkbox" class="styled size"  value="2">
										M
									</label>
								</div>

								<div class="checkbox">
									<label class="display-block">
										<input type="checkbox" class="styled size"  value="3">
										L
									</label>
								</div>

								<div class="checkbox">
									<label class="display-block">
										<input type="checkbox" class="styled size"  value="4">
										XL
									</label>
								</div>

								<div class="checkbox">
									<label class="display-block">
										<input type="checkbox"  class="styled size"  value="5">
										XXL
									</label>
								</div>
							</div>

							<div class="form-group">
								<legend class="text-size-mini text-muted no-border no-padding">Primary Color</legend>

								<div class="row row-colors">
									@forelse($primaryColors as $primaryColor)

									<div class="col-xs-4">
										<input type="checkbox" name="priCheck" class="displayNone " id="{{ $primaryColor->colorName }}" value="{{ $primaryColor->id }}">
										<a class="priColor" style="background-color: {{ $primaryColor->colorCode }}"  for="{{ $primaryColor->colorName }}"></a>
										<span>{{ $primaryColor->colorName }}</span>
									</div>
									@empty
									<span class="text-bold text-primary-600">No Primary Color Inserted</span>
									@endforelse
								</div>
							</div>

							<button type="submit" class="btn bg-blue btn-block">Filter</button>
						</form>
					</div>
				</div> -->
				<!-- /filter -->

			</div>
		</div>
	</div>
    <!-- /detached sidebar -->

</div>
<!-- /content area -->
<script type="text/javascript" src="{{ asset('public/artisan/ajex/adminProductSorting.js') }}"></script>
<script src="{{asset('public/frontEnd/js/star-rating.js')}}"></script>
<script type="text/javascript">

    $("#input-id").rating();

</script>
@endsection