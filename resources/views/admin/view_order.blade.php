@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      THÔNG TIN NGƯỜI MUA
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người mua</th>
            <th>Số điện thoại</th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
          
            <td>{{$order_by_id->customer_name}}</td>
            <td>{{$order_by_id->customer_phone}}</td>
          </tr>
          
        </tbody>
      </table>
    </div>
    
  </div>
</div>
<br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     THÔNG TIN VẬN CHUYỂN
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người nhận hàng</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ giao hàng</th>
            <!-- <th>Ghi chú đơn hàng</th> -->
          </tr>
        </thead>
        <tbody>
          
          <tr>
            <td>{{$order_by_id->shipping_name}}</td>
            <td>{{$order_by_id->shipping_phone}}</td>
            <td>{{$order_by_id->shipping_address}}</td>
            <!-- <td></td> -->
          </tr>
          
        </tbody>
      </table>
      
    </div>
    <span style="margin: 15px 10px;
    display: inline-block;
    color: red;"><b>Ghi chú đơn hàng:</b> {{$order_by_id->shipping_note}}</span>
  </div>
</div>
<br><br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ CHI TIẾT ĐƠN HÀNG
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng tiền</th>
          </tr>
        </thead>
        <tbody>
            @foreach($order_list as $v_order_list)
          <tr>
            <td>{{ $v_order_list->product_name }}</td>
            <td>{{ $v_order_list->product_sales_quanlity }}</td>
            <td>{{ number_format($v_order_list->product_price).' VND' }}</td>
            <td><b>{{ number_format($v_order_list->product_price*$v_order_list->product_sales_quanlity).' VND' }}</b></td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection