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

    /**
     * @author gaoliming
     */
    public function add()
    {
        //返回添加首页
        return $this->fetch();
    }

    /**
     * 编辑数据
     * @author gaoliming
     */
    public function edit()
    {
        //获取ID
        $id = input('id');

        //取出对象
        $User = User::get($id);

        //传递对象
        $this->assign('User', $User);

        //返回给用户
        return $this->fetch();
    }
    
    /**
     * 保存数据
     * @author gaoliming
     */
    public function save()
    {
        //判断两次密码是否一样
        if (input('post.password') !== input('post.newpassword')) {
            
            return $this->error('两次密码不一样');
        }

        //获取传过来的ID
        $id = input('post.id');

        //判断是新增还是更新
        if (null === $id) {
            
            //新增
            $User = new User;
        } else {

            //更新
            $User = User::get($id);
        }

        //获取传过来的数据
        $data = array('username' => input('post.username'),
                'name' => input('post.name'),
                'password' => input('post.password'),
                'email' => input('post.email'),
         );

        //保存并验证
        if (false === $User->validate()->save($data)) {
            
            return $this->error('保存失败' . $User->getError());
        }

        return $this->success('保存成功', url('index'));
        
    }

    /**
     * 删除数据
     * @author gaoliming
     */
    public function delete()
    {
       //获取传过来的id值
       $id = input('id');

       //取出对象
       $User = User::get($id);
       if (null === $User) {
           
           return $this->error('未找到相关记录');
       }

       //删除对象
       if (false === $User->delete()) {
           
           return $this->error('删除失败');
       }

       //返回首页
       return $this->success('删除成功', url('index'));
    }

    /**
     * 像是个人详情
     * @author  gaoliming
     */
    public function detail()
    {
        //获取V层传过来的id值
        $id = input('id');

        //取出对象
        $User = User::get($id);

        //传给V层
        $this->assign('User', $User);

        //返回用户首页
        return $this->fetch();
    }
}