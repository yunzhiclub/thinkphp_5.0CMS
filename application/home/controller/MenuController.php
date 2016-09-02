<?php
namespace app\home\controller;

use app\home\controller\ParenterController;

use app\model\Menu;

class MenuController extends ParenterController
{
    /**
    * 获取数据传入v层
    * @return template 模板
    * @author tangzhenjie
    */
	public function index()
	{
		$name     = input('get.name');
        $pageSize = 5;
        $Menu     = new Menu;
        $Menus    = $Menu->where('name', 'like', '%' . $name . '%')->paginate($pageSize);
		$this->assign('Menus', $Menus);
		return $this->fetch();
	}

   /**
    * 返回添加页面
    * @return template 模板
    * @author tangzhenjie
    */
	public function add()
	{
		return $this->fetch();
	}

   /**
    * 保存数据
    * @author tangzhenjie
    */
    public function insert()
    {
    	$data        = input('post.');
    	$Menu        = new Menu;

        //获取url数据
        $data['url'] = $data['module'] . '/' . $data['controller'] . '/' . $data['action'];

    	if (false === $Menu->validate(true)->save($data)) {
    		return $this->error('添加失败', url('add'));
    	} else {
    		return $this->success('添加成功', url('index'));
    	}
    }

    /**
    * 返回编辑页面
    * @return template 模板
    * @author tangzhenjie
    */
	public function edit()
	{
		$id   = input('id/d');
		$Menu = Menu::get($id);
		$this->assign('Menu', $Menu);
		return $this->fetch();
	}
     
   /**
    * 更新保存数据
    * @author tangzhenjie
    */
    public function update()
    {
    	$data = array(
    		'name'          => input('post.name'), 
			'module'        => input('post.module'), 
			'controller'    => input('post.controller'),
			'action'        => input('post.action'),
			'weight'        => input('post.weight'),
			'status'        => input('post.status'),
			'is_permission' => input('post.is_permission'),
        );
    	$Menu        = Menu::get(input('post.id/d'));
        $data['url'] = $data['module'] . '/' . $data['controller'] . '/' . $data['action'];
    	if (false === $Menu->validate(true)->save($data)) {
    		return $this->error('更新失败', url('add'));
    	} else {
    		return $this->success('更新成功', url('index'));
    	}
   }

   /**
    * 删除数据
    * @author tangzhenjie
    */
    public function delete()
    {
    	$id   = input('id/d');
    	$Menu = Menu::get($id);
    	if ($Menu->delete()) {
    		return $this->success('删除成功', url('index'));
    	} else {
    		return $this->error('删除失败', url('index'));
    	}
    }

}