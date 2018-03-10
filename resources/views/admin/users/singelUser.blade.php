@extends('admin.master')

@section('title')
Single Customer Info
@endsection

@section('asset')
<!-- Theme JS files -->
	
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/libraries/jasny_bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/moment/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/user_profile_tabbed.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/ripple.min.js') }}"></script>
<!-- /theme JS files -->
@endsection

@section('content')
<div class="content">
	@include('admin.includes.message')
	<!-- Detached sidebar -->
	<div class="sidebar-detached">
		<div class="sidebar sidebar-default sidebar-separate">
			<div class="sidebar-content">

				<!-- User details -->
				<div class="content-group">
					<div class="panel-body bg-indigo-400 border-radius-top text-center" style="background-image: url(http://demo.interface.club/limitless/assets/images/bg.png); background-size: contain;">
						<div class="content-group-sm">
							<h6 class="text-semibold no-margin-bottom">
								{{ $userInfo->name }}
							</h6>

							<span class="display-block">
								<?php 
				                  	$date = new DateTime($userInfo->created_at);
				                  	$joinDate = date_format($date, 'd M Y');
				                ?>
								{{ $joinDate }}
							</span>
						</div>

						<a href="#" class="display-inline-block content-group-sm">
							<?php
		                        $userImage = $userInfo->avater ;
		                        if(!file_exists($userImage)){
		                          $userImage = 'public/images/default/profileDeatult.png'; 
		                        }
	                     	?>
							<img src="{{ asset($userImage) }}" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
						</a>

						<!-- <ul class="list-inline list-inline-condensed no-margin-bottom">
							<li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-google-drive"></i></a></li>
							<li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-twitter"></i></a></li>
							<li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-github"></i></a></li>
						</ul> -->
					</div>

					<div class="panel no-border-top no-border-radius-top">
						<ul class="navigation">
							<li class="navigation-header">Navigation</li>
							<li class="active"><a href="#profile" data-toggle="tab"><i class="icon-files-empty"></i> Profile</a></li>
							<li><a href="#messages" data-toggle="tab"><i class="icon-files-empty"></i> Inbox <span class="badge bg-warning-400">{{$unread}}</span></a></li>
							<li><a href="#orders" data-toggle="tab"><i class="icon-files-empty"></i> Orders</a></li>
							
						</ul>
					</div>
				</div>
				<!-- /user details -->


				<!-- Online users -->
				<!-- <div class="sidebar-category">
					<div class="category-title">
						<span>Online users</span>
						<ul class="icons-list">
							<li><a href="#" data-action="collapse"></a></li>
						</ul>
					</div>

					<div class="category-content">
						<ul class="media-list">
							<li class="media">
								<a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
								<div class="media-body">
									<a href="#" class="media-heading text-semibold">James Alexander</a>
									<span class="text-size-mini text-muted display-block">Santa Ana, CA.</span>
								</div>
								<div class="media-right media-middle">
									<span class="status-mark border-success"></span>
								</div>
							</li>

							<li class="media">
								<a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
								<div class="media-body">
									<a href="#" class="media-heading text-semibold">Jeremy Victorino</a>
									<span class="text-size-mini text-muted display-block">Dowagiac, MI.</span>
								</div>
								<div class="media-right media-middle">
									<span class="status-mark border-danger"></span>
								</div>
							</li>

							<li class="media">
								<a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
								<div class="media-body">
									<a href="#" class="media-heading text-semibold">Margo Baker</a>
									<span class="text-size-mini text-muted display-block">Kasaan, AK.</span>
								</div>
								<div class="media-right media-middle">
									<span class="status-mark border-success"></span>
								</div>
							</li>

							<li class="media">
								<a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
								<div class="media-body">
									<a href="#" class="media-heading text-semibold">Beatrix Diaz</a>
									<span class="text-size-mini text-muted display-block">Neenah, WI.</span>
								</div>
								<div class="media-right media-middle">
									<span class="status-mark border-warning"></span>
								</div>
							</li>

							<li class="media">
								<a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
								<div class="media-body">
									<a href="#" class="media-heading text-semibold">Richard Vango</a>
									<span class="text-size-mini text-muted display-block">Grapevine, TX.</span>
								</div>
								<div class="media-right media-middle">
									<span class="status-mark border-grey-400"></span>
								</div>
							</li>
						</ul>
					</div>
				</div> -->
				<!-- /online-users -->


				<!-- Latest updates -->
				<!-- <div class="sidebar-category">
					<div class="category-title">
						<span>Latest updates</span>
						<ul class="icons-list">
							<li><a href="#" data-action="collapse"></a></li>
						</ul>
					</div>

					<div class="category-content">
						<ul class="media-list">
							<li class="media">
								<div class="media-left">
									<a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
								</div>

								<div class="media-body">
									Drop the IE <a href="#">specific hacks</a> for temporal inputs
									<div class="media-annotation">4 minutes ago</div>
								</div>
							</li>

							<li class="media">
								<div class="media-left">
									<a href="#" class="btn border-warning text-warning btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-commit"></i></a>
								</div>
								
								<div class="media-body">
									Add full font overrides for popovers and tooltips
									<div class="media-annotation">36 minutes ago</div>
								</div>
							</li>

							<li class="media">
								<div class="media-left">
									<a href="#" class="btn border-info text-info btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-branch"></i></a>
								</div>
								
								<div class="media-body">
									<a href="#">Chris Arney</a> created a new <span class="text-semibold">Design</span> branch
									<div class="media-annotation">2 hours ago</div>
								</div>
							</li>

							<li class="media">
								<div class="media-left">
									<a href="#" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-merge"></i></a>
								</div>
								
								<div class="media-body">
									<a href="#">Eugene Kopyov</a> merged <span class="text-semibold">Master</span> and <span class="text-semibold">Dev</span> branches
									<div class="media-annotation">Dec 18, 18:36</div>
								</div>
							</li>

							<li class="media">
								<div class="media-left">
									<a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
								</div>
								
								<div class="media-body">
									Have Carousel ignore keyboard events
									<div class="media-annotation">Dec 12, 05:46</div>
								</div>
							</li>
						</ul>
					</div>
				</div> -->
				<!-- /latest updates -->

			</div>
		</div>
	</div>
    <!-- /detached sidebar -->


	<!-- Detached content -->
	<div class="container-detached">
		<div class="content-detached">

			<!-- Tab content -->
			<div class="tab-content">
				<div class="tab-pane fade in active" id="profile">

					<!-- Daily stats -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Profile Details</h6>
							<div class="heading-elements">
								
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
											<th>Customer Name</th>
											<td> <span class="text-bold text-uppercase">{{ $userInfo->name }}</span></td>
										</tr>
										<tr>
											<th>Join At</th>
											<td>
												<?php 
									         		$date = new DateTime($userInfo->created_at);
									         		$joiningDate = date_format($date, 'd F Y');
									          	?>
												<span class="text-semibold">{{ $joiningDate }}</span>
											</td>
										</tr>
										<tr>
											<th>Phone No.</th>
											<td><span class="text-semibold">{{ $userInfo->phoneNo }}</span></td>
										</tr>
										<tr>
											<th>Email Address: </th>
											<td><span class="text-semibold">{{ $userInfo->email }}</span></td>
										</tr>
										<!--<tr>-->
										<!--	<th>Customer Address</th>-->
										<!--	<td><span class="text-semibold">-->
										<!--		<?php $userAddress = App\ConsumerDetail::where('id', $userInfo->id)->first(); ?>-->
										<!--		Af-->
										<!--	</span></td>-->
										<!--</tr>-->
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- /daily stats -->
				</div>

				<div class="tab-pane fade" id="messages">

					<!-- My inbox -->
					<div class="panel panel-white">
						<div class="panel-heading">
							<h6 class="panel-title">{{ ucfirst($userInfo->name) }} Inbox</h6>

							<div class="heading-elements not-collapsible">
								<span class="label bg-warning-400 heading-text">{{ $unread }} Un-read</span>
		                	</div>
						</div>

						<div class="table-responsive">
							<table class="table table-inbox table-lg">
								<tbody data-link="row" class="rowlink">
									
									@forelse($inboxs as $inbox)
									<tr class="unread">
										
										<td class="table-inbox-star rowlink-skip">
											@if($inbox->status = 2)
						                    	<i class="icon-star-full2 text-success-300" title="Replyed"></i>  <!-- Read message Sign -->
						                  	@elseif($inbox->status = 1)
						                    	<i class="icon-star-full2 text-info-300" title="Readed"></i>  <!-- Read message Sign -->
						                 	 @else
						                    	<i class="icon-star-full2 text-warning-300" title="Un-Readed"></i> <!-- unRead message Sign -->
						                  	@endif
										</td>
										<td class="table-inbox-message">
							                <div class="table-inbox-subject">{{ $inbox->productName }}</div>
							                <span class="table-inbox-preview">{{ $inbox->message }}</span>
						              	</td>
										<td class="table-inbox-time">
											<?php 
							                  	$date = new DateTime($inbox->created_at);
							                  	$qusnDate = date_format($date, 'd M y');
							                ?>
							                {{ $qusnDate }}
										</td>
									</tr>
									@empty
									<tr class="unread">
						              	<td>
						                	<label>No Message Found </label>
						              	</td>
						            </tr>
									@endforelse

								</tbody>
							</table>
						</div>
					</div>
					<!-- /my inbox -->

				</div>

				<div class="tab-pane fade" id="orders">

					<!-- Orders history -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Orders history</h6>
							<div class="heading-elements">
								
		                	</div>
						</div>

						<!-- <div class="panel-body">
							<div class="chart-container">
								
							</div>
                    	</div> -->

						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th class="col-lg-2">Order Date</th>
										<th>Total Products</th>
										<th>Total Amount(Tk.)</th>
										<th>Order Status</th>
										<th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
									</tr>
								</thead>
								<tbody>
									@forelse($orders as $order )

									<tr>
										<td class="no-padding-right" style="width: 45px;">
											<?php 
							                  	$date = new DateTime($order->created_at);
							                  	$qusnDate = date_format($date, 'd M y');
							                ?>
							                {{ $qusnDate }}
										</td>
										<td>
											{{ $order->totalProduct }}
										</td>
										<td> Tk. {{ $order->totalAmmount }}</td>
										<td>
											@if($order->status == 0)
						                    	<span class="label bg-warning">Hold</span>
						                    @else
						                    	<span class="label bg-success">Shipped</span>
						                    @endif
										</td>
										
										
										
										<td class="text-center">
											<a href="{{ route('singel.order', $order->id) }}" title="View Shop" class="btn btn-info btn-sm"><i class="icon-eye"></i></a>
										</td>
									</tr>
									@empty
									<tr class="unread">
						              	<td>
						                	<label>No Order Found </label>
						              	</td>
						            </tr>
									@endforelse
								</tbody>
							</table>
						</div>
					</div>
					<!-- /orders history -->

				</div>
			</div>
			<!-- /tab content -->

		</div>
	</div>
	<!-- /detached content -->


</div>

@endsection