<?php
namespace app\home\controller;
use app\model\Systemset;

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
    
    public function insert()
    {
        $Systemset = new Systemset;
        $Systemset->name = input('post.name');
        $Systemset->is_show = input('post.is_show');
        $Systemset->footer_name = input('post.footer_name');
        $Systemset->text = input('post.text');
        if($Systemset->save())
        {
            return $this->success('添加成功', url('index'));
        }
    }

    public function edit()
    {
        $id = input('id/d');
        $Systemset = Systemset::get($id);
        $this->assign('Systemset', $Systemset);
        return $this->fetch();
    }
     
    public function update()
    {
        if(input('post.id') === '')
        {
            $Systemset = new Systemset;
            echo '错误';
        }else{
            $id = input('post.id');
            $Systemset = Systemset::get($id);
            var_dump($id);
            var_dump($Systemset);
        }
        die();
        $name = input('post.name');
        $Systemset->name = $name;
        $Systemset->is_show = input('post.is_show');
        $Systemset->footer_name = input('post.footer_name');
        $Systemset->is_display = input('post.is_display');
        $Systemset->text = input('post.text');
        if($Systemset->save())
        {
            return $this->success('更新成功', url('index'));
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

   

}