<div class="tab-pane fade in active" id="list">
<!-- List -->
	<ul class="media-list">
	@forelse($products as $product)
		<li class="media panel panel-body stack-media-on-mobile">
			<?php $productImage = App\ProductImage::where('id', $product->id)->value('image');  if(!file_exists($productImage)){ $productImage='public/artisan/assets/images/placeholder.jpg'; }?>
			<a href="{{ asset($productImage) }}" class="media-left" data-popup="lightbox">
				<img src="{{ asset($productImage) }}" width="110" style="height: 80%;" alt="{{ $product->productName }}">
			</a>

			<div class="media-body">
				<h6 class="media-heading text-semibold">
					<a href="{{ route('singel.product', $product->id) }}">{{ $product->productName }}</a>
				</h6>

				<ul class="list-inline list-inline-separate mb-10">
					<?php 
						$mainCat = App\Category::where('id', $product->mainCatId)->value('categoryName');
						$secCat = App\Category::where('id', $product->secondCatId)->value('categoryName');
						$thirdCat = App\Category::where('id', $product->thirdCatId)->value('categoryName');
						
					?>
					<li><a href="#" class="text-muted">{{ ucfirst($mainCat) }}</a></li>
					@if($secCat)
					<li><a href="#" class="text-muted">{{ ucfirst($secCat) }}</a></li>
					@endif

					@if($thirdCat)
					<li><a href="#" class="text-muted">{{ ucfirst($thirdCat) }}</a></li>
					@endif
				</ul>

				<p class="content-group-sm">Whole wound wrote at whose to style in. Figure ye innate former do so we.</p>
				<p class="content-group-sm">
					<ul class="list-inline">
						<li style="padding-right: 5px;">Primary Color:</li>
						<?php $primaryColors = explode(',', $product->priColorId); ?>
						@forelse($primaryColors as $primaryColor)
							<?php $color = App\PrimaryColor::where('id',$primaryColor)->select('colorName', 'colorCode')->first();?>
							<li style="padding-right: 5px;"><span class="label" style="background-color: {{$color->colorCode}}" >{{ ucfirst($color->colorName) }}</span></li>
						@empty
							<li style="padding-right: 5px;"><span class="label ">No Color Inserted</span></li>
						@endforelse
					</ul>
				</p>
				<p class="content-group-sm">
					<ul class="list-inline">
						<li style="padding-right: 5px;">Secondary Color:</li>
						<?php $secondaryColors = explode(',', $product->secColorId); ?>
						@forelse($secondaryColors as $secondaryColor)
							<?php $color = App\SecondaryColor::where('id',$secondaryColor)->select('colorName', 'colorCode')->first();?>
							<li style="padding-right: 5px;"><span class="label" style="background-color: {{$color->colorCode}}" >{{ ucfirst($color->colorName) }}</span></li>
						@empty
							<li style="padding-right: 5px;"><span class="label ">No Color Inserted</span></li>
						@endforelse
					</ul>
				</p>

				
			</div>

			<div class="media-right text-center">
				<h4 class="no-margin text-semibold">&#2547; {{ number_format( $product->newPrice, 2, '.', ',')}}</h4>
				@if($product->oldPrice)
					<h5 class="no-margin text-warning-300 text-semibold"><del>&#2547; {{ number_format( $product->oldPrice, 2, '.', ',')}}</del></h5>
				@endif
				@if($product->discount)
					<label class="no-margin text-warning-300 text-semibold"> {{ $product->discount}}</label>
				@endif
				<div class="text-nowrap">
					<i class="icon-star-full2 text-size-base text-primary-600"></i>
					<i class="icon-star-full2 text-size-base text-primary-600"></i>
					<i class="icon-star-full2 text-size-base text-primary-600"></i>
					<i class="icon-star-full2 text-size-base text-primary-600"></i>
					<i class="icon-star-half text-size-base text-primary-600"></i>
				</div>

				<div class="text-muted">15 reviews</div>
				@if($product->status == 1)
					<button type="button" class="btn bg-success-400 mt-15"><i class="icon-checkmark position-left"></i>Publish</button>
				@else
					<button type="button" class="btn bg-danger-400 mt-15"><i class="icon-blocked position-left"></i>UnPublish</button>
				@endif
			</div>
			<div class="media-footer col-md-offset-2">
				<ul class="list-inline list-inline-separate">

					<li><span class="text-semibold">Owner Name: </span>
						@if($product->ownerId != 0)
						<?php $shopName = App\Shop::where('id', $product->ownerId)->value('shopName');?>
						<a href="{{ route('shop.singel.view', $product->ownerId) }}"> {{ ucfirst($shopName) }}</a>
						@else
						<span> Admin</span>
						@endif
					</li>
					<li>
						<ul class="list-inline list-inline-separate mb-10">
							<li>Tag List: </li>
							<?php $tagIds = explode(',', $product->tagsId); ?>
						@forelse($tagIds as $tagId)
							<?php $tag = App\ProductTag::where('id',$tagId)->value('tagTitle');?>
							<li style="padding-right: 15px;"><a href=""> {{ ucfirst($tag) }}</a></li>
						@empty

							<li style="padding-right: 15px;">No Tag Inserted</li>
						@endforelse
						</ul>
					</li>
				</ul>
			</div>
		</li>
	@empty

	@endforelse
	</ul>
	<!-- /list -->
<!-- Pagination -->
	
<!-- /pagination -->

</div>

<div class="tab-pane fade" id="table">
	<div class="panel panel-white">
		

		<table class="table  text-nowrap">
			<thead>
				<tr>
					<th>Product name</th>
					<th>Categorys</th>
					<th>Owner Info</th>
					<th>Price(&#2547;)</th>
					<th>Status</th>
					<th class="text-center"><i class="icon-arrow-down12"></i></th>
				</tr>
			</thead>
			<tbody>
				@forelse($products as $product)
				<tr>
					
					<td>
						<div class="media">
							<?php $productImage = App\ProductImage::where('id', $product->id)->value('image');  if(!file_exists($productImage)){ $productImage='public/artisan/assets/images/placeholder.jpg'; }?>

							<a href="{{ asset($productImage) }}" class="media-left" data-popup="lightbox">
								<img src="{{ asset($productImage) }}" height="60" class=""  alt="{{ $product->productName }}">
							</a>

							<div class="media-body media-middle">
								<a href="{{ route('singel.product', $product->id) }}" class="text-bold">{{ $product->productName }}</a>
								<div class="text-muted text-size-small">
									<span class="status-mark bg-grey position-left"></span>
									{{ $product->productCode }}
								</div>
							</div>
						</div>
					</td>
					<td>
						<?php 
							$mainCat = App\Category::where('id', $product->mainCatId)->value('categoryName');
							$secCat = App\Category::where('id', $product->secondCatId)->value('categoryName');
							$thirdCat = App\Category::where('id', $product->thirdCatId)->value('categoryName');

							$catLst = $mainCat; 
							if($secCat){$catLst =$catLst. '<i class="icon-arrow-right13"></i>'.'</br>' .$secCat ;}
							if($thirdCat){$catLst = $catLst.'<i class="icon-arrow-right13"></i>'.'</br>' .$thirdCat ;}
							echo $catLst;
						?>
					</td>
					<td>
						<?php $ownerName = "Admin"; if($product->ownerId !=0 ){$ownerName = App\Shop::where('id', $product->ownerId)->value('shopName');} echo ucfirst($ownerName);?>
					</td>
					<td>
						<h6 class="no-margin text-semibold">&#2547; {{ number_format($product->newPrice , 2, '.', ',')}}</h6>
					</td>
					<td>
						@if($product->status == 1)
							<button title="Make UnPublish Product"  class="btn btn-success btn-sm" data-toggle="modal" data-target="#delete_shop"><i class="icon-checkmark "></i></button>
						@else
							<button title="Make Pubish Product"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_shop"><i class="icon-blocked"></i> </button>
						@endif
					</td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="{{ route('singel.product', $product->id)}}"><i class="icon-book"></i> View Produt Details</a></li>
									@if($product->ownerId != 0)
									<li><a href="{{ route('shop.singel.view', $product->ownerId) }}"><i class="icon-store"></i>View Product</a></li>
									@endif
									<li class="divider"></li>
									<li><a href="{{ route('product.delete', $product->id) }}"><i class="icon-trash"></i> Delete Product</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
				@empty
				<tr>
					<td colspan="6"><span>No Product Inserted</span></td>
				</tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>