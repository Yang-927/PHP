<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"C:\phpstudy_pro\WWW\1809test\public/../application/index\view\login\login.html";i:1572576802;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<base href="http://www.1809test.com/static/" />
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>用户登录</title>
	<link rel="stylesheet" href="css/base.css" />
	<link rel="stylesheet" href="css/global.css" />
	<link rel="stylesheet" href="css/login-register.css" />
	
</head>
<body>
	<!--顶部信息start-->
	<!--
	<div id="topnav">
		<div class="topwrap">
			<dl class="user-entry">
				<dt>您好，欢迎来到ShopCZ商城<a href=""></a></dt>
				<dd>[<a href="">登录</a>]</dd>
				<dd>[<a href="">注册</a>]</dd>
				<dd></dd>
			</dl>
			<ul class="quick-menu">
				<li class="user-center">
					<div class="menu">
						<a href="" class="menu-hd">我的商城</a>
						<div class="menu-bd">
							<ul>
								<li><a href="">已买到的商品</a></li>
								<li><a href="">我的空间</a></li>
								<li><a href="">我的好友</a></li>
							</ul>
						</div>
					</div>
				</li>
				<li class="cart">
					<div class="menu">
						<span class="menu-hd">购物车<strong>0</strong>种商品</span>
						<div class="menu-bd">
							<div class="no-order">
								<span>您的购物车中暂无商品，赶快选择心爱的商品吧！</span>
								<a href="" class="button">查看购物车</a>
							</div>
						</div>
					</div>
				</li>
				<li class="favorite">
					<div class="menu">
						<a href="" class="menu-hd">我的收藏</a>
						<div class="menu-bd">
							<ul>
								<li><a href="">收藏的商品</a></li>
								<li><a href="">收藏的店铺</a></li>
							</ul>
						</div>
					</div>
				</li>
				<li class="pm">
					<a href="">站内信</a>
				</li>
			</ul>
		</div>
	</div>
	-->
	<!--顶部信息end-->
	
	<div class="header wrap1000">
		<a href=""><img src="images/logo.png" alt="" /></a>
	</div>
	
	<div class="main">
		<div class="login-form fr">
			<div class="form-hd">
				<h3>用户登录</h3>
			</div>
			<div class="form-bd">
				<form action="" method="POST">
					<dl>
						<dt>用户名</dt>
						<dd><input type="text" name="user_name" class="text user_name" /></dd>
					</dl>
					<dl>
						<dt>密&nbsp;&nbsp;&nbsp;&nbsp;码</dt>
						<dd><input type="password" name="pwd" class="text pwd"/></dd>
					</dl>
					<dl>
						<dt>验证码</dt>
						<dd>
							<input type="text" name="code" class="text code" size="10" style="width:58px;">
							<!-- 验证码 -->
							<img src="<?php echo captcha_src(); ?>" alt="验证码" align="center" style="width: 200px;height: 50px;" 	
							onclick="this.src='<?php echo captcha_src(); ?>?'+Math.random();"/>

						<!-- 	<a href="'<?php echo captcha_src(); ?>?'+Math.random();" style="color:#999;">
							看不清，换一张</a> -->
						</dd>
					</dl>
					<dl>
						<dt>&nbsp;</dt>
						<dd><input type="button" value="登  录" class="submit"/> <a href="" class="forget">忘记密码?</a></dd>	
					</dl>
				</form>
				<dl>
					<dt>&nbsp;</dt>
					<dd> 还不是本站会员？立即 <a href="http://www.1809test.com/index.php/index/Login/reg" class="register">注册</a></dd>
				</dl>
				<dl class="other">
					<dt>&nbsp;</dt>
					<dd>
						<p>您可以用合作伙伴账号登录：</p>
						<a href="/index/Login/qqLogin" class="qq"></a>
						<a href="" class="sina"></a>
					</dd>
				</dl>
			</div>
			<div class="form-ft">
			
			</div>		
		</div>
		
		<div class="login-form-left fl">
			<img src="images/left.jpg" alt="" />
		</div>
	</div>
	
	<div class="footer clear wrap1000">
		<p> <a href="">首页</a> | <a href="">招聘英才</a> | <a href="">广告合作</a> | <a href="">关于ShopCZ</a> | <a href="">联系我们</a></p>
		<p>Copyright 2004-2013 itcast Inc.,All rights reserved.</p>
	</div>
	
	
</body>
</html>
<script src="js/jQuery3.4.0.js" type="text/javascript"></script>
<script type="text/javascript">
	$('.submit').click(function(){
		var user_name = $('.user_name').val();
		var pwd = $('.pwd').val();
		var code = $('.code').val();
		
		$.ajax({
			url:'/index/Login/checkUserInfo',//接口URL
			type:'post',//传值方式
			dataType:'json',//返回数据的类型
			//要传的值
			data:{"user_name":user_name,"pwd":pwd,"code":code},
			success:function(res){
				if(res.error_code == 1){
					alert(res.error_msg)
				}else{
					alert(res.error_msg); 
					location.href='/index/Index/index';
				}
			}
		})
	})
</script>