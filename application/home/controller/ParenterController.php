<?php
namespace app\home\controller;

use think\Controller;

/**
*@tangzhenjie
*/
class ParenterController extends Controller
{
	public function __construct()
	{
		parent::__construct();
        //验证用户是否登录
        if(false)
        {
        	//如果没登录就跳转到对应的页面
        	return $this->redirect(url('Login/index'));
        }
	}
}