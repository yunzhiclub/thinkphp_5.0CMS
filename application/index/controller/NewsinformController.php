<?php
namespace app\index\controller;

use think\Controller;
use app\model\Article;
use think\db\Query;
use app\model\Systemset;
	
class NewsinformController extends ParentController
{
	/**
	 * 构造函数
	 * @param  
	 * @return 
	 * @author liuyanzhao
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 实现显示新闻页面
	 * @param  
	 * @return template
	 * @author liuyanzhao
	 */
	public function index()
	{
		$New = new Article;

		//取出slidershow的图片
		$SliderShows = $New->getSliderShow();

		//向V层传值
		$this->assign('SliderShows', $SliderShows);

		//实例化Article
		$Article  =	new Article;

		//把$Articles返回V层
		$Articles = $Article->showNews(input('get.page'));
		$this->assign('Articles', $Articles);
		return $this->fetch();
	}

	/**
	 * 显示新闻详情页
	 * @param  $id
	 * @return object
	 * @author liuyanzhao
	 */
	public function detail()
	{
		//利用id确定文章
		$id   = input('id');

		//取出首页的logo与页脚
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
