<?php 
	class Student{
		// 定义方法
		public const STR = "Yang";
		public $str = "AnYang";
		public function getGoodStudent(){
			echo "Curry&Durant&".$this->str;
			echo "<br>";
			echo "坏学生:".$this->getBadStudent();
		}
		public function getBadStudent(){
			return "kerr";
		}

	}

	$obj = new Student();
	$obj->getGoodStudent();
	echo $obj->str;
 ?>