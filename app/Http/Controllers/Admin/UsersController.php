<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
class UsersController extends Controller
{
    public function index(Request $request){
        // dd();
        $key = $request->input('search');
        if(!empty($key)){
            $tot = DB::table('user')->where('username','=',"{$key}")->count();
            $data = DB::table('user')->where('username','=',"{$key}")->paginate(10);
        }else{
            $tot = DB::table('user')->count();
            $data = DB::table('user')->paginate(10);
        }
        return view('admin.users.users')->with('data',$data)->with('tot',$tot);
    }
    // 添加页面
    public function create(){

    }
    // 插入管理员
    public function store(Request $request){
      
      
    }
    // 修改 模态框传值 path 0,1 
    public function edit(Request $request,$id){
    	
    } 
    // 更新操作  密码   admin/admin/{admin} put
    public function update(Request $request){
    	
    }

    // 删除
    public function destroy(Request $request,$id){
        
    }

    // 修改status状态

    public function status(Request $request){
       
    }
}
