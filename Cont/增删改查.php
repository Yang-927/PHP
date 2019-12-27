<?php 
	header('content-type:text/html;charset=UTF8');

	// 数据库连接
	$link = mysqli_connect('127.0.0.1','root','root');
	// 选择数据库
	mysqli_select_db($link,'myself');
	// 设置字符集
	mysqli_set_charset($link,'utf8');
	// 密码加密
	// $password = md5('Curry');
	// 插入
	// $sql = "insert into Curry(id,userName,passWord) values(null,'Durant','$password')";
	
	// 修改
	$sql = "UPDATE Curry SET userName = 'Green' , passWord = '20000102' Where id = 8 and 10";
	$res = mysqli_query($link,$sql);
	var_dump($res);
 ?>