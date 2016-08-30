<?php
namespace app\index\controller;

use think\Controller;

use app\model\Article;

use app\model\Systemset;

class AboutusController extends Controller
{
    public function index()
    {
    	//获取对象
    	$Article = new Article;
    	$Article = $Article->getAboutUs();

        //取出首页的logo与页脚
        $Systemset = new Systemset;
        $Systemset = $Systemset->where('is_show', '=', 1)->where('is_display', '=', 1)->find();

    	//将对象传入V层
    	$this->assign('Article', $Article);
        $this->assign('Systemset', $Systemset);

    	//返回界面
        return $this->fetch();
    }
}