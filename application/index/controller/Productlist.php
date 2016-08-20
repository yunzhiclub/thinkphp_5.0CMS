<?php
namespace app\index\controller;

use think\Controller;

class Productlist extends Controller
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