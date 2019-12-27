<?php 
	namespace app\index\model;

	use \think\Model;

	use \think\Db;

	class Users extends Model
	{
		protected $id = 'id';

		// 设置当前模板对应的数据表的名称-
		protected $table = 'users';

		public $username = 'YANG';

		public static $age = '21';
		// static静态
		// public static 公共的静态方法
		public static function index(){
			$sql = "SELECT * FROM users";
			$data = Db::query($sql);
			
		}
		public function getUser($user_name){
			$user_info = Db::table($this -> table)
							-> where('user_name',$user_name)
							->find();
			return $user_info;
		}
		public function insterData($data){
			$res = Db::table($this -> table)
						-> insert($data);
			return $res;
		}

		public function updateData($data){
			$res = Db::table($this -> table)
						-> where('user_name',$data['user_name'])
						-> update($data);
			return $res;
		}

		public function getUserInfo($id){
			$res = Db::table($this -> table)
						-> where('id',$id)
						-> find();
			return $res;
		}

		public function updateUserData($id,$data){
			$res = Db::table($this -> table)
						-> where('id',$id)
						-> update($data);
			return $res;
		}
	}
 ?>