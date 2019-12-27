<?php 
	namespace app\index\controller;

	use \think\Controller;
	use \think\Session;

	use app\index\model\Address as Ar;

	class Address extends Controller{
		public function add_add(){
			$return_data = [];
			$data = input('post.');
			$data['user_id'] = Session::get('id');
			$ar_obj = new Ar;
			$data['add_time'] = date("YmdHis");
			$res = $ar_obj -> insertData($data);
			$user_id = Session::get('id');
			if($res){
				$return_data['data'] = $ar_obj -> selectData($user_id);
				$return_data['error_code'] = 0;
				$return_data['error_msg'] = "地址添加成功";
				return $return_data;
			}else{
				$return_data['error_code'] = 1;
				$return_data['error_msg'] = "地址修改失败";
				return $return_data;
			}
		}

		public function address(){
			return $this -> fetch('address');
		}

		public function del(){
			$id = $_POST['id'];
			$return_data = [];
			$ar_obj = new Ar;
			$res = $ar_obj -> delData($id);
			if($res){
				$return_data['error_code'] = 0;
				$return_data['error_msg'] = "删除收货地址成功";
				return $return_data;
			}else{
				$return_data['error_code'] = 1;
				$return_data['error_msg'] = "删除收货地址失败";
				return $return_data;
			}
		}

		public function upd(){
			$id = $_GET['id'];

			return $this -> fetch('address_edit');
		}
	}
 ?>