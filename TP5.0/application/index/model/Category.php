<?php 
	namespace app\index\model;

	use \think\Model;

	use \think\Db;

	class Category extends Model{
		protected $id = 'id';
		protected $table = 'tp5_category';
		protected $goods = 'tp5_goods';
		protected $car = 'tp5_car';

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
		
		public function selectData($id){
			$res = Db::table($this->goods)->where('id',$id)->find();
			return $res;

		}

		// 更新数据
		public function updData($data,$ip){
			$res = Db::table($this -> table) -> where('id',$ip) -> update($data);
			return $res;
		}
		// 修改单条数据
		public function put($data,$ip){
			$res = Db::table($this -> table) -> where('id',$ip) -> update(["is_show" => $data]);
			return $res;
		}

		public function getUserGoodsNum($data){
			$res = Db::table($this -> car)
						-> where('user_id',$data)
						-> count();
			return $res;
		}
	}
 ?>