<?php
namespace app\index\controller;

use think\Controller;

use app\model\Article;

class AboutusController extends Controller
{
    public function index()
    {
    	//获取对象
    	$Article = new Article;
    	$Article = $Article->getAboutUs();
    	//将对象传入V层
    	$this->assign('Article', $Article);

    	//返回界面
        return $this->fetch();
    }
}