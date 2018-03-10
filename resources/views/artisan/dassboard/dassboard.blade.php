@extends('artisan.master')

@section('title')
Dashboard
@endsection

@section('asset')
	{!! Charts::assets() !!}
<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/moment/moment.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/dashboard.js') }}"></script>

	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/ripple.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/general_widgets_stats.js') }}"></script>
	

<!-- /theme JS files -->
@endsection

@section('body')

	<!-- Content area -->
	<div class="content">

		<!-- /simple statistics -->
		<div class="row">
			<div class="col-sm-6 col-md-4">
				<div class="panel panel-body bg-blue-400 has-bg-image">
					<div class="media no-margin">
						<div class="media-body">
							<h6 class="no-margin">T.Product: {{ App\Product::where('ownerId' , Auth::User()->shopId)->count() }}</h6>
							<h6 class="no-margin text-success">Published: {{ App\Product::where('ownerId' , Auth::User()->shopId)->where('status', 1)->count() }}</h6>
							<h6 class="no-margin text-warning">Unpublished: {{ App\Product::where('ownerId' , Auth::User()->shopId)->where('status', 0)->count() }}</h6>
							
						</div>

						<div class="media-right media-middle">
							<i class="icon-bag  icon-3x opacity-75"></i>
						</div>
					</div>
					<!-- <span class="text-uppercase media-right text-size-mini">total Produts</span> -->
				</div>
			</div>

			<div class="col-sm-6 col-md-4">
				<div class="panel panel-body bg-indigo-400 has-bg-image">
					<div class="media no-margin">
						<div class="media-body">
							<h6 class="no-margin">Item: {{ number_format(App\OrderDetail::where('ownerId' , Auth::User()->shopId)->sum('productQuantity')) }}</h6>
							<h6 class="no-margin">Amount:Tk. {{ number_format(App\OrderDetail::where('ownerId' , Auth::User()->shopId)->sum('subTotal')) }}</h6>
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
		<!-- /simple statistics -->

		<!-- Main charts -->
		<div class="row">
			<div class="col-lg-6">

				<!-- Traffic sources -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Weekly Sales Report</h6>
						<div class="heading-elements">
							
						</div>
					</div>

					<div class="panel-body">
						{!! $weeklyReport->render() !!}
					</div>

					
				</div>
				<!-- /traffic sources -->

			</div>

			<div class="col-lg-6">

				<!-- Sales stats -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Monthly Sales statistics</h6>
						<div class="heading-elements">
							
	                	</div>
					</div>

					<div class="panel-body">
						{!! $monthlyReport->render() !!}
					</div>
				</div>
				<!-- /sales stats -->

			</div>
		</div>
		<!-- /main charts -->


		<!-- Dashboard content -->
		<div class="row">
			<div class="col-lg-12">

				<!-- /Order History -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Order History</h6>
						<div class="heading-elements">
							<ul class="icons-list">
		                		<li><a href="{{ route('shop.orders') }}" class="text-semibold text-info">View All</a></li>
		                		<li><a data-action="collapse"></a></li>
		                		<li><a data-action="reload"></a></li>
		                		<li><a data-action="close"></a></li>
		                	</ul>
	                	</div>
					</div>

					<div class="table-responsive">
						<table class="table text-nowrap">
							<thead>
								<tr>
									<th>Product Name</th>
									<th >Client Name</th>
									<th>Size</th>
					                <th>Pri. Color </th>
									<th >Quantity</th>
									<th >Amount</th>
									<th >Status</th>
									<th class="text-center" ><i class="icon-arrow-down12"></i></th>
								</tr>
							</thead>
							<tbody>
								@forelse($orders as $order)
									<tr>
										<td>
											<div class="media-left media-middle">
												<?php
							                        $productImage = DB::table('product_images')->where('productId', $order->productId)->value('image');
							                        if(!file_exists($productImage)){
							                          $productImage = 'public/artisan/assets/images/placeholder.jpg'; 
							                        }
							                      ?>
												<a href="{{ route('singel.item',$order->productId) }}"><img src="{{ asset( $productImage ) }}" class="img-circle img-md" alt=""></a>
											</div>
											<div class="media-left">
												<div class=""><a href="{{ route('shop.singel.order',$order->orderId) }}" class="text-default text-semibold">{{ $order->productName }}</a></div>
												<div class="text-muted text-size-small">
													<span class="status-mark border-blue position-left"></span>
													<?php 
									                  	$date = new DateTime($order->created_at);
									                  	echo	$orderDate = date_format($date, 'd M y');
									                ?>
												</div>
											</div>
										</td>
										<td><span class="text-muted">{{ ucfirst($order->name) }}</span></td>
										<td>Not Define</td>
						                {{--<td>--}}
						                  {{--<?php $priColor = App\PrimaryColor::where('id',$order->priColor)->select('colorName', 'colorCode')->first();?>--}}
						                  {{--<span class="label" style="background-color: {{ $priColor->colorCode}}" >{{ ucfirst($priColor->colorName) }}</span>--}}
						                {{--</td>--}}

										<td><span class="text-success-600">{{ $order->productQuantity }}</span></td>
										<td><h6 class="text-size-small">&#2547; {{ number_format($order->subTotal , 2, '.', ',') }}</h6></td>
										<td>
											@if($order->status == 0)
												<span class="label bg-warning-400">Hold</span>
											@else
												<span class="label bg-success-600">Shipped</span>
											@endif
										</td>
										<td class="text-center">
											<a href="{{ route('shop.singel.order', $order->orderId) }}" title="View Order Details" class="btn bg-primary-800 mt-5 btn-xs"><i class="icon-book"></i></a>
										</td>
									</tr>
								
								@empty

									<tr class="active border-double">
										<td colspan="5">No Oders Found..!</td>
									</tr>
								@endforelse
								
							</tbody>
						</table>
					</div>
				</div>
				<!-- /Order History -->
				
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8">
				<!-- Top Buyer History -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Top Buyer History</h6>
						<div class="heading-elements">
							<ul class="icons-list">
		                		<li><a data-action="collapse"></a></li>
		                		<li><a data-action="reload"></a></li>
		                		<li><a data-action="close"></a></li>
		                	</ul>
	                	</div>
					</div>
					<div class="table-responsive">
						<table class="table text-nowrap">
							<thead>
								<tr>
									<th>Client Name</th>
									<th class="col-md-3">Quantity</th>
									<th class="col-md-3">Total Price</th>
								</tr>
							</thead>
							<tbody>
								@forelse($topBuyers as $topBuyer)
								<tr>
									<td>
										<div class="media-left media-middle">
											
											<?php
						                        $userInfo = App\User::where('id', $topBuyer->consumerId)->select('name','avater', 'email')->first();
						                        $productImage = $userInfo->avater;
						                        if(!file_exists($productImage)){
						                          $productImage = 'public/artisan/assets/images/placeholder.jpg'; 
						                        }
						                      ?>
											<img src="{{ asset($productImage) }}" class="img-circle img-md" alt="{{ $userInfo->name }}">
										
										</div>

										<div class="media-body">
											<div class="media-heading">
												<span class="letter-icon-title text-blue-800 text-semibold">{{ ucfirst($userInfo->name) }}</span>
											</div>

											<!-- <div class="text-muted text-size-small"><i class="icon-mention text-size-mini position-left"></i>{{ $userInfo->email }}</div> -->
										</div>
									</td>
									<td>
										<span class="text-orange-800  text-semibold ">{{ App\OrderDetail::where('consumerId', $topBuyer->consumerId)->sum('productQuantity') }}</span>
									</td>
									<td>
										<span class="text-semibold text-violet-800 no-margin">&#2547; {{ number_format(App\OrderDetail::where('consumerId', $topBuyer->consumerId)->sum('subTotal') , 2, '.', ',') }}</span>
									</td>
								</tr>
								@empty

								@endforelse
								
							</tbody>
						</table>
					</div>
				</div>
				<!-- /Top Buyer History -->
			</div>
			<div class="col-lg-4">

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
									<li><span>No Produt is Found</span></li>
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
									<li><span>No Produt is Found</span></li>
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
									<li><span>No Produt is Found</span></li>
								@endforelse
							</ul>
						</div>
					</div>
					<!-- /tabs content -->

				</div>
				<!-- /Top Products Info -->

			</div>
		</div>
		<!-- /dashboard content -->

		<!-- <div class="row">
			<div class="col-md-12">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Latest Product Review </h6>
						<div class="heading-elements">
							<ul class="icons-list">
		                		<li><a data-action="collapse"></a></li>
		                		<li><a data-action="reload"></a></li>
		                		<li><a data-action="close"></a></li>
		                	</ul>
	                	</div>
                	</div>

					<div class="panel-body">
						<div class="row">
							<div class="col-lg-6">
								<ul class="media-list content-group">
									<li class="media stack-media-on-mobile">
	                					<div class="media-left">
											<div class="thumb">
												<a href="#">
													<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-responsive img-rounded media-preview" alt="">
													<span class="zoom-image"><i class="icon-play3"></i></span>
												</a>
											</div>
										</div>

	                					<div class="media-body">
											<h6 class="media-heading"><a href="#">Up unpacked friendly</a></h6>
				                    		<ul class="list-inline list-inline-separate text-muted mb-5">
				                    			<li><i class="icon-book-play position-left"></i> Video tutorials</li>
				                    			<li>14 minutes ago</li>
				                    		</ul>
											The him father parish looked has sooner. Attachment frequently gay terminated son...
										</div>
									</li>

									<li class="media stack-media-on-mobile">
	                					<div class="media-left">
											<div class="thumb">
												<a href="#">
													<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-responsive img-rounded media-preview" alt="">
													<span class="zoom-image"><i class="icon-play3"></i></span>
												</a>
											</div>
										</div>

	                					<div class="media-body">
											<h6 class="media-heading"><a href="#">It allowance prevailed</a></h6>
				                    		<ul class="list-inline list-inline-separate text-muted mb-5">
				                    			<li><i class="icon-book-play position-left"></i> Video tutorials</li>
				                    			<li>12 days ago</li>
				                    		</ul>
											Alteration literature to or an sympathize mr imprudence. Of is ferrars subject as enjoyed...
										</div>
									</li>
								</ul>
							</div>

							<div class="col-lg-6">
								<ul class="media-list content-group">
									<li class="media stack-media-on-mobile">
	                					<div class="media-left">
											<div class="thumb">
												<a href="#">
													<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-responsive img-rounded media-preview" alt="">
													<span class="zoom-image"><i class="icon-play3"></i></span>
												</a>
											</div>
										</div>

	                					<div class="media-body">
											<h6 class="media-heading"><a href="#">Case read they must</a></h6>
				                    		<ul class="list-inline list-inline-separate text-muted mb-5">
				                    			<li><i class="icon-book-play position-left"></i> Video tutorials</li>
				                    			<li>20 hours ago</li>
				                    		</ul>
											On it differed repeated wandered required in. Then girl neat why yet knew rose spot...
										</div>
									</li>

									<li class="media stack-media-on-mobile">
	                					<div class="media-left">
											<div class="thumb">
												<a href="#">
													<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-responsive img-rounded media-preview" alt="">
													<span class="zoom-image"><i class="icon-play3"></i></span>
												</a>
											</div>
										</div>

	                					<div class="media-body">
											<h6 class="media-heading"><a href="#">Too carriage attended</a></h6>
				                    		<ul class="list-inline list-inline-separate text-muted mb-5">
				                    			<li><i class="icon-book-play position-left"></i> FAQ section</li>
				                    			<li>2 days ago</li>
				                    		</ul>
											Marianne or husbands if at stronger ye. Considered is as middletons uncommonly...
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<!-- <div class="row">
			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
				
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">User Question Table</h5>
						<div class="heading-elements">
							<ul class="icons-list">
		                		<li><a data-action="collapse"></a></li>
		                		<li><a data-action="reload"></a></li>
		                		<li><a data-action="close"></a></li>
		                	</ul>
	                	</div>
					</div>

					<table class="table table-bordered table-hover datatable-highlight">
						<thead>
							<tr>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Job Title</th>
								<th>DOB</th>
								<th>Status</th>
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Marth</td>
								<td><a href="#">Enright</a></td>
								<td>Traffic Court Referee</td>
								<td>22 Jun 1972</td>
								<td><span class="label label-success">Active</span></td>
								<td class="text-center">
									<ul class="icons-list">
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<ul class="dropdown-menu dropdown-menu-right">
												<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
												<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
												<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
											</ul>
										</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>Jackelyn</td>
								<td>Weible</td>
								<td><a href="#">Airline Transport Pilot</a></td>
								<td>3 Oct 1981</td>
								<td><span class="label label-default">Inactive</span></td>
								<td class="text-center">
									<ul class="icons-list">
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<ul class="dropdown-menu dropdown-menu-right">
												<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
												<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
												<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
											</ul>
										</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>Aura</td>
								<td>Hard</td>
								<td>Business Services Sales Representative</td>
								<td>19 Apr 1969</td>
								<td><span class="label label-danger">Suspended</span></td>
								<td class="text-center">
									<ul class="icons-list">
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<ul class="dropdown-menu dropdown-menu-right">
												<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
												<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
												<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
											</ul>
										</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>Nathalie</td>
								<td><a href="#">Pretty</a></td>
								<td>Drywall Stripper</td>
								<td>13 Dec 1977</td>
								<td><span class="label label-info">Pending</span></td>
								<td class="text-center">
									<ul class="icons-list">
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<ul class="dropdown-menu dropdown-menu-right">
												<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
												<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
												<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
											</ul>
										</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>Sharan</td>
								<td>Leland</td>
								<td>Aviation Tactical Readiness Officer</td>
								<td>30 Dec 1991</td>
								<td><span class="label label-default">Inactive</span></td>
								<td class="text-center">
									<ul class="icons-list">
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<ul class="dropdown-menu dropdown-menu-right">
												<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
												<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
												<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
											</ul>
										</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>Maxine</td>
								<td><a href="#">Woldt</a></td>
								<td><a href="#">Business Services Sales Representative</a></td>
								<td>17 Oct 1987</td>
								<td><span class="label label-info">Pending</span></td>
								<td class="text-center">
									<ul class="icons-list">
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<ul class="dropdown-menu dropdown-menu-right">
												<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
												<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
												<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
											</ul>
										</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>Sylvia</td>
								<td><a href="#">Mcgaughy</a></td>
								<td>Hemodialysis Technician</td>
								<td>11 Nov 1983</td>
								<td><span class="label label-danger">Suspended</span></td>
								<td class="text-center">
									<ul class="icons-list">
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<ul class="dropdown-menu dropdown-menu-right">
												<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
												<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
												<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
											</ul>
										</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>Lizzee</td>
								<td><a href="#">Goodlow</a></td>
								<td>Technical Services Librarian</td>
								<td>1 Nov 1961</td>
								<td><span class="label label-danger">Suspended</span></td>
								<td class="text-center">
									<ul class="icons-list">
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<ul class="dropdown-menu dropdown-menu-right">
												<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
												<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
												<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
											</ul>
										</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>Kennedy</td>
								<td>Haley</td>
								<td>Senior Marketing Designer</td>
								<td>18 Dec 1960</td>
								<td><span class="label label-success">Active</span></td>
								<td class="text-center">
									<ul class="icons-list">
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<ul class="dropdown-menu dropdown-menu-right">
												<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
												<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
												<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
											</ul>
										</li>
									</ul>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				
				
			</div>
		</div> -->
	</div>
	<!-- /content area -->

@endsection