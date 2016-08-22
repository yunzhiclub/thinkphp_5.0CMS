<?php
namespace app\home\controller;

use think\Controller;
use app\model\User;

/**
*@tangzhenjie
*/
class ParenterController extends Controller
{
        /**
        *@tangzhenjie
        */
	public function __construct()
	{
		parent::__construct();
                //验证用户是否登录      
                if(!User::islogin())
                {
                	//如果没登录就跳转到对应的页面
                	return $this->error('请先登录', url('Login/index'));
                }
	}
}