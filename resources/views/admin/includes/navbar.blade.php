<div class="navbar navbar-inverse header-highlight">
	<div class="navbar-header" style="background-color: #fff;">
		<?php
            if(!file_exists($logo)){
              $logo = 'public/images/default/dorponLogo.png'; 
            }
      	?>
		<a class="navbar-brand" href="{{ route('admin.dashboard') }}"><img src="{{ asset( $logo ) }}"  alt="logo" ></a>

		<ul class="nav navbar-nav visible-xs-block">
			<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
		</ul>
	</div>

	<div class="navbar-collapse collapse" id="navbar-mobile">
		<ul class="nav navbar-nav">
			<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

			@if(Route::currentRouteName() == 'products')
			<li>
				<a class="sidebar-control sidebar-detached-hide hidden-xs">
					<i class="icon-drag-right"></i>
				</a>
			</li>
			@endif
			
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-store2"></i>
					<span class="visible-xs-inline-block position-right">New Shop</span>
					@if(count($newShopNotification) >0)
						<span class="badge bg-primary-400 badge-left">{{ count($newShopNotification) }}</span>
					@endif
				</a>
				@if(count($newShopNotification) >0)
				<div class="dropdown-menu dropdown-content">
					<div class="dropdown-content-heading">
						New Shop Request
						<ul class="icons-list">
							<li><span class="text-violet-800 text-semibold">{{ $newShop }}</span></li>
							<li><a href="#"><i class="icon-sync"></i></a></li>
						</ul>
					</div>

					<ul class="media-list dropdown-content-body width-350">
						
						@foreach($newShopNotification as $notification)
							<?php //$shopInfo = json_decode($notification->data);?> 
							<li class="media">
								<div class="media-left media-middle">
									<a href="{{ route('new.shop.Notify', $notification->id ) }}" class="">
										<?php $shopLogo =$notification->data->shop->shopLogo; if(!file_exists($notification->data->shop->shopLogo)){$shopLogo='public/artisan/assets/images/placeholder.jpg'; } ?>
										<img src="{{ asset($shopLogo) }}" class="img-circle img-sm ">
									</a>
								</div>

								<div class="media-body">
									<a href="{{ route('new.shop.Notify', $notification->id ) }}"><?php echo App\Merchantile::where('shopId',$notification->data->shop->id )->value('name');?> Request to Create New Shop</a>
									<?php 
					                  	$date = new DateTime($notification->data->shop->created_at);
					                  	$requestDate = date_format($date, 'd F Y');
					                ?>
									<div class="media-annotation">{{ $requestDate }}</div>
								</div>
							</li>
						
						@endforeach
					</ul>

					<div class="dropdown-content-footer">
						<a href="{{ route('shop.list') }}" data-popup="tooltip" title="All activity"><i class="icon-menu display-block"></i></a>
					</div>
				</div>
				@endif
			</li>
		</ul>

		<div class="navbar-right">
			<p class="navbar-text text-bold text-uppercase">{{ Auth::User()->name }}</p>
			<p class="navbar-text"><span class="label bg-success">Online</span></p>
			
			<ul class="nav navbar-nav">				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-bell2"></i>
						<span class="visible-xs-inline-block position-right">New Product</span>
						@if(count($newProductNotify) >0)
							<span class="badge bg-primary-400 badge-left">{{ count($newProductNotify) }}</span>
					
						@endif
					</a>

					@if(count($newProductNotify)> 0)
					<div class="dropdown-menu dropdown-content">
						<div class="dropdown-content-heading">
							New Product Notification
							<ul class="icons-list">
								<li><span class="text-warning-800 text-semibold">{{ $newProduct }}</span></li>
								<!-- <li><a href="#"><i class="icon-menu7"></i></a></li> -->
							</ul>
						</div>

						<ul class="media-list dropdown-content-body width-350">
							@foreach($newProductNotify as $notification)
							<?php 
								
								$productInfo =App\Product::where('id',$notification->data->product)->select('productName', 'thumbImage','created_at')->first();
							
								$thumbImage = $productInfo->thumbImage;
								if(!file_exists($thumbImage)){$thumbImage='public/artisan/assets/images/placeholder.jpg'; }

								$date = new DateTime($productInfo->created_at);
			                  	$insertDate = date_format($date, 'd F Y');
							?> 
							<li class="media">
								<div class="media-left">
									<a href="{{ route('new.product.Notify', $notification->id ) }}" class="">
										<img src="{{ asset($thumbImage) }}" class="img-circle img-sm " alt="New Product">
									</a>
								</div>

								<div class="media-body">
									<a href="{{ route('new.product.Notify', $notification->id ) }}" class="text-info">{{ ucfirst($productInfo->productName) }} Inserted By <span class="text-uppercase text-bold text-violet-700">{{ $notification->data->shop->shopName }}</span></a>
									<div class="media-annotation">{{ $insertDate }}</div>
								</div>
							</li>
							@endforeach
							
						</ul>
					</div>
					@endif
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-bubble8"></i>
						<span class="visible-xs-inline-block position-right">Messages</span>
						<span class="badge bg-primary-400 badge-right">0</span>
					</a>
					
					<div class="dropdown-menu dropdown-content width-350">
						<div class="dropdown-content-heading">
							Messages
							<ul class="icons-list">
								<li><a href="#"><i class="icon-compose"></i></a></li>
							</ul>
						</div>

						<ul class="media-list dropdown-content-body">
							<li class="media">
								<div class="media-left">
									<img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
									<span class="badge bg-danger-400 media-badge">5</span>
								</div>

								<div class="media-body">
									<a href="#" class="media-heading">
										<span class="text-semibold">James Alexander</span>
										<span class="media-annotation pull-right">04:58</span>
									</a>

									<span class="text-muted">who knows, maybe that would be the best thing for me...</span>
								</div>
							</li>

							<li class="media">
								<div class="media-left">
									<img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
									<span class="badge bg-danger-400 media-badge">4</span>
								</div>

								<div class="media-body">
									<a href="#" class="media-heading">
										<span class="text-semibold">Margo Baker</span>
										<span class="media-annotation pull-right">12:16</span>
									</a>

									<span class="text-muted">That was something he was unable to do because...</span>
								</div>
							</li>

							<li class="media">
								<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
								<div class="media-body">
									<a href="#" class="media-heading">
										<span class="text-semibold">Jeremy Victorino</span>
										<span class="media-annotation pull-right">22:48</span>
									</a>

									<span class="text-muted">But that would be extremely strained and suspicious...</span>
								</div>
							</li>

							<li class="media">
								<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
								<div class="media-body">
									<a href="#" class="media-heading">
										<span class="text-semibold">Beatrix Diaz</span>
										<span class="media-annotation pull-right">Tue</span>
									</a>

									<span class="text-muted">What a strenuous career it is that I've chosen...</span>
								</div>
							</li>

							<li class="media">
								<div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
								<div class="media-body">
									<a href="#" class="media-heading">
										<span class="text-semibold">Richard Vango</span>
										<span class="media-annotation pull-right">Mon</span>
									</a>
									
									<span class="text-muted">Other travelling salesmen live a life of luxury...</span>
								</div>
							</li>
						</ul>

						<div class="dropdown-content-footer">
							<a href="#" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a>
						</div>
					</div>
				</li>					
			</ul>
		</div>
	</div>
</div>