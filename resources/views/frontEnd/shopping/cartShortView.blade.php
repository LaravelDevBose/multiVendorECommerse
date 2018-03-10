
<a href="" id="number" ><span class="badge">{{ count($cartProducts) }}</span></a>
<a href="#"><i id="cart" class="fa fa-shopping-cart" aria-hidden="true"></i><p>Cart </p> </a>
<ul class="card-list">
    <h3>My Cart</h3>
    <div class="all-itm">
        <?php $totalAmount= 0;?>
        @foreach($cartProducts as $cartProduct)
        <li>
            <div class="item1">
                <div class="item-photo">
                    <?php $productImage = App\Product::where('id', $cartProduct->id)->value('thumbImage');  if(!file_exists($productImage)){ $productImage='public/artisan/assets/images/placeholder.jpg'; }?>
                    <img src="{{asset($productImage)}}" alt="{{ $cartProduct->name }}">
                </div>
                <div class="item-text">
                    <a href="{{ route('product', $cartProduct->id) }}">{{ ucfirst($cartProduct->name) }}</a>
                    <?php 
                        if(Session::get($cartProduct->rowId)){
                            $priCri = Session::get($cartProduct->rowId);
                             $size = App\Size::where('id', $priCri['size'])->value('sizeTitle');
                            
                        }
                    ?>
                    <p>size: <span>{{ (empty($size)) ? ' ' : $size }}</span></p>
                    <p class="ip2">Qty: <span>{{ $cartProduct->qty }}</span></p>
                    <a>Tk. {{ number_format($cartProduct->price) }}</a>
                </div>
            </div>
        </li>
            <?php $totalAmount = $totalAmount + ($cartProduct->qty * $cartProduct->price); ?>
        @endforeach

    </div>
    <h1>Order Subtotal <span>Tk. {{ number_format($totalAmount) }}</span> </h1>
    <div class="bttn">
        <a href="{{ route('checkout') }}">CHECKOUT</a>
    </div>
</ul>

