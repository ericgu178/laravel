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
      <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
        <ul class="layui-tab-title">
          <li class="layui-this">商品展示</li>
          <li>商品添加</li>
        </ul>
      <div class="layui-tab-content" style="height: 100px;">
          <div class="layui-tab-item layui-show">
            <form class="layui-form" action="">
                <div class="layui-input-inline">
                    共 <b style="color:red">{{$tot}}条</b> 商品数据  只能软删
                </div>
                <div class="layui-input-inline">
                  <input type="text" name="search" required  lay-verify="required" placeholder="search" autocomplete="off" class="layui-input">
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
                  <col width="60">
                  <col width="200">
                  <col width="200">
                  <col width="200">
                  <col>
                </colgroup>
                <thead>
                  <tr>
                    <th>序号</th>
                    <th>商品名称</th>
                    <th>分类</th>
                    <th>价格</th>
                    <th>数量</th>
                    <th>图片</th>
                    <th>介绍</th>
                    <th>加入时间</th>
                    <th>操作</th>
                  </tr> 
                </thead>
                <tbody>
                  @foreach($data2 as $val)
                  <tr>
                    <td>{{$val->id}}</td>
                    <td>{{$val->title}}</td>
                    <td>{{$val->typeid}}</td>
                    <td>￥{{$val->price}}</td>
                    <td>{{$val->num}}</td>
                    <td><img src="{{$val->img}}"  height="100" alt=""></td>
                    <td>{{$val->text}}</td>
                    <td>{{$val->create_time}}</td>
                    <td><a href="javascript:;" onclick="" class="layui-btn layui-btn-sm">修改</a><a href="javascript:;" onclick="" class="layui-btn layui-btn-sm">删除</a></td>
                   </tr>
                   @endforeach
                </tbody>
              </table>
          </div>
          <!-- 商品添加 -->
          <div class="layui-tab-item">
              <form class="layui-form" action="">
                <div class="layui-form-item">
                  <label class="layui-form-label">商品名称</label>
                    <div class="layui-input-inline">
                       <input type="text" name="title" required  lay-verify="required" placeholder="请输入商品名称" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                  <label class="layui-form-label">商品简介</label>
                  <div class="layui-input-block">
                    <textarea name="text" placeholder="商品简介" class="layui-textarea"></textarea>
                  </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">所属分类</label>
                    <div class="layui-input-inline">
                      <select name="path">
                        <option value="">请选择分类</option>
                        @foreach($data as $value)
                        <option value="{{$value->title}}">{{$value->html}}</option>
                         @endforeach
                      </select>
                  </div>
                </div>
                <div class="layui-form-item layui-form-text">
                  <label class="layui-form-label">商品价格</label>
                  <div class="layui-input-block">
                    <div class="layui-input-inline">
                       <input type="text" name="price" required  lay-verify="required" placeholder="价格" autocomplete="off" class="layui-input">
                    </div>
                  </div>
                </div>
                <div class="layui-form-item layui-form-text">
                  <label class="layui-form-label">商品数量</label>
                  <div class="layui-input-block">
                    <div class="layui-input-inline">
                       <input type="text" name="num" required  lay-verify="required" placeholder="数量" autocomplete="off" class="layui-input">
                    </div>
                  </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">商品图片</label>
                      <img id="goods" src="" width="200" height="200">
                      <button type="button" class="layui-btn" id="upload">
                        <i class="layui-icon">&#xe67c;</i>上传图片(<2M)
                    </button>
                </div>
                <div class="layui-form-item">
                  <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                  </div>
                </div>
              </form>
          </div>
      </div>
    </div>  
  </div>
</div>
 
    
@endsection

@section('js')
layui.use(['form','upload'], function(){
    var form = layui.form;
    var upload = layui.upload;
    var imgsrc = ""

  //图片上传
  var uploadInst = upload.render({
    elem: '#upload' //绑定元素
    ,url: '/admin/goods/upload' //上传接口
    ,exts: 'jpg|png|gif'
    ,field:'goodsimg'
    ,multiple: true
    ,data:{"_token":"{{csrf_token()}}"}
    ,done: function(res){
      imgsrc = res.ResultData
      $("#goods").attr('src','/uploads/goods/'+res.ResultData)
    }
    ,error: function(){
      //请求异常回调
    }
  });

  //提交商品信息

  form.on('submit(formDemo)', function(data){
        data.field.goodsimg = imgsrc;
   $.post("/admin/goods",{data:data.field,"_token":'{{csrf_token()}}'},function(res){
     if(res.errcode>0){
       layer.msg(res.errmsg)
     }else{
       layer.msg(res.errmsg)
     }
   },'json')
    return false;
  });
});
@endsection