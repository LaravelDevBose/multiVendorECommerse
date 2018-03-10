<div class="col-lg-4 col-md-4 col-sm-12 user-shopping ">

    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 pull-left">
        <div class="about-shop">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-8 pull-left">
                    <h4>About Shop</h4>
                </div>

            </div>

            <p>
                @if(is_null($shopDetails->aboutShop) || empty( $shopDetails->aboutShop))


                @else
                    {{ $shopDetails->aboutShop }}
                @endif
            </p>
        </div>
    </div>

</div>

