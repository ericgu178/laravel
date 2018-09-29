<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;

class AdminController extends HomeController
{
    public function index(){
    	$data = DB::table('admin')->paginate(10);
    	return view('admin.admin.user')->with('data',$data);
    }
    // 添加页面
    public function create(){

    }
    // 插入管理员
    public function store(Request $request){
       if($request->isMethod('post')){
            if(empty($request->input('_token'))){
                return array('errcode'=>902,'errmsg'=>"不存在_token");
            }
            $data = $request->input('data');
            $username = trim($data['username']);
            $password = trim($data['password']);
            $repassword = trim($data['repassword']);

            unset($data['repassword']);
            if(empty($username)||empty($password)||empty($repassword)){
                return array('errcode'=>101,'errmsg'=>"填写信息不完全");
            }

            if($password!=$repassword){
                return array('errcode'=>102,'errmsg'=>"密码不一致");
            }

            if(!empty(DB::table('admin')->where('username',$username)->first())){
                return array('errcode'=>109,"errmsg"=>"用户名已存在");
            }

            $data['password'] = md5($data['password']);
            $data['create_time'] = date("Y-m-d H:i:s",time());
            if(DB::table('admin')->insert($data)){
                return 1;
            }else{
                return 0;
            }
       }
       else{
            return array('errcode'=>901,'errmsg'=>"不是post提交！");
       }
    }
    // 修改页面  admin/admin/{admin}/edit get
    public function edit(Request $request,$id){
    	if($request->isMethod('get')){
            $res = DB::table('admin')->find($id);
            return array($res);
        }
        else{
            return array('errcode'=>901,'errmsg'=>"不是get提交！");
        }
    } 
    // 更新操作  密码   admin/admin/{admin} put
    public function update(Request $request){
    	if($request->isMethod('put')){
            if(empty($request->input('_token'))){
                return array('errcode'=>902,'errmsg'=>"不存在_token");
            }
            $data = $request->input('data');
            $username = trim($data['username']);
            $oldpassword = trim($data['oldpassword']);
            $password = trim($data['password']);
            $repassword = trim($data['repassword']);

            unset($data['repassword'],$data['oldpassword'],$data['username']);

            if(empty($username)||empty($oldpassword)||empty($password)||empty($repassword)){
                return array('errcode'=>101,'errmsg'=>"填写信息不完全");
            }
            if(empty(DB::table('admin')->where(['username'=>$username,'password'=>md5($oldpassword)])->first())){
                return array('errcode'=>106,'errmsg'=>"旧密码错误");
            }
            if($password!=$repassword){
                return array('errcode'=>102,'errmsg'=>"密码不一致");
            }

            $data['password'] = md5($data['password']);
            $data['update_time'] = date("Y-m-d H:i:s",time());
            if(DB::table('admin')->where("username",$username)->update($data)){
                return 1;
            }else{
                return 0;
            }
        }
        else{
            return array('errcode'=>901,'errmsg'=>"不是put提交！");
        }
    }

    // 删除
    public function destroy(Request $request,$id){
        if($request->isMethod('delete')){
            if(empty($request->input('_token'))){
                return array('errcode'=>902,'errmsg'=>"不存在_token");
            }
            if(empty($id)){
                return array("errcode"=>103,"errmsg"=>"删除id不存在");
            }
            $where['id'] = $id;
            $where['password'] = md5($request->input('password'));
            $res = DB::table('admin')->where($where)->first();
            if(empty($res)){
                return array("errcode"=>104,"errmsg"=>"管理员口令错误");
            }
                DB::table('admin')->delete($id);
                return array('errcode'=>0,"errmsg"=>'删除成功');
        }
        else{
            return array('errcode'=>901,'errmsg'=>"不是delete提交！");
        }
    }

    // 修改status状态

    public function status(Request $request){
        if($request->isMethod('post')){
            $request->except('_token');
            $id = $request->input('id');
            if($request->input('status')==0){
                $status = 1;
            }else{
                $status = 0;
            }
            $update_time = date("Y-m-d H:i:s",time());
            DB::table('admin')->where('id',$id)->update(['status'=>$status,'update_time'=>$update_time]);
        }
        else{
            return array('errcode'=>901,'errmsg'=>"不是post提交！");
        }
    }
}
