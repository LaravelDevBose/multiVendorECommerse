@extends('admin.master')

@section('title')
Admin Dassboard
@endsection

@section('asset')
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

@section('content')

	<!-- Content area -->
	<div class="content">

		<!-- /simple statistics -->
		<div class="row">
			<div class="col-sm-6 col-md-3">
				<div class="panel panel-body bg-blue-400 has-bg-image">
					<div class="media no-margin">
						<div class="media-body">
							<h3 class="no-margin">54,390</h3>
							<span class="text-uppercase text-size-mini">Total Sell</span>
						</div>

						<div class="media-right media-middle">
							<i class="icon-bubbles4 icon-3x opacity-75"></i>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-3">
				<div class="panel panel-body bg-danger-400 has-bg-image">
					<div class="media no-margin">
						<div class="media-body">
							<h3 class="no-margin">389,438</h3>
							<span class="text-uppercase text-size-mini">total product</span>
						</div>

						<div class="media-right media-middle">
							<i class="icon-bag icon-3x opacity-75"></i>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-3">
				<div class="panel panel-body bg-success-400 has-bg-image">
					<div class="media no-margin">
						<div class="media-left media-middle">
							<i class="icon-pointer icon-3x opacity-75"></i>
						</div>

						<div class="media-body text-right">
							<h3 class="no-margin">652,549</h3>
							<span class="text-uppercase text-size-mini">total shop</span>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-3">
				<div class="panel panel-body bg-indigo-400 has-bg-image">
					<div class="media no-margin">
						<div class="media-left media-middle">
							<i class="icon-enter6 icon-3x opacity-75"></i>
						</div>

						<div class="media-body text-right">
							<h3 class="no-margin">245,382</h3>
							<span class="text-uppercase text-size-mini">total visits</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /simple statistics -->

		<!-- Sell charts -->
		<div class="row">
			<div class="col-lg-7">

				<!-- Traffic sources -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">This Week and last Week Sell Report</h6>
						<div class="heading-elements">
							
						</div>
					</div>

					<div class="panel-body">
						This Week and last Week Sell Report
					</div>

					
				</div>
				<!-- /traffic sources -->

			</div>

			<div class="col-lg-5">

				<!-- Sales stats -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Monthly Sell Analytic Report</h6>
						<div class="heading-elements">
							
	                	</div>
					</div>

					<div class="panel-body">
						Monthly Sell Analytic Report
					</div>
				</div>
				<!-- /sales stats -->

			</div>
		</div>
		<!-- /Sell charts -->

		<!-- Visitors charts -->
		<div class="row">
			<div class="col-lg-7">

				<!-- Traffic sources -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">This Week and last Week visitor Report</h6>
						<div class="heading-elements">
							
						</div>
					</div>

					<div class="panel-body">
						This Week and last Week visitor Report
					</div>

					
				</div>
				<!-- /traffic sources -->

			</div>

			<div class="col-lg-5">

				<!-- Sales stats -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Monthly visitor Analytic Report</h6>
						<div class="heading-elements">
							
	                	</div>
					</div>

					<div class="panel-body">
						Monthly visitor Analytic Report
					</div>
				</div>
				<!-- /sales stats -->

			</div>
		</div>
		<!-- /Visitors charts -->


		<!-- Dashboard content -->
		<div class="row">
			<div class="col-lg-8">

				<!-- /Order History -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Order History</h6>
						<div class="heading-elements">
							<span class="label bg-success heading-text">28 active</span>
							<ul class="icons-list">
		                		<li class="dropdown">
		                			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="#"><i class="icon-sync"></i> Update data</a></li>
										<li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
										<li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
										<li class="divider"></li>
										<li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
									</ul>
		                		</li>
		                	</ul>
	                	</div>
					</div>

					{{-- <div class="table-responsive">
						<table class="table table-lg text-nowrap">
							<tbody>
								<tr>
									<td class="col-md-5">
										<div class="media-left">
											<div id="campaigns-donut"></div>
										</div>

										<div class="media-left">
											<h5 class="text-semibold no-margin">38,289 <small class="text-success text-size-base"><i class="icon-arrow-up12"></i> (+16.2%)</small></h5>
											<ul class="list-inline list-inline-condensed no-margin">
												<li>
													<span class="status-mark border-success"></span>
												</li>
												<li>
													<span class="text-muted">May 12, 12:30 am</span>
												</li>
											</ul>
										</div>
									</td>

									<td class="col-md-5">
										<div class="media-left">
											<div id="campaign-status-pie"></div>
										</div>

										<div class="media-left">
											<h5 class="text-semibold no-margin">2,458 <small class="text-danger text-size-base"><i class="icon-arrow-down12"></i> (- 4.9%)</small></h5>
											<ul class="list-inline list-inline-condensed no-margin">
												<li>
													<span class="status-mark border-danger"></span>
												</li>
												<li>
													<span class="text-muted">Jun 4, 4:00 am</span>
												</li>
											</ul>
										</div>
									</td>

									<td class="text-right col-md-2">
										<a href="#" class="btn bg-indigo-300"><i class="icon-statistics position-left"></i> View report</a>
									</td>
								</tr>
							</tbody>
						</table>	
					</div> --}}

					<div class="table-responsive">
						<table class="table text-nowrap">
							<thead>
								<tr>
									<th>Product Name</th>
									<th class="col-md-2">Client Name</th>
									<th class="col-md-1">Quentity</th>
									<th class="col-md-2">Ammout</th>
									<th class="col-md-2">Status</th>
									<th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
								</tr>
							</thead>
							<tbody>
								<tr class="active border-double">
									<td colspan="5">Today</td>
									<td class="text-right">
										<span class="progress-meter" id="today-progress" data-progress="30"></span>
									</td>
								</tr>
								<tr>
									<td>
										<div class="media-left media-middle">
											<a href="#"><img src="{{ asset('public/artisan/assets') }}/images/brands/facebook.png" class="img-circle img-md" alt=""></a>
										</div>
										<div class="media-left">
											<div class=""><a href="#" class="text-default text-semibold">Facebook</a></div>
											<div class="text-muted text-size-small">
												<span class="status-mark border-blue position-left"></span>
												02:00 - 03:00
											</div>
										</div>
									</td>
									<td><span class="text-muted">Mintlime</span></td>
									<td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> 2.43%</span></td>
									<td><h6 class="text-semibold">$5,489</h6></td>
									<td><span class="label bg-blue">Active</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
													<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
													<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
													<li class="divider"></li>
													<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>
										<div class="media-left media-middle">
											<a href="#"><img src="{{ asset('public/artisan/assets') }}/images/brands/youtube.png" class="img-circle img-md" alt=""></a>
										</div>
										<div class="media-left">
											<div class=""><a href="#" class="text-default text-semibold">Youtube videos</a></div>
											<div class="text-muted text-size-small">
												<span class="status-mark border-danger position-left"></span>
												13:00 - 14:00
											</div>
										</div>
									</td>
									<td><span class="text-muted">CDsoft</span></td>
									<td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> 3.12%</span></td>
									<td><h6 class="text-semibold">$2,592</h6></td>
									<td><span class="label bg-danger">Closed</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
													<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
													<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
													<li class="divider"></li>
													<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								

								<tr class="active border-double">
									<td colspan="5">Yesterday</td>
									<td class="text-right">
										<span class="progress-meter" id="yesterday-progress" data-progress="65"></span>
									</td>
								</tr>
								<tr>
									<td>
										<div class="media-left media-middle">
											<a href="#"><img src="{{ asset('public/artisan/assets') }}/images/brands/bing.png" class="img-circle img-xs" alt=""></a>
										</div>
										<div class="media-left">
											<div class=""><a href="#" class="text-default text-semibold">Bing campaign</a></div>
											<div class="text-muted text-size-small">
												<span class="status-mark border-success position-left"></span>
												15:00 - 16:00
											</div>
										</div>
									</td>
									<td><span class="text-muted">Metrics</span></td>
									<td><span class="text-danger"><i class="icon-stats-decline2 position-left"></i> - 5.78%</span></td>
									<td><h6 class="text-semibold">$970</h6></td>
									<td><span class="label bg-success-400">Pending</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropup">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
													<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
													<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
													<li class="divider"></li>
													<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>
										<div class="media-left media-middle">
											<a href="#"><img src="{{ asset('public/artisan/assets') }}/images/brands/amazon.png" class="img-circle img-xs" alt=""></a>
										</div>
										<div class="media-left">
											<div class=""><a href="#" class="text-default text-semibold">Amazon ads</a></div>
											<div class="text-muted text-size-small">
												<span class="status-mark border-danger position-left"></span>
												18:00 - 19:00
											</div>
										</div>
									</td>
									<td><span class="text-muted">Blueish</span></td>
									<td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> 6.79%</span></td>
									<td><h6 class="text-semibold">$1,540</h6></td>
									<td><span class="label bg-blue">Active</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropup">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
													<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
													<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
													<li class="divider"></li>
													<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								
							</tbody>
						</table>
					</div>
				</div>
				<!-- /Order History -->

				<!-- Top Buyer History -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Top Buyer History</h6>
						<div class="heading-elements">
							<span class="heading-text">Balance: <span class="text-bold text-danger-600 position-right">$4,378</span></span>
							<ul class="icons-list">
		                		<li class="dropdown text-muted">
		                			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="caret"></span></a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="#"><i class="icon-sync"></i> Update data</a></li>
										<li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
										<li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
										<li class="divider"></li>
										<li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
									</ul>
		                		</li>
		                	</ul>
						</div>
					</div>

					<div class="panel-body">
						<div id="sales-heatmap"></div>
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
								<tr>
									<td>
										<div class="media-left media-middle">
											<a href="#" >
												<img src="{{ asset('public/artisan/assets') }}/images/brands/facebook.png" class="img-circle img-md" alt="">
											</a>
										</div>

										<div class="media-body">
											<div class="media-heading">
												<a href="#" class="letter-icon-title">Sigma application</a>
											</div>

											<div class="text-muted text-size-small"><i class="icon-checkmark3 text-size-mini position-left"></i> New order</div>
										</div>
									</td>
									<td>
										<span class="text-muted text-size-small">06:28 pm</span>
									</td>
									<td>
										<h6 class="text-semibold no-margin">$49.90</h6>
									</td>
								</tr>

								<tr>
									<td>
										<div class="media-left media-middle">
											<a href="#" >
												<img src="{{ asset('public/artisan/assets') }}/images/brands/facebook.png" class="img-circle img-md" alt="">
											</a>
										</div>

										<div class="media-body">
											<div class="media-heading">
												<a href="#" class="letter-icon-title">Alpha application</a>
											</div>

											<div class="text-muted text-size-small"><i class="icon-spinner11 text-size-mini position-left"></i> Renewal</div>
										</div>
									</td>
									<td>
										<span class="text-muted text-size-small">04:52 pm</span>
									</td>
									<td>
										<h6 class="text-semibold no-margin">$90.50</h6>
									</td>
								</tr>

								<tr>
									<td>
										<div class="media-left media-middle">
											<a href="#" >
												<img src="{{ asset('public/artisan/assets') }}/images/brands/facebook.png" class="img-circle img-md" alt="">
											</a>
										</div>

										<div class="media-body">
											<div class="media-heading">
												<a href="#" class="letter-icon-title">Delta application</a>
											</div>

											<div class="text-muted text-size-small"><i class="icon-lifebuoy text-size-mini position-left"></i> Support</div>
										</div>
									</td>
									<td>
										<span class="text-muted text-size-small">01:26 pm</span>
									</td>
									<td>
										<h6 class="text-semibold no-margin">$60.00</h6>
									</td>
								</tr>

								
							</tbody>
						</table>
					</div>
				</div>
				<!-- /Top Buyer History -->

				<!-- Latest Product Review -->
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
				<!-- /Latest Product Review -->

			</div>

			<div class="col-lg-4">

				<!-- Top Sell Products -->
		    	<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Top Products History</h6>
						<div class="heading-elements">
							<ul class="icons-list">
		                		<li><a data-action="collapse"></a></li>
		                		<li><a data-action="reload"></a></li>
		                		<li><a data-action="close"></a></li>
		                	</ul>
	                	</div>
					</div>

					<ul class="media-list media-list-linked pb-5">
						<li class="media-header text-uppercase text-danger-600">Top Sell Products <span class="pull-right text-uppercase text-success-600">Quentity</span></li>

						<li class="media">
							<a href="#" class="media-link">
								<div class="media-left"><img src="{{ asset('public/artisan/assets') }}/images/brands/facebook.png" class="img-circle img-md" alt=""></div>
								<div class="media-body">
									<span class="media-heading text-semibold">James Alexander</span>
									<span class="media-annotation">UI/UX expert</span>
								</div>
								<div class="media-right media-middle">
									<span >56</span>
								</div>
							</a>
						</li>

						<li class="media">
							<a href="#" class="media-link">
								<div class="media-left"><img src="{{ asset('public/artisan/assets') }}/images/brands/facebook.png" class="img-circle img-md" alt=""></div>
								<div class="media-body">
									<span class="media-heading text-semibold">Jeremy Victorino</span>
									<span class="media-annotation">Senior designer</span>
								</div>
								<div class="media-right media-middle">
									<span >56</span>
								</div>
							</a>
						</li>

						<li class="media">
							<a href="#" class="media-link">
								<div class="media-left"><img src="{{ asset('public/artisan/assets') }}/images/brands/facebook.png" class="img-circle img-md" alt=""></div>
								<div class="media-body">
									<div class="media-heading"><span class="text-semibold">Jordana Mills</span></div>
									<span class="text-muted">Sales consultant</span>
								</div>
								<div class="media-right media-middle">
									<span >56</span>
								</div>
							</a>
						</li>

						<li class="media">
							<a href="#" class="media-link">
								<div class="media-left"><img src="{{ asset('public/artisan/assets') }}/images/brands/facebook.png" class="img-circle img-md" alt=""></div>
								<div class="media-body">
									<div class="media-heading"><span class="text-semibold">William Miles</span></div>
									<span class="text-muted">SEO expert</span>
								</div>
								<div class="media-right media-middle">
									<span >56</span>
								</div>
							</a>
						</li>

						<li class="media-header text-uppercase text-success-600" style="border-bottom: 1px solid #ddd;">Top Rating Product <span class="pull-right text-uppercase text-warning">*****</span></li>

						<li class="media">
							<a href="#" class="media-link">
								<div class="media-left"><img src="{{ asset('public/artisan/assets') }}/images/brands/facebook.png" class="img-circle img-md" alt=""></div>
								<div class="media-body">
									<span class="media-heading text-semibold">Margo Baker</span>
									<span class="media-annotation">Google</span>
								</div>
								<div class="media-right media-middle">
									<span >5.00</span>
								</div>
							</a>
						</li>

						<li class="media">
							<a href="#" class="media-link">
								<div class="media-left"><img src="{{ asset('public/artisan/assets') }}/images/brands/facebook.png" class="img-circle img-md" alt=""></div>
								<div class="media-body">
									<span class="media-heading text-semibold">Beatrix Diaz</span>
									<span class="media-annotation">Facebook</span>
								</div>
								<div class="media-right media-middle">
									<span >4.8</span>
								</div>
							</a>
						</li>

						<li class="media">
							<a href="#" class="media-link">
								<div class="media-left"><img src="{{ asset('public/artisan/assets') }}/images/brands/facebook.png" class="img-circle img-md" alt=""></div>
								<div class="media-body">
									<span class="media-heading text-semibold">Richard Vango</span>
									<span class="media-annotation">Microsoft</span>
								</div>
								<div class="media-right media-middle">
									<span >4.5</span>
								</div>
							</a>
						</li>
					</ul>
				</div>
				<!-- /Top Seall Product -->

				<!-- My messages -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">User Questions</h6>
						<div class="heading-elements">
							{{-- <span class="heading-text"><i class="icon-history text-warning position-left"></i> Jul 7, 10:30</span> --}}
							<span class="label bg-success heading-text">Online</span>
							<ul class="icons-list">
		                		<li><a data-action="collapse"></a></li>
		                		<li><a data-action="reload"></a></li>
		                		<li><a data-action="close"></a></li>
		                	</ul>
						</div>
					</div>

					<!-- Numbers -->
					<div class="container-fluid">
						<div class="row text-center">
							<div class="col-md-4">
								<div class="content-group">
									<h6 class="text-semibold no-margin"><i class="icon-clipboard3 position-left text-slate"></i> 2,345</h6>
									<span class="text-muted text-size-small">unseen Question</span>
								</div>
							</div>

							<div class="col-md-4">
								<div class="content-group">
									<h6 class="text-semibold no-margin"><i class="icon-calendar3 position-left text-slate"></i> 3,568</h6>
									<span class="text-muted text-size-small">unreply Question</span>
								</div>
							</div>

							<div class="col-md-4">
								<div class="content-group">
									<h6 class="text-semibold no-margin"><i class="icon-comments position-left text-slate"></i> 32,693</h6>
									<span class="text-muted text-size-small">all Question</span>
								</div>
							</div>
						</div>
					</div>
					<!-- /numbers -->


					<!-- Area chart -->
					<div id="messages-stats"></div>
					<!-- /area chart -->


					<!-- Tabs -->
                	<ul class="nav nav-lg nav-tabs nav-justified no-margin no-border-radius bg-indigo-400 border-top border-top-indigo-300">
						<li class="active">
							<a href="#today" class="text-size-small text-uppercase" data-toggle="tab">
								Today
							</a>
						</li>
						<li>
							<a href="#unseen" class="text-size-small text-uppercase" data-toggle="tab">
								Unseen
							</a>
						</li>
						<li>
							<a href="#unreply" class="text-size-small text-uppercase" data-toggle="tab">
								Unreply
							</a>
						</li>
					</ul>
					<!-- /tabs -->


					<!-- Tabs content -->
					<div class="tab-content">
						<div class="tab-pane active fade in has-padding" id="today">
							<ul class="media-list">
								<li class="media">
									<div class="media-left">
										<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-circle img-xs" alt="">
										<span class="badge bg-danger-400 media-badge">8</span>
									</div>

									<div class="media-body">
										<a href="#">
											James Alexander
											<span class="media-annotation pull-right">14:58</span>
										</a>

										<span class="display-block text-muted">The constitutionally inventoried precariously...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-circle img-xs" alt="">
										<span class="badge bg-danger-400 media-badge">6</span>
									</div>

									<div class="media-body">
										<a href="#">
											Margo Baker
											<span class="media-annotation pull-right">12:16</span>
										</a>

										<span class="display-block text-muted">Pinched a well more moral chose goodness...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-circle img-xs" alt="">
									</div>

									<div class="media-body">
										<a href="#">
											Jeremy Victorino
											<span class="media-annotation pull-right">09:48</span>
										</a>

										<span class="display-block text-muted">Pert thickly mischievous clung frowned well...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-circle img-xs" alt="">
									</div>

									<div class="media-body">
										<a href="#">
											Beatrix Diaz
											<span class="media-annotation pull-right">05:54</span>
										</a>

										<span class="display-block text-muted">Nightingale taped hello bucolic fussily cardinal...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-circle img-xs" alt="">
									</div>

									<div class="media-body">
										<a href="#">
											Richard Vango
											<span class="media-annotation pull-right">01:43</span>
										</a>
										
										<span class="display-block text-muted">Amidst roadrunner distantly pompously where...</span>
									</div>
								</li>
							</ul>
						</div>

						<div class="tab-pane fade has-padding" id="unseen">
							<ul class="media-list">
								<li class="media">
									<div class="media-left">
										<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-circle img-sm" alt="">
									</div>

									<div class="media-body">
										<a href="#">
											Isak Temes
											<span class="media-annotation pull-right">Tue, 19:58</span>
										</a>

										<span class="display-block text-muted">Reasonable palpably rankly expressly grimy...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-circle img-sm" alt="">
									</div>

									<div class="media-body">
										<a href="#">
											Vittorio Cosgrove
											<span class="media-annotation pull-right">Tue, 16:35</span>
										</a>

										<span class="display-block text-muted">Arguably therefore more unexplainable fumed...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-circle img-sm" alt="">
									</div>

									<div class="media-body">
										<a href="#">
											Hilary Talaugon
											<span class="media-annotation pull-right">Tue, 12:16</span>
										</a>

										<span class="display-block text-muted">Nicely unlike porpoise a kookaburra past more...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-circle img-sm" alt="">
									</div>

									<div class="media-body">
										<a href="#">
											Bobbie Seber
											<span class="media-annotation pull-right">Tue, 09:20</span>
										</a>

										<span class="display-block text-muted">Before visual vigilantly fortuitous tortoise...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-circle img-sm" alt="">
									</div>

									<div class="media-body">
										<a href="#">
											Walther Laws
											<span class="media-annotation pull-right">Tue, 03:29</span>
										</a>
										
										<span class="display-block text-muted">Far affecting more leered unerringly dishonest...</span>
									</div>
								</li>
							</ul>
						</div>

						<div class="tab-pane fade has-padding" id="unreply">
							<ul class="media-list">
								<li class="media">
									<div class="media-left">
										<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-circle img-sm" alt="">
									</div>

									<div class="media-body">
										<a href="#">
											Owen Stretch
											<span class="media-annotation pull-right">Mon, 18:12</span>
										</a>

										<span class="display-block text-muted">Tardy rattlesnake seal raptly earthworm...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-circle img-sm" alt="">
									</div>

									<div class="media-body">
										<a href="#">
											Jenilee Mcnair
											<span class="media-annotation pull-right">Mon, 14:03</span>
										</a>

										<span class="display-block text-muted">Since hello dear pushed amid darn trite...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-circle img-sm" alt="">
									</div>

									<div class="media-body">
										<a href="#">
											Alaster Jain
											<span class="media-annotation pull-right">Mon, 13:59</span>
										</a>

										<span class="display-block text-muted">Dachshund cardinal dear next jeepers well...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-circle img-sm" alt="">
									</div>

									<div class="media-body">
										<a href="#">
											Sigfrid Thisted
											<span class="media-annotation pull-right">Mon, 09:26</span>
										</a>

										<span class="display-block text-muted">Lighted wolf yikes less lemur crud grunted...</span>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<img src="{{ asset('public/artisan/assets') }}/images/placeholder.jpg" class="img-circle img-sm" alt="">
									</div>

									<div class="media-body">
										<a href="#">
											Sherilyn Mckee
											<span class="media-annotation pull-right">Mon, 06:38</span>
										</a>
										
										<span class="display-block text-muted">Less unicorn a however careless husky...</span>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<!-- /tabs content -->

				</div>
				<!-- /my messages -->

			</div>
		</div>
		<!-- /dashboard content -->

		<div class="row">
			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
				<!-- Letest Products  -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Unpublish Products History</h5>
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
				<!-- /Letest Products -->
				
			</div>
		</div>
	</div>
	<!-- /content area -->

@endsection