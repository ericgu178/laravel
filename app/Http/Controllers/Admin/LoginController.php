<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Session;
class LoginController extends Controller
{
    public function login(Request $request){
    	if($request->isMethod('post')){
            $data = $request->input('data');
            $username = $data['username'];
            $password = $data['password'];

            $res = DB::table('admin')->where([["username",'=',$username],["password",'=',md5($password)]])->first();

            if(empty($res)){
                return array("errcode"=>202,"errmsg"=>"账号或密码错误");
            }
            $update['last_time'] = date('Y-m-d H:i:s',time());
            $update['count'] = $res->count+1;
            DB::table('admin')->where('username',$username)->update($update);
            Session::put('info',$res);
            return array("errcode"=>0);

        }
        else{
            return view('admin.login.login');
        }
    }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data['username'] = $request->input('username');
            $res = DB::table('user')->where("username",'=',$data['username'])->first();
            if(!empty($res)){
                return array('errcode'=>201,"errmsg"=>"该用户已被注册");
            }
            if($request->input('is_sub')==1){
                $data['password'] = md5($request->input('password'));
                $data['create_time'] = date('Y-m-d H:i:s',time());
                DB::table('user')->insert($data);
            }
            return array('errcode'=>0);

        }
        else{
            return view('admin.login.register');
        }
    }
    // 退出
    public function logout(){
        Session::forget('info');
    }
}
