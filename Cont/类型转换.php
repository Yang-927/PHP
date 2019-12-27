<?php 
	$num = '123';
	echo gettype($num);
	echo "<br>";
	settype($num, 'int');
	echo "<br>";
	echo gettype($num);
	var_dump($num)
 ?>