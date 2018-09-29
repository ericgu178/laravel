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
      <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
        <ul class="layui-tab-title">
          <li class="layui-this">商品展示</li>
          <li>商品添加</li>
        </ul>
      <div class="layui-tab-content" style="height: 100px;">
          <div class="layui-tab-item layui-show">
            <form class="layui-form" action="">
                <div class="layui-input-inline">
                    共 <b style="color:red">20条</b> 用户数据  只能软删
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
                    <th>商品名称</th>
                    <th>分类</th>
                    <th>价格</th>
                    <th>介绍</th>
                    <th>加入时间</th>
                  </tr> 
                </thead>
                <tbody id="sou">
                  <tr>
                   <td>1</td>
                   <td>2</td>
                   <td>3</td>
                   <td>4</td>
                   <td>5</td>
                   <td>6</td>
                   </tr>
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
                      <select name="city">
                        @foreach($data as $value)
                        <option value="{{$value->p}}">{{$value->html}}</option>
                         @endforeach
                      </select>
                  </div>
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
layui.use('form', function(){
    var form = layui.form(); //只有执行了这一步，部分表单元素才会修饰成功 
});
@endsection