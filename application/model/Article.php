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
    protected $type       = [
        'create_time' => 'datetime',
    ];
  

    public function getIstopAttr($value)
    {
        $status = array('0'=>'否','1'=>'是');
        $istop  = $status[$value];
        if (isset($istop)) {
            return $istop;
        } else {
            return $status[0];
        }
    }

    public function getIsrecommentAttr($value)
    {
        $status      = array('0'=>'否','1'=>'是');
        $isrecomment = $status[$value];
        if (isset($isrecomment)) {
            return $isrecomment;
        } else {
            return $status[0];
        }
    }

    public function getIsslidershowAttr($value)
    {
        $status      = array('0'=>'否','1'=>'是');
        $isrecomment = $status[$value];
        if (isset($isrecomment)) {
            return $isrecomment;
        } else {
            return $status[0];
        }
    }
    public function category()
    {
        return $this->belongsTo('category');
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
        $PageSize  = 8;
        //找出产品列表对应的ID
        $Categorys = Category::all();
        foreach ($Categorys as $value) {
            if ($value->getData('name') === '产品列表'){ 
                $id = $value->id;
            }
        }

        //设定索引
        $map = array('category_id' => $id, );

        //返回对象
        $Article = new Article;
        return $Article->where($map)->order('create_time', 'desc')->paginate($PageSize);
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
        $Article           = Article::get($id);

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
        $PageSize  = 10;
        
        $Categorys = Category::all();
        foreach ($Categorys as $value) {
            if ($value->getData('name') === '新闻列表') 
            {
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

        $Article  = new Article;

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
        $map      = array('category_id' => 1,);//1 是新闻的文章

        $Article  = new Article;
        return $Article->where($map)->order('create_time', 'desc')->paginate($PageSize);
    }

    /**
     * 获取文章图片所保存的地址
     * @author  gaoliming 
     */
    public function getArticleContent($id)
    {
        //索引
        $map            = array('article_id' => $id);

        $ArticleContent = new ArticleContent;

        return $ArticleContent->where($map)->find();
    }

    /**
     * 获取SliderShow的图片
     * @author  gaoliming 
     */
    public function getSliderShow()
    {
        //索引
        $map     = array('is_slidershow' => 1);

        $Article = new Article;
        //返回
        return $Article->where($map)->order('create_time', 'desc')->select();
    }

    /**
    * 获取数据
    * @param string  $title 搜索的题目
    * @return object 
    * @author tangzhenjie
    */
    public function getlist($title)
    {   
        //分页条数
        $pageSize = 5;
        return $this->where('title', 'like', '%' . $title . '%')->paginate($pageSize);
    }

   /**
    * 删除数据
    * @param  int   $id 传入的id
    * @return boolean
    * @author tangzhenjie
    */
   public function move($id)
   {
        $ArticleContent  = new ArticleContent;
        //找出文章对应的附表对应的数据
        $ArticleContents = $ArticleContent->where('article_id', $id)->find();
        //删除附表的数据
        if (false === $ArticleContents->delete()) {
            return false;
        }
        //删除文章表中的数据
        $Article = Article::get($id);
        if (false === $Article->delete()) {
            return false;
        }
        return true;
   }

   /**
   * 新增和更新数据的保存操作
   * @param string   $savepath 用户的图片的的位置
   * @param array    $data 从v层获取的数据
   * @return boolean
   * @author liuxi gaoliming
   */
   public function insert($savepath, $data)
   {
        //根据is_top AND is_recomment决定$data['is_mark']的值
        if ($data['is_top'] === '1' && $data['is_recomment'] === '1') {
            
            $data['is_mark'] = 3;
        }
        if ($data['is_top'] === '0' && $data['is_recomment'] === '1') {
            $data['is_mark'] = 2;
        }
        if ($data['is_top'] === '1' && $data['is_recomment'] === '0') {
            $data['is_mark'] = 1;
        }
        if ($data['is_top'] === '0' && $data['is_recomment'] === '0') {
            $data['is_mark'] = 0;
        }
        //判断是新增还是更新
        if (isset($data['id'])) {
            //执行更新的操作

            //删除存放文章的数据
            $map            = array('article_id' => $data['id']);
            $ArticleContent = new ArticleContent;
            $ArticleContent = $ArticleContent->where($map)->find();
            if ($ArticleContent ==! null) {
               if (false === $ArticleContent->delete()) {
                    return false;
               }  
            }
            

            //向存放文章的数据表存入新的数据
            $Articlecontent             = new ArticleContent;
            $Articlecontent->url        = $savepath;
            $Articlecontent->article_id = $data['id'];
            if (false === $Articlecontent->save()) {
                return false;
            }

            //向文章的数据表里面存入更新数据
            $Article = self::get($data['id']);
            if (false === $Article->validate(true)->save($data)) {
                return false;
            }
            return true;
        }

        
        //执行新增操作
        $Article = new self;
        //向文章表中存入数据并获取存入的id
        if (false === $id = $Article->validate(true)->save($data)) {
            return false;
        }
        //向文章详情表中存入数据
        $ArticleContent             = new ArticleContent;
        $ArticleContent->url        = $savepath;
        $ArticleContent->article_id = $id;
        if (false === $ArticleContent->save()) {
            return false;
        }
        return true;
   }
}