<?php
namespace app\index\controller;

use think\Controller;
use app\model\Article;
use think\db\Query;
use app\model\Systemset;

class NewsinformController extends Controller
{
	/**
	 *@author liuyanzhao
	 */
	public function index()
	{
		//取出点击量的前7条新闻
		$New = new Article;
		$News = $New->getMoreClickNum();

        //取出置顶,推荐的文章
        $TopNews = $New->getTopNews();

        //取出首页的产品公司名称，页脚，log
        $Systemset = new Systemset;
        $Systemsets = $Systemset->getheader();
        $Systemsetss = $Systemset->getfooter();
        $Systemsetsss = $Systemset->getUrl();
        //取出slidershow的图片
        $SliderShows = $New->getSliderShow();

        //向V层传值
        $this->assign('News', $News);
        $this->assign('TopNews', $TopNews);
        $this->assign('Systemsets', $Systemsets);
        $this->assign('Systemsetss', $Systemsetss);
        $this->assign('Systemsetsss', $Systemsetsss);
        $this->assign('SliderShows', $SliderShows);

 		//实例化Article
        $Article  =	new Article;
        
        $Articles = $Article->showNews(input('get.page'));
        $this->assign('Articles', $Articles);
        return $this->fetch();
	}

	public function detail()
	{
		//利用id确定文章
		$id   = input('id');
		//取出首页的logal与页脚
        $Systemset = new Systemset;
        $Systemset = $Systemset->where('is_show', '=', 1)->where('is_display', '=', 1)->find();
		//实例化$News
		$News = new Article;
		//把对应的文章给$News
		$News = $News->getNews($id);
		//向V层传值
		$this->assign('News', $News);
		$this->assign('Systemset', $Systemset);
		//返回V层
		return $this->fetch();

	}
}