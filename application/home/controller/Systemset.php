<?php
namespace app\home\controller;

use app\home\controller\Parenter;

class Systemset extends Parenter
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