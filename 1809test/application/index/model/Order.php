<?php
namespace app\index\model;

use \think\Model;
use \think\Db;

class Order extends Model{
	protected $id = 'id';
	protected $table = 'tp5_order_info';
	protected $order_goods = 'tp5_order_goods';
	protected $goods = 'tp5_goods';
	protected $region = 'tp5_region';
	//获取用户所有的订单
	public function allOrder($user_id=0){

		$data = Db::table($this->table)
		              ->where('user_id',$user_id)
		              ->field('id,order_sn,total_price,status')
		              ->select();
		foreach($data as $k => $v){
			if($v['status'] == 1)
				$data[$k]['status_desc'] = "等待买家付款";
			else if($v['status'] == 2)
				$data[$k]['status_desc'] = "等待商家发货";
			else if($v['status'] == 3)
				$data[$k]['status_desc'] = "确认收货";
			else if($v['status'] == 4)
				$data[$k]['status_desc'] = "退货";
			else if($v['status'] == 5)
				$data[$k]['status_desc'] = "就不给你退货";

			$data[$k]['goods_data'] = Db::table($this->order_goods)
		        ->alias('og')
		        ->join("$this->goods g",'g.id=og.goods_id')
		        ->field('og.number,g.goods_img,g.goods_name,g.price')
		        ->where('og.order_id',$v['id'])
		        ->select();
		}
		return $data;
	}

	//更新订单状态
	public function updateData($user_id,$order_id,$upd_data){
		$res = Db::table($this->table)
		        ->where('user_id',$user_id)
		        ->where('id',$order_id)
		        ->update($upd_data);
		return $res;
	}
	//获取地区信息
	public function getRegion($p_id=1,$region_type=1){
		$data = Db::table($this->region)
		        ->where('parent_id',$p_id)
		        ->where('region_type',$region_type)
		        ->select();
		return $data;
	}



	//添加订单
	public function insertData($data){
		$res = Db::table($this->table)->insertGetId($data);
		return $res;
	}

	//添加订单商品
	public function insertGoodsData($data){
		$res = Db::table($this->order_goods)->insert($data);
		return $res;
	}

	//查询此订单的总价
	public function getOrderPrice($order_id){
		$data = Db::table($this->table)
		        ->where('id',$order_id)
		        ->find();
		return $data;
	}

	//查询商品数据
	public function selectData($order_id){
		$data = Db::table($this->order_goods)
		        ->alias('og')
		        ->join("$this->goods g",'g.id=og.goods_id')
		        ->where('og.order_id',$order_id)
		        ->select();
		return $data;
	}
}
