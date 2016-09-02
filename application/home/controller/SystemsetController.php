<?php
namespace app\home\controller;
use app\model\Systemset;

use think\Request;

use app\home\controller\ParenterController;

class SystemsetController extends ParenterController
{
    /**
     * 获取当前公司的信息
     * @author liuxi
     */
	public function index()
	{
        //获取数据库数据
        $Systemset = new Systemset;
        $Systemset = $Systemset->find();

        //返回添加或编辑的界面
        if (empty($Systemset)) {
            return $this->add();
        } else {
            return $this->edit();
        }
	}

    /**
     * 添加数据的界面
     * @author liuxi
     */
    public function add()
    {
        return $this->fetch('add');
    }
    
    /**
     * 添加数据对应的保存功能
     * @param  object $request 请求对象
     * @author liuxi
     */
    public function insert(Request $request)
    {
        // 获取表单上传文件
        $file = $request->file('file');
        // 上传文件验证
        if (empty($file)) {
            $this->error('请选择上传文件');
        }

        // 移动到框架应用根目录/public/uploads/ 目录下
        $info        = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        $savename    = $info->getSaveName();
        $path        = $info->getSaveName();
        $savepath    = '/thinkphp_5.0CMS/public/uploads/' . $path;
        $Systemset   = new Systemset;

        $data        = input('post.');
        $data['url'] = $savepath;

        if ($info && ($Systemset->validate(true)->save($data))) {
            $this->success('文件上传成功：' . $info->getRealPath(),url('index'));
        } else {
            // 上传失败获取错误信息
            $this->error($file->getError() . $Systemset->getError());
        }

    }

    /**
     * 编辑界面
     * @author liuxi
     */
    public function edit()
    {
        $id        = input('id/d');
        $Systemset = Systemset::get($id);
        $this->assign('Systemset', $Systemset);
        return $this->fetch('edit');
    }
    
    /**
     * 编辑的保存功能
     * @param  object $request 请求对象
     * @author liuxi
     */
    public function update(Request $request)
    {
        //获取post的数组
        $data      = input('post.');

        //获取id
        $id        = input('id');

        $Systemset = Systemset::get($id);

        // 获取表单上传文件
        $file = $request->file('file');
        if (null === $file) {
            $data['url'] = $Systemset->url;
            if (false === $Systemset->validate()->save($data)) {

                return $this->error('更新失败' . $Systemset->getError());
            }
            return $this->success('更新成功', url('index'));
        } else {

            if(input('post.id') === '') {
                $Systemset = new Systemset;
                echo '错误';
            } else {
                $id        = input('post.id');
                $Systemset = Systemset::get($id);
            }

            if (false === $Systemset->delete()) {
                return $this->error('删除失败' . $Systemset->getError());
            }
            
             $Systemsets = new Systemset;
             $er = $Systemsets->data($data)->save();

            // 移动到框架应用根目录/public/uploads/ 目录下
            $info     = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

            $path     = $info->getSaveName();
            $savepath = '/thinkphp_5.0CMS/public/uploads/' . $path;

            //存储路径
            $data['url'] = $savepath;
            if ($info && ($Systemsets->validate()->save($data))) {
                $this->success('文件上传成功：' . $info->getRealPath(),url('index'));
            } else {
                // 上传失败获取错误信息
                $this->error($file->getError() . $Systemsets->getError());
            }
        }

    }

}