@extends('admin.master')

@section('title')
View Order
@endsection

@section('asset')
<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/selects/select2.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/ecommerce_orders_history.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/ripple.min.js') }}"></script>

<!-- /theme JS files -->
@endsection

@section('content')

<!-- Content area -->
<div class="content">
  <!-- Orders history (datatable) -->
        <div class="panel panel-white">
          <div class="panel-heading">
            <h6 class="panel-title">Orders history</h6>
            <div class="heading-elements">
              <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <!-- <li><a data-action="close"></a></li> -->
              </ul>
            </div>
          </div>

          <table class="table text-nowrap">
            <thead>
              <tr>
                <th>Customer Info</th>
                <th>Email Address</th>
                <th>Total Quantity</th>
                <th>Total Amount </th>
                <th>Order Date</th>
                <th>Status</th>
                <th class="text-center"><i class="icon-arrow-down12"></i></th>
              </tr>
            </thead>
            <tbody>
              @forelse($orders as $order)
              <tr>
                <td>
                    <div class="media-left media-middle">
                        <?php
                            $userInfo = App\User::where('id', $order->consumerId)->select('name','email','avater','phoneNo')->first();
                            $image = $userInfo->avater;
                            if(!file_exists($image)){
                                $image = 'public/artisan/assets/images/placeholder.jpg'; 
                            }
                        ?>
                        <a href="{{ route('user.singel.view', $order->consumerId) }}">
                            <img src="{{ asset( $image ) }}" class="img-circle img-md" alt="{{ $userInfo->name }}">
                        </a>
                    </div>
                    <div class="media-left">
                        <div class="">
                            <a href="{{ route('shop.singel.order',$order->orderId) }}" class="text-default text-semibold">{{ $userInfo->name }}</a>
                        </div>
                        <div class="text-muted text-size-small">
                            <span class="status-mark border-blue position-left"></span>
                                {{ $userInfo->phoneNo }}
                        </div>
                    </div>
                </td>
                <td><span class="text-semibold">{{ $userInfo->email }}</span></td>
                <td>{{ $order->totalProduct }}</td>
                <td><span>&#2547; {{ number_format($order->totalAmmount)}}</span></td>
                
                <td>
                  <?php 
                    $date = new DateTime($order->created_at);
                    $orderDate = date_format($date, 'd F y');
                  ?>
                  <span class="text-semibold">{{ $orderDate }}</span>
                </td>
                <td>
                    @if($order->status == 0)
                      <span class="label bg-warning">Hold</span>
                    @else
                      <span class="label bg-success">Shipped</span>
                    @endif
                </td>
                <td class="text-center">
                  <ul class="icons-list">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                      <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="{{ route('order.shipping.mail', $order->id) }}"><i class="icon-truck"></i>Send Shipping Confirm Mail</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('singel.order', $order->id) }}"><i class="icon-warning2"></i>Full View</a></li>
                      </ul>
                    </li>
                  </ul>
                </td>
              </tr>
              @empty
              <tr>
                <td>01.Empty</td>
                <td  rowspan="7"><label class="text-center text-bold text-info">No Order View</label></td>
              </tr>

              @endforelse
            </tbody>
          </table>
        </div>
        <!-- /orders history (datatable) -->

</div>
<!-- Content area -->
@endsection
