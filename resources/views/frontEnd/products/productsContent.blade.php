<div class="row">
    @forelse($products as $product)
    <div class="col-md-4 col-sm-4 col-xs-6 paginate">
        <div class="box_inner">
            <div class="box-image">
                <?php $productImage = $product->thumbImage; if(!file_exists($productImage)){$productImage='public/artisan/assets/images/placeholder.jpg';}?>
                <a href="{{ route('product', $product->id) }}"><img src="{{ asset($productImage) }}" class="img-responsive" alt="{{ $product->productName }}"/></a>
            </div>
            <div class="sale-box">
                @if (Auth::guest())
                    <a href="#" title="Login Pleases"  data-toggle="modal" data-target="#userLogin" style="color: #63c6a7; font-size: 18px;"><i class="fa fa-heart" aria-hidden="true"></i></a>
                @else
                    @php
                        $allUserId = App\ProductFavourite::where('productId', $product->id)->value('userId');
                        $userIds = explode(",", $allUserId);
                    @endphp
                    @if (!in_array(Auth::User()->id, $userIds)|| empty($userIds))
                        <a title="Not Favorite" style="color: #63c6a7; font-size: 18px;" href="{{ route('favorite', array('id'=>$product->id, 'action'=>0)) }}"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    @else
                        <a  title="Favorited"  style="color: red; font-size: 20px;" href="{{ route('favorite', array('id'=>$product->id, 'action'=>Auth::User()->id)) }}"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    @endif

                @endif

            </div>
            <div class="desc">
                <a href="{{ route('product', $product->id) }}"><h3>{{ ucfirst($product->productName) }}</h3></a>

                <a href="{{ route('shop.view',$product->ownerId) }}">
                    @if($product->ownerId ==0)
                    <p>Dorpon</p>
                    @else
                        <?php $shopName = App\Shop::where('id', $product->ownerId)->value('shopName');?>
                            <p>{{ ucfirst($shopName) }}</p>
                    @endif
                </a>
                <div class="review-icon">
                    <input  class="rating rating-loading"  value="{{ $product->averageRating }}" data-size="xs" readonly>
                    <span>({{ number_format($product->countRating($product->id)) }})</span>
                </div>
                <h4>Tk. {{ number_format($product->finalPrice) }}</h4>
                @if(isset($product->discount) )
                <div class="del-item"><del>Tk. {{ $product->sellPrice }}</del>({{ $product->discount }}%)</div>
                @endif
                {{--<h5>Eligible order get 10% off</h5>--}}
            </div>
        </div>
    </div>

    @empty

    @endforelse

</div>
<div class="row">
    <div id="page-nav"></div>

    <script>
        $(function($) {
                
                var pageParts = $(".paginate");

                
                var numPages = pageParts.length;
                
                var perPage = 24;

                
                pageParts.slice(perPage).hide();
                
                if(numPages > perPage){
                    $("#page-nav").pagination({
                        items: numPages,
                        itemsOnPage: perPage,
                        cssStyle: "light-theme",
                        
                        onPageClick: function(pageNum) {
                            
                            var start = perPage * (pageNum - 1);
                            var end = start + perPage;

                        
                            pageParts.hide()
                                     .slice(start, end).show();
                        }
                    });
                }
                
            });

    </script>
</div>


