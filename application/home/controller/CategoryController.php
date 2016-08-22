<?php
namespace app\home\controller;

use app\model\Category;
/**
* @author gaoliming
*/
class CategoryController extends ParenterController
{
	public function index()
	{
		/**
		*@author tangzhenjie
		*/

		$name = input('get.name');
        $page = input('page/d') < 1 ?1 : input('page/d');
        $pageSize = 2;
        $Category  = new Category;
        $Categorys = $Category->where('name', 'like', '%' . $name . '%')->paginate($pageSize);
		$this->assign('Categorys', $Categorys);
		return $this->fetch();
	}
	public function edit()
	{
		/**
		*@author tangzhenjie
		*/
		//返回编辑的页面
		$id = input('id/d');
		$Category = Category::get($id);
		$this->assign('Category', $Category);
		return $this->fetch();
	}
    
    public function update()
    {
    	/**
		*@author tangzhenjie
		*/
		if(input('post.id') === '')
		{
			$Category = new Category;
			echo 'tanzghej';
		}else{
			$id = input('post.name');
		    $Category = Category::get($id);
		    var_dump($id);
		    var_dump($Category);
		}
		die();
		$name = input('post.name');
		$Category->name = $name;
		if($Category->save())
		{
			return $this->success('更新成功', url('index'));
		}
    }
	public function delete()
	{
		/**
		*@author tangzhenjie
		*/
		$id = input('id/d');
		$Category = Category::get($id);
		if($Category->delete())
		{
			return $this->success('删除成功', url('index'));
		}
	}

	public function add()
	{
		/**
		*@author tangzhenjie
		*/
		return $this->fetch();
	}

	public function insert()
	{
		/**
		*@author tangzhenjie
		*/
		$Category = new Category;
		$Category->name = input('post.name');
		if($Category->save())
		{
			return $this->success('添加成功', url('index'));
		}	
	}
}