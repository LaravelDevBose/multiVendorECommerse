@extends('frontEnd.master')

@section('title')
Dorpon | Order Summary
@endsection

@section('headasset')
<!--<link href="{{asset('public/frontEnd/css/style.css')}}" rel="stylesheet">-->
<!--<link href="{{asset('public/frontEnd/css/bootstrap.min.css')}}" rel="stylesheet">-->
<link href="{{asset('public/frontEnd/css/bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/main.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/font-awesome.min.css')}}" rel="stylesheet">
<link href="{{ asset('public/frontEnd/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<!--<link href="{{asset('public/frontEnd/css/homepage.css')}}" rel="stylesheet">-->
<link href="{{asset('public/frontEnd/css/footer.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/header.css')}}" rel="stylesheet">
        
@endsection

@section('content')

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
                            <a class="remove" style="text-decoration:none;" href="{{ route('cart.remove',$cartProduct->rowId) }}" title="Remove"><i  class="fa fa-times" aria-hidden="true"></i></a>

                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 quantity  text-center">
                            <input type="hidden"  name="rowId" value="{{ $cartProduct->rowId}}" >
                            <select name="qty" class="form-control">
                                <?php $proCri = Session::get($cartProduct->rowId); $productQty = App\ProductQuentity::where('productId',$cartProduct->id)->where('sizeId',$proCri['size'])->value('quantity'); $totalQty = $productQty+$cartProduct->qty; ?>
                                @for($i=1;$i<=$totalQty; $i++)
                                    @if($cartProduct->qty == $i)
                                        <option selected value="{{$i}}">{{ $i }}</option>
                                    @else
                                        <option value="{{$i}}">{{ $i }}</option>
                                    @endif
                                @endfor
                            </select>
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
                            <hr>
                            <?php $total = $totalPrice; ?>
                            <h4>total: Tk. <span id="totalP">{{ number_format($total) }}</span></h4>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="gran-total ">
                    <?php Session::put('totalProduct',$totalProduct); Session::put('totalAmount',$total);?>

                    @if(Auth::guest())
                        <a href="{{ route('checkout') }}" class="mybtn pull-right" style="color:#fff; text-decoration:none;"> CHECK OUT<i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                    @else
                        <a class="mybtn pull-right" href="{{ route('shipping') }}" style="color:#fff; text-decoration:none;"> CHECK OUT<i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                    @endif


                </div>
            </div>

        </div>
    </div>

</section>

@endsection

@section('footerLink')
    <script src="{{asset('public/frontEnd/js/productCartAjax.js')}}"></script>
@endsection