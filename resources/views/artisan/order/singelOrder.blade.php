@extends('artisan.master')

@section('title')
Singel Order
@endsection

@section('asset')
<!-- Theme JS files -->
  <script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/ripple.min.js') }}"></script>
<style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  td, th {
    border: 1px solid #000;
    text-align: left;
    padding: 8px;
  }
  .ordertop-tx{
    border-bottom: 1px dotted #000;
    padding-bottom: 20px;
  }
  .orderDelivery-tx{
    border: 1px solid #000;
    margin: 20px 0;
  }
  .orderDelivery-tx-right span{
    padding-left: 10px;
  }
  .orderDelivery-tx-right{
    padding-top: 10px;
  }
  .sub-total{
    float: right;
    padding-right: 20px;
  }
  .sub-total span1{
    padding-left: 28px;
  }
  .sub-total span2{
    padding-left: 10px;
  }
  .footer-text{
    padding-top: 20px;
  }
</style>
<!-- /theme JS files -->
@endsection

@section('body')
  <div class="content">
    <!-- Invoice template -->
    <div class="panel panel-white">
      <div class="panel-heading">
        <h6 class="panel-title">Single Order Information</h6>
        <div class="heading-elements">
          <a href="{{ route('shop.invoice',['orderId'=>$orderInfo->id,'type'=>'V']) }}"  class="btn btn-info btn-sm heading-btn"><i class="icon-eye position-left"></i> Preview</a>
          <a href="{{ route('shop.invoice',['orderId'=>$orderInfo->id,'type'=>'D']) }}"  class="btn btn-success btn-sm heading-btn"><i class="icon-download4 position-left"></i> Download</a>
        </div>
      </div>

      <div class="panel-body no-padding-bottom">


          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="ordertop-tx">
              <p>Dispatch to:</p>
              <h3>Send Cargo <span>{{ ucfirst($userInfo->name) }}</span></h3>
              @if($shippingInfo->houseNo)
                <h3>{{ $shippingInfo->houseNo }}</h3>
              @endif
              @if($shippingInfo->roadNo)
                <h3>{{ $shippingInfo->roadNo }}</h3>
              @endif
              @if($shippingInfo->areaName)
                <h3>{{ $shippingInfo->areaName }}</h3>
              @endif
              @if($shippingInfo->policeStation)
                <h3>{{ $shippingInfo->policeStation }}</h3>
              @endif
                <?php
                $areaName = App\TransportLocation::where('id',$shippingInfo->areaId )->value('areaName');
                $disName = App\TransportLocation::where('id',$shippingInfo->districtId )->value('areaName');
                $divName = App\TransportLocation::where('id',$shippingInfo->divisionId )->value('areaName');
                ?>
              <h3>{{ $areaName }} -{{ $shippingInfo->zipCode }} , {{ $disName }} , {{ $divName }} </h3>
            </div>
            <div class="orderID-tx">
              <h3>Order ID: 202-55557775-3124444</h3>
              <p>Thank you for Buying from Analogue Seduction on Amaxon Marketplace</p>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 orderDelivery-tx">
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="orderDelivery-tx-left">
                  <h6>Detivery address:</h6>
                  <p>Send Cargo <span>{{ ucfirst($userInfo->name) }}</span></p>
                  @if($shippingInfo->houseNo)
                    <p>{{ $shippingInfo->houseNo }}</p>
                  @endif
                  @if($shippingInfo->roadNo)
                    <p>{{ $shippingInfo->roadNo }}</p>
                  @endif
                  @if($shippingInfo->areaName)
                    <p>{{ $shippingInfo->areaName }}</p>
                  @endif
                  @if($shippingInfo->policeStation)
                    <p>{{ $shippingInfo->policeStation }}</p>
                  @endif
                  <p>{{ $areaName }} -{{ $shippingInfo->zipCode }} , {{ $disName }} , {{ $divName }} </p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="orderDelivery-tx-right">
                    <?php
                    $date = new DateTime($shippingInfo->created_at);
                    $orderDate = date_format($date, 'd F Y');
                    ?>
                  <p>Order Date: <Span>{{ $orderDate }}</Span></p>
                  <p>Delivery Service: <Span>Standard</Span></p>
                  <p>Buyer Name: <Span>{{ ucfirst($userInfo->name) }}</Span></p>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="pro-table-tx">
                <table class="table table-orders-history text-nowrap">
                  <tr>
                    <th>Quantity</th>
                    <th>Product Details</th>
                    <th>Unite-Price</th>
                    <th>Sub-Total</th>
                  </tr>
                  @foreach($orderProducts as $orderProduct)
                    <tr>
                      <td>{{ $orderProduct->productQuantity}}</td>
                      <td>
                        <h4>{{ $orderProduct->productName }}</h4>
                        <p>ProductId: <span>{{ $orderProduct->productCode }}</span></p>
                        <p>Size: <span>{{ App\Size::where('id',$orderProduct->sizes )->value('sizeTitle') }}</span></p>
                        <p>Color: <span>{{  App\PrimaryColor::where('id',$orderProduct->priColor)->value('colorName')}}</span></p>
                        <p>Saller:
                          @if($orderProduct->ownerId !=0)
                            <span class="text-semibold">{{ ucfirst(App\Shop::where('id', $orderProduct->ownerId)->value('shopName')) }} </span>
                          @else
                            <span class="text-semibold text-info">Dorpon</span>
                          @endif

                        </p>
                      </td>
                      <td>Tk. {{ number_format($orderProduct->productPrice)}}</td>
                      <td>Tk. {{ number_format($orderProduct->subTotal)}}</td>
                    </tr>
                  @endforeach
                  <table >
                    <td>
                      <div class="sub-total">
                        <h4>Order-Price <span1>Tk. {{ number_format($orderInfo->totalAmmount - $orderInfo->deliveryPrice )}}</span1></h4>
                        <h4>Delivery-Price <span2>Tk. {{ number_format($orderInfo->deliveryPrice) }}</span2></h4>
                      </div>
                    </td>
                  </table>
                  <table>
                    <td>
                      <div class="sub-total">
                        <h3>Order Tolal TK. {{ number_format($orderInfo->totalAmmount) }} </h3>
                      </div>
                    </td>
                  </table>
                </table>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="footer-text">
                <h4>Thanks for buying on Amazon Marketplace.To  provide feedback for the seller please visit <a href="">www.mydorpon.com</a>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id cum nisi voluptatem odit dolores, qui inventore voluptate, vitae repudiandae voluptatibus.</h4>
              </div>
            </div>
          </div>

      </div>
    </div>
    <!-- /invoice template -->
  </div>

@endsection
