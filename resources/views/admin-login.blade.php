<!DOCTYPE html>
<head>
<title>Trang đăng nhập admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>Đăng nhập</h2>
		<span class='text-alert'>
			<?php 
				$message = Session::get('message');
				if($message) {
					echo $message;
					Session::put('message',null);
				}
			?>
		</span>
		<form action="{{URL::to('/admin_dashboard')}}" method="post">
			{{ csrf_field() }}
			<ul style="list-style-type: circle;margin-left: 18px;">
			@foreach($errors->all() as $error) 
				<li>{{ $error }}</li>
			@endforeach
			</ul>
			<input type="text" class="ggg" name="admin_email" placeholder="Địa chỉ email" >
			<input type="password" class="ggg" name="admin_password" placeholder="Mật khẩu" >
			<span class='text-remember'><input type="checkbox" />Nhớ mật khẩu</span>
			<h6><a href="#">Quên mật khẩu</a></h6>
				<div class="g-recaptcha" style="margin-top:23px; display:inline-block;" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
				<br/>
				<div class="clearfix"></div>
				<input type="submit" value="Đăng nhập" name="login">
				<p><a href="{{URL::to('/login-fb')}}">Đăng nhập qua facebook </a>|
				<a href="{{URL::to('/login-google')}}">Đăng nhập qua Google</a>
				</p>
				<p></p>
		</form>
		<!-- <p>Don't Have an Account ?<a href="registration.html">Create an account</a></p> -->
</div>
</div>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="public/backend/js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>
</html>
