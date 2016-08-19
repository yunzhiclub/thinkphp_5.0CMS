<?php
namespace app\index\controller;

use think\Controller;

/**
*@tangzhenjie
*/
class Login extends Controller
{
    //登录不成功时执行的方法
	public function index()
	{
		//返回登录页面
		return $this->fetch();
	}
    
    
	public function login()
	{
		echo '执行登录操作，并登录成功';
		return $this->redirect(url('Index/index'));
	}

	//注销
	public function logout()
	{
		echo '执行注销操作';
		return $this->redirect(url('Login/index'));
	}

}