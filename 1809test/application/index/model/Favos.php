<?php
namespace app\index\model;

use \think\Model;
use \think\Db;

class Favos extends Model{
	protected $table = 'tp5_favo';
	protected $goods_table = 'tp5_goods';
	//获取数据
	public function insertData($data){
		$res = Db::table($this -> table)
					-> insert($data);
		return $res;
	}

	public function selectData($data){
		$res = Db::table($this -> table)
					-> where('user_id',$data['user_id'])
					-> where('goods_id',$data['goods_id'])
					->find();
		return $res;
	}

	public function delData($data){
		$res = Db::table($this -> table)
					-> where('user_id',$data['user_id'])
					-> where('goods_id',$data['goods_id'])
					->delete();
		return $res;
	}
}
