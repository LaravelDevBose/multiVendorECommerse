@extends('frontEnd.master')

@section('title')
Dorpon | Checkout
@endsection

@section('headasset')
<link href="{{asset('public/frontEnd/css/style.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/main.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/font-awesome.min.css')}}" rel="stylesheet">
<link href="{{ asset('public/frontEnd/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<!--<link href="{{asset('public/frontEnd/css/homepage.css')}}" rel="stylesheet">-->
<link href="{{asset('public/frontEnd/css/header.css')}}" rel="stylesheet">
<link href="{{asset('public/frontEnd/css/footer.css')}}" rel="stylesheet">
        
@endsection

@section('content')


  <div class="container shipping-header"><hr><h4>YOUR ACCOUNT INFORMATION</h4></div>
  <div class="container wraper cktout-info">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="well cheackout-info" >
          <p>Please Sign-in to Procceed. If You Do Not Have Any Account, Please Register Below.</p>
        </div>
      </div>
    </div>
      @include('frontEnd.includes.message')
  </div>

  <section>
    <div class="container wraper cktout">
      <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class=" well cheackout-login">

              <h4>SIGN-IN HERE </h4>
                <div class="row">
                  <form method="Post" action="{{ route('user.signIn') }}" method="POST" >{{ csrf_field() }}
                    <div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12 form-edite">
                        <label class="control-lable pull-left" for="contactname">EMAIL ADDRESS :</label>
                        <input type="email" class="form-control pull-right"  name="email" placeholder="you@example.com">
                    </div> 
                    <div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12 form-edite">
                        <label class="control-lable pull-left" for="contactname">PASSWORD :</label>
                        <input type="password" class="form-control pull-right"  name="password" placeholder="******">
                    </div>
                    <div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12 form-edite">
                         <button class=" btn btn-block btn-success">Sign-In</button>
                    </div>
                  </form> 
                </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class=" well cheackout-reg">
              <h4>REGISTER HERE</h4>
              <div class="cheackout">

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <form action="{{ route('user.signUp') }}" method="POST" >
                    {{ csrf_field() }} 
                      <div class="row">

                        <div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12 form-edite">
                            <label class="control-lable pull-left" for="contactname">CONSUMER NAME :</label>
                            <input type="text" class="form-control pull-right"  name="name" value="{{ old('name') }}" required="required" placeholder="your name">
                        </div>
                        <div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12 form-edite">
                            <label class="control-lable pull-left" for="contactname">EMAIL ADDRESS :</label>
                            <input type="email" class="form-control pull-right"  name="email" value="{{ old('email') }}" required="required" placeholder="you@example.com">
                        </div>

                        <div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12 form-edite">
                            <label class="control-lable pull-left" for="contactname">PHONE NUMBER :</label>
                            <input type="number" class="form-control pull-right"  name="phoneNo" value="{{ old('phoneNo') }}" required="required" placeholder="01712345678">
                        </div>
                        <div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12 form-edite">
                            <label class="control-lable pull-left" for="contactname">PASSWORD :</label>
                            <input type="password" class="form-control pull-right"  name="password" required="required" placeholder="******">
                        </div>

                        <div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12 form-edite">
                            <label class="control-lable pull-left" for="contactname">CONFIRM PASSWORD :</label>
                            <input type="password" class="form-control pull-right"  name="password_confirmation" required="required" placeholder="******">
                        </div>
                        
                        <div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12 form-edite">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                        </div>

                        <div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12 form-edite">
                            <button class="btn btn-block  btn-success">Registation</button>
                        </div>

                      </div>
                    </form>
                      {{--<div class="g-recaptcha" data-sitekey="6LcYq0UUAAAAABoFJgNk1_KhvevqD85eXmcquZKx"></div>--}}
                  </div>
                </div>

              </div>
            </div>
          </div>

      </div>

    </div>
  </section>
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
                                  @for($i=1;$i<=10; $i++)
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
                      <?php Session::put('totalProduct',$totalProduct); Session::put('totalAmount',$total);?>
                  </div>

              </div>

          </div>
      </div>

  </section>
    <hr>

@endsection

@section('footerLink')

    <script src="{{asset('public/frontEnd/js/productCartAjax.js')}}"></script>
@endsection