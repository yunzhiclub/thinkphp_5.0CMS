<?php
namespace app\index\controller;

use think\Controller;

use app\model\Article;

use app\model\Systemset;

class AboutusController extends ParentController
{
    public function __construct()
    {
        parent::__construct();
    }
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