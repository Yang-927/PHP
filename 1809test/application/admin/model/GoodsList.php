<?php
namespace app\admin\model;

use \think\Model;
use \think\Db;

class GoodsList extends Model{
	protected $id = 'id';
	protected $table = 'tp5_goods';
	//添加数据
	public function insertData($data){
		$res = Db::table($this->table)->insert($data);
		return $res;
	}
	//查询多条数据 select()结果返回二维数组，find()返回一维数组
	public function selectData(){
		$data = Db::table($this->table)->paginate(5);
		return $data;
	}

	//删除数据
	public function deleteData($id){
		$res = Db::table($this->table)->where('id',$id)->delete();
		return $res;
	}
	//获取单条数据
	public function getOneData($id){
		$data = Db::table($this->table)->where('id',$id)->find();
		return $data;
	}

	public function updateData($id,$data){
		$res = Db::table($this->table)->where('id',$id)->update($data);
		//echo Db::getLastSql();die;
		return $res;
	}
	//查询数据
	public function searchData($keyword){
		if($keyword){
			var_dump(request()->param());die;
			$data = Db::table($this->table)
		       ->where('goods_name','like',"%$keyword%")
		       ->paginate(5, false, ['query' => request()->param()]);
		}else{
			$data = $this->selectData();
		}
		return $data;
	}
}