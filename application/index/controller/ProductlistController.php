<?php
namespace app\index\controller;

use think\Controller;

use app\model\Article;

class ProductlistController extends Controller
{
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
	 * @author gaoliming
	 */
	public function detail()
	{
		//接收穿过来的id值
		$id = input('id');
		//取出对象
		$Product = new Article;
		$Product = $Product->getProduct($id);

		//向V层传值
		$this->assign('Product', $Product);

		//返回用户
		return $this->fetch();
	}
}