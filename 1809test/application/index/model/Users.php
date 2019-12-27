<?php
namespace app\index\model;

use \think\Model;
//引入Db類
use \think\Db;

class Users extends Model{
	protected $id = 'id';
	// 设置当前模型对应的数据表名称
	protected $table = 'tp5_users';
	public static $user_name = "小明";

	/*
		获取相同用户名数据的方法
		20191015
	 */
	public function getUser($user_name){
		$user_info = Db::table($this->table)
						->where('user_name',$user_name)
						->find();
		return $user_info;
	}
	public function getUserId($id){
		$user_info = Db::table($this->table)
						->where('id',$id)
						->find();
		return $user_info;
	}
	/*
		添加数据方法
	 */
	public function insterData($data){
		$res = Db::table($this->table)->insert($data);
		return $res;
	}
	/*
		修改数据方法
	 */
	public function updateData($data){
		$res = Db::table($this->table)
		        ->where('user_name',$data['user_name'])
		        ->update($data);
		return $res;
	}
	public function updateDataId($id,$data){
		$res = Db::table($this->table)
		        ->where('id',$id)
		        ->update($data);
		return $res;
	}
	
}

