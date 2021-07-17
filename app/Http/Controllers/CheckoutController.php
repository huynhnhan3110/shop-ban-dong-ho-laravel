<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; // dùng để thao tác với csdl.
use Session; // dùng để  lưu tạm các message sau khi thực hiện một công việc gì đó.
use App\Http\Requests; // dùng để lấy dữ liệu từ form
use Illuminate\Support\Facades\Redirect; // dùng để chuyển hướng
use Cart;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use App\Rules\Captcha;

use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetail;

session_start();
class CheckoutController extends Controller
{
    public function confirm_order(Request $request) {
        $data = $request->all();
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_note = $data['shipping_note'];
        $shipping->shipping_method = $data['payment_select'];
        $shipping->save();

        $shipping_id = $shipping->shipping_id;
        $order_code = substr(md5(microtime()), rand(0,26),5);
        
        $order = new Order();
        $order->shipping_id = $shipping_id;
        $order->customer_id = Session::get('customer_id');
        $order->order_code = $order_code;
        $order->order_status = 1;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = now();
        $order->save();
        if(Session::get('cart')) {
        foreach(Session::get('cart') as $key => $cart) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_code = $order_code;
            $orderDetail->product_id = $cart['product_id'];
            $orderDetail->product_name = $cart['product_name'];
            $orderDetail->product_price = $cart['product_price'];
            $orderDetail->product_sales_quanlity = $cart['product_qty'];
            $orderDetail->order_feeship = $data['feeship'];
            $orderDetail->order_coupon =  $data['coupon'];
            $orderDetail->save();
         }
        }
        Session::forget('fee');
        Session::forget('cart');
        Session::forget('coupon');

    }
    public function delete_fee_home() {
        if(Session::get('fee')) {
            Session::forget('fee');
        }
        return redirect()->back();
    }
    public function calculate_fee(Request $request) {
        $data = $request->all();
        $feeship = Feeship::where('fee_matp',$data['cityId'])->where('fee_maqh',$data['provinceId'])->where('fee_xaid',$data['wardId'])->get();
        if($feeship) {
            if($feeship->count() > 0) {
                foreach($feeship as $key => $fee) {
                    Session::put('fee',$fee->fee_feeship);
                    Session::save();
                }
            } else {
                Session::put('fee',10000);
                Session::save();
            }
            
            
        }        
    }
    public function get_delivery_home(Request $request) {
        $data = $request->all();
        $output = '';
        if($data['action'] == 'nameCity') {
            $selectProvince = Province::where('matp',$data['ma_id'])->orderBy('maqh','ASC')->get();
            $output .= "<option value='0'>---Chọn quận huyện---</option>";
            foreach($selectProvince as $key => $qh) {
                $output .="<option value='".$qh->maqh."'>".$qh->name_quanhuyen."</option>";
            }
        } else {
            $selectWards = Wards::where('maqh',$data['ma_id'])->orderBy('xaid','ASC')->get();
            $output .= "<option value='0'>---Chọn xã phường---</option>";
            foreach($selectWards as $key => $xp) {
                $output .= "<option value='".$xp->xaid."'>".$xp->name_xaphuong."</option>";
            }
        }
        echo $output;
    }
    public function AuthLogin() {
        if(Session::get('admin_id') != null) {
            return Redirect::to('admin.dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function login_checkout(Request $request)  {
        $meta_title = "Đăng nhập hoặc đăng ký tài khoản";
        $meta_desc = "Đăng nhập hoặc đăng ký tài khoản của shop";
        $meta_keywords = "đăng nhập xwatch247, xwatch247 login";
        $meta_canonical = $request->url();
        $image_og = "";

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $branch_product = DB::table('tbl_branch_product')->where('branch_status','1')->orderby('branch_id','desc')->get();
        return view('pages.checkout.login_checkout')->with('category_product',$cate_product)->with('branch_product',$branch_product)
        ->with('meta_title',$meta_title)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_canonical',$meta_canonical)
        ->with('image_og',$image_og);
        
    }
    public function add_customer(Request $request) {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_password'] = md5($request->customer_password);

        $validated = $request->validate([
            'customer_name' => 'required|min:5',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|numeric|min:9',
            'customer_password' => 'required|min:6',
            'g-recaptcha-response'=>new Captcha(),
        ]);

        $customer_id = DB::table('tbl_customers')->insertGetId($data);
        $customer_name = $request->customer_name;

        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$customer_name);
        
        return Redirect::to('/checkout');
    }
    public function checkout(Request $request) {
        $meta_title = "Thông tin giao hàng";
        $meta_desc = "Trang nhập thông tin giao hàng của bạn";
        $meta_keywords = "giao hàng xwatch247, xwatch247 checkout";
        $meta_canonical = $request->url();
        $image_og = "";
        $city = City::orderBy('matp')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $branch_product = DB::table('tbl_branch_product')->where('branch_status','1')->orderby('branch_id','desc')->get();
        return view('pages.checkout.view_checkout')->with('category_product',$cate_product)->with('branch_product',$branch_product)
        ->with('meta_title',$meta_title)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_canonical',$meta_canonical)
        ->with('image_og',$image_og)->with('cityData',$city);
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
    public function payment(Request $request) {
        $meta_title = "Chọn phương thức thanh toán";
        $meta_desc = "Trang Chọn phương thức thanh toán của bạn";
        $meta_keywords = "thanh toán xwatch247, xwatch247 payment";
        $meta_canonical = $request->url();
        $image_og = "";
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $branch_product = DB::table('tbl_branch_product')->where('branch_status','1')->orderby('branch_id','desc')->get();
        return view('pages.checkout.payment')->with('category_product',$cate_product)->with('branch_product',$branch_product)
        ->with('meta_title',$meta_title)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_canonical',$meta_canonical)
        ->with('image_og',$image_og);
    }
    public function logout_checkout() {
        Session::put('shipping_id',null);
        Session::put('customer_id',null);
        Session::put('customer_name',null);
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request) {
        $email = $request->email_account;
        $password = md5($request->password_account);

        $result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();
      
        
        if($result) {
            Session::put('customer_id',$result->customer_id);
            Session::put('customer_name',$result->customer_name);
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
            
            $meta_title = "Đặt hàng thành công";
            $meta_desc = "";
            $meta_keywords = "";
            $meta_canonical = $request->url();
            $image_og = "";

            return view('pages.checkout.handcash')->with('category_product',$cate_product)->with('branch_product',$branch_product)
            ->with('meta_title',$meta_title)
            ->with('meta_desc',$meta_desc)
            ->with('meta_keywords',$meta_keywords)
            ->with('meta_canonical',$meta_canonical)
            ->with('image_og',$image_og);
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
        
        $products = DB::table('tbl_order_details')->where('tbl_order_details.order_id',$order_id)->get();
        return view('admin.view_order')->with('order_by_id',$order_by_id)->with('order_list',$products);
    }
    public function delete_order($order_id) {
        $this->AuthLogin();
        DB::table('tbl_order_details')->where('order_id',$order_id)->delete();
        DB::table('tbl_order')->where('order_id',$order_id)->delete();
        Session::put('message','Xóa đơn hàng thành công');
        return Redirect::to('/manage-order');
    }
    
}
