<?php
namespace app\index\controller;
use think\Controller;
use app\model\Usermanage;
use think\View;

class LoginController extends Controller
{
	public function index()
	{
		return $this->fetch();
	}

	public function login()
	{
		/**
		*@tangzhenjie
		*/
		if(Usermanage::login(input('post.username') , input('post.password')))
        {	
        	return $this->success('登录成功' , url('Index/index'));
        }else{
        	return $this->error('登录失败' , url('index'));
        }
	}

	public function logout()
	{
		session('style', null);
		session('usermanageId', null);
		return $this->success('退出成功', url('Index/index'));
	}
}