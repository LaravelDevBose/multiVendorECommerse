
<div class="container review-info">
  <div class="row">
    <h3 class="text-center">REVIEWS</h3>
  @if(!count($productsReviews)==0)

    @foreach($productsReviews as $productReview)
    <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="review-wrap">
         <div class="review-item-1 text-center">
         <?php $productImage = DB::table('product_images')->where('productTableId', $productReview->productId)->first(); ?>
           <img style="height:170px; width:170px; border-radius:85px;" src="{{ asset($productImage->image)}}">
           <a style="text-decoration:none;" href="{{ route('singel.product.view', array('id'=>$productReview->productId)) }}"> <h3 class="">{{ strtoupper($productReview->productName) }}</h3></a>
         </div>
         <div class="review-item-2">
            <p class="pull-left">{{ ucwords($productReview->comment) }}</p>
         </div>
        </div>
    </div>
    @endforeach

  @endif
  </div>
  <div class="row text-center">
    {{ $productsReviews->links() }}
       <!-- <button class="mybtn">VIEW ALL REVIEWS<i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>  -->
  </div>
</div>