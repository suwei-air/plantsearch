<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>校园植物检索系统</title>
<link href="http://lib.sinaapp.com/js/bootstrap/latest/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="/static/css/default.css" rel="stylesheet" type="text/css">
<link href="/static/css/index.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="v-center" style="display: table; height: 100%; width: 100%; #position: relative; overflow: hidden;">
<div class="v-center" style="#position: absolute; #top: 50%;display: table-cell; vertical-align: middle;">
<section id="index-wrap">
  <!-- img src="/image/bg.jpg" -->
  <nav>
    <ul id="search-link">
      <li><a href="/search/pro">专业版</a></li>
      <li><a href="/search">模糊版</a></li>
    </ul>
    <ul id="user">
      <li><a href="/user/login">登录</a></li>
      <li><a href="#">注册</a></li>
      <li><a href="/page/view/manage">管理入口</a></li>
    </ul>
  </nav>
  <div id="main">
    <form id="search-form" action="/search">
      <div class="input-append">
        <input class="span2" id="inputIcon" type="text" placeholder="猜猜看">
        <span class="add-on"><i class="icon-search icon-white"></i></span>
      </div>
    </form>
  </div>
</section>
</div>
</div>

<!-- div id="ggf-logo">
  <img alt="Global Greengrants Fund" title="Global Greengrants Fund" src="/image/ggf-logo.png">
</div -->

<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
<script src="http://lib.sinaapp.com/js/bootstrap/latest/js/bootstrap.min.js"></script>
<script language="javascript">
function onResize() {
	$('div.v-center').height($('body').height());
	var nav = $('#index-wrap > nav');
	nav.width($('#index-wrap').width() / $('#index-wrap').height() > 1.78 ? $('#index-wrap').height() * 1.78 : $('#index-wrap').width());
	var div = $('#index-wrap > div');
	div.width($('#index-wrap').width() / $('#index-wrap').height() > 1.78 ? $('#index-wrap').height() * 1.6 : $('#index-wrap').width());
	div.height($('#index-wrap').height() * 0.9);
}
//$(window).load(onResize);
$(window).resize(onResize);
$(document).ready(onResize);
</script>
</body>
</html>
