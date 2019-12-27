<?php
namespace app\admin\controller;

use \think\Controller;
use app\admin\model\Cat;
use \think\Db;

class Category extends Controller{
	public function cat_list(){
		$cat_obj = new Cat;
		$data = !empty($cat_obj->selectData())?$cat_obj->selectData():[];
		$this->assign('data',$data);
		return $this->fetch('cat_list');
	}

	public function cat_add(){
		$cat_obj = new Cat;
		$data = input('post.');//1、获取数据
		if($data){
			$res = $cat_obj->insertData($data);//2、插入数据
			if($res){
				$this->success('商品分类添加成功','Category/cat_list');
			}else{
				$this->error('商品分类添加失败');
			}
		}

		return $this->fetch('cat_add');
	}
	//删除分类
	public function cat_del(){
		$cat_obj = new Cat;
		$id = input('get.id');
		if($id){
			$res = $cat_obj->deleteData($id);
			if($res){
				$this->success('删除并修改成功','Category/cat_list');
			}else{
				$this->error('删除失败');
			}
		}else{
			$this->error('未获取到ID');
		}
	}
	//编辑分类
	public function cat_upd(){
		$cat_obj = new Cat;
		$id = input('get.id');
		$data = $cat_obj->get_cat_data($id);
		$this->assign('data',$data);
		return $this->fetch('cat_edit');
	}
	public function cat_to_upd(){
		$data = input('post.');
		$id = $data['cat_id'];
		unset($data['cat_id']);
		$res = Db::table('tp5_category')
		       ->where('id',$id)
		       ->update($data);
		if($res){
			$this->success('修改成功','Category/cat_list');
		}else{
			$this->error('修改失败');
		}
	}
}


