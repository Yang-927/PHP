<?php
namespace app\index\model;

use \think\Model;
use \think\Db;

class Address extends Model{
	protected $id = 'id';
	protected $table = 'tp5_user_address';
	protected $region = 'tp5_region';
	//插入用户的新地址
	public function insertData($data){
		$res = Db::table($this->table)
		       ->insert($data);
		return $res;
	}
	//删除用户地址
	public function deleteData($user_id,$id){
		$res = Db::table($this->table)
		       ->where(['user_id'=>$user_id,'id'=>$id])
		       ->delete();
		return $res;
	}
	//查询用户地址信息
	public function selectData($user_id){
		$data = Db::table($this->table)
		       ->where('user_id',$user_id)
		       ->select();
		foreach ($data as $k => $v) {
			$province_data = Db::table($this->region)
							 ->field('region_name')
			                 ->where('region_id',$v['province_id'])
			                 ->find();
			$city_data = Db::table($this->region)
							 ->field('region_name')
			                 ->where('region_id',$v['city_id'])
			                 ->find();
			$county_data = Db::table($this->region)
							 ->field('region_name')
			                 ->where('region_id',$v['county_id'])
			                 ->find();
			$data[$k]['province_name'] = $province_data['region_name'];
			$data[$k]['city_name'] = $city_data['region_name'];
			$data[$k]['county_name'] = $county_data['region_name'];
		}
		return $data;
	}
}