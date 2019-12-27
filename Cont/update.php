<?php 
	header("content-type:text/html;charset=UTF8");
	// 数据库连接
	$link = mysqli_connect('127.0.0.1','root','root');
	// 选择数据库
	mysqli_select_db($link,'myself');
	// 设置字符集
	mysqli_set_charset($link,'UTF8');

	$id = $_POST['id'];

	$UserName = $_POST['UserName'];

	$inquire = "SELECT * from register ";

	$re = mysqli_query($link,$inquire);

	$arr = mysqli_fetch_array($re);

	var_dump($arr);
	
	$sql = "UPDATE register set UserName = '$UserName' WHERE id = $id";

	$res = mysqli_query($link,$sql);

	mysqli_close($link);
 ?>