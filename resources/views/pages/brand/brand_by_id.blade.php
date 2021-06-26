@extends('layout')
@section("content")
<div class="features_items"><!--features_items-->
@foreach($brand_name as $key => $brandName)
<h2 class="title text-center">{{$brandName->branch_name}}</h2>
@endforeach
@foreach($brand_by_id as $key => $pro_by_brand)
<div class="col-sm-4">
   
    <div class="product-image-wrapper">
    
        <div class="single-products">
                <div class="productinfo text-center">
                    <a href="{{URL::to('chi-tiet-san-pham/'.$pro_by_brand->product_id)}}"><img src="{{URL::to('public/upload/product/'.$pro_by_brand->product_image)}}" alt="" /></a>
                    <h2>{{number_format($pro_by_brand->product_price)." VND"}}</h2>
                    <p>{{$pro_by_brand->product_name}}</p>
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