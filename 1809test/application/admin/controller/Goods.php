<?php
namespace app\admin\controller;

use \think\Controller;
use \think\Request;
use app\admin\model\GoodsList;
use app\admin\model\Cat;

class Goods extends Controller{
	public function goods_list(){
		$goods_obj = new GoodsList;
		$data = $goods_obj->selectData();
		if($data){
			$this->assign('data',$data);
		}
		return $this->fetch('goods_list');
	}

	public function goods_add(){
		$goods_obj = new GoodsList;
		$cat_obj = new Cat;
		$data = input('post.'); //=>$_POST
		
		if($data){
			// 获取表单上传文件 例如上传了001.jpg
    		$file = request()->file('goods_img');
    		//上传文件的验证，包括文件大小、文件类型
    		$info = $file->validate(['size'=>2097152,'ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH . 'public'.DS . 'static' . DS . 'uploads');
    		$data['goods_img'] = 'uploads/'.$info->getSaveName();
			$res = $goods_obj->insertData($data);
			if($res){
				$this->success('商品添加成功','Goods/goods_list');
			}else{
				$this->error('商品添加失败');
			}
		}
		$cat_list = $cat_obj->selectData();
		$this->assign('cat_list',$cat_list);
		return $this->fetch('goods_add');
	}

	/*
		点击编辑，将数据渲染到修改页面
	 */
	public function goods_edit(){
		$goods_obj = new GoodsList;
		$cat_obj = new Cat;
		$id = !empty(input('get.id'))?input('get.id'):0;
		if($id){
			$data = $goods_obj->getOneData($id);
			//获取分类数据，渲染分类
			$cat_list = $cat_obj->selectData();
			//将数据渲染到页面上
			$this->assign('cat_list',$cat_list);
			if($data){
				$this->assign('data',$data);
				return $this->fetch('goods_edit');
			}else{
				$this->error("未获取到数据");
			}
		}else{
			$this->error("未获取到ID");
		}
		
	}
	/*
		此方法才是修改数据，同步到库
	 */
	public function goods_upd(){
		$goods_obj = new GoodsList;
		$data = !empty(input('post.'))?input('post.'):[];
		$id = $data['id'];
		unset($data['id']);
		$res = $goods_obj->updateData($id,$data);
		if($res){
			//重定向
			$this->redirect('/admin/Goods/goods_list');
		}
		$this->error('修改失败');
	}

	/*
		删除数据方法
	 */
	public function goods_del(){
		$goods_obj = new GoodsList;
		//为什么要用$_REQUEST
		$id = !empty(input('post.id'))?input('post.id'):0;
		$is_sale = !empty(input('post.is_sale'))?input('post.is_sale'):0;
		if($id){
			if($is_sale == 1){
				$return_data['error_code'] = 1;
	        	$return_data['error_msg'] = "请先下架此商品";
	        	return $return_data;
			}elseif($is_sale == 2){
				$res = $goods_obj->deleteData($id);
				if($res){
					$return_data['error_code'] = 0;
		        	$return_data['error_msg'] = "删除成功";
		        	return $return_data;
				}
				$return_data['error_code'] = 1;
	        	$return_data['error_msg'] = "删除失败";
	        	return $return_data;
			}else{
				$return_data['error_code'] = 1;
	        	$return_data['error_msg'] = "未获取到正确的上下架ID";
	        	return $return_data;
			}
		}else{
			$return_data['error_code'] = 1;
	        $return_data['error_msg'] = "未获取到ID";
	        return $return_data;
		}
	}

	/*
		搜索
	 */
	public function search(){
		$goods_obj = new GoodsList;
		$keyword = !empty(input('get.keyword'))?input('get.keyword'):'';
		
		$data = $goods_obj->searchData($keyword);
		$this->assign('data',$data);
		return $this->fetch('goods_list');
		
	}
}