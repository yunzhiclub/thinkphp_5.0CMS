<?php
namespace app\home\controller;

use app\home\controller\ParenterController;
use app\model\User;

/**
*@tangzhenjie
*/
class PersonalController extends ParenterController
{
	public function index()
	{
		/**
		*@tangzhenjie
		*/
		$userId = session('userId');
		$User = User::get($userId);
		$this->assign('User', $User);
		return $this->fetch();
	}

	public function edit()
	{
		/**
		*@tangzhenjie
		*/
		$userId = session('userId');
		$User = User::get($userId);
		if($User->password != input('post.password'))
		{
			return $this->error('原密码错误', url('index'));
		}
		if(input('post.newpassword') !== input('post.repassword'))
		{
			return $this->error('两次输入的密码不同', url('index'));
		}
		$User->name = input('post.name');
		$User->username = input('post.username');
		$User->password = input('post.newpassword');
		

		if($User->save() === false)
		{
			return $this->error('更新失败', url('index'));
		}else{
			return $this->success('更新成功', url('index'));
		}
		//return $this->redirect(url('Index/index'));
	}
}