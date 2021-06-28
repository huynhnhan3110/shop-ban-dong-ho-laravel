@extends('layout')
@section("title","Trang thanh toán");
@section("content")
<section id="cart_items">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Thanh toán</li>
				</ol>
			</div><!--/breadcrums-->
			<div class="register-req">
				<p>Vui lòng đăng nhập hoặc đăng ký để tiến hành thanh toán</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Thông tin đơn hàng</p>
							<div class="form-one">
								<form action="{{URL::to('/save-checkout-customer')}}" method="POST">
                                    {{ csrf_field() }}
									<input type="text" name="shipping_name" placeholder="Tên người nhận">
									<input type="text" name="shipping_email" placeholder="Địa chỉ email">
									<input type="text" name="shipping_phone" placeholder="Số điện thoại">
									<input type="text" name="shipping_address" placeholder="Địa chỉ nhận hàng *">
							        <textarea name="shipping_note"  placeholder="Ghi chú đơn hàng của bạn" rows="16"></textarea>
                                    <input type="submit" class="btn btn-primary sm-10" value="Đặt hàng">
								</form>
							</div>
							
						</div>
					</div>			
				</div>
			</div>
			<div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
			</div>

			
	</section> <!--/#cart_items-->
@endsection