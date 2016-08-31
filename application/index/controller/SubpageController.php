<?php
namespace app\index\controller;

use think\Controller;
use app\model\Article;
use think\db\Query;
use app\model\Systemset;

class SubpageController extends ParentController
{

	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * @author liuyanzhao
	 * 
	 */
	public function index()
	{
        $Article =	new Article;
        $Articles = $Article->getAllArticle(input('get.page'));
        $this->assign('Articles', $Articles);
        return $this->fetch();
	}

	public function detail()
	{
		//利用id确定文章
		$id   = input('id');
		//实例化$News
		$News = new Article;
		//把对应的文章给$News
		$News = $News->getNews($id);
        //取出首页的logal与页脚
        $Systemset = new Systemset;
        $Systemset = $Systemset->where('is_show', '=', 1)->where('is_display', '=', 1)->find();
        $this->assign('Systemset', $Systemset);
		//向V层传值
		$this->assign('News', $News);
		//返回V层
		return $this->fetch();

	}
    
}
