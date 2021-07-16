<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\Redirect; // dùng để chuyển hướng
use Session; // dùng để  lưu tạm các message sau khi thực hiện một công việc gì đó.
use App\Http\Requests; // dùng để lấy dữ liệu từ form
session_start();

class CouponController extends Controller
{
    public function AuthLogin() {
        
        if(Session::get('admin_id') != null) {
            return Redirect::to('admin.dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function unset_coupon() {
        $coupon = Session::get('coupon');
        if($coupon) {
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã giảm giá thành công');
        }
    }
    public function add_coupon() {
        $this->AuthLogin();
        return view('admin.coupon.add_coupon');
    }
    public function save_coupon(Request $request) {
        $data = $request->all();
        $coupon = new Coupon();
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->save();
        Session::put('message','Thêm thành công mã giảm giá');
        return view('admin.coupon.add_coupon');
    }
    public function all_coupon() {
        $this->AuthLogin();
        $coupon = Coupon::orderBy('coupon_id','DESC')->get();
        return view('admin.coupon.all_coupon')->with(compact('coupon',$coupon));
    }
    public function delete_coupon($coupon_id) {
        $coupon = Coupon::find($coupon_id)->first();
        $coupon->delete();
        Session::put('message','Xóa mã giảm giá thành công');
        return Redirect::to('/all-coupon');
    }
}
