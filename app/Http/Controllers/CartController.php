<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; // dùng để thao tác với csdl.
use Session; // dùng để  lưu tạm các message sau khi thực hiện một công việc gì đó.
use App\Http\Requests; // dùng để lấy dữ liệu từ form
use Illuminate\Support\Facades\Redirect; // dùng để chuyển hướng
use Cart;
class CartController extends Controller
{
    //
    public function save_cart(Request $request) {
        $productId = $request->productID;
        $quanlity = $request->quanlity;
        $product = DB::table('tbl_product')->where('product_id',$productId)->first();
        $data['id'] = $productId;
        $data['qty'] = $quanlity;
        $data['name'] = $product->product_name;
        $data['price'] = $product->product_price;
        $data['weight'] = $product->product_price;//fake
        $data['options']['image'] = $product->product_image;
        Cart::add($data);
        return Redirect::to('view-cart');
    }
    public function view_cart(Request $request) {
        $meta_title = "Thông tin giỏ hàng";
        $meta_desc = "Trang Thông tin giỏ hàng của bạn";
        $meta_keywords = "giỏ hàng xwatch247, xwatch247 cart";
        $meta_canonical = $request->url();
        $image_og = "";
        
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $branch_product = DB::table('tbl_branch_product')->where('branch_status','1')->orderby('branch_id','desc')->get();
        return view('pages.cart.view_cart')->with('category_product',$cate_product)->with('branch_product',$branch_product)
        ->with('meta_title',$meta_title)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_canonical',$meta_canonical)
        ->with('image_og',$image_og);
    }
    public function delete_row_cart($rowId) {
        Cart::update($rowId,0);
        return Redirect::to('/view-cart');
    }
    public function update_cart_quanlity(Request $request) {
        $rowId = $request->rowIDChangeQty;
        $qty = $request->quantity_change;
        Cart::update($rowId,$qty);
        return Redirect::to('/view-cart');
    }
    // cart ajax
    public function add_cart_ajax(Request $request) {
        $data = $request->all();
        print_r($data);
    }
}
