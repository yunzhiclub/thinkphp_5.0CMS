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
        //获取全部对象
        $New = new User;
        $Users = $New->ListUsers(input('get.name'));

        //向V层传递数据
        $this->assign('Users', $Users);

        //显示uer列表
        return $this->fetch();
    }

    /**
     * 添加数据的界面
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
        
        //获取保存的结果
        $User = new User;
        $result = $User->UserSave(input('post.'), input('post.id'));

        if (false === $result) {
            
            return $this->error('保存失败');
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