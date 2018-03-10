@extends('artisan.master')

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

@section('body')

<!-- Content area -->
<div class="content">
  <!-- Orders history (datatable) -->
        <div class="panel panel-white">
          <div class="panel-heading">
            <h6 class="panel-title">Orders History</h6>
            <div class="heading-elements">
              <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <!-- <li><a data-action="close"></a></li> -->
              </ul>
            </div>
          </div>

          <table class="table  text-nowrap">
            <thead>
              <tr>
                <th>Product name</th>
                <th>Buyer name</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Price</th>
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
                                  echo  $orderDate = date_format($date, 'd M y');
                              ?>
                    </div>
                  </div>
                </td>
                <td><span class="text-semibold">{{ $order->name }}</span></td>
                <td>Not Define</td>
                <!-- <td><span>&#2547; {{ number_format($order->productPrice , 2, '.', ',')}}</span></td> -->
                <td>{{ $order->productQuantity }}</td>
                <td>
                  <h6 class="no-margin text-semibold">Tk. {{ number_format($order->subTotal)}} </h6>
                </td>
                <td>
                    @if($order->status == 0)
                      <span class="label bg-warning-400">Hold</span>
                    @else
                      <span class="label bg-success-600">Shipped</span>
                    @endif
                  </td>
                <td class="text-center">
                  <ul class="icons-list">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                      <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="{{ route('shop.shipping.order', $order->id) }}"><i class="icon-truck"></i> In Shipping</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('shop.singel.order', $order->orderId) }}"><i class="icon-warning2"></i>Full View</a></li>
                      </ul>
                    </li>
                  </ul>
                </td>
              </tr>
              @empty
              <tr>
                
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
