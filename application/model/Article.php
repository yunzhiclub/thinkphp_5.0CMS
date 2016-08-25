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
     * 获取产品的对象
     * @author gaoliming
     */
    public function getProduct($id)
    {
        return Article::get($id);
    }


    /*
     * 获取新闻通知的对象（$news）
     * @author liuyanzhao 
     */
    public function getNews($id)
    {
        //对应的article表里的文章
        return Article::get($id);
    }
}