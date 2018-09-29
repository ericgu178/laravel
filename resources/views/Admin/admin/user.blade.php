@extends('public.admin')
@section('_style')
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
@endsection
@section('main')
<div class="layui-body">
  <div style="padding: 15px;">
 <button class="layui-btn" onclick="tianjia()">添加管理员</button>
 <table class="layui-table">
   <colgroup>
     <col width="60">
     <col width="80">
     <col width="100">
     <col width="200">
     <col width="200">
     <col width="80">
     <col>
   </colgroup>
   <thead>
     <tr>
       <th>序号</th>
       <th>管理员</th>
       <th>登录次数</th>
       <th>加入时间</th>
       <th>最后登录时间</th>
       <th>状态</th>
       <th>操作</th>
     </tr> 
   </thead>
   <tbody>
    @foreach($data as $value)
     <tr>
       <td>{{$value->id}}</td>
       <td>{{$value->username}}</td>
       <td>{{$value->count}}</td>
       <td>{{$value->create_time}}</td>
       <td>{{$value->last_time}}</td>
       <td>@if($value->status==0)<button onclick="status({{$value->status}},{{$value->id}})" class="layui-btn layui-btn-sm">正常</button>@else<button onclick="status({{$value->status}},{{$value->id}})" class="layui-btn layui-btn-sm layui-btn-danger">禁用</button>@endif</td>
       <td>
       <a href="javascript:;" onclick="xiugai({{$value->id}})"class="layui-btn layui-btn-sm">修改密码</a>
         <a href="javascript:;" onclick="del({{$value->id}})" class="layui-btn layui-btn-danger layui-btn-sm">删除管理员</a>
       </td>
     </tr>
     @endforeach
     
   </tbody>
   
 </table>
  {{$data->links()}}
   </div>
</div>
@endsection

@section('js')
// 添加
function tianjia(){
    layui.use('layer', function(){
      var layer = layui.layer;
        layer.open({
          type: 2,
          title: '添加管理员',
          area:['27%','350px'],
          content: "/admin/admin/model/addadmin"
        });
    })
}
// 修改
function xiugai(id){
  localStorage.setItem('id',id);
  layui.use('layer', function(){
      var layer = layui.layer;
        layer.open({
          type: 2,
          title: '修改密码',
          area:['27%','350px'],
          content: "/admin/admin/model/updateadmin"
        });
    })
}
// 删除
function del(id){
  layui.use('layer', function(){
        var layer = layui.layer;
          layer.confirm('你确定删除吗？'
          ,{icon: 7, title:'提示'}
          ,function(index){
            layer.close(index);
            layer.prompt({
                formType: 1,
                title: '请输入管理员口令',
            }, function(value, index){
                  $.post('/admin/admin/'+id,{password:value,"_token":"{{csrf_token()}}","_method":"delete"},function(res){
                     if(res.errcode>0){
                        layer.msg(res.errmsg);
                     }else{
                        layer.msg(res.errmsg);
                        layer.close(index);
                        setTimeout(function(){
                            location.reload();
                        },1000)
                     }
                  },'json')
                  });
          });
  }); 
}
// 修改状态
function status(status,id){
  $.post('/admin/admin/status',{id:id,status:status,'_token':'{{csrf_token()}}'},function(res){
        
  },"json")
  location.reload();
}
@endsection