@extends('layout')


@section("content")

@foreach($product_by_id as $key => $productDetail)
<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{URL::to('public/upload/product/'.$productDetail->product_image)}}" alt="" />
            <h3>ZOOM</h3>
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">
            
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <a href=""><img src="{{URL::to('public/frontend/img/product-details/similar1.jpg')}}" alt=""></a>
                        <a href=""><img src="{{URL::to('public/frontend/img/product-details/similar2.jpg')}}" alt=""></a>
                        <a href=""><img src="{{URL::to('public/frontend/img/product-details/similar3.jpg')}}" alt=""></a>
                    </div>
                    <div class="item">
                        <a href=""><img src="{{URL::to('public/frontend/img/product-details/similar1.jpg')}}" alt=""></a>
                        <a href=""><img src="{{URL::to('public/frontend/img/product-details/similar2.jpg')}}" alt=""></a>
                        <a href=""><img src="{{URL::to('public/frontend/img/product-details/similar3.jpg')}}" alt=""></a>
                    </div>
                    <div class="item">
                        <a href=""><img src="{{URL::to('public/frontend/img/product-details/similar1.jpg')}}" alt=""></a>
                        <a href=""><img src="{{URL::to('public/frontend/img/product-details/similar2.jpg')}}" alt=""></a>
                        <a href=""><img src="{{URL::to('public/frontend/img/product-details/similar3.jpg')}}" alt=""></a>
                    </div>
                    
                </div>

                <!-- Controls -->
                <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                </a>
                <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
                </a>
        </div>

    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="{{URL::to('public/frontend/img/product-details/new.jpg')}}" class="newarrival" alt="" />
            <h2>{{$productDetail->product_name}}</h2>
            <p>Mã đồng hồ: {{$productDetail->product_id}}</p>
            <img src="{{URL::to('public/frontend/img/product-details/rating.png')}}" alt="" />
            <form action="{{URL::to('/save-cart')}}" method="POST">
            {{ csrf_field() }}
            <span>
                <span>{{number_format($productDetail->product_price).' VND'}}</span>
                <label>Số lượng:</label>
                <input name="productID" type="hidden" value="{{ $productDetail->product_id }}"/>
                <input name="quanlity" type="number" value="1" min="1"/>
                <button type="submit" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i>
                    Thêm vào giỏ hàng
                </button>
            </span>
            </form>
            <p><b>Trạng thái:</b> Còn hàng</p>
            <p><b>Tình trạng:</b> Mới 100%</p>

            <p><b>Danh mục:</b> {{$productDetail->category_name}}</p>
            <p><b>Thương hiệu:</b> {{$productDetail->branch_name}}</p>
            <div class="fb-share-button" 
                data-href="{{$meta_canonical}}" 
                data-layout="button_count" data-size="small">
                    <a target="_blank" 
                        href="https://www.facebook.com/sharer/sharer.php?u={{ $meta_canonical }}&amp;src=sdkpreparse" 
                        class="fb-xfbml-parse-ignore">
                        Share
                    </a>
                    
            </div>
            <div class="fb-like" data-href="{{ $meta_canonical }}" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="false"></div>        
            <!-- <a href=""><img src="{{URL::to('public/frontend/img/product-details/share.png')}}" class="share img-responsive"  alt="" /></a> -->
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->
<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
            <li><a href="#reviews" data-toggle="tab">Đánh giá (5)</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade  active in" id="details" >
            <div class="col-sm-12">
                <p>{!!$productDetail->product_desc!!}</p>
                
            </div>
            
        </div>
        
        <div class="tab-pane fade" id="companyprofile" >
            <div class="col-sm-12">
                <p>{!!$productDetail->product_content!!}</p>
                
            </div>
            
        </div>
        
        
        <div class="tab-pane fade" id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>
                
                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name"/>
                        <input type="email" placeholder="Email Address"/>
                    </span>
                    <textarea name="" ></textarea>
                    <b>Rating: </b> <img src="{{URL::to('public/frontend/img/product-details/rating.png')}}" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>
        
    </div>
</div><!--/category-tab-->

@endforeach
<div class="facebook-comment"><!--fb comment-->
    <h2 class="title text-center">Bình luận facebook</h2>
    <div class="fb-comments" data-href="{{ $meta_canonical }}" data-width="100%" data-numposts="5"></div>
</div>
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm gợi ý</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($relate_product->chunk(3) as $chunk_related)
            <div class="item @if ($loop->first) active @endif">
                @foreach($chunk_related as $key => $relate)	
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                    <a href="{{URL::to('chi-tiet-san-pham/'.$relate->product_id)}}">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{URL::to('public/upload/product/'.$relate->product_image)}}" alt="" />
                            <h2>{{number_format($relate->product_price)." VND"}}</h2>
                            <p>{{$relate->product_name}}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                        </div>
                            
                    </div>
                    </a>
                    </div>
                </div>
                @endforeach
                
            </div>
            @endforeach
            
        </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
            </a>			
    </div>
</div><!--/recommended_items-->
                    
					
@endsection