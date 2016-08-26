<?php
namespace app\index\controller;

use think\Controller;

use app\model\Article;

class NewsinformController extends Controller
{
	public function index()
	{
		//返回首页
		return $this->fetch();
	}

	public function detail()
	{
		return $this->fetch();
	}
}