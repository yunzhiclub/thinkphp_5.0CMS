<?php
namespace app\index\controller;

use think\Controller;

use app\model\Article;

class NewsinformController extends Controller
{
	public function index()
	{

        $News =	new Article;
        $News = $News->showNews();
        
        $this->assign('News', $News);
        return $this->fetch();
	}

	public function detail()
	{
		return $this->fetch();
	}
}