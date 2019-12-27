<?php 
	namespace app\index\controller;

	use \think\Controller;

	class Er extends Controller
	{
		public function er(){
			return $this -> fetch('er');
		}
	}
 ?>