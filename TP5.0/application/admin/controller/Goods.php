<?php 
	namespace app\admin\controller;

	use \think\Controller;

	use app\admin\model\GoodsList;

	use \think\Request;

	use app\admin\model\GoodsTypeList;

	use app\admin\model\CategoryList;

	class Goods extends Controller{
		public function goods_list(){
			$goods_obj = new GoodsList;

			$data = $goods_obj -> selectAllData();

			if ($data) {
				$this -> assign('data',$data);
			}
			return $this -> fetch('goods_list');
		}

		public function goods_add(){
			$data = input('post.');		// =>$_POST;
			// 假如想调用单个属性则input('post.goods_name')
			$goods_obj = new GoodsList;
			$cat_obj = new CategoryList;
			if ($data) {
				$file = request() -> file('goods_img');
				$info = $file->validate(['size'=>2097152,'ext'=>'jpeg,jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads');
				$data['goods_img'] = 'uploads/'.$info->getSaveName();
				$res = $goods_obj -> insertData($data);
				if($res){
					$this -> success('商品添加成功','Goods/goods_list');
				}else{
					$this -> error('商品添加失败');
				}
			}
			$cat_list = $cat_obj->selectAllData();
			$this->assign('cat_list',$cat_list);
			return $this -> fetch('goods_add');
		}

		public function goods_edit(){
			$id = $_GET['ip'];
			$goods_obj = new GoodsList;
			$cat_obj = new CategoryList;
			if($id){
				$res = $goods_obj -> selectData($id);
				//获取分类数据，渲染分类
				$cat_list = $cat_obj->selectAllData();
				//将数据渲染到页面上;
				$this ->assign('cat_list',$cat_list);  //可以渲染两次页面 
				if($res){
					$this->assign('data',$res);
					return $this->fetch('goods_edit');
				}else{
					$this->error("未获取到数据");
				}
			}else{
				$this->error("未获取到ID");
			}
		}

		// 删除
		public function goods_del(){
			$return_data = [];
			$data = $_POST['ip'];
			$goods_obj = new GoodsList;
			$is_sale = !empty($_POST['is_sale'])?$_POST['is_sale']:0;

			if ($data) {
				if ($is_sale == 1) {
					$return_data['error_code'] = 1;
					$return_data['error_msg'] ='请先下架此商品';
					return $return_data;
				}else if($is_sale == 0){
					$res = $goods_obj -> delData($data);
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

			
		/* 修改页 */

		// 更新
		public function goods_upd(){
			$return_data = [];
			$data = $_POST;
			$ip = $_GET['ip'];
			$goods_obj = new GoodsList;
			if($data){
				$file = request() -> file('goods_img');
				if($file){
					$info = $file->validate(['size'=>2097152,'ext'=>'jpeg,jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads');
					$data['goods_img'] = 'uploads/'.$info->getSaveName();
				}
				$res = $goods_obj -> updDate($data,$ip);
				if($res){
					$this -> success('商品信息修改成功','Goods/goods_list');
				}else{
					$this -> error('商品修改失败');
				}
			}

		}
		
		public function putaway(){
			$ip = $_POST['ip'];
			$goods_obj = new GoodsList;
			$return_data = [];

			$res = $goods_obj -> selectData($ip);
			$is_sale = $res['is_sale'];

			if ($is_sale == 0) {
				$is_sale = 1;
				$goods_obj -> put($is_sale,$ip);
				$return_data['error_code'] = 1;
				$return_data['error_msg'] ='已上架';
				return $return_data;
			}else{
				$is_sale = 0;
				$goods_obj -> put($is_sale,$ip);
				$return_data['error_code'] = 0;
				$return_data['error_msg'] ='已下架';
				return $return_data;
			}
		}

		// 搜索
		public function search(){
			$keyword = input('get.keyword');
			$goods_obj = new GoodsList;

			$data = $goods_obj -> searchData($keyword);

			$this->assign('data',$data);

			return $this->fetch("goods_list");
		}

		public function type_add(){
			$goods_obj = new GoodsTypeList;
			$data = input('post.');
			if ($data) {
				$res = $goods_obj -> insertData($data);
				if($res){
					$this -> success('商品添加成功','Goods/type_list');
				}else{
					$this -> error('商品添加失败');
				}
			}
			return $this->fetch("goods_type_add");
		}
		public function type_del(){
			$return_data = [];
			$data = $_POST['ip'];
			$goods_obj = new GoodsTypeList;
			$is_sale = !empty($_POST['is_sale'])?$_POST['is_sale']:0;

			if ($data) {
				if ($is_sale == 1) {
					$return_data['error_code'] = 1;
					$return_data['error_msg'] ='请先下架此商品';
					return $return_data;
				}else if($is_sale == 0){
					$res = $goods_obj -> delData($data);
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
		public function type_edit(){
			$data = $_GET['ip'];
			$goods_obj = new GoodsTypeList;
			$res = $goods_obj -> selectData($data);
			if($res){
				$this -> assign('data',$res);
			}
			return $this->fetch("goods_type_edit");
		}

		public function type_list(){
			$goods_obj = new GoodsTypeList;

			$data = $goods_obj -> selectAllData();

			if ($data) {
				$this -> assign('data',$data);
			}else{
				$this -> error('数据库无数据,请前去添加',"/admin/Goods/type_add");
			}
			return $this->fetch("goods_type_list");
		}
		
		public function type_upd(){
			$return_data = [];
			$data = $_POST;
			$ip = $_GET['ip'];
			$goods_obj = new GoodsTypeList;

			$res = $goods_obj -> updDate($data,$ip);
			if($res){
				$this -> success('商品信息修改成功','Goods/type_list');
			}else{
				$this -> error('商品修改失败');
			}
		}
		public function type_putaway(){
			$ip = $_POST['ip'];
			$goods_obj = new GoodsTypeList;
			$return_data = [];

			$res = $goods_obj -> selectData($ip);
			$is_sale = $res['is_sale'];

			if ($is_sale == 0) {
				$is_sale = 1;
				$goods_obj -> put($is_sale,$ip);
				$return_data['error_code'] = 1;
				$return_data['error_msg'] ='已上架';
				return $return_data;
			}else{
				$is_sale = 0;
				$goods_obj -> put($is_sale,$ip);
				$return_data['error_code'] = 0;
				$return_data['error_msg'] ='已下架';
				return $return_data;
			}
		}
	}
 ?>