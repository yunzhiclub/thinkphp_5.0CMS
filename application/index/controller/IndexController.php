<?php
namespace app\index\controller;
use think\Controller;

use app\model\Article;

class IndexController extends Controller
{
    public function index()
    {
        //取出点击量的前五条新闻
		$New = new Article;
		$News = $New->getMoreClickNum();

		//向V层传值
		$this->assign('News', $News);


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
