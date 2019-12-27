<?php
namespace app\index\model;

use \think\Model;
use \think\Db;

class Cartmod extends Model{
	protected $id = 'id';
	protected $table = 'tp5_cart';
	protected $goods_t = 'tp5_goods';
	//更新库存
	public function updateStock($goods_id,$data){
		$res = Db::table($this->goods_t)
			   ->where('id',$goods_id)
			   ->update($data);
		return $res;
	}

	//获取商品总价
	public function getGoodstp($user_id,$goods_str){
		$data = Db::table($this->table)
		        ->alias('c')
		        ->join("$this->goods_t g",'g.id=c.goods_id')
		        ->where('c.user_id',$user_id)
		        ->whereIn('c.goods_id',$goods_str)
		        ->select();
		return $data;
	}

	//获取数据
	public function selectData($cat_id=0,$id=0,$user_id){
		$data = [];
		if($cat_id){
			//获取分类下的商品
			$data = Db::table($this->goods_t)
					->field('id,goods_name,price,goods_img')
			        ->where('cat_id',$cat_id)
			        ->select();
		}else if($id){
			$data = Db::table($this->goods_t)
		        ->where('id',$id)
		        ->find();
		}else if($user_id){
			//获取可显示的有序的分类
			$data = Db::table($this->table)
				->alias('c')
				->join("$this->goods_t g",'g.id=c.goods_id')
				->field('g.goods_img,g.goods_name,g.price,g.id,c.number,g.stock')
				->where('c.user_id',$user_id)
		        ->order('c.add_time','desc')
		        ->select();
		    if ($data) {
				foreach ($data as $key => $value) {
					$data[$key]['total_price'] = $value['number'] * $value['price'];
				}
			}
		}

		return $data;
	}


	public function insterData($data){
		$res = Db::table($this->table)->insert($data);
		return $res;
	}

	//获取用户加入购物车的商品
	public function getUserGoods($data){
		$user_goods = Db::table($this->table)
			->where('goods_id',$data['goods_id'])
			->where('user_id',$data['user_id'])
			->find();
		return $user_goods;
	}
	
	public function updateData($data,$upd_data){
		$res = Db::table($this->table)
			->where('goods_id',$data['goods_id'])
			->where('user_id',$data['user_id'])
			->update($upd_data);
		return $res;
	}

	//获取用户加入购物车的商品数量
	public function getUserGoodsNum($id){
		$count = Db::table($this->table)
		         ->where('user_id',$id)
		         ->count();
		return $count;
	}

	public function deleteData($data){
		$res = Db::table($this->table)
		       ->where('user_id',$data['user_id'])
		       ->where('goods_id',$data['goods_id'])
		       ->delete();
		return $res;
	}
}
