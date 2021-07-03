@extends('admin_layout')
@section('admin_content')
<div class="form-w3layouts">
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm danh mục sản phẩm
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
                                <form role="form" action="{{URL::to('/save-category-product')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea rows="8" class="form-control" name="category_product_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục">
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Từ khóa danh mục</label>
                                    <input type="text" name="category_product_keywords" class="form-control" id="exampleInputEmail1" placeholder="Từ khóa">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển thị</label>
                                    <select class="form-control input-sm m-bot15" name="selectStatus">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    </select>
                                </div>
                               
                                <button type="submit" class="btn btn-info">Thêm danh mục</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
</div>
</div>
@endsection