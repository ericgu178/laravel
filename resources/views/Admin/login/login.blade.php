<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
 
    <title>登录页</title>
    <link rel="stylesheet" type="text/css" href="/style/admin/layui/css/layui.css">
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/style/admin/layui/layui.js"></script>
    <link rel="stylesheet" href="/style/admin/style.css">
</head>
<body>
 
<div class="login-main">
    <header class="layui-elip">登录</header>
    <form class="layui-form">
        <div class="layui-input-inline">
            <input type="text" name="username" required lay-verify="required" placeholder="用户名" autocomplete="off"
                   class="layui-input">
        </div>
        <div class="layui-input-inline">
            <input type="password" name="password" required lay-verify="required" placeholder="密码" autocomplete="off"
                   class="layui-input">
        </div>
        <div class="layui-input-inline login-btn">
            <button lay-submit lay-filter="login" class="layui-btn">登录</button>
        </div>
        <hr/>
        <!--<div class="layui-input-inline">
            <button type="button" class="layui-btn layui-btn-primary">QQ登录</button>
        </div>
        <div class="layui-input-inline">
            <button type="button" class="layui-btn layui-btn-normal">微信登录</button>
        </div>-->
        <p><a href="register" class="fl">立即注册</a><a href="javascript:;" class="fr">忘记密码？</a></p>
    </form>
</div>

<script type="text/javascript">
    layui.use(['form','layer','jquery'], function () {
 
        // 操作对象
        var form = layui.form;
        var $ = layui.jquery;
        form.on('submit(login)',function (data) {
            // console.log(data.field);
            $.ajax({
                url:'login',
                data:{data:data.field,"_token":"{{csrf_token()}}"},
                dataType:'json',
                type:'post',
                success:function (res) {
                    if (res.errcode == 0){
                      layer.msg("登录成功");
                      setTimeout(function(){
                        location.href = "../admin";
                      },1000)
                        
                    }else{
                        layer.msg(res.errmsg);
                    }
                }
            })
            return false;
        })
 
    });
</script>
</body>
</html>