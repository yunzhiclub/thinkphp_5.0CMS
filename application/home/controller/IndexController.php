<?php
namespace app\home\controller;

use app\home\controller\ParenterController;

class IndexController extends ParenterController
{
	/**
	* 后台首页
	* @return template 模板
	* @author tangzhenjie
	*/
    public function index()
    {
        return $this->fetch();
    }

}
