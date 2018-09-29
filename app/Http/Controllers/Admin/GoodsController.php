<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Session;
class GoodsController extends Controller
{
    public function index(){
    	$info = Session::get('info');
        if(empty($info->username)){
            return view('admin.login.login');
        }
        $data = DB::select("select *,concat(path,',',id) p from shop_types order by p");
        
        foreach ($data as $key => $value) {
            $arr = explode(',',$value->path);
            $size =  count($arr);
            $value->html = str_repeat("|----",$size-1).$value->name;
        }
        
        return view('admin.goods.goods')->with("data",$data);
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

}
