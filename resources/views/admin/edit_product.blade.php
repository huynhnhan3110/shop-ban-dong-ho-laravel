@extends('admin_layout')
@section('admin_content')
<div class="form-w3layouts">
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật sản phẩm
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
                                <form role="form" action="{{URL::to('/update-product/'.$edit_product->product_id)}}" method="POST" enctype='multipart/form-data'>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{$edit_product->product_name}}">
                                    @error('product_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" value="{{$edit_product->product_price}}">
                                    @error('product_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/upload/product/'.$edit_product->product_image)}}" alt="" width="100" height="100">
                                   
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Từ khóa sản phẩm</label>
                                    <input type="text" value="{{ $edit_product->product_keywords }}" name="product_keywords" class="form-control" id="exampleInputEmail1" placeholder="Từ khóa sản phẩm">
                                    @error('product_keywords')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea rows="8" class="form-control" name="product_desc" id="ckeditor3">
                                    {{$edit_product->product_desc}}
                                    </textarea>
                                    @error('product_desc')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea rows="8" class="form-control" name="product_content" id="ckeditor4" placeholder="Mô tả sản phẩm">
                                    {{$edit_product->product_content}}
                                    </textarea>
                                    @error('product_content')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Danh mục</label>
                                    <select class="form-control input-sm m-bot15" name="selectCategory">
                                    @foreach($category_product as $key => $cate)
                                        @if($edit_product->category_id == $cate->category_id) 
                                        <option value="{{$cate->category_id}}" selected>{{$cate->category_name}}</option>
                                        @else
                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Thương hiệu</label>
                                    <select class="form-control input-sm m-bot15" name="selectBranch">
                                    @foreach($branch_product as $key => $branch)
                                        @if($edit_product->branch_id == $branch->branch_id) 
                                        <option value="{{$branch->branch_id}}" selected>{{$branch->branch_name}}</option>
                                        @else
                                        <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển thị</label>
                                    <select class="form-control input-sm m-bot15" name="selectProductStatus">
                                      
                                        @if($edit_product->product_status == 1) 
                                        <option value="1" selected>Hiển thị</option>
                                        <option value="0">Ẩn</option>

                                        @endif
                                        @if($edit_product->product_status == 0)
                                        <option value="0" selected>Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                        @endif
                                    </select>
                                </div>
                               
                                <button type="submit" class="btn btn-info">Cập nhật sản phẩm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
</div>
</div>
@endsection