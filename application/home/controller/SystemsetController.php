<?php
namespace app\home\controller;
use app\model\Systemset;

use think\Request;

use app\home\controller\ParenterController;

class SystemsetController extends ParenterController
{
    /**
     * 获取当前公司的信息
     * @return
     * @author liuxi
     */
	public function index()
	{
        //接收搜索框传过来的name
        $name = input('get.name');

        //分页每页的大小
        $PageSize = 5;

        //取出数据库中的数据
        $Systemset = new Systemset;
        $Systemsets = $Systemset->where('name', 'like', '%' . $name . '%')->paginate($PageSize);

        //向V层传递数据
        $this->assign('Systemsets', $Systemsets);

        //显示uer列表
        return $this->fetch();
	}

    public function detail()
    {
        return $this->fetch();
    }

    public function add()
    {
        return $this->fetch();
    }
    
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
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        $savename = $info->getSaveName();
        $path = $info->getSaveName();
        $savepath = '\thinkphp_5.0CMS\public\uploads\\' . $path;
        $Systemset = new Systemset;

        $data = input('post.');
        $data['url'] = $savepath;

        if ($info&&($Systemset->validate(true)->save($data))) {
            $this->success('文件上传成功：' . $info->getRealPath(),url('index'));
        } else {
            // 上传失败获取错误信息
            $this->error($file->getError() . $Systemset->getError());
        }

    }

    public function edit()
    {
        $id = input('id/d');
        $Systemset = Systemset::get($id);
        $this->assign('Systemset', $Systemset);
        return $this->fetch();
    }
     
    public function update(Request $request)
    {
        // 获取表单上传文件
        $file = $request->file('file');

        // 上传文件验证
        $result = $this->validate(['file' => $file], ['file'=>'require|image'],['file.require' => '请选择上传文件', 'file.image' => '非法图像文件']);
        if(true !== $result){
            $this->error($result);
        }


        if(input('post.id') === '')
        {
            $Systemset = new Systemset;
            echo '错误';
        }else{
            $id = input('post.id');
            $Systemset = Systemset::get($id);

        }

        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        $savename = $info->getSaveName();
        $path = $info->getSaveName();
        $savepath = '\thinkphp_5.0CMS\public\uploads\\' . $path;

        $data = input('post.');
        $data['url'] = $savepath;

        if ($info&&($Systemset->validate()->save($data))) {
            $this->success('文件上传成功：' . $info->getRealPath(),url('index'));
        } else {
            // 上传失败获取错误信息
            $this->error($file->getError() . $Systemset->getError());
        }

    }

    public function delete()
    {
        $id = input('id/d');
        $Systemset = Systemset::get($id);
        if($Systemset->delete())
        {
            return $this->success('删除成功', url('index'));
        }
    }

    // 文件上传提交

    // // 文件上传提交
    // public function update(Request $request)
    // {
    //     // 获取表单上传文件
    //     $file = $request->file('file');
    //     // 上传文件验证
    //     $result = $this->validate(['file' => $file], ['file'=>'require|image'],['file.require' => '请选择上传文件', 'file.image' => '非法图像文件']);
    //     if(true !== $result){
    //         $this->error($result);
    //     }
    //     // 移动到框架应用根目录/public/uploads/ 目录下
    //     $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
    //     if ($info) {
    //         $this->success('文件上传成功：' . $info->getRealPath());
    //     } else {
    //         // 上传失败获取错误信息
    //         $this->error($file->getError());
    //     }

    // }



}