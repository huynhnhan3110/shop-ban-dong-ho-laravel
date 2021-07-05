<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; // dùng để thao tác với csdl.
use Session; // dùng để  lưu tạm các message sau khi thực hiện một công việc gì đó.
use App\Http\Requests; // dùng để lấy dữ liệu từ form
use Illuminate\Support\Facades\Redirect; // dùng để chuyển hướng
use App\Models\Category;
use App\Models\Brand;

use App\Models\Product;

session_start();
class CategoryProducts extends Controller
{
    public function AuthLogin() {
        if(Session::get('admin_id') != null) {
            return Redirect::to('admin.dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_product() {
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    public function all_category_product() {
        $this->AuthLogin();
        $all_category_product = Category::orderBy('category_id','DESC')->get();
        // $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);

        return view('admin_layout')->with('admin.all_category_product',$manager_category_product);
    }
    public function save_category_product(Request $request) {
        $this->AuthLogin();
        $category = new Category();
        $data = $request->all();
        $category->category_name = $data['category_product_name'];
        $category->category_desc = $data['category_product_desc'];
        $category->category_product_keywords = $data['category_product_keywords'];
        $category->category_status = $data['selectStatus'];

        $category->save();

        Session::put('message','Thêm danh mục thành công');
        
        return Redirect::to('add-category-product');
    }
    public function unactive_category_product($category_product_id) {
        $this->AuthLogin();
        Category::find($category_product_id)->update(['category_status'=>0]);
        Session::put('message', 'Hủy kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');

    }
    public function active_category_product($category_product_id) {
        $this->AuthLogin();
        Category::find($category_product_id)->update(['category_status'=>1]);
        Session::put('message', 'Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');

    }
    public function edit_category_product($category_product_id) {
        $this->AuthLogin();
        $edit_category_product = Category::find($category_product_id);
        // $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);

        return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);
    }
    public function update_category_product(Request $request, $category_product_id) {
        $this->AuthLogin();
        $data = $request->all();
        $category = Category::find($category_product_id);
        $category->category_name = $data['category_product_name'];
        $category->category_desc = $data['category_product_desc'];
        $category->category_product_keywords = $data['category_product_keywords'];
        $category->save();
        // $data = array();
        // $data['category_name'] = $request->category_product_name;
        // $data['category_desc'] = $request->category_product_desc;
        // $data['category_product_keywords'] = $request->category_product_keywords;

        // DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message', 'Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id) {
        $this->AuthLogin();
        Category::find($category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    // End Category Admin Page
    public function category_by_id(Request $request,$category_id,) {
       

        $cate_product = Category::orderBy('category_id','desc')->get();
        $branch_product = Brand::orderBy('branch_id','desc')->get();
        $category_by_id = Product::join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->where('tbl_category_product.category_id', $category_id)->get();
        
       
        $category_name = Category::find($category_id)->limit(1)->get();
        
        foreach($category_name as $key => $val) {
             // seo meta
             $meta_title = $val->category_name;
            $meta_desc = $val->category_desc;
            $meta_keywords = $val->category_product_keywords;
            $meta_canonical = $request->url();
            $image_og = "";
            
            // end seo meta
        }
        return view('pages.category.category_by_id')->with('category_product',$cate_product)->with('branch_product',$branch_product)
        ->with('category_by_id',$category_by_id)->with('category_name',$category_name)
        ->with('meta_title',$meta_title)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_canonical',$meta_canonical)
        ->with('image_og',$image_og);
    }
}
