@extends('frontEnd.master')

@section('title')
Dorpon | Order Summary
@endsection

@section('headasset')
<!--<link href="{{asset('public/frontEnd/css/style.css')}}" rel="stylesheet">-->
<link href="{{asset('public/frontEnd/css/bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/main.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/font-awesome.min.css')}}" rel="stylesheet">
<link href="{{ asset('public/frontEnd/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{asset('public/frontEnd/css/header.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/footer.css')}}" rel="stylesheet">
        
@endsection

@section('content')

<hr>
<div class="container heading"><h4>Order Summary</h4></div>
<section class="cart-warp">
    @if (Session::get('emptyMsg'))
        <div class="promo-code">
            <h3 class="text-center text-info">{{ Session::get('emptyMsg') }}</h3>
        </div>
    @endif
        @include('frontEnd.includes.message')
    <div class="container wraper-edited">
        <div class="wraper-price-edite">
            <div class="row goods-item">
                <div class="col-lg-5 col-md-6 col-sm-6 col-xs-3 goods-part" id="item-info">
                    <h5>Iten</h5>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 goods-part text-center" id="qty">
                    <h5 id="big">Quantity</h5>
                    <h5 id="small">Qty</h5>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 goods-part" id="ut-p">
                    <h5 class="pull- right" id="big">Unit Price (Tk.)</h5>
                    <h5 id="small">Price (Tk.)</h5>
                </div>
                <div class="col-lg-3 col-md-2 col-sm-2 col-xs-3 goods-part" id="total">
                    <h5 class="pull-right">Total (Tk.)</h5>
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
                            <hr>
                            <?php $total = $totalPrice; ?>
                            <h4>total: Tk. <span id="totalP">{{ number_format($total) }}</span></h4>
                        </div>
                    </div>
                </div>
                <?php Session::put('totalProduct',$totalProduct); Session::put('totalAmount',$total);?>
            </div>

        </div>
    </div>

</section>

    <div class="container"><h4>GIVE YOUR DETAILS INFORMATION</h4></div>
    <section>
        <div class="container wraper">
            <div class="row">
                <div class="well">
                    <p class="text-info">Dear Sir If You went to Use Your Address as Order Shipping Address Than Just Save the From And Continuous </p>
                </div>

                <div class="well">
                    <form action="{{ route('shipping.save') }}" method="POST">{{ csrf_field() }}
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-5 col-xs-8 form-edite">
                                <label class="control-lable pull-left" for="contactname">HOUSE NO. :</label>
                                <input type="text" class="form-control pull-right" value="{{ ($detailsInfo->houseNo) ? $detailsInfo->houseNo :' ' }}"  name="houseNo" placeholder="HOUSE NO.">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-5 col-xs-8 form-edite">
                                <label class="control-lable pull-left" for="contactname">ROAD NO. :</label>
                                <input type="text" class="form-control pull-right" value="{{ ($detailsInfo->roadNo) ? $detailsInfo->roadNo : ' ' }}" name="roadNo" placeholder="ROAD NO.">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-5 col-xs-8 form-edite">
                                <label class="control-lable pull-left" for="contactname">BLOCK :</label>
                                <input type="text" class="form-control pull-right" value="{{ ($detailsInfo->block) ? $detailsInfo->block :' ' }}" name="block" placeholder="BLOCK">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-5 col-xs-8 form-edite">
                                <label class="control-lable pull-left" for="contactname">AREA NAME :<span class="text-danger">*</span></label>
                                <input type="text" class="form-control pull-right" value="{{ ($detailsInfo->areaName) ? $detailsInfo->areaName : '' }}" name="areaName" placeholder="VILLAGE">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-5 col-xs-8 form-edite">
                                <label class="control-lable pull-left" for="contactname">POSTAL/ZIP CODE :<span class="text-danger">*</span></label>
                                <input type="number" class="form-control pull-right" value="{{ ($detailsInfo->zipCode) ? $detailsInfo->zipCode: '' }}"  required name="zipCode" placeholder="POSTAL/ZIP CODE">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-5 col-xs-8 form-edite">
                                <label class="control-lable pull-left" for="contactname">DIVISION :<span class="text-danger">*</span></label>
                                <select  class="form-control pull-right" name="divisionId" required data-placeholder="Select your Division" >
                                    @foreach($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->areaName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-5 col-xs-8 form-edite">
                                <label class="control-lable pull-left" for="contactname">DISTRICT :<span class="text-danger">*</span></label>
                                <select  class="form-control pull-right" name="districtId" required data-placeholder="Select Your District">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-5 col-xs-8 form-edite">
                                <label class="control-lable pull-left" for="contactname">THANA/UPOZILA :<span class="text-danger">*</span></label>
                                <select  class="form-control pull-right" name="areaId" required data-placeholder="Select Your Thana && Upozila">
                                    <option></option>
                                </select>
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-5 col-xs-8 form-edite">
                                <button type="submit" class="btn btn-success btn-block">SAVE SHIPPING INFORMATION</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('footerLink')
    <script src="{{ asset('public/frontEnd/js/productCartAjax.js') }}"></script>

@endsection