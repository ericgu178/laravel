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
        // 商品展示
        $data2 = DB::table('goods')->paginate(10);
        $tot = count($data2);
        return view('admin.goods.goods')->with("data",$data)->with('data2',$data2)->with('tot',$tot);
    }
    // 添加页面
    public function create(){
        
    }
    // 插入管理员
    public function store(Request $request){
        if($request->isMethod('post')){
            $data = $request->input('data');
            $arr['img'] = "http://2.com/uploads/goods/".$data['goodsimg'];
            $arr['title'] = $data['title'];
            $arr['typeid'] = $data['path'];
            $arr['text'] = $data['text'];
            $arr['price'] = $data['price'];
            $arr['num'] = $data['num'];
            $arr['create_time'] = date("Y-m-d H:i:s",time());
            DB::table('goods')->insert($arr);
            return array('errcode'=>0,'errmsg'=>"上传成功");
        }
        else{
            return array('errcode'=>901,'errmsg'=>"不是post提交");
        }
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

    // 上传图片

    public function upload(Request $request){
        $file = $request->file('goodsimg');
        $filepath = $file->getRealPath();
        // 移动路径
        $path = public_path('uploads\goods');
        // 文件后缀
        $postfix = $file->getClientOriginalExtension();
        // 文件名
        $fileName = md5(time().rand(0,10000)).'.'.$postfix;
        // 移动
        if(!$file->move($path,$fileName)){
            return array('errcode'=>301,"errmsg"=>"上传失败");
        }

        return array('errcode'=>0,'ResultData'=>$fileName);
    }

}
