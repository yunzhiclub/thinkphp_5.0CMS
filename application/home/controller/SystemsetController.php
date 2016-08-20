<?php
namespace app\home\controller;

use app\home\controller\Parenter;

class SystemsetController extends ParenterController
{
	public function index()
	{
		return $this->fetch();
	}

	public function save()
	{
		return $this->redirect(url('index'));
	}
}