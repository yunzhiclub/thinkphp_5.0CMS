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
    /**
    * 取出数据传给模板
    * @return tempate
    * @author tangzhenjie
    */
    public function index()
    {
        $Article  = new Article;
        //取出文章
        $Articles = $Article->getlist(input('get.title'));
        //向模板传值
        $this->assign('Articles', $Articles);
        //渲染模板
        return $this->fetch();
    }

    /**
    * 传数据返回编辑模板
    * @return template
    * @author tangzhenjie
    */
    public function edit()
    {
        //返回编辑的页面
        $id        = input('id/d');
        $Article   = Article::get($id);
        $Category  = new Category;
        $Categorys = $Category->select();
        $this->assign('Article', $Article);
        $this->assign('Categorys', $Categorys);
        return $this->fetch();
    }

    /**
     * 更新和新增数据的保存操作
     * @param  object $request 请求对象
     * @author liuxi gaoliming
     */
    public function update(Request $request)
    {
        //获取表单上传文件
        $file = $request->file('file');
        if ($file === null) {
            return $this->error('请输入图像', url('index'));
        }

        //验证图片
        $result = $this->validate(['file' => $file], ['file'=>'require|image'], ['file.require' => '请选择上传文件', 'file.image' => '非法图像文件']);
        if (true !== $result) {
            return $this->error($result);
        }

        // 移动到框架应用根目录/public/uploads/ 目录下
        $info     = $file->move(ROOT_PATH . 'public' . DS . 'images');

        //获取存储路径
        $path     = $info->getSaveName();
        $savepath = '/thinkphp_5.0CMS/public/images/' . $path;

        $Article  = new Article;
        if ($Article->insert($savepath, input('post.'))) {
            return $this->success('保存成功', url('index'));
        }

        return $this->error('保存失败', url('index'));
    }
    /**
     * 删除数据
     * @author tangzhenjie gaoliming
     */
    public function delete()
    {
        $Article = new Article;
        if ($Article->move(input('id/d'))) {
            return $this->success('删除成功', url('index'));
        } else {
            return $this->error('删除失败' . $Article->getError());
        }
    }

    /**
    * 传入数据返回模板
    * @return template
    * @author tangzhenjie 
    */
    public function add()
    {
        $Category  = new Category;
        $Categorys = $Category->select();

        //向模板传入类别
        $this->assign('Categorys', $Categorys);
        return $this->fetch();
    }  
}