@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ MÃ GIẢM GIÁ
    </div>
    <?php
      $message = Session::get('message');
      if($message) {
        echo "<span class='text-alert'>".$message."</span>";
        Session::put('message',null);
      }
    ?>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên mã giảm giá</th>
            <th>Mã giảm giá</th>
            <th>Số lượng mã</th>
            <th>Chức năng mã</th>
            <th>Số lượng giảm</th>
            <th>Tùy chọn</th>
          </tr>
        </thead>
        <tbody>
          @foreach($coupon as $key =>$cp)
          <tr>
            
            <td>{{ $cp->coupon_name}}</td>
            <td>{{ $cp->coupon_code}}</td>
            <td>{{ $cp->coupon_time}}</td>
            <td><span class="text-ellipsis">
              <?php
                if($cp->coupon_condition == 1) {
              ?>
                Giảm theo phần trăm
              <?php } else { ?>
                Giảm theo tiền
              <?php 
                }
              ?>
            </span></td>
            
            <td>
              @if($cp->coupon_condition == 1)
              {{ $cp->coupon_number }} %
              @else
              {{ number_format($cp->coupon_number,0,',','.') }} VND
              @endif
            </td>
            <td>
              <a onclick="return confirm('Bạn có chắc là muốn xóa mã giảm giá này không ?')" href="{{URL::to('delete-coupon/'.$cp->coupon_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection