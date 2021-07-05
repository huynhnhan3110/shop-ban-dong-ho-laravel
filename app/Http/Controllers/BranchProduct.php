<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB; // dùng để thao tác với csdl.
use App\Models\Brand;

use Session; // dùng để  lưu tạm các message sau khi thực hiện một công việc gì đó.
use App\Http\Requests; // dùng để lấy dữ liệu từ form
use Illuminate\Support\Facades\Redirect; // dùng để chuyển hướng
session_start();
class BranchProduct extends Controller
{
    public function AuthLogin() {
        if(Session::get('admin_id') != null) {
            return Redirect::to('admin.dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function add_branch_product() {
        $this->AuthLogin();
        return view('admin.add_branch_product');
    }
    public function all_branch_product() {
        $this->AuthLogin();
        $all_branch_product = Brand::orderBy('branch_id','DESC')->get();
        
        // $all_branch_product = DB::table('tbl_branch_product')->get();
        $manager_branch_product = view('admin.all_branch_product')->with('all_branch_product',$all_branch_product);

        return view('admin_layout')->with('admin.all_branch_product',$manager_branch_product);
    }
    public function save_branch_product(Request $request) {
        $this->AuthLogin();
        $data = $request->all();
        $brand = new Brand();
        $brand->branch_name = $data['branch_product_name'];
        $brand->branch_product_keywords = $data['branch_product_keywords'];
        $brand->branch_desc = $data['branch_product_desc'];
        $brand->branch_status = $data['selectStatus'];
        $brand->save();
        // $data = array();
        // $data['branch_name'] = $request->branch_product_name;
        // $data['branch_product_keywords'] = $request->branch_product_keywords;

        // $data['branch_desc'] = $request->branch_product_desc;
        // $data['branch_status'] = $request->selectStatus;
        
        // DB::table('tbl_branch_product')->insert($data);
        Session::put('message','Thêm thương hiệu thành công');
        
        return Redirect::to('add-branch-product');
    }
    public function unactive_branch_product($branch_product_id) {
        $this->AuthLogin();
        Brand::find($branch_product_id)->update(['branch_status' => 0]);
        // DB::table('tbl_branch_product')->where('branch_id',$branch_product_id)->update(['branch_status'=>0]);
        Session::put('message', 'Hủy kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-branch-product');

    }
    public function active_branch_product($branch_product_id) {
        $this->AuthLogin();
        Brand::find($branch_product_id)->update(['branch_status'=>1]);
        // DB::table('tbl_branch_product')->where('branch_id',$branch_product_id)->update(['branch_status'=>1]);
        Session::put('message', 'Kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-branch-product');

    }
    public function edit_branch_product($branch_product_id) {
        $this->AuthLogin();
        $edit_branch_product = Brand::find($branch_product_id);

        // $edit_branch_product = DB::table('tbl_branch_product')->where('branch_id',$branch_product_id)->get();
        $manager_branch_product = view('admin.edit_branch_product')->with('edit_branch_product',$edit_branch_product);

        return view('admin_layout')->with('admin.edit_branch_product',$manager_branch_product);
    }
    public function update_branch_product(Request $request, $branch_product_id) {
        $this->AuthLogin();
        $data = $request->all();
        $brand = Brand::find($branch_product_id);
        $brand->branch_name = $data['branch_product_name'];
        $brand->branch_product_keywords = $data['branch_product_keywords'];
        $brand->branch_desc = $data['branch_product_desc'];
        $brand->save();
        // $data = array();
        // $data['branch_name'] = $request->branch_product_name;
        // $data['branch_product_keywords'] = $request->branch_product_keywords;
        // $data['branch_desc'] = $request->branch_product_desc;

        // DB::table('tbl_branch_product')->where('branch_id',$branch_product_id)->update($data);
        Session::put('message', 'Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-branch-product');
    }
    public function delete_branch_product($branch_product_id) {
        $this->AuthLogin();
        Brand::find($branch_product_id)->delete();
        // DB::table('tbl_branch_product')->where('branch_id',$branch_product_id)->delete();
        Session::put('message','Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-branch-product');
    }
    // End Branch Admin Page
    public function brand_by_id($brand_id, Request $request) {
        

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $branch_product = DB::table('tbl_branch_product')->where('branch_status','1')->orderby('branch_id','desc')->get();

        $brand_by_id = DB::table('tbl_product')->join('tbl_branch_product','tbl_product.branch_id','=','tbl_branch_product.branch_id')
        ->where('tbl_branch_product.branch_id', $brand_id)->get();


        $brand_name = DB::table('tbl_branch_product')->where('branch_id',$brand_id)->limit(1)->get();

        foreach($brand_name as $key => $val) {
            // seo meta
            $meta_title = $val->branch_name;
           $meta_desc = $val->branch_desc;
           $meta_keywords = $val->branch_product_keywords;
           $meta_canonical = $request->url();
           $image_og = "";
           // end seo meta
       }

        return view('pages.brand.brand_by_id')->with('category_product',$cate_product)->with('branch_product',$branch_product)
        ->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name)
        ->with('meta_title',$meta_title)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_canonical',$meta_canonical)
        ->with('image_og',$image_og);
    }
}
