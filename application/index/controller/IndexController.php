<?php
namespace app\index\controller;
use think\Controller;

use app\index\controller\ParentController;

use app\model\Article;
use app\model\Systemset;

class IndexController extends ParentController
{
    public function __construct()
    {
        //先执行父类的构造函数
        parent::__construct();

    }
    public function index()
    {
		$New = new Article;

        //取出slidershow的图片
        $SliderShows = $New->getSliderShow();

		//向V层传值
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
    	$this->assign('News', $Article);

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
