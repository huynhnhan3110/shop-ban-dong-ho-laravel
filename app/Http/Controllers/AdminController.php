<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Socialite;
use App\Models\Social;
use App\Models\Login;
use App\Http\Requests;
use Validator;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
{   
    // login google
    public function login_google(){
        return Socialite::driver('google')->redirect();
   }
public function callback_google(){
        $users = Socialite::driver('google')->stateless()->user(); 
        // return $users->email;
        $authUser = $this->findOrCreateUser($users,'google');
        
        $account_name = Login::where('admin_id',$authUser->user)->first();
        Session::put('admin_name',$account_name->admin_name);
        Session::put('admin_id',$account_name->admin_id);
        
        return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
      
    }
    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){
            return $authUser;
        }
        else {
            $hieu = new Social([
                'provider_user_id' => $users->id,
                'provider' => strtoupper($provider)
            ]);
    
            $orang = Login::where('admin_email',$users->email)->first();
    
                if(!$orang){
                    $orang = Login::create([
                        'admin_name' => $users->name,
                        'admin_email' => $users->email,
                        'admin_password' => '',
    
                        'admin_phone' => '',
                        'admin_status' => 1
                    ]);
                }
            $hieu->login()->associate($orang); // lấy khóa chính làm khóa ngoại của tbl_social
            $hieu->save();
    
           return $hieu;
        }

    }

    // login fb
    public function login_facebook() {
        return Socialite::driver('facebook')->redirect();
    }
    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri  
            $account_name = Login::where('admin_id',$account->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }else{
            $hieu = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => ''

                ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();

            $account_name = Login::where('admin_id',$account->user)->first();

            Session::put('admin_name',$account_name->admin_name);
                Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        } 
    }

    // end login fb
    public function AuthLogin() {
        if(Session::get('admin_id') != null) {
            return Redirect::to('admin.dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function index() {
        return view('admin-login');
    }
    public function admin_layout() {
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request) {
        $data = $request->validate([
            'admin_email'=>'required',
            'admin_password'=>'required',
            'g-recaptcha-response'=>new Captcha(),
        ]);
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $result = Login::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        
        if($result) {
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
        } else {
            Session::put('message','Mật khẩu hoặc tài khoản không đúng, vui lòng nhập lại!');
            return Redirect::to('/admin');
        }
        
    }
    public function logout() {
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
    
}
