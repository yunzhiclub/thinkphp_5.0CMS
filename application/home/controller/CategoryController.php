<?php
namespace app\home\controller;

/**
* @author gaoliming
*/
class CategoryController extends ParenterController
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
    
    public function update()
    {
    	return $this->redirect(url('index'));
    }
	public function delete()
	{
		return $this->redirect(url('index'));
	}
}