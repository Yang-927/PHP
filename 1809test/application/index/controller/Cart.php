<?php
namespace app\index\controller;
//控制基本類
use \think\Controller;
use \think\Session;
use app\index\model\Cartmod;
use app\index\model\Cat;
use app\index\model\Order;
use app\index\model\Address as Ar;
use \think\Db;

class Cart extends Controller{
	//购物车商品添加方法
	public function cart_add(){
		//判断用户是否登录
		if(!Session::get('id')){
			$return_data['error_code'] = 2;
            $return_data['error_msg'] = "请您先登录";
            return $return_data;
		}

		$cat_obj = new Cat;
		$cart_obj = new Cartmod;
		$return_data = [];
		$data = input('post.');

		$goods_data = $cat_obj->selectData(0,$data['goods_id']);
		//判断商品是否上架
		if($goods_data['is_sale'] != 1){
			$return_data['error_code'] = 0;
            $return_data['error_msg'] = "此商品已下架";
            return $return_data;
		}
		//判断商品是否有库存
		if($goods_data['stock'] == 0){
			$return_data['error_code'] = 0;
            $return_data['error_msg'] = "此商品已售完";
            return $return_data;
		}
		$data['user_id'] =  Session::get('id');
		$data['add_time'] = time();

		//查询此用户是否已经加入过此类商品
		$user_goods = $cart_obj->getUserGoods($data);
		$upd_data['number'] = $data['number']+$user_goods['number'];

		if($user_goods){
			$res = $cart_obj->updateData($data,$upd_data);
		}else{
			$res = $cart_obj->insterData($data);
		}

		if($res){
			$return_data['error_code'] = 0;
            $return_data['error_msg'] = "添加商品至购物车成功";
            return $return_data;
		}else{
			$return_data['error_code'] = 1;
            $return_data['error_msg'] = "添加商品至购物车失败";
            return $return_data;
		}
	}

	public function cart_list(){
		$cart_obj = new Cartmod;
		$user_id = Session::get('id');
		$data = $cart_obj->selectData(0,0,$user_id);
		$this->assign('data',$data);
		// var_dump($data);die;
		return $this->fetch('cart_list');
	}

	public function cart_upd_num(){
		$cart_obj = new Cartmod;
		$data = input('post.');
		$data['user_id'] = Session::get('id');
		$upd_data['number'] = $data['number'];
		unset($data['number']);
		$cart_obj->updateData($data,$upd_data);
	}

	public function cart_del(){
		$cart_obj = new Cartmod;
		$data = input('post.');
		$data['user_id'] = Session::get('id');
		$res = $cart_obj->deleteData($data);
		if ($res) {
			$return_data['error_code'] = 0;
            $return_data['error_msg'] = "删除购物车商品成功";
            return $return_data;
		}else{
			$return_data['error_code'] = 1;
            $return_data['error_msg'] = "删除购物车商品失败";
            return $return_data;
		}
	}

	public function car_flow(){
			$order_obj = new Order;
			$ar_obj = new Ar;
			$order_id = Session::get('order_id');
			$user_id = Session::get('id');
			$order_list = $order_obj -> selectData($order_id);
			$order_info = $order_obj -> getOrderPrice($order_id);
			$region_list = $order_obj -> getRegion();
			// var_dump($region_list);die;
			// 用户已有地址
			$user_address = $ar_obj -> selectData($user_id);
			$this -> assign('order_id', $order_id);
			$this -> assign('data', $order_list);
			$this -> assign('region_list', $region_list);
			$this -> assign('total_price', $order_info['total_price']);
			$this -> assign('user_address', $user_address);
			return $this -> fetch('flow2');
		}

	public function order_add(){
		$car_obj = new Cartmod;
		$order_obj = new Order;
		$data = input('post.');
		$ins_data['order_sn'] = date('YmdHis', time()).rand(100, 999);
		$ins_data['goods_id'] = rtrim($data['goods_str'], ',');
		$ins_data['user_id'] = Session::get('id');

		$goods_list = $car_obj -> getGoodstp($ins_data['user_id'], $data['goods_str']);
		// 计算总价
		$ins_data['total_price'] = 0;
		foreach ($goods_list as $k => $v) {
			$ins_data['total_price'] += $v['number'] * $v['price'];
		}
		$ins_data['status'] = 1;
		$ins_data['add_time'] = date('Y:m:d H:i:s');
		// var_dump($ins_data);die;
		$res = $order_obj -> insertData($ins_data);
		// var_dump($res);die;
		Session::set('order_id', $res);
		if ($res) {
			$ins_data2['order_id'] = $res;
			$ins_data2['user_id']  = Session::get('id');
			$ins_data2['add_time'] = date('Y:m:d H:i:s');
			foreach ($goods_list as $key => $value) {
				$ins_data2['goods_id'] = $value['goods_id'];
				$ins_data2['number'] = $value['number'];
				$order_obj -> insertGoodsData($ins_data2);
				// 插入成功后删除购物车中以下单的商品
				$car_obj -> deleteData(['goods_id'=>$ins_data2['goods_id'],'user_id'=>$ins_data['user_id']]);
				// 预占库存
				$update_data['stock'] = $v['stock'] - $ins_data2['number'];
				// $car_obj -> updateStock($ins_data2['goods_id'],$ins_data2['number'])
			}
			$return_data['error_code'] = 0;
			$return_data['error_msg']  = "下单成功";
			return $return_data;
		} else {
			$return_data['error_code'] = 1;
			$return_data['error_msg']  = "下单失败";
			return $return_data;
		}
	}

}