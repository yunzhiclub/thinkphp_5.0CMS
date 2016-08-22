<?php
namespace app\home\controller;

use app\model\User;

class UserController extends ParenterController
{
    /**
     * @author liuxi
     */
    public function index()
    {
        //接收搜索框传过来的name
        $name = input('get.name');

        //分页每页的大小
        $PageSize = 5;

        //取出数据库中的数据
        $User = new User;
        $Users = $User->where('name', 'like', '%' . $name . '%')->paginate($PageSize);

        //向V层传递数据
        $this->assign('Users', $Users);

        //显示uer列表
        return $this->fetch();
    }

    public function add()
    {
        return $this->fetch();
    }
    
    public function insert()
    {
        return $this->redirect("index");
    }

    public function edit()
    {
        return $this->fetch();
    }
     
    public function update()
    {
        return $this->redirect('index');
    }

    public function delete()
    {
       return $this->redirect('index');
    }

}