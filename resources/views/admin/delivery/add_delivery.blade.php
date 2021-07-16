@extends('admin_layout')
@section('admin_content')
<div class="form-w3layouts">
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm giá vận chuyển
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
                                <form role="form" action="{{URL::to('/save-branch-product')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputFile">Chọn thành phố</label>
                                    <select class="form-control input-sm m-bot15 choose city" name="nameCity" id="nameCity">
                                        <option value="0">Chọn tỉnh thành phố</option>
                                        @foreach($cityData as $key => $ci) 
                                            <option value="{{ $ci->matp }}">{{ $ci->name_city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Chọn quận huyện</label>
                                    <select class="form-control input-sm m-bot15 choose province" name="nameProvince" id="nameProvince">
                                        <option value="0">Chọn quận huyện</option>
                                        

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Chọn xã phường</label>
                                    <select class="form-control input-sm m-bot15 ward" name="nameWards" id="nameWards">
                                        <option value="0">Chọn xã phường</option>

                                    </select>
                                </div>
                               
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phí vận chuyển</label>
                                    <input type="text" name="feeship" class="form-control feeship" id="feeship">
                                </div>
                                <button type="button" class="btn btn-info feeship_add">Thêm phí vận chuyển</button>
                            </form>
                            </div>

                        </div>
                        <div id="fetch_delivery"></div>
                    </section>

            </div>
</div>
</div>
@endsection