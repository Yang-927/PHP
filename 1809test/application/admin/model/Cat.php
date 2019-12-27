<?php
namespace app\admin\model;

use \think\Model;
use \think\Db;

class Cat extends Model{
	protected $id = 'id';
	protected $table = 'tp5_category';
	protected $goods_t = 'tp5_goods';
	//添加方法
	public function insertData($data){
		$res = Db::table($this->table)->insert($data);
		return $res;
	}
	//获取数据
	public function selectData(){
		$data = Db::table($this->table)
		        ->order('sort')
		        ->select();
		foreach ($data as $key => $value) {
			$data[$key]['goods_num'] = Db::table($this->goods_t)
			->where('cat_id',$value['id'])
			->count();
		}
		//select * from tp5_category order by sort asc(升序)/desc(降序)
		return $data;
	}
	//删除分类
	public function deleteData($id){
		$del_res = Db::table($this->table)
		       ->where('id',$id)
		       ->delete();
		//获取此分类下的商品
		$data = $this->get_data($id);

		if($del_res && $data){
			$upd_res = Db::table($this->goods_t)
		       ->where('cat_id',$id)
		       ->update(['cat_id'=>0]);
		    return true;
		}else if($del_res){
			return true;
		}else{
			return false;
		}
	}
	//条件查询
	public function get_data($id){
		$data = Db::table($this->goods_t)
		->where('cat_id',$id)
		->select();
		return $data;
	}
	//查询单条分类
	public function get_cat_data($id){
		$data = Db::table($this->table)
		        ->where('id',$id)
		        ->find();
		return $data;
	}
}
