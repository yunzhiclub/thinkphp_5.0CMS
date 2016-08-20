<?php
namespace app\home\controller;

use app\model\Usermanage;

class UsermanageController extends ParenterController
{
	/**
	 * @author gaoliming
	 */
	public function index()
	{
		//接收搜索框传过来的name
		$name = input('get.name');

		//分页每页的大小
		$PageSize = 5;

		//取出数据库中的数据
		$User = new Usermanage;
		$Users = $User->where('name', 'like', '%' . $name . '%')->paginate($PageSize);

		//向V层传递数据
		$this->assign('Users', $Users);

		//显示uer列表
		return $this->fetch();
	}

	/**
	 * @author gaoliming
	 */
	public function add()
	{
		//取出一个空对象
		$User = new Usermanage;

		//向V层传递数据
		$this->assign('User', $User);

		//添加用户
		return $this->fetch();
	}

	public function delete()
	{
		//删除用户
		return $this->redirect(url('index'));
	}

	public function edit()
	{
		//编辑用户
		return $this->fetch();
	}

	public function save()
	{
		//保存进入数据库
	}

	public function state()
	{
		//改变用户状态
		return $this->redirect(url('index'));
	}

	public function detail()
	{
		return $this->fetch();
	}
}