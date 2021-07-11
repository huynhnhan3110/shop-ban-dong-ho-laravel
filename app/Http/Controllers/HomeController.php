<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; // dùng để thao tác với csdl.
use Session; // dùng để  lưu tạm các message sau khi thực hiện một công việc gì đó.
use App\Http\Requests; // dùng để lấy dữ liệu từ form
use Illuminate\Support\Facades\Redirect; // dùng để chuyển hướng
use Mail;
session_start();
class HomeController extends Controller
{
    public function send_mail(Request $request) {
        $from_name = $request->contact_name; // ten nguoi gui
        $to_email = "huynhnhan.dev@gmail.com";//send to this email
        $subject = $request->contact_subject." - phản hồi từ Xwatch247";
        $data = array("name"=>$from_name,"emailKH"=>$request->contact_email,"body"=>$request->contact_message); //body of mail.blade.php

        Mail::send('pages.send_mail',$data,function($message) use ($from_name,$to_email,$subject){
            $message->to($to_email)->subject($subject);//send this mail with subject
            $message->from($to_email,$from_name);//send from this mail
        });
        Session::put('message','Đã gửi thành công, xin cảm ơn bạn');
        return Redirect::to('/contact');
    }
    public function contact(Request $request) {
        $meta_title = "Liên hệ";
        $meta_desc = "Đồng hồ giá tốt, chính hãng, thời trang với giá tiền phù hợp cho tất cả mọi người.";
        $meta_keywords = "đồng hồ, đồng hồ nam, watch store, đồng hồ nữ";
        $meta_canonical = $request->url();
        $image_og = "";
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $branch_product = DB::table('tbl_branch_product')->where('branch_status','1')->orderby('branch_id','desc')->get();
        
        return view('pages.contact')->with('category_product',$cate_product)->with('branch_product',$branch_product)
        ->with('meta_title',$meta_title)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_canonical',$meta_canonical)
        ->with('image_og',$image_og);
    }
    public function index(Request $request) {
        // seo meta
        $meta_title = "Shop đồng hồ Xwatch247 - Trang chủ";
        $meta_desc = "Đồng hồ giá tốt, chính hãng, thời trang với giá tiền phù hợp cho tất cả mọi người.";
        $meta_keywords = "đồng hồ, đồng hồ nam, watch store, đồng hồ nữ";
        $meta_canonical = $request->url();
        $image_og = "";

        // end seo meta
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $branch_product = DB::table('tbl_branch_product')->where('branch_status','1')->orderby('branch_id','desc')->get();
        

        $product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(9)->get();
        return view('pages.home')->with('category_product',$cate_product)->with('branch_product',$branch_product)
        ->with('product',$product)
        ->with('meta_title',$meta_title)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_canonical',$meta_canonical)
        ->with('image_og',$image_og);
    }
    public function search(Request $request) {
        

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $branch_product = DB::table('tbl_branch_product')->where('branch_status','1')->orderby('branch_id','desc')->get();
       
        $keywords = $request->keywordsubmit;
        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
        // seo meta
        
        $meta_title = "Tìm '$keywords' trong Xwatch247";
        $meta_desc = "Trang tìm kiếm sản phẩm của shop";
        $meta_keywords = "search xwatch247, tìm kiếm xwatch247";
        $meta_canonical = $request->url();
        $image_og = "";

        // end seo meta
        return view('pages.product.search')->with('category_product',$cate_product)->with('branch_product',$branch_product)->with('search_product',$search_product)
        ->with('meta_title',$meta_title)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_canonical',$meta_canonical)
        ->with('image_og',$image_og);    
    }
}
