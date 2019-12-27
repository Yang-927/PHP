<?php 
	header("content-type:text/html;charset=UTF8");

	// 获取数据库连接
	$link = mysqli_connect("127.0.0.1","root","root");
	// 选择数据库
	mysqli_select_db($link,"myself");
	// 设置字符集
	mysqli_set_charset($link,"UTF8");

	$UserName = !empty( $_POST['UserName'])?$_POST['UserName']:'';
	$PassWord = md5( $_POST['PassWord'] );

	$sql = "SELECT * from register WHERE UserName = '$UserName'";
	$res = mysqli_query($link,$sql);
	$row[] = mysqli_fetch_array($res);
	if(empty($row[0])){
		$suc = "INSERT INTO register(id,UserName,PassWord) VALUES(null,'$UserName','$PassWord')";
		$res = mysqli_query($link,$suc);
		echo "<h1 style='text-align:center;color:green;'>注册成功</h1>";
	}else{
		echo "<h1 style='text-align:center;color:red;'>已存在相同用户名,请返回上页重新注册</h1>";
		$url = "http://www.cont.com/register.html";
		echo " <script type = 'text/javascript'> ";
		echo "alert('已存在相同用户名,请返回上页重新注册')";
		echo " window.location.href = '$url' ";
		echo " </script> ";
	}
	mysqli_close($link);
 ?>