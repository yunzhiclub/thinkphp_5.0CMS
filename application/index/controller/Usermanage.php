<?php
namespace app\index\controller;

use app\index\controller\Parenter;

class Usermanage extends Parenter
{
	public function index()
	{
		//显示uer列表
		return $this->fetch();
	}
}