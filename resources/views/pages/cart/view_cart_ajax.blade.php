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
					<tbody>
                        <?php
                            $totalcartPrice = 0;
                        ?>
                        @foreach(Session::get('cart') as $key => $cart)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/upload/product/'.$cart['product_image'])}}" alt="" width="50" height="50"></a>
							</td>
							<td class="cart_description">
								<h4><a href=""></a></h4>
								<p>Mã đồng hồ: {{$cart['product_id']}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($cart['product_price'],0,',','.')}}đ</p>
							</td>
							<td class="cart_quantity">
								<form action="{{URL::to('/update-view-cart')}}" method="POST">
								{{ csrf_field() }}
								<div class="cart_quantity_button">
									<input type="hidden" name="rowIDChangeQty" value="">
									<input class="cart_quantity_input" type="number" name="quantity_change" value="{{$cart['product_qty']}}" size="2">
									<input type="submit" value="Cập nhật" class="submitQty">
								</div>
								</form>
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
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/')}}"><i class="fa fa-times"></i></a>
							</td>
                        
						</tr>
                        @endforeach
					</tbody>
				</table>
			</div>
	</section> <!--/#cart_items-->
    <section id="do_action">
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng tiền sản phẩm <span>{{number_format($totalcartPrice,0,',','.')}}đ</span></li>
							<li>Thuế <span></span></li>
							<li>Phí vận chuyển <span></span></li>
							<li>Tổng tiền thanh toán <span></span></li>
						</ul>
							<?php
									$customer_id = Session::get('customer_id');
								
									if($customer_id != NULL) {
									?>
									<a class="btn btn-default check_out" onclick="return alert('Bạn chưa có gì trong giỏ hàng, vui lòng thêm một sản phẩm')" href="#">Thanh toán</a>
									<?php }
									elseif($customer_id != NULL){?>
										<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
									<?php }  else { ?>
										<a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
									<?php } ?>
							
					</div>
				</div>
			</div>
	</section><!--/#do_action-->

@endsection