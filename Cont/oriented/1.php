<?php 
	header("content-type:text/html;charset=utf8");

	$link = mysqli_connect("127.0.0.1","root","root");

	mysqli_select_db($link,'myself');

	mysqli_set_charset($link,"UTF8");

	$sql = "SELECT id,Title,Cont,UpdateTime FROM article limit 3";

	$res = mysqli_query($link,$sql);

	while ($row = mysqli_fetch_assoc($res)) {
		$array[] = $row;
	}

	$json_str = json_encode($array);
	var_dump(json_decode($json_str));
 ?>