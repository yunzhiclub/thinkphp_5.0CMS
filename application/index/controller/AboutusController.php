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

        //取出首页的产品公司名称，页脚，log
        $Systemset = new Systemset;
        $Systemsets = $Systemset->getheader();
        $Systemsetss = $Systemset->getfooter();
        $Systemsetsss = $Systemset->getUrl();
        //取出slidershow的图片
        $SliderShows = $Article->getSliderShow();

        //将对象传入V层
        $this->assign('Article', $Article);
        $this->assign('Systemsets', $Systemsets);
        $this->assign('Systemsetss', $Systemsetss);
        $this->assign('Systemsetsss', $Systemsetsss);
        $this->assign('SliderShows', $SliderShows);

    	//返回界面
        return $this->fetch();
    }
}