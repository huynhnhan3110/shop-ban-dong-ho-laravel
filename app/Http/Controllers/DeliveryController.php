<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests; // dùng để lấy dữ liệu từ form
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;

class DeliveryController extends Controller
{
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
        $cityData = City::orderBy('matp','ASC')->get();
        
        return view('admin.delivery.add_delivery')->with(compact('cityData',$cityData));
    }
}
