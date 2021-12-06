<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Electro </title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
         <link rel="stylesheet" href="{{asset('frontend')}}/css/font-awesome.min.css">
		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="{{asset('frontend')}}/css/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" href="{{asset('frontend')}}/css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="{{asset('frontend')}}/css/slick-theme.css"/>
		<link type="text/css" rel="stylesheet" href="{{asset('frontend')}}/css/nouislider.min.css"/>
		<link type="text/css" rel="stylesheet" href="{{asset('frontend')}}/css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>


    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#"><i class="fa fa-dollar"></i> BDT</a></li>
						@php
							$customer_id=Session::get('id')
						@endphp
						@if ($customer_id==Null)
						<li><a href="{{route('user.login.check')}}"><i class="fa fa-user-o"></i> Login</a></li>
						@else
						<li><a href="{{route('user.logout')}}"><i class="fa fa-user-o"></i> Logout</a></li>
						@endif
					
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="{{route('/')}}" class="logo">
									<img src="{{asset('frontend/img/logo.png')}}" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->

						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
									<option value="" style="display: none;" selected>All Categories</option>
											@foreach ($categories as $category)
											<option value="{{$category->id}} ">  {{ $category->name   }} </option>
											@endforeach
									</select>
									<input class="input" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								@php
									$cart_array = cartArray();
								@endphp
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty"><?=count($cart_array) ?></div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											@foreach ($cart_array as $cartpruct )										
											@php
												$images= $cartpruct['attributes'][0];
												$images=explode('|',$images);
												$images= $images[0];
											@endphp

											<div class="product-widget">
												<div class="product-img">
													<img src=" {{asset('/image/'.$images)}} " alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="{{route('singlepage',[$cartpruct['id']])}}"> {{ $cartpruct['name']}} </a></h3>
													<h4 class="product-price"><span class="qty">{{ $cartpruct['quantity']}}</span>&#2547;{{ $cartpruct['price']}}</h4>
												</div>
												<a href="{{url('cart/delete/'.$cartpruct['id'])}}" class="delete"><i class="fa fa-close"></i></a>
											</div>
											@endforeach

										</div>
										<div class="cart-summary">
											<small><?=count($cart_array) ?> Item(s) selected</small>
											<h5>SUBTOTAL:&#2547;  {{ Cart::getTotal() }} </h5>
										</div>
										<div class="cart-btns">
											<a href="{{route('user.login.check')}}">View Cart</a>
											<a href="{{route('checkout')}}">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->

	@yield('content')
@include('frontend.layout.news')
		<!-- /NEWSLETTER -->
		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
								<ul class="footer-links">
									<li><a href="#">Hot deals</a></li>
									<li><a href="#">Laptops</a></li>
									<li><a href="#">Smartphones</a></li>
									<li><a href="#">Cameras</a></li>
									<li><a href="#">Accessories</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Orders and Returns</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="#">My Account</a></li>
									<li><a href="#">View Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="{{asset('frontend')}}/js/jquery.min.js"></script>
		<script src="{{asset('frontend')}}/js/bootstrap.min.js"></script>
		<script src="{{asset('frontend')}}/js/slick.min.js"></script>
		<script src="{{asset('frontend')}}/js/nouislider.min.js"></script>
		<script src="{{asset('frontend')}}/js/jquery.zoom.min.js"></script>
		<script src="{{asset('frontend')}}/js/main.js"></script>

	</body>
</html>
