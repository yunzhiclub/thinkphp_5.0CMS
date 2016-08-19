<?php
namespace app\home\controller;

/**
* @author gaoliming
*/
class Category extends Parenter
{
	public function index()
	{
		//返回首页
		return $this->fetch();
	}
	public function edit()
	{
		//返回编辑的页面
		return $this->fetch();
	}
}