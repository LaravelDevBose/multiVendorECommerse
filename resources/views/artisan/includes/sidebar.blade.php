<div class="sidebar sidebar-main">
	<div class="sidebar-content">

		<!-- User menu -->
		<div class="sidebar-user-material">
			<div class="category-content">
				<div class="sidebar-user-material-content">
					<a href="#">
					@if(is_null(Auth::User()->avater))
						<img src="{{ asset('public/artisan/') }}/assets/images/placeholder.jpg" class="img-circle img-responsive" alt="">
					@else
						<img src="{{ asset(Auth::User()->avater) }}" class="img-circle img-responsive" alt="">
					@endif
					</a>
					<h6 class="text-uppercase">{{ Auth::User()->name }}</h6>
					<span class="text-size-small">{{ Auth::User()->email }}</span>
				</div>
											
				<div class="sidebar-user-material-menu">
					<a href="#user-nav" data-toggle="collapse" id="acc"><span>My account</span> <i class="caret"></i></a>
				</div>
			</div>
			
			<div class="navigation-wrapper collapse" id="user-nav">
				<ul class="navigation">
					<li class="<?php echo (Route::currentRouteName() =='artisan.profile.image') ?"active" :" " ; ?>"><a href="{{ route('artisan.profile.image') }}"><i class="icon-users2"></i> <span>Change Profile Image</span></a></li>
					<li class="<?php echo (Route::currentRouteName() =='password.change.form') ?"active" :" " ; ?>"><a href="{{ route('password.change.form') }}"><i class="icon-user-lock"></i> <span>Change Password</span></a></li>
					<li class="divider"></li>
					<li ><a href="{{ route('merchantile.logout') }}"><i class="icon-switch2"></i> <span>Logout</span></a></li>
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
					<li class="<?php echo (Route::currentRouteName() =='merchantile.dashboard' )?"active" :" " ; ?>"><a href="{{ route('merchantile.dashboard') }}"><i class="icon-grid"></i> <span>Dashboard</span></a></li>
					<li class="<?php echo (Request::route()->getPrefix() == 'shop/item' )?"active" :" " ; ?>"><a href="{{ route('items') }}"><i class="icon-cart2"></i> <span>Products</span></a></li>
					<li class="<?php echo (Request::route()->getPrefix() =='shop/order' )?"active" :" " ; ?>"><a href="{{ route('shop.orders') }}"><i class="icon-bag"></i> <span>Orders</span></a></li>
					<li class="<?php echo (Request::route()->getPrefix() =='shop/profile' || Request::route()->getPrefix() =='shop/modarator'  )?"active" :" " ; ?>"><a href="{{ route('shop.profile') }}"><i class="icon-home2"></i> <span>Shop Profile</span></a></li>

				</ul>
			</div>
		</div>
		<!-- /main navigation -->

	</div>
</div>
<?php if(Route::currentRouteName() =='artisan.profile.image' || Route::currentRouteName() =='password.change.form' ){ ?>
	<script> $('#acc').attr('aria-expanded', true).removeClass('collapsed'); $('#user-nav').addClass('in').attr('aria-expanded', true); </script>
<?php }else{ ?>
	<script> $('#acc').attr('aria-expanded', false).addClass('collapsed'); $('#user-nav').removeClass('in').attr('aria-expanded', true); </script>
<?php } ?>
