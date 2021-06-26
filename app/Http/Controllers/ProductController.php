<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; // dùng để thao tác với csdl.
use Session; // dùng để  lưu tạm các message sau khi thực hiện một công việc gì đó.
use App\Http\Requests; // dùng để lấy dữ liệu từ form
use Illuminate\Support\Facades\Redirect; // dùng để chuyển hướng
session_start();
class ProductController extends Controller
{
    public function AuthLogin() {
        if(Session::get('admin_id') != null) {
            return Redirect::to('admin.dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function add_product() {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $branch_product = DB::table('tbl_branch_product')->orderby('branch_id','desc')->get();

        return view('admin.add_product')->with('category_product',$cate_product)->with('branch_product',$branch_product);
    }
    public function all_product() {
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')->join('tbl_branch_product','tbl_product.branch_id','=','tbl_branch_product.branch_id')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->orderby('product_id','desc')->get();
        return view('admin.all_product')->with('all_product',$all_product);
    }
    public function save_product(Request $request) {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['branch_id'] = $request->selectBranch;
        $data['category_id'] = $request->selectCategory;
        $data['product_content'] = $request->product_content;
        $data['product_desc'] = $request->product_desc;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->selectProductStatus;
        
        $file_select = $request->file('product_image');
        if($file_select != null) {
            $split = explode('.',$file_select->getClientOriginalName());
            $get_image_name = current($split); // chi lay ten - 0 lay duoi
            $get_extension = end($split); // lay extension
            $new_image_file = $get_image_name.rand(0,99).'.'.$get_extension; // tao ten moi ket hop random va lay duoi.
            $file_select->move('public/upload/product/',$new_image_file);
            $data['product_image'] = $new_image_file;
        }
        else {$data['product_image'] = '';}
        DB::table('tbl_product')->insert($data);
        Session::put('message','Thêm sản phẩm thành công');
        
        return Redirect::to('all-product');
    }
    public function unactive_product($product_id) {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message', 'Hủy kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');

    }
    public function active_product($product_id) {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message', 'Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');

    }
    public function edit_product($product_id) {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $branch_product = DB::table('tbl_branch_product')->orderby('branch_id','desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_branch_product = view('admin.edit_product')->with('edit_product',$edit_product)
        ->with('category_product',$cate_product)->with('branch_product',$branch_product);

        return view('admin_layout')->with('admin.edit_product',$manager_branch_product);
    }
    public function update_product(Request $request, $product_id) {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['branch_id'] = $request->selectBranch;
        $data['category_id'] = $request->selectCategory;
        $data['product_content'] = $request->product_content;
        $data['product_desc'] = $request->product_desc;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->selectProductStatus;
        
        $file_select = $request->file('product_image');
        if($file_select != null) {
            $split = explode('.',$file_select->getClientOriginalName());
            $get_image_name = current($split); // chi lay ten - 0 lay duoi
            $get_extension = end($split); // lay extension
            $new_image_file = $get_image_name.rand(0,99).'.'.$get_extension; // tao ten moi ket hop random va lay duoi.
            $file_select->move('public/upload/product/',$new_image_file);
            $data['product_image'] = $new_image_file;
        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function delete_product($product_id) {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }

    // End Admin Page
    public function detail_product($product_id) {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $branch_product = DB::table('tbl_branch_product')->where('branch_status','1')->orderby('branch_id','desc')->get();

        $product_by_id = DB::table('tbl_product')->join('tbl_branch_product','tbl_product.branch_id','=','tbl_branch_product.branch_id')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.product_id',$product_id)->get();
    
        foreach($product_by_id as $key => $product) {
            $category_id = $product->category_id;
        }
        
        $relate_product = DB::table('tbl_product')->join('tbl_branch_product','tbl_product.branch_id','=','tbl_branch_product.branch_id')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->where('tbl_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();
    

        return view('pages.product.detail-product')->with('category_product',$cate_product)->with('branch_product',$branch_product)
        ->with('product_by_id',$product_by_id)
        ->with('relate_product',$relate_product);
    }

    
}
