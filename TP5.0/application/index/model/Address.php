<?php 
	namespace app\index\model;

	use \think\Model;

	use \think\Db;

	class Address extends Model{
		protected $id = 'id';
		protected $table = 'tp5_user_address';
		protected $region = "tp5_region";



		public function insertData($data){
			$res = Db::table($this -> table)
						-> insert($data);
			return $res;
		}

		public function selectData($user_id){
			$res = Db::table($this -> table)
							-> where('user_id',$user_id)
							-> select();
			foreach ($res as $k => $v) {
				$province_data = Db::table($this -> region)
										-> field('region_name')
										-> where('region_id',$v['province_id'])				
										-> find();
				$city_data = Db::table($this -> region)
										-> field('region_name')
										-> where('region_id',$v['city_id'])				
										-> find();
				$county_data = Db::table($this -> region)
										-> field('region_name')
										-> where('region_id',$v['county_id'])				
										-> find();

				$res[$k]["province_name"] = $province_data['region_name'];
				$res[$k]["city_name"] = $city_data['region_name'];
				$res[$k]["county_name"] = $county_data['region_name'];
			}
			return $res;
		}

		public function delData($id){
			$res = Db::table($this -> table)
						-> where('id',$id)
						-> delete();
			return $res;
		}
	}
 ?>