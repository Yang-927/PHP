<?php 
	namespace app\index\model;

	use \think\Model;

	use \think\Db;

	class Cars extends Model{
		protected $table = 'tp5_car';
		protected $goods_table = 'tp5_goods';

		public function getGoodstp($user_id,$goods_id){
			$res = Db::table($this->table)
						->alias('c')
						->join("$this->goods_table g",'g.id = c.goods_id')
						->where('c.user_id',$user_id)
						->whereIn('c.goods_id',$goods_id)
						->select();

			return $res;
		}

		

		public function insertData($data){
			$res = Db::table($this -> table)
						-> insert($data);

			return $res;
		}

		public function delData($data){
			$res = Db::table($this -> table)
					 -> where('id',$data)
					 -> delete();
			return $res;
		}
		
		public function selectData($id){
			$res = Db::table($this->goods)->where('id',$id)->find();
			return $res;
		}
		public function selectCar($user_id){
			$res = [];
			$res = Db::table($this -> table)
						-> alias('c')
						-> join ("$this->goods_table g","g.id = c.goods_id")
						-> field('g.stock,g.goods_img,g.goods_name,g.shop_price,g.id,c.number')
						-> where('c.user_id',$user_id)
						-> order('c.add_time','desc')
						-> select();
			if ($res) {
				foreach ($res as $key => $value) {
					$res[$key]['total_price'] = $value['number'] * $value['shop_price'];
				}
			}
			return $res;
		}
		// 更新数据
		public function updData($data,$ip){
			$res = Db::table($this -> table) -> where('id',$ip) -> update($data);
			return $res;
		}

		public function getUserGoods($data){
			$res = Db::table($this -> table)
							-> where('goods_id',$data['goods_id'])
							-> where('user_id',$data['user_id'])
							-> find();
			return $res;
		}

		public function updUserGoods($data,$upd_data){
			$res = Db::table($this -> table)
							-> where('goods_id',$data['goods_id'])
							-> where('user_id',$data['user_id'])
							-> update($upd_data);
			return $res;
		}

		public function delCar($data){
			$res = Db::table($this -> table)
						-> where('goods_id',$data['goods_id'])
						-> where('user_id',$data['user_id'])
						-> delete();
			return $res;
		}
		
	}
 ?>