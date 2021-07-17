<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $meta_desc }}">
	<meta name="robots" content="INDEX,FOLLOW"/>
	<meta name="keywords" content="{{ $meta_keywords }}">
	<link rel = "canonical" href = "{{ $meta_canonical }}" />
    <title>{{ $meta_title }}</title>
	<meta property="og:image" content="{{$image_og}}" />
	<meta property="og:site_name" content="shopbanhanglaravel.com" /> <!-- Thay doi domain -->
	<meta property="og:description" content="{{$meta_desc}}" />
	<meta property="og:title" content="{{$meta_title}}" />
	<meta property="og:url" content="{{$meta_canonical}}" />
	<meta property="og:type" content="website" />

    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('public/frontend/img/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{URL::to('trang-chu')}}"><img src="{{URL::to('public/frontend/img/home/logo.png')}}" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-user"></i> Tài khoản<?php
									$customer_name = Session::get('customer_name');
									if($customer_name) {
										echo "(".$customer_name.")";
									}
								?></a></li>
								<li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>
								<?php
									$customer_id = Session::get('customer_id');
									$shipping_id = Session::get('shipping_id');
									if($customer_id != NULL && $shipping_id != NULL) {
									?>
									<li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
									<?php }
									elseif($customer_id != NULL && $shipping_id == NULL) {?>
										<li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
									<?php }
									elseif($customer_id != NULL) {
									?>
									<li><a onclick="return alert('Bạn chưa có gì trong giỏ hàng, vui lòng thêm một sản phẩm')" href="#"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
									<?php }
									else {?>
										<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>

									<?php
									}
									?>
								
								
								<li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
									<?php
									$customer_id = Session::get('customer_id');
								
									if($customer_id != NULL) {
									?>
									<li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
									<?php }
									else {?>
										<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
									<?php } ?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
								<li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li> 
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li> 
								<li><a href="{{URL::to('/view-cart')}}">Giỏ hàng</a></li>
								<li><a href="{{URL::to('/contact')}}">Liên hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="search_box pull-right">
						<form action="{{URL::to('/tim-kiem')}}" method="POST">
										{{ csrf_field() }}
							<input type="text" placeholder="Tìm kiếm sản phẩm" name="keywordsubmit"/>
							<input type="submit" value="Tìm kiếm"  style="margin-top:0; color:white" class="btn btn-primary">
						</form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free E-Commerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{URL::to('public/frontend/img/home/girl1.jpg')}}" class="girl img-responsive" alt="" />
									<img src="{{URL::to('public/frontend/img/home/pricing.png')}}"  class="pricing" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>100% Responsive Design</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{URL::to('public/frontend/img/home/girl2.jpg')}}" class="girl img-responsive" alt="" />
									<img src="{{URL::to('public/frontend/img/home/pricing.png')}}"  class="pricing" alt="" />
								</div>
							</div>
							
							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free Ecommerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{URL::to('public/frontend/img/home/girl3.jpg')}}" class="girl img-responsive" alt="" />
									<img src="{{URL::to('public/frontend/img/home/pricing.png')}}" class="pricing" alt="" />
								</div>
							</div>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh mục sản phẩm</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@foreach($category_product as $key => $cate)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{URL::to('danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></h4>
								</div>
							</div>
							@endforeach
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Thương hiệu sản phẩm</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									@foreach($branch_product as $key => $branch)
									<li><a href="{{URL::to('thuong-hieu-san-pham/'.$branch->branch_id)}}"> <span class="pull-right">
										(50)
										</span>{{$branch->branch_name}}</a></li>
									@endforeach
								</ul>
							</div>
						</div><!--/brands_products-->
						
						
						
						<div class="shipping text-center"><!--shipping-->
							<img src="{{URL::to('public/frontend/img/home/shipping.jpg')}}" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					@yield('content')
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{URL::to('public/frontend/img/home/iframe1.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{URL::to('public/frontend/img/home/iframe2.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{URL::to('public/frontend/img/home/iframe3.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{URL::to('public/frontend/img/home/iframe4.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="{{URL::to('public/frontend/img/home/map.png')}}" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
	<script>
		$(document).ready(function() {
			$('.add-to-cart').click(function() {
				var id = $(this).data('id_product');
				var cart_product_id = $('.product_id_'+id).val();
				var cart_product_name = $('.product_name_'+id).val();
				var cart_product_image = $('.product_image_'+id).val();
				var cart_product_price = $('.product_price_'+id).val();
				var cart_product_qty = $('.product_qty_'+id).val();
				var cart_product_token = $('input[name="_token"]').val();
				$.ajax({
					url: '{{url('/add-cart-ajax')}}',
					method: 'POST',
					data: {cart_product_id:cart_product_id, cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,
						cart_product_qty:cart_product_qty,_token:cart_product_token},
					success:function(data) {
						swal({
							title: "Đã thêm sản phẩm vào giỏ hàng",
							text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
							icon: "success",
							showCancelButton: true,
							cancelButtonText: "Xem tiếp",

							confirmButtonClass: "btn-success",
							confirmButtonText: "Đi đến giỏ hàng",
							closeOnConfirm: false,
							}, function() {
								window.location.href = "{{url('/gio-hang')}}";
							}

							);

					},
					error: function (data, textStatus, errorThrown) {
						console.log(data);
					},
				})
			});
		})
	</script>
	

	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v11.0&appId=1011902732305839&autoLogAppEvents=1" nonce="D3BpO0xr"></script>
	
	<script>
		$(document).ready(function() {
		
		$('.confirm-order').click(function(){
		var shipping_name = $('.shipping_name').val();
		var shipping_email = $('.shipping_email').val();
		var shipping_phone = $('.shipping_phone').val();
		var shipping_address = $('.shipping_address').val();
		var shipping_note = $('.shipping_note').val();
		var payment_select = $('.payment_select').val();
		var _token = $('input[name="_token"]').val();
		
		var feeship = $('.fee_shipping').val();
		var coupon = $('.coupon_value').val();
		swal({
			title: "Xác nhận đặt hàng ?",
			text: "Bạn sẽ không thể hủy đơn hàng sau khi thực hiện thao tác này!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Ok, đồng ý",
			cancelButtonText: "Không, để sau",
			closeOnConfirm: false,
			closeOnCancel: false
			},
			function(isConfirm) {
			if (isConfirm) {
				$.ajax({
					url: '{{url::to("/confirm-order")}}',
					method: 'POST',
					data: {
						shipping_name:shipping_name, shipping_email:shipping_email,shipping_phone:shipping_phone,
						shipping_address:shipping_address,shipping_note:shipping_note,payment_select:payment_select,feeship:feeship,coupon:coupon,_token:_token
					},
					success: function () {
						
					}
				});
				swal("Thành công!", "Đơn hàng của bạn đã được xác nhận", "success");
				window.setTimeout(() => {
					location.reload();
				}, 3000);
			} else {
				swal("Đã đóng!", "Đơn hàng chưa được gửi đi", "error");
			}
		});
			
		});
		$('.feeship_calculate').click(function(){
			var cityId = $('.city').val();
			var provinceId = $('.province').val();
			var wardId = $('.ward').val();
			var _token = $('input[name="_token"]').val();

			if(cityId == 0 || provinceId == 0 || wardId == 0) {
				
				alert('Vui lòng chọn địa chỉ giao hàng');
			} else {
				$.ajax({
                    url: '{{url::to("/calculate-fee")}}',
                    method: 'POST',
                    data: {
                        cityId:cityId, provinceId:provinceId,wardId:wardId,_token:_token
                    },
                    success: function () {
                    	location.reload();
                    }
                })
			}
		});
		$('.choose').on('change',function () {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';

                if(action == 'nameCity') {
                    result = "nameProvince";
                } else {
                    result = "nameWards";
                }
                
                $.ajax({
                    url: '{{url::to("/get-delivery-home")}}',
                    method: 'POST',
                    data: {
                        action:action, ma_id:ma_id, _token:_token
                    },
                    success: function (data) {
                        $('#'+result).html(data);
                    }
                })
            });
		});
	</script>
</body>
</html>