@extends('frontEnd.master')

@section('title')
Dorpon-PaymentInfo
@endsection

@section('headasset')
<link href="{{asset('public/frontEnd/css/style.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/main.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/bootstrap-select.css')}}" rel="stylesheet">
<link href="{{ asset('public/frontEnd/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        
@endsection

@section('content')
    <hr>
@include('frontEnd.includes.message')
<div class="container heading"><h4>ORDER SUMMARY</h4></div>
<section class="cart-warp">
    @if (Session::get('emptyMsg'))
        <div class="promo-code">
            <h3 class="text-center text-info">{{ Session::get('emptyMsg') }}</h3>
        </div>
    @endif

    <div class="container wraper-edited">
        <div class="wraper-price-edite">
            <div class="row goods-item">
                <div class="col-lg-5 col-md-6 col-sm-6 col-xs-3 goods-part" id="item-info">
                    <h5>ITEM</h5>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 goods-part text-center" id="qty">
                    <h5 id="big">QUANTITY</h5>
                    <h5 id="small">QTY</h5>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 goods-part" id="ut-p">
                    <h5 class="pull- right" id="big">UNIT PRICE (Tk. )</h5>
                    <h5 id="small">PRICE (Tk. )</h5>
                </div>
                <div class="col-lg-3 col-md-2 col-sm-2 col-xs-3 goods-part" id="total">
                    <h5 class="pull-right">TOTAL (Tk.)</h5>
                </div>
            </div>
        </div>

    </div>
    <div id="cartViewList">
        <?php $totalPrice=0 ; $totalProduct=0; $total=0;?>
        @foreach( $cartProducts as $cartProduct )
            <div class="container wraper-price">
                <div class="wraper-price-edite">
                    <div class="row goods-item">
                        <div class="col-lg-5 col-sm-6 col-md-6 col-xs-12 goods-promo  item-info">
                            <?php $productImage = App\Product::where('id', $cartProduct->id)->value('thumbImage');  if(!file_exists($productImage)){ $productImage='public/artisan/assets/images/placeholder.jpg'; }?>
                            <img class="pull-left" src="{{ asset($productImage)}}" alt="{{ $cartProduct->name }}">
                            <div class="item-title">
                                <a href="{{ route('product',$cartProduct->id) }}">{{ ucwords($cartProduct->name) }}</a>
                            </div>
                            {{--<a class="remove" style="text-decoration:none;" href="{{ route('cart.remove',$cartProduct->rowId) }}" title="Remove"><i  class="fa fa-times" aria-hidden="true"></i></a>--}}

                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 quantity  text-center">
                            <h5 class="pull-right">{{ $cartProduct->qty }}</h5>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 ut-p ">
                            <h5 class="pull-right">{{ number_format($cartProduct->price)}}</h5>
                        </div>
                        <div class="col-lg-3 col-md-2 col-xs-4 col-sm-2  total ">
                            <h5  class="pull-right">
                                {{ number_format($cartProduct->price*$cartProduct->qty)}} </h5>
                        </div>
                    </div>
                </div>
            </div>
            <?php $totalPrice= $totalPrice +($cartProduct->price*$cartProduct->qty); $totalProduct++; ?>
        @endforeach


        <div class="container total-cosr-wraper">
            <div class="total-cosr-banner">
                <div class="total-cost">
                    <div class="promo-code pull-left">
                        <h3>promo code</h3>
                        <p>Type Your Promo Code to Get Discount</p>
                        <input type="text" name="name" placeholder="Write Code Here">
                        <label>Apply</label>
                    </div>
                    <div class="sub-total pull-right">
                        <div class="subtotal-calculate">
                            <h3>subtotal : Tk. <span id="subTotal">{{ number_format($totalPrice) }}</span></h3>
                            <p>savings : <span> Tk. 0</span></p>
                            <p>Cart Weight : <span>{{ Session::get('cartWeight') }}KG. </span></p>
                            <p>Delivery Change : <span> Tk.{{ number_format(Session::get('deliveryPrice')) }} </span></p>
                            <hr>
                            <?php $total = $totalPrice + Session::get('deliveryPrice'); Session::put('totalAmmount', $total); ?>
                            <h4>total: Tk. <span id="totalP">{{ number_format($total) }}</span></h4>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</section>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right des">
            <!-- <h3>TERMS OF PAYMENT</h3> -->
            <div class="payment-discription">
                <h3 class="pay-head" onclick="payment()">TERMS OF PAYMENT <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i></h3>
                <div id="pay-des" class="payhide">
                    <P>Pay online using your Visa, Mastercard, American Express or DBBL Nexus account or net banking<br>
                        Please ensure your card is active and on hand to fill in your details.<br>
                        Click Confirm Order below to complete payment and check-out. </P>
                    <p>Cancellation Policy: <br>
                        Please note that Daraz.com.bd will have the right to refuse or cancel any order at any time whether or not the order has been confirmed and your credit card charged. In case of cancellation of prepaid orders (fully or partially), full amount paid by the customer will be refunded within 2-3 business days of cancelling the orders</p>
                    <p>Online Refund Policy:<br>
                        Online refund will take 7 to 10 working days. It might take longer based on bank and transaction method.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
            <div class="payment-method">
                <h4>PAYMENT METHOD</h4>
                <div class="row">
                    <form action="{{ route('payment.save') }}" method="post">{{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                                <label class="control-label" for="paymentType">SELECT METHOD</label>
                                <select id="paymentType" name="paymentType" value="{{ old('paymentType') }}" class="form-control ">
                                    <option value="cod">Cash On Delivery</option>
                                    <option value="sslcommerz">Online Payment</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label" for="paymentType">&nbsp;</label>
                            <div class="col-lg-8 col-sm-8 col-xs-12">
                                <button class="btn btn-success btn-block">SUBMIT ORDER</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footerLink')
    <script src="{{asset('public/frontEnd/js/productCartAjax.js')}}"></script>
@endsection