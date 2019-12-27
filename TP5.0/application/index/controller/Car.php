<?php
	namespace app\index\controller;

	use \think\Controller;
	use \think\Session;

	use \app\index\model\Cars;
	use \app\index\model\Category;
	use \app\index\model\Order;
	use \app\index\model\Users;
	use \app\index\model\Address as Ar;

	class Car extends Controller{
		
		public function car_add(){
			$return_data = [];
			$data = input('post.');
			$data['user_id'] = Session::get('id');
			$upd_data = [];
			$car_obj = new Cars;
			$cate_obj = new Category;
			// 判断是否登录
			if (!Session::get('id')) {
				$return_data['error_code'] = 2;
				$return_data['error_msg'] ='请您先登录';
				return $return_data;
			}
			// 判断上下架
			$goods_data = $cate_obj -> selectData($data['goods_id']);
			if ($goods_data['is_sale'] != 1) {
				$return_data['error_code'] = 1;
				$return_data['error_msg'] ='此商品已下架';
				return $return_data;
			}
			// 判断库存数量
			if ($goods_data['is_sale'] == 0) {
				$return_data['error_code'] = 1;
				$return_data['error_msg'] ='此商品已经售完';
				return $return_data;
			}
			if ($data['number'] == 0) {
				$return_data['error_code'] = 1;
				$return_data['error_msg'] ='商品数量不可为0';
				return $return_data;
			}
			// 查询此用户是否已经添加过此类商品
			$user_goods = $car_obj -> getUserGoods($data);

			$upd_data['number'] = $data['number'] + $user_goods['number'];
			if ($user_goods) {
				$upd = $car_obj -> updUserGoods($data, $upd_data);
				if ($upd) {
					$return_data['error_code'] = 0;
					$return_data['error_msg'] ='加入购物车成功';
					return $return_data;
				} else {
					$return_data['error_code'] = 1;
					$return_data['error_msg'] ='加入购物车失败';
					return $return_data;
				}
			} else {
				$data['add_time'] = date("Y:m:d H:i:s");
				$res = $car_obj -> insertData($data);
				if ($res) {
					$return_data['error_code'] = 0;
					$return_data['error_msg'] ='加入购物车成功';
					return $return_data;
				} else {
					$return_data['error_code'] = 1;
					$return_data['error_msg'] ='加入购物车失败';
					return $return_data;
				}
			}
		}

		public function car_list()
		{
			$car_obj = new cars;
			$user_id = Session::get('id');
			$data = $car_obj -> selectCar($user_id);
			$this -> assign('data', $data);
			return $this -> fetch('flow');
		}

		public function car_upd_num()
		{
			$user_id = Session::get('id');
			$car_obj = new Cars;
			$data = input('post.');
			$data['user_id'] = $user_id;
			$upd_data['number'] = $data['number'];
			unset($data['number']);
			$res = $car_obj -> updUserGoods($data, $upd_data);
		}

		public function car_del()
		{
			$data = input('post.');
			$data['user_id'] = Session::get('id');
			$car_obj = new Cars;

			$res = $car_obj -> delCar($data);
			if ($res) {
				$return_data['error_code'] = 0;
				$return_data['error_msg'] = "删除成功";
				return $return_data;
			} else {
				$return_data['error_code'] = 1;
				$return_data['error_msg'] = "删除失败";
				return $return_data;
			}
		}

		public function order_add()
		{
			$car_obj = new Cars;
			$order_obj = new Order;
			$data = input('post.');
			$ins_data['order_sn'] = date('YmdHis', time()).rand(100, 999);
			$ins_data['goods_id'] = rtrim($data['goods_str'], ',');
			$ins_data['user_id'] = Session::get('id');

			$goods_list = $car_obj -> getGoodstp($ins_data['user_id'], $data['goods_str']);
			// 计算总价
			$ins_data['total_price'] = 0;
			foreach ($goods_list as $k => $v) {
				$ins_data['total_price'] += $v['number'] * $v['shop_price'];
			}
			$ins_data['status'] = 1;
			$ins_data['add_time'] = date('Y:m:d H:i:s');

			$res = $order_obj -> insertData($ins_data);
			// var_dump($res)
			Session::set('order_id', $res);
			if ($res) {
				$ins_data2['order_id'] = $res;
				$ins_data2['user_id'] = Session::get('id');
				$ins_data2['add_time'] = date('Y:m:d H:i:s');
				foreach ($goods_list as $key => $value) {
					$ins_data2['goods_id'] = $value['goods_id'];
					$ins_data2['number'] = $value['number'];
					$order_obj -> insertGoodsData($ins_data2);
					// 插入成功后删除购物车中以下单的商品
					$car_obj -> delCar(['goods_id'=>$ins_data2['goods_id'],'user_id'=>$ins_data['user_id']]);
					// 预占库存
					$update_data['stock'] = $v['stock'] - $ins_data2['number'];
					// $car_obj -> updateStock($ins_data2['goods_id'],$ins_data2['number'])
				}
				$return_data['error_code'] = 0;
				$return_data['error_msg'] = "下单成功";
				return $return_data;
			} else {
				$return_data['error_code'] = 1;
				$return_data['error_msg'] = "下单失败";
				return $return_data;
			}
		}

		public function car_flow()
		{
			$order_obj = new Order;
			$ar_obj = new Ar;
			$order_id = Session::get('order_id');
			$user_id = Session::get('id');
			$order_list = $order_obj -> selectData($order_id);
			$order_info = $order_obj -> getOrderPrice($order_id);
			$region_list = $order_obj -> getRegion();
			// 用户已有地址
			$user_address = $ar_obj -> selectData($user_id);
			$this -> assign('order_id', $order_id);
			$this -> assign('data', $order_list);
			$this -> assign('region_list', $region_list);
			$this -> assign('total_price', $order_info['total_price']);
			$this -> assign('user_address', $user_address);
			return $this -> fetch('flow2');
		}

		public function getRegion()
		{
			//接收flow2里面传过来的数据
			$order_obj=new Order;
			$data=input("post.");
			$region_list=$order_obj->getRegion($data['region_id'], $data['region_type']);
			return $region_list;
		}

		public function go_suc()
		{
			return $this -> fetch('flow3');
		}

		public function order_upd()
		{
			$data = input('post.');
			$return_data = [];
			$order_id = $data['order_id'];
			$user_id = Session::get('id');
			$upd_data['address_id'] = $data['address_id'];
			$upd_data['status'] = 2;

			$order_obj = new Order;
			$users_obj = new Users;

			$res = $order_obj -> updateData($user_id, $order_id, $upd_data);

			$order_tp = $order_obj ->getOrderPrice($order_id);

			$user_info = $users_obj -> getUserInfo($user_id);

			$upd_data2['balance'] = floatval($user_info['balance'] - $order_tp['total_price']);
			if ($upd_data2['balance'] < 0) {
				$return_data['error_code'] = 1;
				$return_data['error_msg'] = "账户余额不足";
				return $return_data;
			} else {
				$res2 = $users_obj -> updateUserData($user_id, $upd_data2);
			}

			if ($res && $res2) {
				$return_data['error_code'] = 0;
				$return_data['error_msg'] = "购买成功";
				return $return_data;
			} else {
				if (!$res) {
					$return_data['error_code'] = 1;
					$return_data['error_msg'] = "订单状态修改失败";
					return $return_data;
				}
				if (!$res2) {
					$return_data['error_code'] = 1;
					$return_data['error_msg'] = "用户余额修改失败";
					return $return_data;
				}
			}
		}

		public function order_list()
		{
			$order_obj = new Order;
			$user_id = Session::get('id');
			$data = $order_obj -> allOrder($user_id);
			// var_dump($data);die;
			$this -> assign('data', $data);
			return $this -> fetch('order');
		}
	}
