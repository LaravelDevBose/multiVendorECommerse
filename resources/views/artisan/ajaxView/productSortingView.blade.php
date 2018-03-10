<div class="tab-pane fade in active" id="list">
	<!-- List -->
	<ul class="media-list">
		@forelse($products as $product)
			<li class="media panel panel-body stack-media-on-mobile">
                <?php $productImage =$product->thumbImage;  if(!file_exists($productImage)){ $productImage='public/artisan/assets/images/placeholder.jpg'; }?>
				<a href="{{ asset($productImage) }}" class="media-left" data-popup="lightbox">
					<img src="{{ asset($productImage) }}" width="110" style="height: auto;" alt="{{ $product->productName }}">
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

					<p class="content-group-sm">{{ $product->shortDes }}</p>
					<p class="content-group-sm">
					<ul class="list-inline">
						<li style="padding-right: 5px;">Primary Color:</li>
                        <?php $priColors = explode(',', $product->priColorId); ?>
						@forelse($priColors as $primaryColor)
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
						@if(!is_null($product->secColorId))
                            <?php $secColors = explode(',', $product->secColorId); ?>
							@forelse($secColors as $secondaryColor)
                                <?php $color = App\SecondaryColor::where('id',$secondaryColor)->select('colorName', 'colorCode')->first();?>
								<li style="padding-right: 5px;"><span class="label" style="background-color: {{$color->colorCode}}" >{{ ucfirst($color->colorName) }}</span></li>
							@empty
								<li style="padding-right: 5px;"><span class="label ">No Color Inserted</span></li>
							@endforelse
						@endif
					</ul>
					</p>


				</div>

				<div class="media-right text-center ">
					<h4 class="no-margin text-semibold">&#2547; {{ number_format( $product->finalPrice, 2)}}</h4>
					<h6 class="no-margin text-semibold">&#2547; {{ number_format( $product->costPrice, 2)}}</h6>

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

				<div class="media-footer ">
					<div class=" media-left">
						<ul class="list-inline ">
							<li style="padding-right: 5px;"><a href="{{ route('singel.item',$product->id) }}" title="Full View" class="btn bg-primary-800 mt-5 btn-xs"><i class="icon-book"></i></a></li>
							<li style="padding-right: 5px;" ><a href="{{ route('item.edit',$product->id) }}" title="Edit Product" class="btn bg-info-400 mt-5 btn-xs"><i class=" icon-pencil7"></i></a></li>
							<li style="padding-right: 5px;"><button title="Delete Product" class="btn bg-danger-400 mt-5 btn-xs"><i class="icon-cancel-square2"></i></button></li>
						</ul>

					</div>
					<div class="media-right">
						<ul class="list-inline ">
							<li>
								<ul class="list-inline list-inline-separate mb-5">
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
				<th>Sell Price (TK.)</th>
				<th>Shop Price (TK.)</th>
				<th>Status</th>
				<th class="text-center"><i class="icon-arrow-down12"></i></th>
			</tr>
			</thead>
			<tbody>
			@forelse($products as $product)
				<tr>

					<td>
						<div class="media">
                            <?php $productImage = $product->thumbImage;  if(!file_exists($productImage)){ $productImage='public/artisan/assets/images/placeholder.jpg'; }?>

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
						<h6 class="no-margin text-semibold">&#2547; {{ number_format($product->finalPrice , 2)}}</h6>
					</td>
					<td>

						<h6 class="no-margin text-semibold">&#2547; {{ number_format($product->costPrice , 2)}}</h6>
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
									<li><a href="{{ route('singel.product', $product->id)}}"><i class="text-primary-600 icon-book"></i> View Produt Details</a></li>
									<li><a href="{{ route('item.edit', $product->id) }}"><i class="text-info-400 icon-pencil7"></i>Edit Product</a></li>
									<li class="divider"></li>
									<li><a href="{{ route('product.delete', $product->id) }}"><i class="text-danger-600 icon-trash"></i> Delete Product</a></li>
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