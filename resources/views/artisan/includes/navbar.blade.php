<div class="navbar navbar-default header-highlight">
	<div class="navbar-header">
		<a class="navbar-brand" href="index.html"><img src="assets/images/logo_light.png" alt=""></a>

		<ul class="nav navbar-nav visible-xs-block">
			<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>

		</ul>
	</div>

	<div class="navbar-collapse collapse" id="navbar-mobile">
		<ul class="nav navbar-nav">
			<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

			<li>
				<a class="sidebar-control sidebar-detached-hide hidden-xs">
					<i class="icon-drag-right"></i>
				</a>
			</li>
			<li><a href="{{ route('index') }}"><i class="icon-home5" ></i></a></li>
		
		</ul>

		<div class="navbar-right">
			<p class="navbar-text">{{ Auth::User()->name }}</p>
			<p class="navbar-text"><span class="label bg-success">Online</span></p>
			
			<ul class="nav navbar-nav">

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-bell2"></i>
						<span class="visible-xs-inline-block position-right">Notification</span>
						<span class="status-mark border-pink-300"></span>
					</a>

					<div class="dropdown-menu dropdown-content">
						<div class="dropdown-content-heading">
							Notification
							<ul class="icons-list">
								<li><a data-action="reload"></a></li>
							</ul>
						</div>

						<ul class="media-list dropdown-content-body width-350">
							@forelse($productStatusNotifications  as $notification)
							<?php $product = json_decode($notification->data);?>
							 
							<li class="media">
								<div class="media-left media-middle">
									<a href="{{ route('singel.item', $product->product->id ) }}" class="">
										{{--<img src="{{ asset($product->product->image) }}" class="img-circle img-sm ">--}}
									</a>
								</div>

								<div class="media-body">
									<a href="{{ route('singel.item', $product->product->id ) }}">
										{{ $product->product->productName }} is Make {{ ($product->product->status == 1)? "Publish" : "Unpublish" }} Now .!
									<?php 
					                  	$date = new DateTime($notification->created_at);
					                  	$statusDate = date_format($date, 'd F Y');
					                ?>
									<div class="media-annotation">{{ $statusDate }}</div>
									</a> 
								</div>
							</li>
							@empty

							@endforelse

						
						</ul>
						<div class="dropdown-content-footer">
							<a href="{{ route('items') }}" data-popup="tooltip" title="All activity"><i class="icon-menu display-block"></i></a>
						</div>
					</div>
				</li>


				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-bubble8"></i>
						<span class="visible-xs-inline-block position-right">Messages</span>
						<span class="status-mark border-pink-300"></span>
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