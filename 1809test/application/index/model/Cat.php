<?php
namespace app\index\model;

use \think\Model;
use \think\Db;

class Cat extends Model{
	protected $id = 'id';
	protected $table = 'tp5_category';
	protected $goods_t = 'tp5_goods';
	
	//获取数据
	public function selectData($cat_id=0,$id=0){
		if($cat_id){
			//获取分类下的商品
			$data = Db::table($this->goods_t)
					->field('id,goods_name,price,goods_img')
			        ->where('cat_id',$cat_id)
			        ->select();
		}else if($id){
			$data = Db::table($this->goods_t)
		        ->where('id',$id)
		        ->find();
		}else{
			//获取可显示的有序的分类
			$data = Db::table($this->table)
				->where('is_show',1)
		        ->order('sort')
		        ->select();
		}
		return $data;
	}

	

}
