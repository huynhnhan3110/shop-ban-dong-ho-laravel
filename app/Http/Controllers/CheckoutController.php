<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; // dùng để thao tác với csdl.
use Session; // dùng để  lưu tạm các message sau khi thực hiện một công việc gì đó.
use App\Http\Requests; // dùng để lấy dữ liệu từ form
use Illuminate\Support\Facades\Redirect; // dùng để chuyển hướng
use Cart;
session_start();
class CheckoutController extends Controller
{
    //
    public function AuthLogin() {
        if(Session::get('admin_id') != null) {
            return Redirect::to('admin.dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function login_checkout() {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $branch_product = DB::table('tbl_branch_product')->where('branch_status','1')->orderby('branch_id','desc')->get();
        return view('pages.checkout.login_checkout')->with('category_product',$cate_product)->with('branch_product',$branch_product);
        
    }
    public function add_customer(Request $request) {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_password'] = md5($request->customer_password);

        $customer_id = DB::table('tbl_customers')->insertGetId($data);
        $customer_name = $request->customer_name;

        Session::put('customer_id',$customer_id);
        // Session::put('customer_name',$customer_name);
        
        return Redirect::to('/checkout');
    }
    public function checkout() {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $branch_product = DB::table('tbl_branch_product')->where('branch_status','1')->orderby('branch_id','desc')->get();
        return view('pages.checkout.view_checkout')->with('category_product',$cate_product)->with('branch_product',$branch_product);
    }
    public function save_checkout_customer(Request $request) {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;

        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_note'] = $request->shipping_note;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id);

        return Redirect::to('/payment');
    }
    public function payment() {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $branch_product = DB::table('tbl_branch_product')->where('branch_status','1')->orderby('branch_id','desc')->get();
        return view('pages.checkout.payment')->with('category_product',$cate_product)->with('branch_product',$branch_product);
    }
    public function logout_checkout() {
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request) {
        $email = $request->email_account;
        $password = md5($request->password_account);

        $result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();
      
        
        if($result) {
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/checkout');
        } else {
            Session::put('message','Mật khẩu hoặc tài khoản không đúng, vui lòng nhập lại!');
            return Redirect::to('/login-checkout');

        }

    }
    public function save_order(Request $request) {
      // insert payment method
        $data = array();
        $data['payment_method'] = $request->payment_value;
        $data['payment_status'] = "Đang chờ xử lý";

        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        $data_order = array();
        $data_order['customer_id'] = Session::get('customer_id');
        $data_order['shipping_id'] = Session::get('shipping_id');
        $data_order['payment_id'] = $payment_id;
        $data_order['order_total'] = Cart::total();
        $data_order['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($data_order);

        $data_detail_order = array();
        $content = Cart::content();
        
        foreach($content as $v_content) {
            $data_detail_order['order_id'] = $order_id;
            $data_detail_order['product_id'] = $v_content->id;
            $data_detail_order['product_name'] = $v_content->name;
            $data_detail_order['product_price'] = $v_content->price;
            $data_detail_order['product_sales_quanlity'] =  $v_content->qty;
            DB::table('tbl_order_details')->insert($data_detail_order);
        }
        if($data['payment_method'] == 1) {
            Cart::destroy();
            echo "Đơn này trả Thẻ ATM";
        }elseif($data['payment_method'] == 2) {
            Cart::destroy();
            $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
            $branch_product = DB::table('tbl_branch_product')->where('branch_status','1')->orderby('branch_id','desc')->get();
            
            return view('pages.checkout.handcash')->with('category_product',$cate_product)->with('branch_product',$branch_product);
        }elseif($data['payment_method'] == 3) {
            Cart::destroy();
            echo "Đơn này trả Thẻ ATM";
        }
    }
    public function manage_order() {
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')
        ->orderby('tbl_order.order_id','desc')->get();

        return view('admin.manage_order')->with('all_order',$all_order);
    }
    public function view_order_detail($order_id) {
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers','tbl_customers.customer_id','=','tbl_order.customer_id')
        ->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')
        ->join('tbl_order_details','tbl_order_details.order_id','=','tbl_order.order_id')
        ->where('tbl_order.order_id',$order_id)
        ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')->first();
        // echo "<pre>";
        // print_r($order_by_id);
        // echo "<pre>";
        $products = DB::table('tbl_order_details')->where('tbl_order_details.order_id',$order_id)->get();
        return view('admin.view_order')->with('order_by_id',$order_by_id)->with('order_list',$products);
    }
}
