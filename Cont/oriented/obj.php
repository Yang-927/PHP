<?php 
	include("./obj1.php");
	class Student extends Person{
		public function say(){
			$this -> test();
		}
		
	}
	// 实例化,类外调用
	$stu = new Student();
	$stu -> say()
 ?>