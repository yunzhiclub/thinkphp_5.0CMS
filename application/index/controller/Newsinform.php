<?php
namespace app\index\controller;

use think\Controller;

class Newsinform extends Controller
{
	public function index()
	{
		return $this->fetch();
	}

	public function detail()
	{
		return $this->fetch();
	}
}