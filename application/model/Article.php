<?php
namespace app\model;

use think\Model;

class Article extends Model
{

    /**
     * 自动时间转换
     * @author  gaoliming
     */
     protected $dateFormat = 'Y-m-d';    // 日期格式

    // 类型转换
    protected $type = [
        'create_time' => 'datetime',
    ];
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
     * @author  gaoliming
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
        $PageSize = 8;
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
        return $Article->where($map)->order('create_time' , 'desc')->paginate($PageSize);
    }

    /**
     * 获取产品的对象
     * @author gaoliming
     */
    public function getProduct($id)
    {
        return Article::get($id);
    }

    /**
     * 获取首页点击量前五的新闻
     * @author gaoliming
     */
    public function getMoreClickNum()
    {
        $Article = new Article;

        return $Article->order('clicknum', 'desc')->limit(7)->select();
    }

    /**
     * 对点击量+1
     * @author  gaoliming>
     */
    public function plus($id)
    {
        $Article = Article::get($id);

        $Article->clicknum = $Article->clicknum + 1;

        //保存点击量
        $Article->save();
    }

    /**
     *  获取新闻通知的对象（$news）
     * @author liuyanzhao 
     */
    public function getNews($id)
    {
        //对应的article表里的文章
        return Article::get($id);
    }
    /**
     * 做下一步的新闻列表页
     * @author liuyanzhao
     */
    public function showNews($page)
    { 
        $PageSize = 10;
        
        $Categorys = Category::all();
        foreach ($Categorys as $value) 
        {
            
            if ($value->getData('name') === '新闻列表') {
                //取出对应的id
                $id = $value->id;
            }
        }

        $map = array('category_id' => $id, );

        $Article = new Article;
        return $Article->where($map)->order('create_time', 'desc')->paginate($PageSize);
    }

    /**
     * 取出置顶的文章
     * @author  gaoliming
     */
    public function getTopNews()
    {

        //制定分页大小
        $PageSize = 6;

        $Article = new Article;

        //查询
        
        return $Article->where('is_mark', '>=', 2)->order('is_mark', 'desc')->paginate($PageSize);
        
    }
    /**
     * @author liuyanzhao
     * 获取所有的文章
     */
    public function getAllArticle()
    {
        //设置分页信息
        $PageSize = 20;
        //用$map传入id
        $map = array('category_id' => 1,);//1 是新闻的文章

        $Article = new Article;
        return $Article->where($map)->order('create_time', 'desc')->paginate($PageSize);
    }
}