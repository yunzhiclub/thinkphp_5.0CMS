<?php
namespace app\home\controller;

use app\home\controller\Parenter;

class Usermanage extends Parenter
{
	public function index()
	{
		//显示uer列表
		return $this->fetch();
	}

	public function add()
	{
		//添加用户
		return $this->fetch();
	}

	public function insert()
	{
		//保存用户
		return $this->redirect(url('index'));
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

	public function update()
	{
		//存入编辑用户
		return $this->redirect(url('index'));
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