<?php
namespace app\home\controller;

use app\home\controller\ParenterController;

use app\model\Menu;

class MenuController extends ParenterController
{
	public function index()
	{
		/**
		*@tangzhenjie
		*/
		$name = input('get.name');
        $pageSize = 2;
        $Menu  = new Menu;
        $Menus = $Menu->where('name', 'like', '%' . $name . '%')->paginate($pageSize);
		$this->assign('Menus', $Menus);
		return $this->fetch();
	}

	public function add()
	{
		return $this->fetch();
	}
    
    public function insert()
    {
    	/**
    	*@tangzhenjie
    	*/
    	$data = input('post.');
    	$Menu = new Menu;
    	if(false === $Menu->validate(true)->save($data))
    	{
    		return $this->error('添加失败', url('add'));
    	}else{
    		return $this->success('添加成功', url('index'));
    	}
    }

	public function edit()
	{
		$id = input('id/d');
		$Menu = Menu::get($id);
		$this->assign('Menu', $Menu);
		return $this->fetch();
	}
     
    public function update()
    {
    	/**
    	*@tangzhenjie
    	*/
    	$data = array(
    		'name' => input('post.name'), 
			'module' => input('post.module'), 
			'controller' => input('post.controller'),
			'action' => input('post.action'),
			'weight' => input('post.weight'),
			'status' => input('post.status'),
			'is_permission' => input('post.is_permission')
        );
    	$Menu = Menu::get(input('post.id/d'));
    	if(false === $Menu->validate(true)->save($data))
    	{
    		return $this->error('更新失败', url('add'));
    	}else{
    		return $this->success('更新成功', url('index'));
    	}
   }

    public function delete()
    {
    	/**
    	*@tangzhenjie
    	*/
    	$id = input('id/d');
    	$Menu = Menu::get($id);
    	if($Menu->delete())
    	{
    		return $this->success('删除成功', url('index'));
    	}else{
    		return $this->error('删除失败', url('index'));
    	}
    }

}