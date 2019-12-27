<?php
namespace app\index\controller;

// 控制基本类
use \think\Controller;
// 引入Users模型类
use app\index\model\Users;

use app\index\model\Category;

use app\index\model\Favo;

use \think\Session;

class Index extends Controller
{
	public function index()
	{
		$cat_obj = new Category;
		$cat_list = $cat_obj->selectAllData();
		$this->assign("cat_list",$cat_list);


		$act = !empty($_POST['act'])?$_POST['act']:'';
		if($act){
			//存在为退出
			Session::delete('user_name');
			Session::delete('id');
		}
		$id = Session::get('id');
		$count = $cat_obj -> getUserGoodsNum($id);
		$this -> assign('cart_num',$count);


		$user_name = Session::get('user_name');
		$this->assign('user_name',$user_name);
		return $this->fetch('index');

		// 类外引用静态方法
		// 类名::方法名
		// 类内引用静态方法
		// self::index()
		/*echo Users::$age;
		Users::getUser();
		// 对象 = new 引入的类
		$users = new Users();
		// echo $users -> table;
		$users -> getUser();
		echo $users -> username;die;*/

		/*
		类外引用属性和方法
			实例化对象:对象= new 引入的类();
			属性:
				类外引用:对象->属性名;
				类内使用:$this->属性名;
			方法:
				类外引用: 对象->方法名;
				类内引用:$this->方法名;
		*/
	
	}
	
	public function goods_list(){
		$cat_obj = new Category;
		$data    = input('get.');
		$cat_id  = !empty($data['cat_id'])?$data['cat_id']:'0';
		if($cat_id){
			$goods_list = $cat_obj -> selectAllData($cat_id);
		}
		$this->assign('goods_list',$goods_list);
		return $this->fetch('list');
	}

	public function goods_detail(){
		$cat_obj = new Category;
		$favo_obj = new Favo;
		$data = input('get.');
		$id = !empty($data['id'])?$data['id']:0;
		$user_id = Session::get('id');
		if($id){
			$res = $cat_obj -> selectData($id);
			$is = $favo_obj -> selectData($id,$user_id);
			if($is){
				$res['is_red'] = 0;
			}else{
				$res['is_red'] = 1;
			}
			$this -> assign('data',$res);
		}
		return $this -> fetch('goods');
	}

	public function favo(){
		$favo_obj = new Favo;
		$cat_obj = new Category;
		$act = !empty($_POST['act'])?$_POST['act']:'';
		if($act){
			//存在为退出
			Session::delete('user_name');
			Session::delete('id');
		}
		$id = Session::get('id');
		$count = $cat_obj -> getUserGoodsNum($id);
		$this -> assign('cart_num',$count);


		$user_name = Session::get('user_name');
		$this->assign('user_name',$user_name);
		$user_id = Session::get('id');
		if (!$user_id) {
			$this -> success('还没有登录','index/Login/login');
		}else{
			$data = $favo_obj -> selectFavo($user_id);
			$this -> assign('data',$data);
		}
		return $this -> fetch('favorite');
	}

	public function goods_favo(){
		$data = [];
		$data['goods_id'] = input('post.goods_id');
		$favo_obj = new Favo;
		$return_data = [];
		$data['user_id'] = Session::get('id');
		if (!Session::get('id')) {
			$this -> success('还没有登录','index/Login/login');
		}
		$user_goods = $favo_obj -> getUserGoods($data);
			if($user_goods){
				$return_data['error_code'] = 0;
					$return_data['error_msg'] = '已存在该商品';
					return $return_data;
			}else{
				$data['add_time'] = date("Y:m:d H:i:s");
				$res = $favo_obj -> insertData($data);
				if($res){
					$return_data['error_code'] = 0;
					$return_data['error_msg'] = '收藏成功';
					return $return_data;
				}else{
					$return_data['error_code'] = 1;
					$return_data['error_msg'] = '收藏失败';
					return $return_data;
				}
			}
	}
}

