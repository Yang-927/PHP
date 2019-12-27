<?php
header("content-type:text/html;charset=utf8");
//数据库连接
$link = mysqli_connect('127.0.0.1','root','root');
//选择数据库
mysqli_select_db($link,'myself');
//设置字符集
mysqli_set_charset($link,'utf8');

$user_name = !empty($_POST['user_name'])?$_POST['user_name']:'';
$password = !empty($_POST['password'])?$_POST['password']:'';
//判断用户名和密码是否不为空,为空跳转回静态页面
if(!$user_name){
	echo "<script>
		alert('用户名不能为空');
		location.href='login.html';
	</script>";
	exit;
}
if(!$password){
	echo "<script>
		alert('密码不能为空');
		location.href='login.html';
	</script>";   
	exit;
}

//判断用户是否已经注册
$sql = "SELECT * from users WHERE user_name='$user_name'";
$result = mysqli_query($link,$sql);//执行sql
$array = mysqli_fetch_array($result);//获取单条结果
//var_dump($array['password'],md5($password));die;
if($array){
	//判断密码是否正确
	if($array['password'] == md5($password)){
		echo "登录成功!";
	}else{
		echo "<script>
		alert('密码输入有误,请重新登录!');
		location.href='login.html';
		</script>";   
		exit;
	}
}else{
	echo "<script>
		alert('此用户不存在,请注册');
		location.href='register.html';
	</script>";   
	exit;
}







