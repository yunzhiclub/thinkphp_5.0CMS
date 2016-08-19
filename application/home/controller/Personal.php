<?php
namespace app\home\controller;

use app\home\controller\Parenter;

/**
*@tangzhenjie
*/
class Personal extends Parenter
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