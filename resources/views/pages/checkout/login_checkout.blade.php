@extends('layout')
@section("title","Trang đăng nhập thanh toán");
@section("content")
<section id="form"><!--form-->
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập</h2>
						<form action="{{URL::to('/login')}}" method="POST">
							<span><?php 
								$message = Session::get('message');
								if($message) {
									echo $message;
									Session::put('message',NULL);
								}
							?></span>
							
							{{ csrf_field() }}
							<input type="email" placeholder="Địa chỉ email" name="email_account"/>
							<input type="password" placeholder="Mật khẩu" name="password_account" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Ghi nhớ đăng nhập
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">HOẶC</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký tài khoản</h2>
						<form action="{{URL::to('/add-customer')}}" method="POST">
							{{csrf_field()}}
							<input type="text" name="customer_name" placeholder="Họ tên"/>
							<input type="email" name="customer_email" placeholder="Địa chỉ email"/>
							<input type="tel" name="customer_phone" placeholder="Số điện thoại">
							<input type="password" name="customer_password" placeholder="Mật khẩu"/>
							<button type="submit" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
	</section><!--/form-->

@endsection