<?php
namespace app\index\controller;

use think\Controller;

use app\model\Systemset;

use app\model\Article;

class ParentController extends Controller
{
	/**
	 * 构造函数
	 * @param  
	 * @return object
	 * @author gaoliming
	 */
	public function __construct()
	{
		parent::__construct();
		//取出点击量的前七条新闻
		$New = new Article;
		$News = $New->getMoreClickNum();

        //取出置顶,推荐的文章
        $TopNews = $New->getTopNews();

        //取出首页的产品公司名称，页脚，log
        $Systemset = new Systemset;
        $header = $Systemset->getheader();
        $footer = $Systemset->getfooter();
        $url = $Systemset->getUrl();

		//向V层传值
		$this->assign('News', $News);
        $this->assign('TopNews', $TopNews);
        $this->assign('header', $header);
        $this->assign('footer', $footer);
        $this->assign('url', $url);
	}
}