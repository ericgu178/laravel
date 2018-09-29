<!doctype html>
<html class="no-js" lang="">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>商城管理</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/style/admin/layui/css/layui.css">
<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/style/admin/layui/layui.js"></script>
</head>
<body class="layui-layout-body">
        <div class="layui-layout layui-layout-admin">
          <div class="layui-header">
            <div class="layui-logo">商城管理</div>
            <!-- 头部区域（可配合layui已有的水平导航） -->
            
            <ul class="layui-nav layui-layout-right">
              <li class="layui-nav-item">
                <a href="javascript:;">
                  <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                  admin
                </a>
                <dl class="layui-nav-child">
                  <dd><a href="">基本资料</a></dd>
                  <dd><a href="">安全设置</a></dd>
                </dl>
              </li>
              <li class="layui-nav-item"><a href="javascript:;" onclick="exit()">退出</a></li>
            </ul>
          </div>
          
          <div class="layui-side layui-bg-black">
            <div class="layui-side-scroll">
              <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
              <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                <li class="layui-nav-item layui-nav-itemed">
                  <a class="" href="javascript:;">商城管理平台</a>
                  <dl class="layui-nav-child" id="first">
                    <dd class=""><a href="/admin">首页</a></dd>
                    <dd class=""><a href="/admin/admin">管理员管理</a></dd>
                    <dd class=""><a href="/admin/users">会员管理</a></dd>
                    <dd class=""><a href="/admin/types">分类管理</a></dd>
                    <dd class=""><a href="/wx/index.php/Home/Material/index/type/image.html">商品管理</a></dd>
                    <dd class=""><a href="/wx/index.php/Home/fans/index.html">订单管理</a></dd>
                  </dl>
                </li>
                 <li class="layui-nav-item">
                  <a class="" href="javascript:;">其他管理</a>
                  <dl class="layui-nav-child" id="second">
                    <dd class=""><a href="/wx/index.php/Home/Qunfa/newslist.html">评论管理</a></dd>
                    <dd class=""><a href="/wx/index.php/Home/Qunfa/newslist.html">系统管理</a></dd> 
                  </dl>
                </li>
              </ul>
            </div>
          </div>
        <!-- 占位 -->
          @yield('main')
    <!-- 底部固定区域 -->
    <div class="layui-footer">© guxuejian.top - 微信二次开发</div>
</div>                               
        
</body>
</html>
<script type="text/javascript">
  layui.use('element', function(){
  var element = layui.element;
});
  @yield('js')
</script>
