<link rel="stylesheet" type="text/css" href="/style/admin/layui/css/layui.css">
<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/style/admin/layui/layui.js"></script>

<form class="layui-form" action="" style="padding-top: 15px;padding-right: 15px;" onsubmit="return false">
  <div class="layui-form-item">
    <label class="layui-form-label">用户名</label>
    <div class="layui-input-inline">
      <input type="text" name="username" required  lay-verify="required" placeholder="请输入用户名" autocomplete="off" disabled="" style="background: #f4f4f4" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">旧密码</label>
    <div class="layui-input-inline">
      <input type="password" name="oldpassword" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">密码</label>
    <div class="layui-input-inline">
      <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
    </div>
  </div>
   <div class="layui-form-item">
    <label class="layui-form-label">确认密码</label>
    <div class="layui-input-inline">
      <input type="password" name="repassword" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
    </div>
  </div>
</form>
 
<script>
init();
layui.use('form', function(){
  var form = layui.form;
  
  //监听提交
  form.on('submit(formDemo)', function(data){
    if(data.field.username.length<8){
      layer.msg("用户名不小于8位");
      return;
    }
    if(data.field.password.length<6){
      layer.msg("密码不小于6位");
      return;
    }
    if(data.field.password!=data.field.repassword){
      layer.msg("密码不一致");
      return;
    }
    $.post("/admin/admin/1",{data:data.field,"_token":'{{csrf_token()}}','_method':"put"},function(res){
      if(res.errcode>0){
        layer.msg(res.errmsg)
      }else{
        layer.msg('修改成功')
        var index = parent.layer.getFrameIndex(window.name);
        setTimeout(function(){parent.layer.close(index);parent.location.href='/admin/admin';}, 1000);
      }
    },'json')
    
  });
});
function init(){
  $.get("/admin/admin/"+localStorage.getItem('id')+'/edit',{},function(res){
      $("input[name='username']").val(res[0].username)
  },'json')
}
</script>