<?php 
	header("content-type:text/html;charset=UTF8");

	for ($i=1; $i <= 9; $i++) { 
		for ($j=1; $j <= $i; $j++) { 
			echo " $j × $i  = " .($i*$j)."&nbsp;&nbsp;&nbsp;" ;
		}
		echo "<br>";
	}

	// for 循环;
	for ($i=100; $i < 130; $i++) { 
		echo $i."&nbsp;";
	}
	echo "<br>";
	// 奇数偶数
	echo "奇数:";
	for ($i=0; $i < 100; $i++) { 
		if($i%2 != 0){
			echo "$i &nbsp;";
		}
	}
	echo "<br>";
	echo "偶数:";
	for ($i=0; $i < 100; $i++) { 
		if($i%2 == 0){
			echo "$i &nbsp;";
		}
	}
	echo "<br>";
	// while循环实现奇数偶数筛选
	echo "奇数:";
	$a=0;
	while ($a<100) {
		if($a%2 != 0){
			echo "$a &nbsp;";
		}
		$a++;
	}
	echo "<br>";
	$array = [
		['id'=>1,'user_name'=>"Curry"],
		['id'=>2,'user_name'=>"Durant"]
	];
	foreach ($array as $key => $value) {
		echo $key."=>".$value['user_name']."<br>";
	}
 ?>