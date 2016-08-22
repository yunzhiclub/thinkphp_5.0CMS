<?php
namespace app\home\controller;

use app\home\controller\ParenterController;

/**
*@tangzhenjie
*/
class PersonalController extends ParenterController
{
	public function index()
	{
		return $this->fetch();
	}

	public function edit()
	{
		//保存数据
		
		return $this->redirect(url('Index/index'));
	}
}