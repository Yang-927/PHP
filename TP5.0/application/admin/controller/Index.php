<?php 
	namespace app\admin\controller;

	use \think\Controller;

	class Index extends Controller{
		public function index(){
			return $this -> fetch('index');
		}
		public function top(){
			return $this -> fetch('top');
		}
		public function menu(){
			return $this -> fetch('menu');
		}
		public function main(){
			return $this -> fetch('main');
		}
		public function drag(){
			return $this -> fetch('drag');
		}
	}
 ?>