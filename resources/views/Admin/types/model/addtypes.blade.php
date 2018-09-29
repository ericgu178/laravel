<link rel="stylesheet" type="text/css" href="/style/admin/layui/css/layui.css">
<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/style/admin/layui/layui.js"></script>

<form class="layui-form" action="" style="padding-top: 15px;padding-right: 15px;" onsubmit="return false">
  <div class="layui-form-item">
    <label class="layui-form-label">父级分类</label>
    <div class="layui-input-inline">
      <select id="select" name="pid">
      </select> 
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">分类名</label>
    <div class="layui-input-inline">
      <input type="text" name="name" required  lay-verify="required" placeholder="请输入分类名" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">标题</label>
    <div class="layui-input-inline">
      <input type="text" name="title" required lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
  </div>
   <div class="layui-form-item">
    <label class="layui-form-label">关键字</label>
    <div class="layui-input-inline">
      <input type="text" name="keywords" required lay-verify="required" placeholder="请输入关键字" autocomplete="off" class="layui-input">
    </div>
  </div>
    <div class="layui-form-item">
    <label class="layui-form-label">简介</label>
    <div class="layui-input-inline">
      <input type="text" name="description" required lay-verify="required" placeholder="请输入简介" autocomplete="off" class="layui-input">
    </div>
  </div>
      <div class="layui-form-item">
    <label class="layui-form-label">sort</label>
    <div class="layui-input-inline">
      <input type="text" name="sort" required lay-verify="required" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">是否楼层</label>
    <div class="layui-input-block">
      <input type="checkbox" name="is_lou" lay-skin="switch" value="1" lay-text="是|否">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>
<script>
  init();
//Demo
layui.use('form', function(){
  var form = layui.form;
  form.on('submit(formDemo)', function(data){
    if(localStorage.getItem('typeid')=="no"){
      var typeid = 0;
    }else{
      typeid = localStorage.getItem('typeid');
    }
    $.post("/admin/types",{typeid:typeid,data:data.field,"_token":'{{csrf_token()}}'},function(res){

      if(res.errcode>0){
        layer.msg(res.errmsg)
      }else{
        layer.msg('添加成功')
        var index = parent.layer.getFrameIndex(window.name);
        setTimeout(function(){parent.layer.close(index);parent.location.href='/admin/types';}, 1000);
      }
    },'json')
    
  });
});

function init(){
  if(localStorage.getItem('pid')!='no'&&localStorage.getItem('typeid')!="no"){
    $.get("/admin/types/"+localStorage.getItem('typeid')+'/edit',{},function(res){
      // 更新form
        $.each(res.all,function(index,r){
           $('#select').append("<option value='"+r.path+"'>"+r.name+"</option>")
        })
        $("#select option[value='"+res.data.path+"']").attr('selected','true')
        layui.use('form', function(){
          var form = layui.form;
            form.render('select');
        });
    })
  }
}
</script>