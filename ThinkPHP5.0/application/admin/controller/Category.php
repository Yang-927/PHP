<?php 
	namespace app\admin\controller;

	use \think\Controller;

	use app\admin\model\CategoryList;

	class Category extends Controller{

		public function cat_list(){
			$cate_obj = new CategoryList;

			$data = $cate_obj -> selectAllData();

			if ($data) {
				$this -> assign('data',$data);
			}else{
				$this -> error('数据库无数据,请前去添加','/admin/Category/cat_add');
			}
			return $this -> fetch('cat_list');
		}

		public function cat_add(){
			$data = input('post.');
			$cate_obj = new CategoryList;
			if($data){
				$res = $cate_obj -> insertData($data);
				if($res){
					$this -> success('添加成功','/admin/Category/cat_list');
				}
			}
			return $this -> fetch('cat_add');
		}

		public function cat_edit(){
			$cate_obj = new CategoryList;
			$id = input('get.ip');

			$data = $cate_obj -> selectData($id);
			if($data){
				$this -> assign('data',$data);
			}
			return $this -> fetch('cat_edit');
		}

		public function cat_upd(){
			$cate_obj = new CategoryList;
			
			$id = input('get.ip');

			$data = input('post.');
			if($data){
				$res = $cate_obj -> updData($data,$id);
				if($res){
					$this -> success('更新成功','/admin/Category/cat_list');
				}else{
					$this -> error('更新失败');
				}
			}
		}

		public function is_show(){
			$ip = $_POST['ip'];
			$cate_obj = new CategoryList;
			$return_data = [];

			$res = $cate_obj -> selectData($ip);
			$is_show = $res['is_show'];

			if ($is_show == 0) {
				$is_show = 1;
				$cate_obj -> put($is_show,$ip);
				$return_data['error_code'] = 1;
				$return_data['error_msg'] ='已上架';
				return $return_data;
			}else{
				$is_show = 0;
				$cate_obj -> put($is_show,$ip);
				$return_data['error_code'] = 0;
				$return_data['error_msg'] ='已下架';
				return $return_data;
			}
		}

		public function cat_del(){
			$cate_obj = new CategoryList;

			$id = input('post.ip');

			$is_show = !empty($_POST['is_show'])?$_POST['is_show']:0;


			if ($id) {
				if ($is_show == 1) {
					$return_data['error_code'] = 1;
					$return_data['error_msg'] ='请先下架此商品';
					return $return_data;
				}else if($is_show == 0){
					$res = $cate_obj -> delData($id);
					if(!$res){
						$return_data['error_code'] = 1;
						$return_data['error_msg'] ='删除失败';
						return $return_data;
					}else{
						$return_data['error_code'] = 0;
						$return_data['error_msg'] ='删除成功';
						return $return_data;
					}
				}else{
					$return_data['error_code'] = 1;
					$return_data['error_msg'] ='未获取到正确的上下架ID';
					return $return_data;
				}
			}
		}
	}
 ?>