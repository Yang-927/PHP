<?php 
	$str = "Hello World";
	// 获取字符串长度(空格也算)
	echo strlen($str);
	echo "<br>";
	$str = "we are family";
	// 转换为小写
	echo strtolower($str);
	echo "<br>";
	// 转换为大写
	echo strtoupper($str);
	echo "<br>";
	// 首字母大写
	echo ucfirst($str);
	echo "<br>";
	// 所有首字母大写
	echo ucwords($str);
	echo "<br>";
	// 字符串替换
	echo str_replace('family', 'friends', $str);

	/*// 去除空格
	$str = "\t\t\t\t\n\r杨彬\t\t然\t\t\t";
	echo ltrim($str);
	echo rtrim($str);
	echo trim($str);*/
	echo "<br>";
	// 获取字符串首次出现的位置
	echo strpos($str,'a');
	echo "<br>";
	echo strrpos($str, 'a');
	echo "<br>";
	// 截取字符串
	echo substr($str,2,6)
 ?>