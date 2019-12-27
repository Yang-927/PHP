<?php 
	$j = 5;

	echo $j--;

	echo "<br>";

	echo $j;

	echo "<br>";

	$j = 10;

	echo --$j;

	echo "<br>";

	$i = "Z";

	echo ++$i;
	echo "<hr>";


	// true xor true,
	// true xor false,
	// false xor true,
	// false xor false, 


	$i = 5;
	echo $i++ + $i--;

	$a = 0;
	$b = 1;
	if($a++ && $b)
		echo 'true';
	else
		echo 'false';
 ?>