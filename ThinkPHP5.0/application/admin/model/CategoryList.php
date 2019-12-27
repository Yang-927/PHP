<?php 
	namespace app\admin\model;

	use \think\Model;

	use \think\Db;

	class CategoryList extends Model{
		protected $id = 'id';
		protected $table = 'tp5_category';

		public function selectAllData(){
			$res = Db::table($this -> table) -> select();

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
			$res = Db::table($this->table)->where('id',$id)->find();
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
	}
 ?>