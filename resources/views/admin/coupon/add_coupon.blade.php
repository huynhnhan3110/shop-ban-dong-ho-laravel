@extends('admin_layout')
@section('admin_content')
<div class="form-w3layouts">
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm mã giảm giá
                        </header>
                        <?php 
                            $message = Session::get('message');
                            if($message) {
                                echo "<span class='text-alert'>".$message."</span>";
                                Session::put('message',null);
                            }
                        ?>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-coupon')}}" method="POST" enctype='multipart/form-data'>
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                    <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1">
                                </div>
                               
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã giảm giá</label>
                                    <input type="text"name="coupon_code" class="form-control">
                                   
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng mã</label>
                                    <input type="text"name="coupon_time" class="form-control">
                                   
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chức năng mã</label>
                                    <select class="form-control input-sm m-bot15" name="coupon_condition">
                                    
                                        <option value="0">------- Chọn --------</option>
                                        <option value="1">Giảm theo %</option>
                                        <option value="2">Giảm theo tiền</option>
                               
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số phần trăm giảm hoặc số tiền</label>
                                    <input type="text"name="coupon_number" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-info">Thêm mã giảm giá</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
</div>
</div>
@endsection