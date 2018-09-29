<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
class TypesController extends Controller
{
    public function index(){
    	// echo 123;
    	$one = DB::table('types')->where('pid','0')->get();
        foreach ($one as $value) {
            $value->zi = DB::table('types')->where('pid',$value->id)->get();
            foreach ($value->zi as $v) {
                $v->zi = DB::table('types')->where('pid',$v->id)->get();
            }
        }
    	return view('admin.types.types')->with('data',$one);


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
            $typeid = $request->input('typeid');
            $data = $request->input('data');

            if($data['pid']!=null){
                $data['path'] = $data['pid'].",{$typeid}";
                $data['pid'] = $typeid;
            }else{
                $data['path'] = $typeid;
                $data['pid']  = 0;
            } 
            if(DB::table('types')->insert($data)){
                return 1;
            }else{
                return 0;
            }
       }
       else{
            return array('errcode'=>901,'errmsg'=>"不是post提交！");
       }
    }
    // 修改 模态框传值 path 0,1 
    public function edit(Request $request,$id){
    	if($request->isMethod('get')){
            $all = DB::table('types')->select('path','name')->get();
            $res = DB::table('types')->select('id','path','pid')->find($id);
            return array('all'=>$all,'data'=>$res);
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
