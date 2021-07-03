@extends('layout')
@section("content")
<div class="features_items"><!--features_items-->
<h2 class="title text-center">Kết quả tìm kiếm</h2>
@foreach($search_product as $key => $pro)
<div class="col-sm-4">
   
    <div class="product-image-wrapper">
        <a href="{{URL::to('chi-tiet-san-pham/'.$pro->product_id)}}">
        <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{URL::to('public/upload/product/'.$pro->product_image)}}" alt="" />
                    <h2>{{number_format($pro->product_price)." VND"}}</h2>
                    <p>{{$pro->product_name}}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
                
        </div>
        </a>
        <div class="choose">
            <ul class="nav nav-pills nav-justified">
                <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                <li><a href="#"><i class="fa fa-plus-square"></i>Thêm so sánh</a></li>
            </ul>
        </div>
        
    </div>
</div>

@endforeach
</div><!--features_items-->
@endsection
