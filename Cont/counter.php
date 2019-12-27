<?php 
	$num1 = $_GET['num1'];
	$num2 = $_GET['num2'];
	$symbol = $_GET['symbol'];

	switch($symbol){    //字符串，整型
		case "+":
				$cont = $num1 + $num2;
				echo $cont;
				break;
		case "-":
				$cont = $num1 - $num2;
				echo $cont;
				break;
		case "*":
				$cont = $num1 * $num2;
				echo $cont;
            	break;
        case "/":
				$cont = $num1 / $num2;
				echo $cont;
           		break;
}
 ?>