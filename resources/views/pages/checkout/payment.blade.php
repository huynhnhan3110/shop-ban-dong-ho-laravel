@extends('layout')
@section("title","Trang xác nhận thanh toán")
@section("content")
<section id="cart_items">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="review-payment">
				<h2>Xem lại giỏ hàng và chọn phương thức thanh toán</h2>
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
                        $carts = Cart::content();
                    ?>
                    @foreach($carts as $cart_item)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/upload/product/'.$cart_item->options->image)}}" alt="" width="50" height="50"></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$cart_item->name}}</a></h4>
								<p>Mã đồng hồ: {{$cart_item->id}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($cart_item->price)." VND"}}</p>
							</td>
							<td class="cart_quantity">
								<form action="{{URL::to('/update-view-cart')}}" method="POST">
								{{ csrf_field() }}
								<div class="cart_quantity_button">
									<input type="hidden" name="rowIDChangeQty" value="{{$cart_item->rowId}}">
									<input class="cart_quantity_input" type="number" name="quantity_change" value="{{$cart_item->qty}}" size="2">
									<input type="submit" value="Cập nhật" class="submitQty">
								</div>
								</form>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
                                    <?php
                                        $subtotal = $cart_item->price * $cart_item->qty;
                                        echo number_format($subtotal). " VND";
                                    ?>
                                </p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$cart_item->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
                        
						</tr>
                    @endforeach
					</tbody>
				</table>
			</div>
			<div class="payment-options">
                <div class="review-payment">
                <h2>Chọn hình thức thanh toán</h2>
                </div>
                <form action="{{URL::to('save-order')}}" method="POST">
                    {{ csrf_field() }}
					<span>
						<label><input type="checkbox" name="payment_value" value="1"> Trả trước bằng thẻ ATM</label>
					</span>
					<span>
						<label><input type="checkbox" name="payment_value" value="2"> Trả tiền khi nhận hàng</label>
					</span>
                    <span>
						<label><input type="checkbox" name="payment_value" value="3"> Trả bằng thẻ ghi nợ</label>
					</span>
                    <input type="submit" class="btn btn-primary sm-10" value="Đặt hàng">

                </form>
				</div>
		</div>
			
	</section> <!--/#cart_items-->
@endsection