<?php 
	// 最大值
	echo max(4,2,6,35);
	echo "<br>";
	// 最小值
	echo min(6,8,4,5,3);
	echo "<br>";
	// 幂运算
	echo pow(2, 5);
	echo "<br>";
	// 平方根
	echo sqrt(81);
	echo "<br>";
	// 随机数
	echo rand(0,100);
	echo "<br>";
	// 四舍五入
	echo round(5.456555);	// 5
	echo "<br>";
	// 
	$num = 123456789.123456789;
	echo number_format($num,5);
	echo "<br>";
	// 浮点
	echo fmod(5.5, 1.2);
 ?>