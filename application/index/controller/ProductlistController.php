<?php
namespace app\index\controller;

use think\Controller;
use app\model\Article;
use app\model\Systemset;

class ProductlistController extends ParentController
{
    /**
     * 构造函数
     * @author gaoliming
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 实现显示V层模板
     * @param  
     * @return template
     * @author gaoliming
     */
    public function index()
    {
        //获取产品列表的所有对象
        $Products = new Article;
        $Products = $Products->getAllProdects();

        //向V层传递
        $this->assign('Products', $Products);

        //返回用户
        return $this->fetch();
    }

    /**
     * 产品详情页
     * @return template 
     * @author gaoliming
     */
    public function detail()
    {
        //接收穿过来的id值
        $id = input('id');

        //取出对象
        $Product = new Article;

        //取出首页的logal与页脚
        $Systemset = new Systemset;
        $Systemset = $Systemset->where('is_show', '=', 1)->where('is_display', '=', 1)->find();

        //对象点击量+1
        $Product->plus($id);

        //取出对象
        $Product = $Product->getProduct($id);

        //向V层传值
        $this->assign('News', $Product);
        $this->assign('Systemset', $Systemset);

        //返回V层
        return $this->fetch();
    }

    /**实现显示更多的功能
     * @return template
     * @author liuyanzhao 
     */
    public function more()
    {    
        $Products = new Article;
        $Products = $Products->getAllProdects();

        //取出首页的logo与页脚
        $Systemset = new Systemset;
        $Systemset = $Systemset->where('is_show', '=', 1)->where('is_display', '=', 1)->find();

        //向V层传递
        $this->assign('Products', $Products);
        $this->assign('Systemset', $Systemset);

        //返回V层
        return $this->fetch();
    }
}