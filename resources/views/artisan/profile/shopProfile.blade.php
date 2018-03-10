@extends('artisan.master')

@section('title')
Shop Profile
@endsection

@section('asset')
<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/moment/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/visualization/echarts/echarts.js') }}"></script>

	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/uploader_bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/user_pages_profile.js') }}"></script>

	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/ripple.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/components_modals.js') }}"></script> 

	

<!-- /theme JS files -->
@endsection

@section('body')

<!-- Cover area -->
<div class="profile-cover">
	@if(is_null($shopInfo->bannerImage))
	<div class="profile-cover-img" style="background-image: url( {{ asset('public/images/default/shop_cover_image.jpg') }} )"></div>
	@else
	<div class="profile-cover-img" style="background-image: url( {{ asset( $shopInfo->bannerImage ) }} )"></div>
	@endif
	<div class="media">
		<div class="media-left">
			<i class="profile-thumb">
				@if(empty($shopInfo->shopLogo))
				<img src="{{ asset('public/artisan/assets/images/placeholder.jpg') }}" class="img-circle img-xxl" alt="">
				@else
				<img src="{{ asset( $shopInfo->shopLogo ) }}" class="img-circle img-xxl" alt="">
				@endif
			</i>
		</div>

		<div class="media-body">
			<?php 
         		$date = new DateTime($shopInfo->created_at);
         		$joiningDate = date_format($date, 'd F Y');
          	?>
    		<h1 class="text-uppercase">{{ $shopInfo->shopName }} 
    			<small class="display-block">Estiblish: {{ $joiningDate }}</small>
    			<small class="display-block">Shop Id: {{ $shopInfo->shopViewId }}</small>
    		</h1>
		</div>

		<div class="media-right media-middle">
			<ul class="list-inline list-inline-condensed no-margin-bottom text-nowrap">
				<li><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#update_logo_modal"><i class="icon-camera position-left"></i>Update Logo</button></li>
				<li><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#update_cover_modal"><i class="icon-file-picture position-left"></i> Update Cover</button></li>
			</ul>
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
			<li class="active"><a href="#policy" data-toggle="tab"><i class="icon-menu7 position-left"></i>Shop Policy</a></li>
			<!-- <li><a href="#details" data-toggle="tab"><i class="icon-address-book3 position-left"></i>Shop Address</a></li> -->
			<li><a href="#modarator" data-toggle="tab"><i class=" icon-reading position-left"></i>Moderator</a></li>
			<li><a href="#settings" data-toggle="tab"><i class="icon-cog3 position-left"></i> Settings</a></li>
		</ul>
		@if(Auth::User()->authority == 1)
		<div class="navbar-right">
			<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_shop"><i class="icon-cancel-circle2 position-left"></i> Shop Delete Request</button></li>			
		</div>
		@endif
	</div>
</div>
<!-- /toolbar -->


<!-- Content area -->
<div class="content">
	@include('artisan.includes.message')
	<!-- User profile -->
	<div class="row">
		<div class="col-lg-12">
			<div class="tabbable">
				<div class="tab-content">

				<!-- Shop Policy -->
					<div class="tab-pane fade in active" id="policy">
						<div class="timeline timeline-left content-group">
							<div class="timeline-container">

								<!-- Shop Address -->
								<div class="timeline-row">
									<div class="timeline-icon">
										<div class="bg-warning-400">
											<i class="icon-bookmark"></i>
										</div>
									</div>

									<div class="panel panel-flat timeline-content">
										<div class="panel-heading">
											<h6 class="panel-title">Shop Address</h6>
											<div class="heading-elements">
												<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_address">Address <i class="icon-pencil7 position-right"></i></button>
						                	</div>
										</div>

										<div class="panel-body">
											<div class="table-responsive">
												<table class="table">
													
													<tbody>

													<tr>
														<th>House No</th>
														<td><h4 class="text-uppercase"> {{ (isset($shopAdress->houseNo)?$shopAdress->houseNo:' ')}}</h4></td>

													</tr>
													<tr>
														<th>Road No</th>
														<td>{{(isset($shopAdress->roadNo)?$shopAdress->roadNo:' ') }}</td>

													</tr>

													<tr>
														<th>Block</th>
														<td>{{ (isset($shopAdress->block)?$shopAdress->block:' ')}}</td>

													</tr>
													<tr>
														<th>Area Name</th>
														<td>{{(isset($shopAdress->areaName)?$shopAdress->areaName:' ')}}</td>

													</tr>
													<tr>
														<th>Upozila/Thana</th>
														<td>
															<label>
															@if(isset($shopAdress->areaId))
															<?php echo App\TransportLocation::where('id',$shopAdress->areaId )->value('areaName');?>
															@else

															@endif
															</label>
														</td>

													</tr>
													<tr>
														<th>District</th>
														<td>
															<label>
																@if(isset($shopAdress->districtId))
                                                                    <?php echo App\TransportLocation::where('id',$shopAdress->districtId )->value('areaName');?>
																@else

																@endif
															</label>
														</td>
													</tr>

													<tr>
														<th>Division</th>
														<td>
															<label>
																@if(isset($shopAdress->divisionId))
                                                                    <?php echo App\TransportLocation::where('id',$shopAdress->divisionId )->value('areaName');?>
																@else

																@endif
															</label>
														</td>
													</tr>

													</tbody>
												</table>
											</div>

										</div>
									</div>
								</div>
								<!-- /Shop Address -->

								<!-- About Shop -->
								<div class="timeline-row">
									<div class="timeline-icon">
										<div class="bg-warning-400">
											<i class="icon-bookmark"></i>
										</div>
										
									</div>

									<div class="panel panel-flat timeline-content">
										<div class="panel-heading">
											<h6 class="panel-title">About shop</h6>
											<div class="heading-elements">
												<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_about">@if(is_null($shopInfo->aboutShop)) Insert @else Update @endif <i class="icon-pencil7 position-right"></i></button>	
						                	</div>
										</div>

										<div class="panel-body">
											
											<blockquote>
												@if(is_null($shopInfo->aboutShop))
													<p>No Data Found</p>
												@else
													<p>{!! $shopInfo->aboutShop !!}</p>
												@endif
											</blockquote>
										</div>
									</div>
								</div>
								<!-- /About Shop -->
								<!-- Return Policy -->
								<div class="timeline-row">
									<div class="timeline-icon">
										<div class="bg-warning-400">
											<i class="icon-truck"></i>
										</div>
									</div>

									<div class="panel panel-flat timeline-content">
										<div class="panel-heading">
											<h6 class="panel-title">Return Policy</h6>
											<div class="heading-elements">
												<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_return">@if(is_null($shopInfo->returnPolicy)) Insert @else Update @endif <i class="icon-pencil7 position-right"></i></button>	
						                	</div>
										</div>

										<div class="panel-body">
											
											<blockquote>
												@if(is_null($shopInfo->returnPolicy))
													<p>No Data Found</p>
												@else
													<p>{!! $shopInfo->returnPolicy !!}</p>
												@endif
											</blockquote>
										</div>
									</div>
								</div>
								<!-- /Return Policy -->

								<!-- Shipping Policy -->
								<div class="timeline-row">
									<div class="timeline-icon">
										<div class="bg-warning-400">
											<i class="icon-cart2"></i>
										</div>
									</div>

									<div class="panel panel-flat timeline-content">
										<div class="panel-heading">
											<h6 class="panel-title">Shipping Policy</h6>
											<div class="heading-elements">
												<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_shipping">@if(is_null($shopInfo->shippingPolicy)) Insert @else Update @endif <i class="icon-pencil7 position-right"></i></button>	
						                	</div>
										</div>

										<div class="panel-body">
											
											<blockquote>
												@if(is_null($shopInfo->shippingPolicy))
													<p>No Data Found</p>
												@else
													<p>{!! $shopInfo->shippingPolicy !!}</p>
												@endif
											</blockquote>
										</div>
									</div>
								</div>
								<!-- /Shipping Shop -->

							</div>
					    </div>

					</div>
				<!-- /Shop Policy -->
				<!-- Shop Modarator -->
					<div class="tab-pane fade" id="modarator">

						<div class="panel panel-flat">
							<div class="panel-heading">
								<h5 class="panel-title">Shop Moderator Information</h5>
								@if(Auth::User()->authority ==1 )
								<div class="heading-elements">
									<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#insert_modarator"> <i class="icon-plus-circle2"></i> Insert</button>
			                	</div>
			                	@endif
							</div>

							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th style="width: 15px;">#</th>
											<th >Image</th>
											<th>Moderator Name</th>
											<th class="col-md-2">Email</th>
											<th class="col-md-2">Phone NO.</th>
											<th>Type</th>
											@if(Auth::User()->authority < 3 )
											<th class="col-md-2">Action</th>
											@endif
										</tr>
									</thead>
									<tbody>
										<?php $i=1;?>
										@foreach($modarators as $modarator)
										<tr>
											<td>{{ $i++ }}</td>
											<td>
												<div class="media-left media-middle">
													<a href="#">
														@if(is_null($modarator->avater))
														<img src="{{ asset('public/artisan/assets/images/placeholder.jpg') }}" class="img-circle img-lg" alt="">
														@else
														<img src="{{ asset($modarator->avater) }}" class="img-circle img-lg" alt="">
														@endif
													</a>
												</div>
											</td>
											<td id="modaratorName">{{ $modarator->name }}</td>
											<td>{{ $modarator->email }}</td>
											<td>{{ $modarator->phoneNo }}</td>
											<td>{{ ($modarator->authority == 1) ? 'Founder' : (($modarator->authority == 2) ? 'Admin' : 'Editor') }}</td>
											@if(Auth::User()->authority ==1 )
											    @if($modarator->authority > 1 )
    											<td >
    												<button type="button" class="btn btn-danger btn-sm delete_modarator" data-toggle="modal" data-target="#delete_modarator" id="{{ $modarator->id}}" onclick="deleteModarator(this)"> <i class=" icon-bin"></i></button>
    											</td>
    											@endif
											@endif
										</tr>
										@endforeach

									</tbody>
								</table>
							</div>
						</div>
						
					</div>
				<!-- Shop Modarator -->
				<script type="text/javascript">
					function deleteModarator(button) {
						var modaratorId = button.id;
						var modaratorName = button.parentElement.parentElement.children[2].innerHTML;
						document.getElementById('modarator_name').innerHTML= modaratorName;
						document.getElementById('modaraterId').value = modaratorId;
					}
				</script>

				<!-- Shop Setting -->
					<div class="tab-pane fade col-lg-8 col-lg-offset-2 col-md-12 col-sm-12" id="settings">

						<!-- Account settings -->
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">General Account Settings</h6>
								<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<li><a data-action="reload"></a></li>

				                	</ul>
			                	</div>
							</div>

							<div class="panel-body">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>Heading</th>
												<th>Information</th>
												@if(Auth::User()->authority < 3 )
												<th>Action</th>
												@endif
											</tr>
										</thead>
										<tbody>

											<tr>
												<th>Shop Name</th>
												<td><h4 class="text-uppercase"> {{ $shopInfo->shopName }}</h4></td>
												@if(Auth::User()->authority < 3 )
												<td>
													<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_shop_name" > <i class="icon-pencil7"></i></button>
												</td>
												@endif
											</tr>
											<tr>
												<th>Shop Email</th>
												<td>{{ (is_null($shopInfo->shopEmail)) ? "Insert Shop Contact Email" : $shopInfo->shopEmail }}</td>
												@if(Auth::User()->authority < 3 )
												<td>
													<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_email"> <i class="icon-pencil7"></i></button>
												</td>
												@endif
											</tr>

											<tr>
												<th>Artisan View Name</th>
												<td><span>{{ (is_null($shopInfo->shopDetailsFour)) ? " " : $shopInfo->shopDetailsFour }}</span></td>
												@if(Auth::User()->authority < 3 )
												<td>
													<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_custom_artisan_name"> <i class="icon-pencil7"></i></button>
												</td>
												@endif
											</tr>
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">General Account Settings</h6>
								<div class="heading-elements">
									<ul class="icons-list">
										<li><a data-action="collapse"></a></li>
										<li><a data-action="reload"></a></li>

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
												<h5><?php echo App\DorponAssociate::where('id', $shopInfo->associateId)->value('name');?></h5>
											</td>
										</tr>
										<tr>
											<th>Associate Percent(%)</th>
											<td><span class="text-bold text-uppercase"><h5><?php echo App\DorponAssociate::where('id', $shopInfo->associateId)->value('assocPersent');?></h5></span></td>
										</tr>
										<tr>
											<th>Dorpon Percent(%)</th>
											<td>
												<label>{{ $shopInfo->dorponPersent }}%</label>
											</td>
										</tr>

										<tr>
											<th>Quality Check </th>
											<td>
												<div class="form-group">
													<div class="checkbox">
														<input type="checkbox" name="qtyCheck" disabled  {{ ($shopInfo->qtyCheck ==1)?'checked': ' ' }} class="styled size" >
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<th>Pick-up</th>
											<td>
												<div class="form-group">
													<div class="checkbox">
														<input type="checkbox" class="styled" disabled  {{ ($shopInfo->pickUpStatus ==1)?'checked': ' ' }} name="pickUpStatus">
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<th>Product Publication</th>
											<td>
												<div class="form-group">
													<div class="checkbox">
														<input type="checkbox" class="styled size" disabled {{ ($shopInfo->publicationCheck ==1)?'checked': ' ' }} name="publicationCheck">
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
				<!-- Shop Setting -->
				</div>
			</div>
		</div>
	</div>
</div>


@include('artisan.modelBox.artisanProfileModel')
<script src="{{ asset('public/artisan/ajex/shopAddressCrud.js') }}"></script>
@endsection
