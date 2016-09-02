<?php
namespace app\home\controller;

use think\Controller;
use app\model\User;

/**
* @author tangzhenjie
*/
class ParenterController extends Controller
{
        /**
        * 判断是否登录
        * @author tangzhenjie
        */
	public function __construct()
	{
            parent::__construct();
            if (!User::islogin()) {
                return $this->error('请先登录', url('Login/index'));
            }
        }
}