<div class="sidebar sidebar-main">
	<div class="sidebar-content">

		<!-- User menu -->
		<div class="sidebar-user-material">
			<div class="category-content">
				<div class="sidebar-user-material-content">

					<a href="#">
						<?php
							$profileImage = Auth::User()->avater;
				            if(!file_exists($profileImage)){
				              $profileImage = 'public/images/default/profileDeatult.png'; 
				            }
				      	?>
						<img src="{{ asset($profileImage) }}" class="img-circle img-responsive" alt="">
					</a>
					<h6 class="text-bold text-uppercase">{{ Auth::User()->name }}</h6>
					<span class="text-size-small">{{ Auth::User()->email }}</span>
				</div>
											
				<div class="sidebar-user-material-menu">
					<a href="#user-nav" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>
				</div>
			</div>
			
			<div class="navigation-wrapper collapse" id="user-nav">
				<ul class="navigation">
					<li><a href="#"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
					<li class="divider"></li>
					<li><a href="#"><i class="icon-cog5"></i> <span>Account settings</span></a></li>
					<li><a href="{{ route('admin.logout') }}"><i class="icon-switch2"></i> <span>Logout</span></a></li>
				</ul>
			</div>
		</div>
		<!-- /user menu -->


		<!-- Main navigation -->
		<div class="sidebar-category sidebar-category-visible">
			<div class="category-content no-padding">
				<ul class="navigation navigation-main navigation-accordion">

					<!-- Main -->
					<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
					<li class="<?php echo (Route::currentRouteName() =='admin.dashboard' )?"active" :" " ; ?>"><a href=" {{ route('admin.dashboard') }} "><i class="icon-grid"></i> <span>Dashboard</span></a></li>                 
					<li class="<?php echo (Route::currentRouteName() =='category' )?"active" :" " ; ?>"><a href=" {{ route('category') }} "><i class="icon-equalizer2"></i> <span>Category</span></a></li>                  
					<li class="<?php echo (Route::currentRouteName() =='giftType' )?"active" :" " ; ?>"><a href=" {{ route('giftType') }} "><i class="icon-gift"></i> <span>Gift Type</span></a></li>                   
					<li class="<?php echo (Route::currentRouteName() =='products' )?"active" :" " ; ?>"><a href=" {{ route('products') }} "><i class="icon-bag"></i> <span>Product</span></a></li>

					<li class="<?php echo (Route::currentRouteName() =='sizes' )?"active" :" " ; ?>"><a href=" {{ route('sizes') }} "><i class="icon-rulers"></i> <span>Sizes</span></a></li>                  
					<li class="<?php echo (Route::currentRouteName() =='materials' )?"active" :" " ; ?>"><a href=" {{ route('materials') }} "><i class="icon-bag"></i> <span>Materials</span></a></li>
					<li class="<?php echo (Route::currentRouteName() =='colors' )?"active" :" " ; ?>"><a href=" {{ route('colors') }} "><i class="icon-brush"></i> <span>Colors</span></a></li>
					<li class="<?php echo (Route::currentRouteName() =='orders' )?"active" :" " ; ?>"><a href="{{ route('orders') }}"><i class="icon-cart-add"></i> <span>Orders</span></a></li>
					<li class="<?php echo (Route::currentRouteName() =='qusen.list' )?"active" :" " ; ?>"><a href="{{ route('qusen.list') }}"><i class="icon-bubbles5"></i> <span>Questions</span></a></li>              
					<!--<li class=""><a href="{{ route('admin.dashboard') }}"><i class="icon-envelop"></i> <span>Emails</span></a></li>                    -->
					<li class="<?php echo (Route::currentRouteName() =='shop.list' )?"active" :" " ; ?>"><a href="{{ route('shop.list') }}"><i class="icon-store2"></i> <span>Shop Details</span></a></li>                  
					<li class="<?php echo (Route::currentRouteName() =='user.list' )?"active" :" " ; ?>"><a href="{{ route('user.list') }}"><i class="icon-users4"></i> <span>Customers Info</span></a></li>
					<li class="<?php echo (Route::currentRouteName() =='logos' )?"active" :" " ;echo (Route::currentRouteName() =='videos' )?"active" :" " ;  echo (Route::currentRouteName() =='sliders' )?"active" :" " ; ?>">
						<a href="#"><i class="icon-home4"></i> <span>Template Design</span></a>
						<ul>
							<li class="<?php echo (Route::currentRouteName() =='logos' )?"active" :" " ; ?>"><a href="{{ route('logos') }}"><i class="icon-snowflake"></i> <span>Logo</span></a></li>
							<li class="<?php echo (Route::currentRouteName() =='sliders' )?"active" :" " ; ?>"><a href="{{ route('sliders') }}"><i class="icon-images2"></i> <span>Slider</span></a></li>
							<li class="<?php echo (Route::currentRouteName() =='videos' )?"active" :" " ; ?>"><a href="{{ route('videos') }}"><i class="icon-clapboard-play"></i> <span>Youtube Video</span></a></li>
						</ul>
					</li>

					<li>
					    <a href="#"><i class="icon-truck"></i> <span>Product Transport</span></a>
					    <ul>
					        <li class="<?php echo (Route::currentRouteName() =='locations' )?"active" :" " ; ?>"><a href="{{ route('locations') }}"><i class="icon-location4"></i> <span>Location</span></a></li>
					        <li class="<?php echo (Route::currentRouteName() =='deliveryCriterias' )?"active" :" " ; ?>"><a href="{{ route('deliveryCriterias') }}"><i class="icon-reading"></i> <span>Delivery Criteria</span></a></li>
					        <li class="<?php echo (Route::currentRouteName() =='pickUpCriterias' )?"active" :" " ; ?>"><a href="{{ route('pickUpCriterias') }}"><i class="icon-clapboard-play"></i> <span>pick-Up Criteria</span></a></li>
					    </ul>
					</li>
					<li>
						<a href="#"><i class="icon-hand"></i> <span>Dorpon Helper</span></a>
						<ul>
							<li class="<?php echo (Route::currentRouteName() =='associates' )?"active" :" " ; ?>"><a href="{{ route('associates') }}"><i class="icon-user-tie"></i> <span>Associate</span></a></li>
							<li class="<?php echo (Route::currentRouteName() =='friends' )?"active" :" " ; ?>"><a href="{{ route('friends') }}"><i class="icon-man-woman"></i> <span>Friend</span></a></li>
							<li class="<?php echo (Route::currentRouteName() =='suppliers' )?"active" :" " ; ?>"><a href="{{ route('suppliers') }}"><i class="icon-collaboration "></i> <span>Supplier</span></a></li>
						</ul>
					</li>

				</ul>
			</div>
		</div>
		<!-- /main navigation -->

	</div>
</div>