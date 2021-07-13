@extends('layout')
@section("title","Trang giỏ hàng")
@section("content")
<section id="cart_items">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Home</a></li>
				  <li class="active">Giỏ hàng của bạn</li>
				</ol>
			</div>
            
            
			<div class="table-responsive cart_info">
			<?php
				$totalcartPrice = 0;
			?>
			

			@if(session()->has('message'))
			<div class="alert alert-danger">
				{{ session()->get('message') }}
			</div>
			@elseif(session()->has('error'))
				{{ session()->get('error') }}
			@endif
			
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sản phẩm</td>
							<td class="price">Giá sản phẩm</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Thành tiền</td>
							<td></td>
						</tr>
					</thead>
					<form action="{{URL::to('/update-cart')}}" method="POST">
					<tbody>
					
					@if(Session::get('cart'))
                        @foreach(Session::get('cart') as $key => $cart)
						
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/upload/product/'.$cart['product_image'])}}" alt="" width="50" height="50"></a>
							</td>
							<td class="cart_description">
								<h4><a href="{{URL::to('/chi-tiet-san-pham/'.$cart['product_id'])}}">{{$cart['product_name']}}</a></h4>
								<!-- <p>Mã: {{$cart['product_id']}}</p> -->
							</td>
							<td class="cart_price">
								<p>{{number_format($cart['product_price'],0,',','.')}}đ</p>
							</td>
							<td class="cart_quantity">
								
								{{ csrf_field() }}
								<div class="cart_quantity_button">
									<input class="cart_quantity_input" type="number" min="1" name="quantity_change[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" size="2">
								</div>
								
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
                                   @php
                                   $totalPrice = $cart['product_price'] * $cart['product_qty'];
                                   echo number_format($totalPrice,0,',','.');
                                   $totalcartPrice += $totalPrice;
                                   @endphpđ</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/del-cart/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
								
							</td>
                        
						</tr>
                        @endforeach
						<tr>
							<td colspan="5">
								<input type="submit" value="Cập nhật giỏ hàng" class="submitQty check_out">
								<a href="{{URL::to('/delete-cart')}}" class="submitQty check_out">Xóa tất cả sản phẩm</a>
								
									<?php
									$customer_id = Session::get('customer_id');
								
									if($customer_id != NULL) {
									?>
									<a class="check_out" onclick="return alert('Bạn chưa có gì trong giỏ hàng, vui lòng thêm một sản phẩm')" href="#">Thanh toán</a>
									<?php }
									elseif($customer_id != NULL){?>
										<a class="check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
									<?php }  else { ?>
										<a class="check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
									<?php } ?>
								<div class="pull-right"><ul>
									<li>Tổng tiền sản phẩm <span>{{number_format($totalcartPrice,0,',','.')}}đ</span></li>
									<li>Thuế <span></span></li>
									<li>Phí vận chuyển <span></span></li>
									<li>Tổng tiền thanh toán <span></span></li>
								</ul></div>
							</td>
						</tr>
					
						
					</tbody>
					</form>
					<tr>
						<td>
							<form action="{{URL::to('/check-coupon')}}" method="POST">
							@csrf
							<input type="text" name="coupon_code" class="form-control" placeholder="Nhập mã giảm giá">
							<input type="submit" class="submitQty check_out" value="Áp dụng mã giảm giá">
							</form>
						</td>
					</tr>
					@else
						<tr><td colspan="5"><center><p>Không có sản phẩm nào</p></center></td></tr>
						@endif
				</table>
				
				
			</div>
			
	</section> <!--/#cart_items-->
	
@endsection