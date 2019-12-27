<?php 
	namespace app\index\model;

	use \think\Model;

	use \think\Db;

	class Favo extends Model{
		protected $table = 'tp5_favo';
		protected $goods_table = 'tp5_goods';

		public function selectAllData($cat_id=0){
			if($cat_id){
				//获取分类下的商品
				$data = Db::table($this->goods)
				->field('id,goods_name,shop_price,goods_img')
				->where("cat_id",$cat_id)
				->select();
			}else{
				//获取可显示有序分类
				$data = Db::table($this->table)
					->where("is_show",1)
			        ->order('sort_order')
			        ->select();
			}
			//select * from tp5_category order by sort asc(升序)/desc(降序)
			return $data;
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
		
		public function selectData($id,$user_id){
			$res = Db::table($this -> table)
						->where('goods_id',$id)
						->where('user_id',$user_id)
						->select();
			return $res;
		}

		public function selectFavo($user_id){
			$res = [];
			$res = Db::table($this -> table)
						-> alias('c')
						-> join ("$this->goods_table g","g.id = c.goods_id")
						-> field('g.goods_img,g.goods_name,g.shop_price,g.id')
						-> where('c.user_id',$user_id)
						-> order('c.add_time','desc')
						-> paginate(16);
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
	}
 ?>