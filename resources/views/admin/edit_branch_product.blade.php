@extends('admin_layout')
@section('admin_content')
<div class="form-w3layouts">
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa thương hiệu sản phẩm
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
                            @foreach($edit_branch_product as $key => $edit_value)
                                <form role="form" action="{{URL::to('/update-branch-product/'.$edit_value->branch_id)}}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" value= "{{$edit_value->branch_name}}" name="branch_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                                    <textarea rows="8" class="form-control" name="branch_product_desc" id="exampleInputPassword1" placeholder="Mô tả thương hiệu">{{$edit_value->branch_desc}}
                                    </textarea>
                                </div>
                               
                                <button type="submit" class="btn btn-info">Lưu</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
</div>
</div>
@endsection