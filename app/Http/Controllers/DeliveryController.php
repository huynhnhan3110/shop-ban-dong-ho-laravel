<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests; // dùng để lấy dữ liệu từ form
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use Illuminate\Support\Facades\Redirect; // dùng để chuyển hướng
use Session; // 
session_start();
class DeliveryController extends Controller
{
    public function AuthLogin() {
        
        if(Session::get('admin_id') != null) {
            return Redirect::to('admin.dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function update_feeship(Request $request) {
        $data = $request->all();
        $feeship = Feeship::find($data['fee_id']);
        
        $new_fee = trim($data['fee_value'],'.');
        $feeship->fee_feeship = $new_fee;
        $feeship->save();
    }
    public function fetch_feeship() {
        $feeship = Feeship::orderBy('fee_id','DESC')->get();
        $output = '';
        $output .= '<div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>Tên tỉnh</td>
                                    <td>Tên quận huyện</td>
                                    <td>Tên xã phường</td>
                                    <td>Phí vận chuyển (VND)</td>
                                </tr>
                            </thead>
                            <tbody>';
        foreach($feeship as $key => $fee) {
            $output .= '<tr>
                <td>'.$fee->city->name_city.'</td>
                <td>'.$fee->province->name_quanhuyen.'</td>
                <td>'.$fee->wards->name_xaphuong.'</td>
                <td contenteditable data-fee_edit='.$fee->fee_id.' class="fee_edit_class">'.number_format($fee->fee_feeship,0,',','.').'</td>
            </tr>';
        }
        $output .= '</tbody></table></div>';
        echo $output;
    }
    public function add_feeship(Request $request) {
        $data = $request->all();
        $feeship = new Feeship();
        $feeship->fee_matp = $data['city'];
        $feeship->fee_maqh = $data['province'];
        $feeship->fee_xaid = $data['ward'];
        $feeship->fee_feeship = $data['feeship'];
        $feeship->save();
        
        
    }
    public function get_delivery(Request $request) {
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
    public function delivery() {
        $this->AuthLogin();
        $cityData = City::orderBy('matp','ASC')->get();
        
        return view('admin.delivery.add_delivery')->with(compact('cityData',$cityData));
    }
}
