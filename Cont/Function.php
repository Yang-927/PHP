<?php 
	header("content-type:text/html;charset=UTF8");

	function getUserName($Yang,$Curry){
		echo "$Yang";
		echo "<br>";
		echo "$Curry";
	}
	getUserName('Curry','win');


	$i = 1;
	function getYang($i){
		echo '$i='.$i;
		$i++;
		return $i;
	}
	$i = getYang($i);
	echo "<br>";


	function fool(){
		echo "这是一个函数调用";
	}

	fool();
	echo "<br>";

	function Sum($sum1,$sum2){
		$sum = $sum1 + $sum2;
		echo "$sum";
	}

	Sum(1,3);
	echo "<br>";
	function gap($x,$y){
		
	}
 ?>