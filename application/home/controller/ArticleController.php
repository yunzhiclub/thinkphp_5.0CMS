<?php
namespace app\home\controller;

use app\home\controller\ParenterController;

use app\model\Article;
use app\model\Category;

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
        $title = input('post.title');
        $page = input('page/d') < 1 ?1 : input('page/d');
        $pageSize = 2;
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
    
    public function update()
    {
        $data = input('post.');
        $id = input('post.id');
        $Article = Article::get($id);
        if(false === $Article->validate(true)->save($data))
        {
            return $this->error('更新失败', url('index'));
        }else{
            return $this->success('更新成功', url('index'));
        }
    }

    public function delete()
    {
        /**
        *@tangzhenjie
        */
        $id = input('id/d');
        $Article = Article::get($id);
        if($Article->delete())
        {
            return $this->success('删除成功', url('index'));
        }
    }

    public function add()
    {
        $Category = new Category;
        $Categorys = $Category->select();
        $this->assign('Categorys', $Categorys);
        return $this->fetch();
    }

    public function insert()
    {
        $data = input('post.');
        $Article = new Article;
        if(false === $Article->validate(true)->save($data))
        {
            return $this->error('添加失败'.$Article->getError(), url('add'));
        }else{
            return $this->success('添加成功'.$Article->getError(), url('index'));
        }
    }

}