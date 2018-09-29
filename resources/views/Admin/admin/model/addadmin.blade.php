<link rel="stylesheet" type="text/css" href="/style/admin/layui/css/layui.css">
<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/style/admin/layui/layui.js"></script>

<form class="layui-form" action="" style="padding-top: 15px;padding-right: 15px;" onsubmit="return false">
  <div class="layui-form-item">
    <label class="layui-form-label">用户名</label>
    <div class="layui-input-inline">
      <input type="text" name="username" required  lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
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
    <label class="layui-form-label">状态</label>
    <div class="layui-input-block">
      <input type="checkbox" name="status" lay-skin="switch" value="1" lay-text="禁用|正常">
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
//Demo
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
    $.post("/admin/admin",{data:data.field,"_token":'{{csrf_token()}}'},function(res){
      if(res.errcode>0){
        layer.msg(res.errmsg)

      }else{
        layer.msg('添加成功')
        var index = parent.layer.getFrameIndex(window.name);
        setTimeout(function(){parent.layer.close(index);parent.location.href='/admin/admin';}, 1000);
      }
    },'json')
    
  });
});
</script>