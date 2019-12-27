<?php 
	include("./obj1.php");
	class Student extends Person{
		public function __construct(){
			echo "1";
			echo "<br>";
		}
	}


$stu = new Student();
$stu -> test();
 ?>
