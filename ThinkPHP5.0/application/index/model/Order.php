<?php 
	namespace app\index\model;

	use \think\Model;

	use \think\Db;

	class Order extends Model{
		protected $table = 'tp5_order_info';
		protected $order_goods = 'tp5_order_goods';
		protected $goods = 'tp5_goods';
		protected $region = 'tp5_region';

		public function getRegion($p_id=1,$region_type=1){
			$data = Db::table($this->region)
				->where("parent_id",$p_id)
				->where('region_type',$region_type)
				->select();
			return $data;
		}

		public function insertData($data){
			$res = Db::table($this -> table) -> insertGetId($data);
			return $res;
		}
		public function insertGoodsData($data){
			$res = Db::table($this -> order_goods) -> insert($data);
			return $res;
		}

		public function getOrderPrice($order_id){
			$res = Db::table($this -> table)
					->where('id',$order_id)
					->find();
			return $res;
		}

		public function selectData($order_id){
			$res = Db::table($this -> order_goods)
							-> alias('og')
							-> join("$this->goods g",'g.id = og.goods_id')
							-> field('g.id,g.goods_name,g.goods_img,g.shop_price,og.number')
							-> where('og.order_id',$order_id)
							-> select();
			return $res;
		}

		public function updateData($user_id,$order_id,$upd_data){
			$res = Db::table($this -> table)
						 ->where('user_id',$user_id)
						 ->where('id',$order_id)
						 ->update($upd_data);
			return $res;
		}

		// 获取用户所有的订单
		public function allOrder($user_id = 0){
			$res = Db::table($this -> table)
								-> where('user_id',$user_id)
								-> field('id,order_sn,total_price,status')
								-> select();
			foreach ($res as $k => $v) {
				if($v['status'] == 1){
					$res[$k]['status_desc'] = "未支付";
				}else if($v['status'] == 2){
					$res[$k]['status_desc'] = "待发货";
				}else if($v['status'] == 3){
					$res[$k]['status_desc'] = "确认收货";
				}else if($v['status'] == 4){
					$res[$k]['status_desc'] = "已完成";
				}else if($v['status'] == 5){
					$res[$k]['status_desc'] = "不可能退货";
				}
				$res[$k]['goods_data'] = Db::table($this -> order_goods)
							-> alias('og')
							-> join("$this->goods g","g.id = og.goods_id")
							-> field('og.number,g.goods_img,g.goods_name,g.shop_price')
							-> where('og.order_id',$v['id'])
							-> select();
			}
			return $res;
		}

	}
 ?>