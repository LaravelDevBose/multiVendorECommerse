@extends('admin.master')

@section('title')
Shop Profile
@endsection

@section('asset')
	{!! Charts::assets() !!}
<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/tables/datatables/extensions/buttons.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/moment/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/visualization/echarts/echarts.js') }}"></script>

	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/uploader_bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/datatables_extension_colvis.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/user_pages_profile.js') }}"></script>

	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/ripple.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/components_modals.js') }}"></script>
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
<!-- /theme JS files -->
@endsection

@section('content')

<!-- Cover area -->
<div class="profile-cover">
	<?php
        $coverImage = $ShopDetails->bannerImage;
        if(!file_exists($coverImage)){
          $coverImage = 'public/images/default/shop_cover_image.jpg'; 
        }
    ?>
	<div class="profile-cover-img" style="background-image: url( {{ asset($coverImage) }} )"></div>
	<div class="media">
		<div class="media-left">
			<a href="#" class="profile-thumb">
				<?php
					$shopLogo = 'public/artisan/assets/images/placeholder.jpg'; 

					if(!is_null($shopInfo->shopLogo) && file_exists($shopInfo->shopLogo)){
						$shopLogo = $shopInfo->shopLogo;
					}
			    ?>
				<img src="{{ asset( $shopLogo ) }}" class="img-circle img-xxl" alt="shopLogo">
			</a>
		</div>

		<div class="media-body">
			<?php 
         		$date = new DateTime($shopInfo->created_at);
         		$joiningDate = date_format($date, 'd F Y');
          	?>
    		<h1 class="text-uppercase">{{ $shopInfo->shopName }} 
    			<small class="display-block">Estiblish: {{ $joiningDate }}</small>
    			<small class="display-block">Shop Code: {{ $shopInfo->shopViewId }}</small>
    		</h1>
		</div>

	
	</div>
</div>
<!-- /cover area -->


<!-- Toolbar -->
<div class="navbar navbar-default navbar-xs content-group">
	<ul class="nav navbar-nav visible-xs-block">
		<li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
	</ul>

	<div class="navbar-collapse collapse" id="navbar-filter">
		<ul class="nav navbar-nav">
			<li class="active"><a href="#analytic" data-toggle="tab"><i class="icon-stats-growth position-left"></i>Analytic Report</a></li>
			<li><a href="#details" data-toggle="tab"><i class="icon-library2 position-left"></i>Shop Info</a></li>
			<li><a href="#products" data-toggle="tab"><i class="icon-cart2 position-left"></i> Products </a></li>
			<li><a href="#modarator" data-toggle="tab"><i class=" icon-reading position-left"></i>Moderators</a></li>
			<li><a href="#setting" data-toggle="tab"><i class="icon-cog7 position-left"></i>Settings</a></li>
		</ul>

		<div class="navbar-right">
		    <ul class="nav navbar-nav">
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle text-info text-bold" data-toggle="dropdown">{{ ($shopInfo->status == 1) ? 'Active Shop' : ' Blocked Shop' }} <span class="caret"></span></a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a class="btn btn-success " data-toggle="modal" data-target="#shop_block_modal"><i class="icon-eye position-left"></i> Active Shop</a></li>
						<li><a  class="btn btn-warning btn-sm" data-toggle="modal" data-target="#shop_block_modal"><i class="icon-eye-blocked position-left"></i> Block Shop</a></li>
						<li><a  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#shop_delete_modal"><i class="icon-bin position-left"></i> Delete Shop</a></li>
						
					</ul>
				</li>
			</ul>
		    
		</div>
	</div>
</div>
<!-- /toolbar -->


<!-- Content area -->
<div class="content">
	@include('admin.includes.message')
	<!-- User profile -->
	<div class="row">
		<div class="col-lg-12">
			<div class="tabbable">
				<div class="tab-content">

				<!-- Shop Policy -->
					<div class="tab-pane fade in active" id="analytic">
						<div class="timeline timeline-left content-group">
							<div class="timeline-container">
								<!-- simple statistics -->
								<div class="timeline-row">
									<div class="timeline-icon">
										<div class="bg-warning-400">
											<i class="icon-archive"></i>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6 col-md-4">
											<div class="panel panel-body bg-blue-400 has-bg-image">
												<div class="media-body">
													<h6 class="no-margin">T.Products: {{ App\Product::where('ownerId' , $shopInfo->id)->count() }}</h6>
													<h6 class="no-margin text-success">Published: {{ App\Product::where('ownerId' , $shopInfo->id)->where('status', 1)->count() }}</h6>
													<h6 class="no-margin text-warning">Unpublished: {{ App\Product::where('ownerId' , $shopInfo->id)->where('status', 0)->count() }}</h6>
													
												</div>

												<div class="media-right media-middle">
													<i class="icon-bag  icon-3x opacity-75"></i>
												</div>
											</div>
										</div>

										<div class="col-sm-6 col-md-4">
											<div class="panel panel-body bg-indigo-400 has-bg-image">
												<div class="media no-margin">
													<div class="media-body">
														<h6 class="no-margin">Item: {{ number_format(App\OrderDetail::where('ownerId' , $shopInfo->id)->sum('productQuantity')) }}</h6>
														<h6 class="no-margin">Amount: Tk {{ number_format(App\OrderDetail::where('ownerId' , $shopInfo->id)->sum('subTotal')) }}</h6>
														<h6 class="text-uppercase no-margin">total orders</h6>
													</div>

													<div class="media-right media-middle">
														<i class="icon-cart-add icon-3x opacity-75"></i>
													</div>
												</div>
											</div>
										</div>

										<div class="col-sm-6 col-md-4">
											<div class="panel panel-body bg-success-400 has-bg-image">
												<div class="media no-margin">
													<div class="media-body">
														<h6 class="no-margin">Rating: 5.00</h6>
														<h6 class="no-margin">FAQ: 100</h6>
														<!-- <h6 class="no-margin">Rating: 5.00</h6> -->
														<h6 class="text-uppercase no-margin">About Shop</h6>
													</div>
													<div class="media-right media-middle">
														<i class="icon-store icon-3x opacity-75"></i>
													</div>
												</div>
											</div>
										</div>

										
									</div>
									
								</div>
								<!-- /simple statistics -->

								<!-- Weekly Sell -->
								<div class="timeline-row">
									<div class="timeline-icon">
										<div class="bg-indigo-400">
											<i class="icon-stats-dots"></i>
										</div>
										{{-- <img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" alt=""> --}}
									</div>
									<div class="panel panel-flat timeline-content">
										<div class="panel-heading">
											<h6 class="panel-title">This Week and Last Week Sell</h6>
											<div class="heading-elements">
												
											</div>
										</div>

										<div class="panel-body">
											{!! $weeklyReport->render() !!}
										</div>
										
									</div>
									
								</div>
								<!-- /Weekly Sell -->

								<!-- Monthly Sell Report -->
								<div class="timeline-row">
									<div class="timeline-icon">
										<div class="bg-success-400">
											<i class="icon-stats-bars2"></i>
										</div>
										{{-- <img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" alt=""> --}}
									</div>
									<div class="panel panel-flat timeline-content">
										<div class="panel-heading">
											<h6 class="panel-title">Monthly Sell Report</h6>
											<div class="heading-elements">
												
						                	</div>
										</div>

										<div class="panel-body">
											{!! $monthlyReport->render() !!}
										</div>
									</div>
									
								</div>
								<!-- /Monthly Sell Report -->

								

							</div>
					    </div>

					</div>
				<!-- /Shop Policy -->


				<!-- Shop Details -->
					<div class="tab-pane fade" id="details">

						<!-- Profile info -->
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">Shop Information</h6>
								<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<li><a data-action="reload"></a></li>
				                		<li><a data-action="close"></a></li>
				                	</ul>
			                	</div>
							</div>

							<div class="panel-body">
								<div class="table-responsive ">
									<table class="table">
										<thead>
											<tr>
												<th>Heading</th>
												<th>Information</th>
											</tr>
										</thead>
										<tbody>

											<tr>
												<th>Shop Name</th>
												<td> <span class="text-bold text-uppercase">{{ $shopInfo->shopName }}</span></td>
											</tr>
											<tr>
												<th>Shop Id</th>
												<td> <span class="text-bold text-uppercase">{{ $shopInfo->shopViewId }}</span></td>
											</tr>
											<tr>
												<th>Establish </th>
												<td>
													<?php 
										         		$date = new DateTime($shopInfo->created_at);
										         		$joiningDate = date_format($date, 'd F Y');
										          	?>
													<span class="text-semibold">{{ $joiningDate }}</span>
												</td>
											</tr>
											<tr>
												<th>Owner's Name</th>
												<td><span class="text-bold text-uppercase">{{ $ownerInfo->name }}</span></td>
											</tr>
											<tr>
												<th>Owner's Phone No.</th>
												<td><span class="text-semibold">{{ $ownerInfo->phoneNo }}</span></td>
											</tr>
											<tr>
												<th>Owner's Email: </th>
												<td><span class="text-semibold">{{ $ownerInfo->email }}</span></td>
											</tr>
											<tr>
												<th>Shop Address</th>
												
												<td>
													<span class="text-semibold">

													<?php 
														
														if(!is_null($shopAddress)){
															if(!is_null($shopAddress->houseNo)){ echo $shopAddress->houseNo.'-'; }

															if(!is_null($shopAddress->roadNo)){ echo $shopAddress->roadNo.'-'; }

															if(!is_null($shopAddress->block)){ echo $shopAddress->block.'-'; }

															if(!is_null($shopAddress->areaName)){ echo $shopAddress->areaName.'-'; }
																 echo App\TransportLocation::where('id', $shopAddress->areaId)->value('areaName') .'-'.App\TransportLocation::where('id', $shopAddress->districtId)->value('areaName').'-'.App\TransportLocation::where('id', $shopAddress->divisionId)->value('areaName');
														}else{
															echo 'Shop Address Not Insert.';
														}
													?>
													</span>
												</td>
											</tr>
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- /profile info -->

						<!-- About Shop -->
						<div class="panel panel-flat timeline-content">
							<div class="panel-heading">
								<h6 class="panel-title">About Shop</h6>
								<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<li><a data-action="reload"></a></li>
				                		<li><a data-action="close"></a></li>
				                	</ul>
			                	</div>
							</div>

							<div class="panel-body">
								
								<blockquote>
									<p>{{ $ShopDetails->aboutShop }}</p>
									
								</blockquote>
							</div>
						</div>
						<!-- /About Shop -->

						<!-- Shipping Shop -->
						<div class="panel panel-flat timeline-content">
							<div class="panel-heading">
								<h6 class="panel-title">Shipping Policy</h6>
								<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<li><a data-action="reload"></a></li>
				                		<li><a data-action="close"></a></li>
				                	</ul>	
			                	</div>
							</div>

							<div class="panel-body">
								
								<blockquote>
									<p>{{ $ShopDetails->shippingPolicy }}</p>
								</blockquote>
							</div>
						</div>
						<!-- /Shipping Shop -->

						<!-- Return Policy -->
						<div class="panel panel-flat timeline-content">
							<div class="panel-heading">
								<h6 class="panel-title">Return Policy</h6>
								<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<li><a data-action="reload"></a></li>
				                		<li><a data-action="close"></a></li>
				                	</ul>	
			                	</div>
							</div>

							<div class="panel-body">
								
								<blockquote>
									<p>{{ $ShopDetails->returnPolicy }}</p>
								</blockquote>
							</div>
						</div>
						<!-- /Return Policy -->

					</div>
				<!-- /Shop Details -->

				<!-- Shop Product -->
					<div class="tab-pane fade" id="products">

						<div class="row">
							<div class="col-md-8">
								<div class="panel panel-flat">
									<div class="panel-heading">
										<h5 class="panel-title">Shop Products</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<!-- <li><a data-action="close"></a></li> -->
						                	</ul>
					                	</div>
									</div>

									<table class="table datatable-colvis-state">
										<thead>
											<tr>
												<th>Image</th>
												<th>Product Name</th>
												<th>Category</th>
												<th>Total Sell</th>
												<th>Artisan Price</th>
												<th>Sell Price</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@forelse($shopProducts as $shopProduct)
											<tr>
												<td>
													<?php
								                        $productImage = DB::table('product_images')->where('productId', $shopProduct->id)->value('image');
								                        if(!file_exists($productImage)){
								                          $productImage = 'public/artisan/assets/images/placeholder.jpg'; 
								                        }
								                    ?>
													<a href="{{ asset($productImage) }}" class="media-left" data-popup="lightbox">
														<img src="{{ asset($productImage) }}" width="60" height="60" alt="{{ $shopProduct->productName }}">
													</a>
												</td>
												<td>
													<div class="media-left">
														<div class=""><a href="{{ route('singel.product',$shopProduct->id) }}" class="text-default text-bold text-uppercase">{{ $shopProduct->productName }}</a></div>
														<div class="text-size-mini text-uppercase">
															<span class=" icon-qrcode text-primary text-size-mini"></span>
															{{ $shopProduct->productCode }}
														</div>
													</div>
												</td>
												<td>
													<?php 
														$mainCat = App\Category::where('id', $shopProduct->mainCatId)->value('categoryName');
														$secCat = App\Category::where('id', $shopProduct->secondCatId)->value('categoryName');
														$thirdCat = App\Category::where('id', $shopProduct->thirdCatId)->value('categoryName');

														$catLst = $mainCat; 
														if($secCat){$catLst =$catLst. '<i class="icon-arrow-right13"></i>'.'</br>' .$secCat ;}
														if($thirdCat){$catLst = $catLst.'<i class="icon-arrow-right13"></i>'.'</br>' .$thirdCat ;}
														echo $catLst;
													?>
												</td>
												<td>
													<?php echo $totalSell = App\OrderDetail::where('productId',$shopProduct->id)->sum('productQuantity'); ?>
												</td>
												<td>TK. {{ number_format($shopProduct->artisanPrice )}}</td>
												<td>Tk. {{ number_format($shopProduct->sellPrice )}}</td>
												<td>
													@if($shopProduct->status == 1)
														<span class="label label-success">Published</span>
													@else
														<span class="label label-danger">UnPublished</span>
													@endif
												</td>
												<td>
					                            	<a href="{{ route('singel.product',$shopProduct->id) }}" title="View product" class="btn btn-info btn-sm"><i class="icon-eye"></i></a>
					                            </td>
											</tr>

											@empty
											<tr>
												<td colspan="7"><span>No Product Insert .</span> </td>
											</tr>

											@endforelse
										</tbody>
									</table>
								</div>
							</div>


							<div class="col-md-4">
								<!-- Top Products Info -->
								<div class="panel panel-flat">
									<div class="panel-heading">
										<h6 class="panel-title">Top Products</h6>
										<div class="heading-elements">							
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
										</div>
									</div>

									<!-- Tabs -->
				                	<ul class="nav nav-lg nav-tabs nav-justified no-margin no-border-radius bg-indigo-400 border-top border-top-indigo-300">
										<li class="active">
											<a href="#qty" class="text-size-small text-uppercase" data-toggle="tab">
												By Quantity
											</a>
										</li>
										<li>
											<a href="#price" class="text-size-small text-uppercase" data-toggle="tab">
												By Price
											</a>
										</li>
										<li>
											<a href="#rating" class="text-size-small text-uppercase" data-toggle="tab">
												By Rating
											</a>
										</li>
									</ul>
									<!-- /tabs -->


									<!-- Tabs content -->
									<div class="tab-content">
										<div class="tab-pane active fade in has-padding" id="qty">
											<ul class="media-list">
												@forelse($topSellProducts as $topProduct)
													<li class="media">
														<a href="{{ route('singel.item',$topProduct->productId ) }}" class="media-link">
															<?php
									                        	$productImage = App\productImage::where('productId',$topProduct->productId)->value('image');
									                        	if(!file_exists($productImage)){
									                          		$productImage = 'public/artisan/assets/images/placeholder.jpg'; 
									                        	}
									                      	?>
															<div class="media-left"><img src="{{ asset($productImage) }}" class="img-circle img-md" alt=""></div>
															<div class="media-body">
																<?php $product = App\Product::where('id', $topProduct->productId)->select('productName', 'productCode')->first();?>
																<span class="media-heading text-semibold">{{ ucfirst($product->productName) }}</span>
																<span class="media-annotation text-uppercase">{{ $product->productCode }}</span>
															</div>
															<div class="media-right media-middle">
																<span class="text-success-600">{{ $topProduct->sellCount }}</span>
															</div>
														</a>
													</li>
												@empty
													<li><span>No Product is Found</span></li>
												@endforelse
											</ul>
										</div>

										<div class="tab-pane fade has-padding" id="price">
											<ul class="media-list">
												@forelse($topSellPriceProducts as $topSellPriceItem)
													<li class="media">
														<a href="{{ route('singel.item',$topProduct->productId ) }}" class="media-link">
															<?php
									                        	$productImage = App\productImage::where('productId',$topSellPriceItem->productId)->value('image');
									                        	if(!file_exists($productImage)){
									                          		$productImage = 'public/artisan/assets/images/placeholder.jpg'; 
									                        	}
									                      	?>
															<div class="media-left"><img src="{{ asset($productImage) }}" class="img-circle img-md" alt=""></div>
															<div class="media-body">
																<?php $product = App\Product::where('id', $topSellPriceItem->productId)->select('productName', 'productCode')->first();?>
																<span class="media-heading text-semibold">{{ ucfirst($product->productName) }}</span>
																<span class="media-annotation text-uppercase">{{ $product->productCode }}</span>
															</div>
															<div class="media-right media-middle">
																<span class="text-success-600">{{ number_format($topSellPriceItem->ammount) }}</span>
															</div>
														</a>
													</li>
												@empty
													<li><span>No Product is Found</span></li>
												@endforelse
											</ul>
										</div>

										<div class="tab-pane fade has-padding" id="rating">
											<ul class="media-list">
												@forelse($topRateProducts as $topRateItem)
													<li class="media">
														<a href="{{ route('singel.item',$topProduct->productId ) }}" class="media-link">
															<?php
									                        	$productImage = App\productImage::where('productId',$topRateItem->productId)->value('image');
									                        	if(!file_exists($productImage)){
									                          		$productImage = 'public/artisan/assets/images/placeholder.jpg'; 
									                        	}
									                      	?>
															<div class="media-left"><img src="{{ asset($productImage) }}" class="img-circle img-md" alt=""></div>
															<div class="media-body">
																<?php $product = App\Product::where('id', $topRateItem->productId)->select('productName', 'productCode')->first();?>
																<span class="media-heading text-semibold">{{ ucfirst($product->productName) }}</span>
																<span class="media-annotation text-uppercase">{{ $product->productCode }}</span>
															</div>
															<div class="media-right media-middle">
																<span class="text-success-600">{{ $topRateItem->sellCount }}</span>
															</div>
														</a>
													</li>
												@empty
													<li><span>No Product is Found</span></li>
												@endforelse
											</ul>
										</div>
									</div>
									<!-- /tabs content -->

								</div>
								<!-- /Top Products Info -->
							</div>

						</div>
						
					</div>
				<!-- Shop Product -->

				<!-- Shop Modarator -->
					<div class="tab-pane fade" id="modarator">

						<div class="panel panel-flat">
							<div class="panel-heading">
								<h5 class="panel-title">Shop Moderator's Information</h5>
								
							</div>

							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th style="width: 15px;">#</th>
											<th style="width: 65px;" >Image</th>
											<th>Modarator Name</th>
											<th class="col-md-2">Phone Number</th>
											<th class="col-md-2">Email Address</th>
											<th>Moderator Type</th>
											
										</tr>
									</thead>
									<tbody>

										@foreach($modarators as $modarator )
										<tr>
											<td>1</td>
											<td>
												<?php
							                        $modaratorImage = $modarator->avater;
							                        if(!file_exists($modaratorImage)){
							                          $modaratorImage = 'public/images/default/profileDeatult.png'; 
							                        }
							                    ?>
												<a href="{{ asset($modaratorImage) }}" class="media-left" data-popup="lightbox">
													<img src="{{ asset($modaratorImage) }}" width="60" height="60" alt="">
												</a>
											</td>
											<td><span class="text-bold text-uppercase">{{ $modarator->name }}</span></td>
											<td><span class="text-semibold">{{ $modarator->phoneNo }}</span></td>
											<td><span class="text-semibold">{{ $modarator->email }}</span></td>
											<td><span class="text-bold">{{ ($modarator->authority == 1)? 'Founder':(($modarator->authority == 2)?'Super Modarator':'Modarator') }}</span></td>
											
										</tr>
										@endforeach
											
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						
					</div>
				<!-- Shop Modarator -->

				<!-- Shop Setting -->
				<div class="tab-pane fade" id="setting">

					<!-- Profile info -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Shop Information</h6>
							<div class="heading-elements">
								<ul class="icons-list">
									<li><a data-action="collapse"></a></li>
									<li><a data-action="reload"></a></li>
									<li><a data-action="close"></a></li>
								</ul>
							</div>
						</div>

						<div class="panel-body">
							<div class="table-responsive ">
								<table class="table">
									<thead>
									<tr>
										<th>Heading</th>
										<th>Information</th>
									</tr>
									</thead>
									<tbody>

									<tr>
										<th>Shop Associate</th>
										<td>
											<div class="col-md-6">
												<select name="associateId"  data-placeholder="Select Dorpon Associate Name"  class="select">

												<option value="0">Select A Shop Associate </option>
												@forelse($shopAssoInfo as $shopAsso)
													@if($shopAsso->id == $ShopDetails->associateId)
														<option value="{{$shopAsso->id}}" selected>{{ ucfirst($shopAsso->name) }}</option>
													@else
														<option value="{{$shopAsso->id}}" >{{ ucfirst($shopAsso->name) }}</option>
													@endif
												@empty

												@endforelse
												</select>
											</div>
										</td>
									</tr>
									<!-- <tr>
										<th>Associate's Percentage(%)</th>
										<td>
											<div class="col-md-3">
												<input type="number" name="dorponPersent" class="form-control"  placeholder="Enter Dorpon Percentage">
											</div>
										</td>
									</tr> -->
									<tr>
										<th>Dorpon's Percentage(%)</th>
										<td>
											<div class="col-md-3">
												<input type="number" name="dorponPersent" value="{{ $ShopDetails->dorponPersent }}" class="form-control"  placeholder="Enter Dorpon Percentage">
											</div>
										</td>
									</tr>

									<tr>
										<th>Shop Zone</th>
										<td >
											<div class="col-md-6">

												<select name="shopAreaType" data-placeholder="Select Shop Zone Area"  class="select">
												</select>
											</div>
										</td>
									</tr>
									<tr>
										<th>Quality Check </th>
										<td>
											<div class="form-group">
												<div class="checkbox">
													<input type="checkbox"  name="qtyCheck" class="styled size" {{ ($ShopDetails->qtyCheck == 1)?'checked':'' }}>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<th>Pick-up</th>
										<td>
											<div class="form-group">
												<div class="checkbox">
													<input type="checkbox" class="styled" name="pickUpStatus" {{ ($ShopDetails->pickUpStatus == 1)?'checked':'' }}>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<th>Product Publication</th>
										<td>
											<div class="form-group">
												<div class="checkbox">
													<input type="checkbox" class="styled size" name="publicationCheck" {{ ($ShopDetails->publicationCheck == 1)?'checked':'' }}>
												</div>
											</div>
										</td>
									</tr>

									<tr>
										<th>Feature Shop</th>
										<td>
											<div class="form-group">
												<div class="checkbox">
													<input type="checkbox" class="styled size" name="featureShop" {{ ($ShopDetails->shopDetailsTwo == 1)?'checked':'' }}>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<th>Feature Artisan</th>
										<td>
											<div class="form-group">
												<div class="checkbox">
													<input type="checkbox" class="styled size" name="featureArtisan" {{ ($ShopDetails->shopDetailsOne == 1)?'checked':'' }}>
												</div>
											</div>
										</td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div>
				<!-- /Shop Setting -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /user profile -->


<!-- Block Shop Model -->
<div id="shop_block_modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			@if($shopInfo->status == 1)
			<div class="modal-header bg-danger">
			@else
			<div class="modal-header bg-primary">
			@endif
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">{{ ($shopInfo->status == 1) ?'Block The Shop': 'Active The Shop' }}</h5>
			</div>
			<form action="{{ route('shop.block') }}" method="POST">{{ csrf_field() }} 
				<div class="modal-body">
					<div class="alert alert-warning" role="alert">
						 <i> {{ ($shopInfo->status == 1) ?' If You Block This Shop All Products Will Be Unpublished': 'If You Active This Shop All Product Will Be Published' }} </i>.
					</div>
					<div class="row">
						<input type="hidden" name="shopId" value="{{ $shopInfo->id }}">
						<input type="hidden" name="status" value="{{ $shopInfo->status }}">
						<div class="col-md-6 col-md-offset-3">
							<label>Admin password</label>
							<input type="password" name="password" class="form-control">
							<span class="help-block">For Security Purpose Enter Your Password</span>
						</div>
					</div>	
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					@if($shopInfo->status == 1)
					<button type="submit" class="btn btn-danger">Block</button>
					@else
					<button type="submit" class="btn btn-success">Block</button>
					@endif 
				</div>
			</form>
		</div>
	</div>
</div>
</div>
<!-- /Block Shop Model -->
	<script type="text/javascript" src="{{ asset('public/artisan/ajex/shopSetting.js') }}"></script>
<script>
var shopId = "{{ $shopInfo->id }}";
</script>
@endsection
