<?php
namespace app\index\controller;
use think\Controller;

use app\index\controller\ParenterController;
use app\model\Article;
use app\model\Systemset;

class IndexController extends Controller
{
    public function index()
    {
        //取出点击量的前五条新闻
		$New = new Article;
		$News = $New->getMoreClickNum();

        //取出置顶,推荐的文章
        $TopNews = $New->getTopNews();

        //取出首页的logal与页脚
        $Systemset = new Systemset;
        $Systemset = $Systemset->where('is_show', '=', 1)->where('is_display', '=', 1)->find();

        //取出slidershow的图片
        $SliderShows = $New->getSliderShow();

		//向V层传值
		$this->assign('News', $News);
        $this->assign('TopNews', $TopNews);
        $this->assign('Systemset', $Systemset);
        $this->assign('SliderShows', $SliderShows);


		//返回首页
		return $this->fetch();
    }

    /**
     * 显示详情页
     * @author  gaoliming
     */
    public function detail()
    {
    	//获取ID
    	$id = input('id');

    	//判断类型
    	$Article = Article::get($id);

    	//传值
    	$this->assign('New', $Article);

    	switch ($Article->category_id) {
    		case '2':
    			$string = 'productlist';
    			break;
    		
    		case '1':
    			$string = 'newsinform';
    	}

    	//对象点击量+1
		$Article->plus($id);

    	//返回首页
    	return $this->fetch($string . '\detail');
    }
}
