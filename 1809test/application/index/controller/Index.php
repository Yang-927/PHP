<?php
namespace app\index\controller;
//控制基本類
use \think\Controller;
//引入Users模型類
use app\index\model\Users;
use \think\Session;//引入session会话
use \app\index\model\Cat;
use \app\index\model\Cartmod;
use \app\index\model\Order;
use \app\index\model\Favos;
use \think\Db;

class Index extends Controller
{
   
	/*
		渲染模板
		石
		2019.10.11
	 */
	//方法修飾符   public    private    protected
	public function index(){
		$cart_obj = new Cartmod;
		//获取分类
		$cat_obj = new Cat;
		$cat_list = $cat_obj->selectData();
		$this->assign('cat_list',$cat_list);

		$act = !empty($_POST['act'])?$_POST['act']:'';
		if($act){
			//存在为退出
			Session::delete('user_name');
			Session::delete('id');
		}

		$id = Session::get('id');
		$count = $cart_obj->getUserGoodsNum($id);
		$this->assign('cart_num',$count);

		$user_name = Session::get('user_name');
		$this->assign('user_name',$user_name);
		return $this->fetch('index');


		/*
			實例化對象：對象 = new 引入的類();
			屬性：
			類外引用：對象->屬性名;
			類內引用：$this->屬性名;
			方法：
			類外引用：對象->方法名();
			類內引用：$this->方法名();
		 */
		// $users = new Users();
		// $users->getUser();
		/*
			静态方法的使用
			方法:
			类外引用:	类名::方法名();
			类内引用:  	self::方法名();
			属性:
			类外引用:	类名::$属性名;
			类内引用:  	self::$属性名;
		 */
		//echo Users::$user_name;
		//Users::getUser(); //只是为了调用

		
	}
	public function goods_list(){
		$cat_obj = new Cat;
		$data = input('get.');
		$cat_id = !empty($data['cat_id'])?$data['cat_id']:0;
		if($cat_id){
			$goods_list = $cat_obj->selectData($cat_id);
		}
		$this->assign('goods_list',$goods_list);
		return $this->fetch('list');
	}

	public function goods_detail(){
		$cat_obj = new Cat;
		$favo_obj = new Favos;
		$data = input('get.');
		$data['goods_id'] = $data['id'];
		$data['user_id'] = Session::get('id');
		//查询此商品是否被收藏
		

		$id = !empty($data['id'])?$data['id']:0;
		if($id){
			$goods_list = $cat_obj->selectData(0,$id);
			$is = $favo_obj -> selectData($data);
			// var_dump($is);die;
			if($is){
				$goods_list['is_red'] = 1;
			}else{
				$goods_list['is_red'] = 0;
			}
			// var_dump($goods_list);die;
		}
		$this->assign('goods_list',$goods_list);
		return $this->fetch('goods');
	}
	public function add_favo(){
		$return_data = [];
		$data = [];
		$data['goods_id'] = input('post.goods_id');
		$data['user_id'] = Session::get('id');
		$favo_obj = new Favos;
		if (!$data['user_id']) {
			$return_data['error_code'] = 0;
			$return_data['error_msg'] = '您还没有登录,请登录后收藏';
			return $return_data;
		}
		$data['add_time'] = date('Y-m-d H:i:s');
		$user_goods = $favo_obj ->selectData($data);
		if($user_goods){
			$return_data['error_code'] = 0;
			$return_data['error_msg'] = '已存在该商品';
			return $return_data;
		}
		$res = $favo_obj -> insertData($data);
		if($res){
			$return_data['error_code'] = 1;
			$return_data['error_msg'] = '收藏成功';
			return $return_data;
		}else{
			$return_data['error_code'] = 0;
			$return_data['error_msg'] = '收藏失败';
			return $return_data;
		}
	}
	

	public function del_favo(){
		$data = [];
		$data['goods_id'] = input('post.goods_id');
		$data['user_id'] = Session::get('id');
		$favo_obj = new Favos;
		if (!$data['user_id']) {
			$return_data['error_code'] = 0;
			$return_data['error_msg'] = '您还没有登录,请登录后收藏';
			return $return_data;
		}

		$res = $favo_obj -> delData($data);
		if($res){
			$return_data['error_code'] = 1;
			$return_data['error_msg'] = '取消收藏成功';
			return $return_data;
		}else{
			$return_data['error_code'] = 0;
			$return_data['error_msg'] = '取消收藏失败';
			return $return_data;
		}
	}
}
