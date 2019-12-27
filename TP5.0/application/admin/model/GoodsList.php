<?php 
	namespace app\admin\model;

	use \think\Model;

	use \think\Db;

	class GoodsList extends Model{
		protected $id = 'id';
		protected $table = 'tp5_goods';

		public function insertData($data){
			$res = Db::table($this -> table)
						-> insert($data);

			return $res;
		}
		// 查询数据
		// Select 返回二维数组 Find返回一维数组;
		public function selectAllData(){
			$res = Db::table($this -> table) -> paginate(10);

			return $res;
		}

		public function delData($data){
			$res = Db::table($this -> table)
					 -> where('id',$data)
					 -> delete();
					
			return $res;
		}

		// 查询确定的一条数据
		public function selectData($data){
			$res = Db::table($this->table)->where('id',$data)->find();
			return $res;

		}

		// 更新数据
		public function updDate($data,$ip){
			$res = Db::table($this -> table) -> where('id',$ip) -> update($data);
			return $res;
		}
		// 修改单条数据
		public function put($data,$ip){
			$res = Db::table($this -> table) -> where('id',$ip) -> update(["is_sale" => $data]);
			return $res;
		}
		public function searchData($keyword){
			if($keyword){
				$data = Db::table($this->table)->where('goods_name','like',"%$keyword%")->paginate(10,false,['query' => request() -> param()]);
			}else{
				$data = $this-> selectAllData();
			}
			return $data;
		}
	}
 ?>