<?php
header("content-type:text/html;charset=utf8");
//数据库连接
$link = mysqli_connect('127.0.0.1','root','root');
//选择数据库
mysqli_select_db($link,'myself');
//设置字符集
mysqli_set_charset($link,'utf8');

$user_name = !empty($_GET['user_name'])?$_GET['user_name']:'';
$password = !empty($_GET['password'])?$_GET['password']:'';
//判断用户名和密码是否不为空,为空跳转回静态页面
if(!$user_name){
	echo "<script>
		alert('用户名不能为空');
		location.href='index.html';
	</script>";
	exit;
}
if(!$password){
	echo "<script>
		alert('密码不能为空');
		location.href='index.html';
	</script>";   
	exit;
}
//判断用户是否已经注册
$sql = "SELECT * from users WHERE user_name='$user_name'";
$result = mysqli_query($link,$sql);//执行sql
$array = mysqli_fetch_array($result);//获取单条结果

if($array){
	echo "<script>
		alert('此用户已经注册');
		location.href='index.html';
	</script>";
	exit;
}else{
	$password = md5($password);
	//插入数据
	$sql = "INSERT INTO users(user_name,password) VALUES('$user_name','$password')";
	$res = mysqli_query($link,$sql);
	if($res) echo '<a href="./login.html">注册成功,去登录</a>'; else echo '注册失败';
}






