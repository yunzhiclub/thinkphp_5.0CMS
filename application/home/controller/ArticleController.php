<?php
namespace app\home\controller;

use app\home\controller\ParenterController;

use app\model\Article;
use app\model\Category;
use app\model\ArticleContent;

use think\Request;

/**
* @author liuxi
*/
class ArticleController extends ParenterController
{
    public function index()
    {
        /**
        *@tangzhenjie
        */
        $title = input('get.title');
        $pageSize = 5;
        $Article  = new Article;
        $Articles = $Article->where('title', 'like', '%' . $title . '%')->paginate($pageSize);
        $this->assign('Articles', $Articles);
        return $this->fetch();
    }

    public function edit()
    {
        //返回编辑的页面
        $id = input('id/d');
        $Article = Article::get($id);
        $Category = new Category;
        $Categorys = $Category->select();
        $this->assign('Article', $Article);
        $this->assign('Categorys', $Categorys);
        return $this->fetch();
    }

    /**
     * @author liuxi gaoliming
     */
    public function update(Request $request)
    {
        // 获取表单上传文件
        $file = $request->file('file');
        // 上传文件验证
        $result = $this->validate(['file' => $file], ['file'=>'require|image'],['file.require' => '请选择上传文件', 'file.image' => '非法图像文件']);
        if(true !== $result){
            $this->error($result);
        }

        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'images');

        $path = $info->getSaveName();

        $savepath = '/thinkphp_5.0CMS/public/images/' . $path;

        $data = input('post.');

        if (input('post.is_top') === '1' && input('post.is_recomment') === '1') {
            
            $data['is_mark'] = 3;
        }
        if (input('post.is_top') === '0' && input('post.is_recomment') === '1') {
            
            $data['is_mark'] = 2;
        }
        if (input('post.is_top') === '1' && input('post.is_recomment') === '0') {
            
            $data['is_mark'] = 1;
        }
        if (input('post.is_top') === '0' && input('post.is_recomment') === '0') {
            
            $data['is_mark'] = 0;
        }

        $id = input('post.id');

        //删除存文章url表中的数据
        $map = array('article_id' => $id, );
        $ArticleContent = new ArticleContent;
        $ArticleContent = $ArticleContent->where($map)->find();
        if (false === $ArticleContent->delete()) {
            
            return $this->error('删除失败' . $ArticleContent->getError());
        }

        $Article = Article::get($id);

        $ArticleContent = new ArticleContent;

        $ArticleContent->url = $savepath;
        
        if(false === $Article->validate(true)->save($data))
        {
            return $this->error('编辑失败'.$Article->getError(), url('add'));
        }

        $datas = $Article->where('id', '=', $id)->find();

        $ArticleContent->article_id = $datas->id;

        if(false === $ArticleContent->save())
        {
            return $this->error('编辑失败'.$ArticleContent->getError(), url('add'));
        }

        return $this->success('编辑成功', url('index'));

    }

    public function delete()
    {
        /**
        *@tangzhenjie gaoliming
        */
        $id = input('id/d');
        $Article = Article::get($id);

        //删除存文章url表中的数据
        $map = array('article_id' => $id, );
        $ArticleContent = new ArticleContent;
        $ArticleContent = $ArticleContent->where($map)->find();
        if (false === $ArticleContent->delete()) {
            
            return $this->error('删除失败' . $ArticleContent->getError());
        }
        if(false === $Article->delete())
        {
            return $this->success('删除失败' . $Article->getError());
        }

        return $this->success('删除成功', url('index'));
    }

    public function add()
    {
        $Category = new Category;
        $Categorys = $Category->select();
        $this->assign('Categorys', $Categorys);
        return $this->fetch();
    }

    /**
    *@liuxi gaoliming tangzhenjie
    */
    public function insert(Request $request)
    { 
        // 获取表单上传文件
        $file = $request->file('file');
        // 上传文件验证
        $result = $this->validate(['file' => $file], ['file'=>'require|image'],['file.require' => '请选择上传文件', 'file.image' => '非法图像文件']);
        if(true !== $result){
            $this->error($result);
        }

        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'images');

        $path = $info->getSaveName();

        $savepath = '/thinkphp_5.0CMS/public/images/' . $path;
        $data = input('post.');


        if (input('post.is_top') === '1' && input('post.is_recomment') === '1') {
            
            $data['is_mark'] = 3;
        }
        if (input('post.is_top') === '0' && input('post.is_recomment') === '1') {
            
            $data['is_mark'] = 2;
        }
        if (input('post.is_top') === '1' && input('post.is_recomment') === '0') {
            
            $data['is_mark'] = 1;
        }
        if (input('post.is_top') === '0' && input('post.is_recomment') === '0') {
            
            $data['is_mark'] = 0;
        }

        $Article = new Article;
        $ArticleContent = new ArticleContent;

        $ArticleContent->url = $savepath;
        
        if(false === $id = $Article->validate(true)->save($data))
        {
            return $this->error('添加失败'.$Article->getError(), url('add'));
        }

        $datas = $Article->where('id', '=', $id)->find();

        $ArticleContent->article_id = $datas->id;

        if(false === $ArticleContent->save())
        {
            return $this->error('添加失败'.$ArticleContent->getError(), url('add'));
        }

        return $this->success('添加成功', url('index'));

    }

}