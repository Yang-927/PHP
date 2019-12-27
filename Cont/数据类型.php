<?php

	header("content-type:text/html;charset=utf8");
	$num = 1 + '2e23';
	var_dump($num);
	die;

	// 数组
	$array = array();
	// 对象
	$obj = new stdClass();
	// 特殊类型
	// 资源
	$handle = fopen('./curry.php', 'r');

	// NULL
	$str = NULL;
	var_dump($str);

	/*
	PHP数据类型:
		1.字符串
		2.整型
		3.浮点
		4.数组
		5.对象
		6.NULL
		7.资源
		8.Bool
	 */	
	/*
	伪数据类型:
		mixed
		callback
		number
		void
	 */
	die;
	$float_s1 = 2e3;
	var_dump($float_s1);
	echo "<br>";

	$float_s2 = 2e-3;
	var_dump($float_s2);
	echo "<br>";

	if(1)
		echo "相等";
	else
		echo "不等";
	echo "<br>";

	var_dump(true);
	echo "<br>";
	var_dump(false);
	echo "<br>";

	// 字符串
	// 单引号不解析变量,双引号解析变量;
	$str = "He said \"I'm fine \"";
	// 反斜杠代表转义字符
	echo "$str";
 ?>