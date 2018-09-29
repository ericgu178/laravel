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

 <button class="layui-btn" onclick="tianjia('no','no')">添加分类</button>
 <table class="layui-table">
   <colgroup>
     <col width="60">
     <col width="200">
     <col width="200">
     <col width="200">
     <col width="200">
     <col>
   </colgroup>
   <thead>
     <tr>
       <th>序号</th>
       <th>分类</th>
       <th>标题</th>
       <th>关键字</th>
       <th>简介</th>
       <th>是否楼层</th>
       <th>操作</th>
     </tr> 
   </thead>
   <tbody>
    @foreach($data as $value)
     <tr>
       <td>{{$value->id}}</td>
       <td>{{$value->name}}</td>
       <td>{{$value->title}}</td>
       <td>{{$value->keywords}}</td>
       <td>{{$value->description}}</td>
       <td>@if($value->is_lou==0)<button onclick="status({{$value->is_lou}})" class="layui-btn layui-btn-sm">是</button>@else<button onclick="status({{$value->is_lou}})" class="layui-btn layui-btn-sm layui-btn-danger">否</button>@endif</td>
       <td>
       <a href="javascript:;" class="layui-btn layui-btn-sm" onclick="tianjia('{{$value->pid}}','{{$value->id}}')">添加分类</a>
       <a href="javascript:;" onclick="xiugai({{$value->id}})"class="layui-btn layui-btn-sm">修改</a>

         <a href="javascript:;" onclick="del({{$value->id}})" class="layui-btn layui-btn-danger layui-btn-sm">删除分类</a>
       </td>
     </tr>
      @foreach($value->zi as $v)
     <tr>
       <td>{{$v->id}}</td>
       <td>|---- {{$v->name}}</td>
       <td>{{$v->title}}</td>
       <td>{{$v->keywords}}</td>
       <td>{{$v->description}}</td>
       <td>@if($v->is_lou==0)<button onclick="status({{$v->is_lou}})" class="layui-btn layui-btn-sm">是</button>@else<button onclick="status({{$v->is_lou}})" class="layui-btn layui-btn-sm layui-btn-danger">否</button>@endif</td>
       <td>
       <a href="javascript:;" class="layui-btn layui-btn-sm" onclick="tianjia('{{$v->pid}}','{{$v->id}}')">添加分类</a>
       <a href="javascript:;" onclick="xiugai({{$v->id}})"class="layui-btn layui-btn-sm">修改</a>

         <a href="javascript:;" onclick="del({{$v->id}})" class="layui-btn layui-btn-danger layui-btn-sm">删除分类</a>
       </td>
     </tr>
      @foreach($v->zi as $vv)
     <tr>
       <td>{{$vv->id}}</td>
       <td>|----|---- {{$vv->name}}</td>
       <td>{{$vv->title}}</td>
       <td>{{$vv->keywords}}</td>
       <td>{{$vv->description}}</td>
       <td>@if($vv->is_lou==0)<button onclick="status({{$vv->is_lou}})" class="layui-btn layui-btn-sm">是</button>@else<button onclick="status({{$vv->is_lou}})" class="layui-btn layui-btn-sm layui-btn-danger">否</button>@endif</td>
       <td>
       <a href="javascript:;" class="layui-btn layui-btn-sm" onclick="tianjia('{{$vv->pid}}','{{$vv->id}}')">添加分类</a>
       <a href="javascript:;" onclick="xiugai({{$vv->id}})"class="layui-btn layui-btn-sm">修改</a>

         <a href="javascript:;" onclick="del({{$vv->id}})" class="layui-btn layui-btn-danger layui-btn-sm">删除分类</a>
       </td>
     </tr>
        @endforeach
      @endforeach
     @endforeach
     
   </tbody>
 </table>

   </div>
</div>
    
@endsection

@section('js')
// 添加
function tianjia(pid,id){
   localStorage.setItem('typeid',id);
   localStorage.setItem('pid',pid); 
   layui.use('layer', function(){
     var layer = layui.layer;
       layer.open({
         type: 2,
         title: '添加管理员',
         area:['27%','500px'],
         content: "/admin/types/model/addtypes"
       });
   })
    
}
// 修改
function xiugai(id){
console.log(id)
 // localStorage.setItem('id',id);
 // layui.use('layer', function(){
 //     var layer = layui.layer;
 //       layer.open({
 //         type: 2,
 //         title: '修改密码',
 //         area:['27%','350px'],
 //         content: "/admin/types/model/updatetypes"
 //       });
 //   })
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