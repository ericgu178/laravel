@extends('public.admin')
<style type="text/css">
.pagination {
    display: inline-block;
    padding: 0;
    margin: 0;
}

.pagination li{
  display: inline-block;
  width: 30px;
  text-align: center;
  line-height: 30px;
  height: 30px;
  cursor: pointer;

}
.pagination li a,span{
  display: inline-block;
  width: 30px;
  height: 30px;
}
.pagination .active span{
    color: #fff;
    text-align: center;
    line-height: 30px;
    width: 30px;
    height: 30px;
    display: block;
    background: #000;
}
</style>
@section('main')

<div class="layui-body">
  <div style="padding: 15px;">
  <form class="layui-form" action="">
    <div class="layui-input-inline">
      共{{$tot}}条用户数据  只能软删
    </div>
    <div class="layui-input-inline">
      <input type="text" name="search" required  lay-verify="required" placeholder="输入电话号查询" autocomplete="off" class="layui-input">
    </div>
    <button class="layui-btn layui-btn-sm">搜索</button>
    <a href="users" class="layui-btn layui-btn-sm">返回</a>

  </form>

    
 <table class="layui-table">
   <colgroup>
     <col width="60">
     <col width="150">
     <col width="150">
     <col width="60">
     <col width="200">
     <col width="200">
     <col>
   </colgroup>
   <thead>
     <tr>
       <th>序号</th>
       <th>用户名</th>
       <th>签名</th>
       <th>性别</th>
       <th>邮箱</th>
       <th>注册时间</th>
       <th>状态</th>
     </tr> 
   </thead>
   <tbody id="sou">
    @foreach($data as $value)
     <tr>
       <td>{{$value->id}}</td>
       <td>{{$value->username}}</td>
       <td>{{$value->nickname}}</td>
       <td>@if($value->sex==0)男@elseif($value->sex==1)女@else未知@endif</td>
       <td></td>
       <td>{{$value->create_time}}</td>
       <td>@if($value->status==0)<button onclick="status({{$value->status}},{{$value->id}})" class="layui-btn layui-btn-sm">启用</button>@elseif($value->status==1)<button onclick="status({{$value->status}},{{$value->id}})" class="layui-btn layui-btn-sm layui-btn-danger">未启用</button>@else<button onclick="status({{$value->status}},{{$value->id}})" class="layui-btn layui-btn-sm layui-btn-danger">禁用</button>@endif</td>
     </tr>
     @endforeach
   </tbody>
 </table>
{{$data->links()}}
   </div>
</div>
    
@endsection

@section('js')

// 修改状态
function status(status,id){
  $.post('/admin/users/status',{id:id,status:status,'_token':'{{csrf_token()}}'},function(res){
        
  },"json")
  location.reload();
}
@endsection