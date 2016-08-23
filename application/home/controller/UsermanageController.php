<?php
namespace app\home\controller;

use app\model\Usermanage;

class UsermanageController extends ParenterController
{
	/**
	 * @author gaoliming
	 */
	public function index()
	{
		//接收搜索框传过来的name
		$name = input('get.name');

		//分页每页的大小
		$PageSize = 5;

		//取出数据库中的数据
		$User = new Usermanage;
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
		//添加用户
		return $this->fetch();
	}

	/**
	 * 删除数据
	 * @author gaoliming
	 */
	public function delete()
	{
		//接收id
		$id = input('id');

		//取出对象
		$User = Usermanage::get($id);

		if (null === $User) {

			return $this->error('未找到相关记录');
		}

		//删除数据
		if (false === $User->delete()) {
			
			return $this->error('删除失败' . $User->getError());
		}

		return $this->success('删除成功', url('index'));
	}

	/**
	 * 编辑数据
	 * @author gaoliming	
	 */
	public function edit()
	{
		//获取id
		$id = input('id');

		//取出对象
		$User = Usermanage::get($id);

		//向V层传值
		$this->assign('User', $User);
		
		//返回用户
		return $this->fetch();
	}

	/**
	 * @author  gaoliming
	 */
	public function save()
	{
		//判断两次的密码是否一样
		if (input('post.password') !== input('post.newpassword')) {
			
			return $this->error('两次的密码不一样');
		}
		//判断是更新还是增加
		$id = input('post.id');
		if (null === $id) {
			//新增
			$User =  new Usermanage;
			
		} else {

			//更新
			$User = Usermanage::get($id);
		}

		//对对象进行一一赋值
		$data = array(
			'name' => input('post.name'),
			'username' => input('post.username'),
			'password' => input('password'),
			'status' => input('post.status'),
			'sex' => input('sex'),
			'email' => input('post.email'),
			);

		//验证并保存
		if (false === $User->validate(true)->save($data)) {
			
			return $this->error('保存错误' . $User->getError());
		}

		//返回首页
		return $this->success('保存成功', url('index'));
	}

	/**
	 * 改变状态
	 * @author gaoliming
	 */
	public function state()
	{
		//接收传过来的ID值
		$id = input('id');

		//取出对象
		$User = Usermanage::get($id);

		//获取状态
		$status = $User->getData('status');

		//修改状态
		if ($status === 0) {
			
			//解冻
			$User->status = 1;

		} else {

			//冻结
			$User->status = 0;

		}

		//进行保存
		if (false === $User->validate()->save()) {
			
			return $this->error('修改失败');
		}

		//返回index
		if ($status === 0) {
			
			return $this->success('解冻成功', url('index'));
		} else {

			return $this->success('冻结成功', url('index'));
		}
	}

	/**
	 * 显示用户细节信息
	 * @author gaoliming
	 */
	public function detail()
	{
		//获取V层传过来的id值
		$id = input('id');

		//取出对象
		$User = Usermanage::get($id);

		//传给V层
		$this->assign('User', $User);

		//返回用户首页
		return $this->fetch();
	}
}