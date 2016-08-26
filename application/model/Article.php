<?php
namespace app\model;

use think\Model;

class Article extends Model
{
	public function getIstopAttr($value)
    {
        $status = array('0'=>'否','1'=>'是');
        $istop = $status[$value];
        if (isset($istop))
        {
            return $istop;
        } else {
            return $status[0];
        }
    }
    public function getIsrecommentAttr($value)
    {
        $status = array('0'=>'否','1'=>'是');
        $isrecomment = $status[$value];
        if (isset($isrecomment))
        {
            return $isrecomment;
        } else {
            return $status[0];
        }
    }
	public function category()
	{
		return $this->belongsTo("category");
	}

    /**
     * 返回关于我们的对象
     * @author  galiming
     */
    public function getAboutUs()
    {
        //找出关于我们对应的id
        $Categorys = Category::all();
        foreach ($Categorys as $value) {
            
            if ($value->getData('name') === '关于我们') {
                
                $id = $value->id;
            }
        }

        //设定索引
        $map = array('category_id' => $id,);

        return Article::get($map);
    }

    /**
     * 返回所有的产品
     * @author gaoliming
     */
    public function getAllProdects()
    {
        //设定分页的大小
        $PageSize = 1;
        //找出产品列表对应的ID
        $Categorys = Category::all();
        foreach ($Categorys as $value) {
            
            if ($value->getData('name') === '产品列表') {
                
                $id = $value->id;
            }
        }

        //设定索引
        $map = array('category_id' => $id, );

        //返回对象
        $Article = new Article;
        return $Article->where($map)->paginate($PageSize);
    }

    /**
     * 获取产品的对象
     * @author gaoliming
     */
    public function getProduct($id)
    {
        return Article::get($id);
    }
}