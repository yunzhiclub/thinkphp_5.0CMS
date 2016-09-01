<?php
namespace app\home\controller;

use app\model\Category;

class CategoryController extends ParenterController
{
	/**
	* 取出数据
	* @return template 模板
	* @author tangzhenjie 
	*/
	public function index()
	{
		$Category  = new Category;
        //取出文章
        $Categorys = $Category->getlist(input('get.name'));
        //向模板传值
		$this->assign('Categorys', $Categorys);
		//渲染模板
		return $this->fetch();
	}


	/**
	* 获得编辑页面
	* @return template 模板
	* @author tangzhenjie
	*/
	public function edit()
	{
		//返回编辑的页面
		$id = input('id/d');
		$Category = Category::get($id);
		$this->assign('Category', $Category);
		return $this->fetch();
	}

    /**
    * 新增和更新的保存操作
	* @author tangzhenjie
	*/
    public function update()
    {
		//获取v层传过来的数据
		$data = input('post.');
		$Category = new Category;

		//判断是否保存成功
		if ($Category->insert($data)) {
			return $this->success('保存成功', url('index'));
		}
		return $this->error('保存失败', url('index'));
    }

    /**
    * 删除数据
	* @author tangzhenjie
	*/
	public function delete()
	{
		$id = input('id/d');
		$Category = Category::get($id);
		if ($Category->delete()) {
			return $this->success('删除成功', url('index'));
		}
	}

	/**
	* @return template 模板
	* @author tangzhenjie
	*/
	public function add()
	{
		return $this->fetch();
	}
}