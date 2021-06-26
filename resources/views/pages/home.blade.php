@extends('layout')
@section("content")
<div class="features_items"><!--features_items-->
<h2 class="title text-center">Sản phẩm mới nhất</h2>
@foreach($product as $key => $pro)
<div class="col-sm-4">
   
    <div class="product-image-wrapper">
    
        <div class="single-products">
                <div class="productinfo text-center">
                    <a href="{{URL::to('chi-tiet-san-pham/'.$pro->product_id)}}"><img src="{{URL::to('public/upload/product/'.$pro->product_image)}}" alt="" /></a>
                    <h2>{{number_format($pro->product_price)." VND"}}</h2>
                    <p>{{$pro->product_name}}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
                
        </div>
        
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