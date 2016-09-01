<?php
namespace app\home\controller;

use think\Controller;
use app\model\User;

/**
*@tangzhenjie
*/
class LoginController extends Controller
{
    //登录不成功时执行的方法
	public function index()
	{
		//返回登录页面
		return $this->fetch();
	}
    
    /**
    * 登录操作
	* @author tangzhenjie
	*/
	public function login()
	{
		if(User::login(input('post.username') , input('post.password')))
        {
        	return $this->success('登录成功' , url('Index/index'));
        }else{
        	return $this->error('登录失败' , url('index'));
        }
	}

	/**
    * 注销
	* @author tangzhenjie
	*/
	public function logout()
	{
		session('userId', null);
		return $this->success('注销成功' , url('index'));
	}

}