<?php
namespace app\index\controller;

use think\Controller;
use app\model\Article;
use think\db\Query;

class SubpageController extends Controller
{
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
		//向V层传值
		$this->assign('News', $News);
		//返回V层
		return $this->fetch();

	}
    
}
