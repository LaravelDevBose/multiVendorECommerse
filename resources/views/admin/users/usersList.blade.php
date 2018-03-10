@extends('admin.master')

@section('title')
Customers List
@endsection

@section('asset')
<!-- Theme JS files -->
	
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/datatables_sorting.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/ripple.min.js') }}"></script>
<!-- /theme JS files -->
@endsection

@section('content')
<div class="content">
	@include('admin.includes.message')
	<div class="row">
		<div class="col-md-12">

			<!-- Complex headers with sorting -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">Registered Customers Information</h5>
					<div class="heading-elements">
						<ul class="icons-list">
	                		<li><a data-action="collapse"></a></li>
	                		<li><a data-action="reload"></a></li>
	                		<!-- <li><a data-action="close"></a></li> -->
	                	</ul>
                	</div>
				</div>

				<table class="table table-bordered datatable-complex-header">
					<thead>
						<tr>
                            <th rowspan="2">Customer Info</th>
                            <th colspan="2">Contact Info</th>
                            <th colspan="2">Order Info</th>
                            <th rowspan= "2">Action</th>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <th>Email Address</th>
                            <th>T.Purchase</th>
                            <th>T.Amount( Tk.)</th>
                            
                        </tr>
					</thead>
					<tbody>
						@forelse($users as $user)
			            <tr>
                            <td>
                            	<div class="media-left media-middle">
									<a href="#">
										<?php
					                        $userImage = $user->avater ;
					                        if(!file_exists($userImage)){
					                          $userImage = 'public/images/default/profileDeatult.png'; 
					                        }
					                     ?>
										<img src="{{ asset( $userImage ) }}" class="img-circle img-lg" alt="">
									</a>
								</div>
								<div class="media-left">
									<div class=""><a href="#" class="text-default text-bold text-uppercase">{{ $user->name }}</a></div>
									<div class="text-muted text-size-small">
										<!-- <i class="icon-pushpin border-blue position-left"></i> -->
										<span class="icon-pushpin text-size-small text-info "></span>
										<?php 
						                  	$date = new DateTime($user->created_at);
						                  	$joinDate = date_format($date, 'd M Y');
						                ?>
										{{ $joinDate }}
									</div>
								</div>
                            </td>
                            <td>{{ $user->phoneNo }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                            	<?php echo App\Order::where('consumerId',$user->id)->sum('totalProduct');?>
                            </td>
                            <td>
                            	Tk.<?php echo App\Order::where('consumerId',$user->id)->sum('totalAmmount');?>
                            </td>
                            <td>
                            	<a href="{{ route('user.singel.view', $user->id) }}" title="View Shop" class="btn btn-info btn-sm"><i class="icon-eye"></i></a>
                            	<!-- <button title="Block Shop" class="btn btn-danger btn-sm"><i class="icon-eye-blocked"></i></button> -->
                            </td>
                        </tr>

                        @empty
                        	<tr>
                        		<td colspan="7">
                        			<span class="text-semibold text-info">No Customer's Account Information Found..!!</span>
                        		</td>
                        	</tr>

                        @endforelse

			        </tbody>
				</table>
			</div>
			<!-- /complex headers with sorting -->
			
		</div>
	</div>

</div>

@endsection