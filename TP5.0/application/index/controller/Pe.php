<?php 
	namespace app\index\controller;

	use \think\Controller;

	class Pe extends Controller
	{
		public function pe(){
			return $this -> fetch('pe');
		}
	}
 ?>