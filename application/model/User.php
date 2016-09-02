<?php
namespace app\model;

use think\Model;

class User extends Model
{
	protected $dateFormat = 'Y/m/d';
    protected $type       = [
        // 设置last_time_on为时间戳类型（整型）
        'last_time_on' => 'timestamp',
    ];

    /**
     * 判断是否登录
     * @return boolean
     * @author tangzhenjie
     */
	static public function islogin()
	{
		$userId = session('userId');
		if (isset($userId)) {
			return true;
		} else {
			return false;
		}
	}

    /**
     * 登录操作
     * @return boolean
     * @author tangzhenjie
     */
	static public function login($username, $password)
	{
        //获取登录对象
		$map  = array('username' => $username);
		$User = self::get($map);
        
        //获取这次登录时间
		$time = time();

		//判断是否取出对应的对象
		if ($User === null) {
			return false;
		}
	    if ($User->password === $password) {
		    session('userId', $User->getData('id'));
		    $User->last_time_on  = $User->login_time_on;
		    $User->login_time_on = $time;
		    $User->save();
		    return true;
		} else {
		    return false;
	    }
	
	}

	/**
     * 查询数据
     * @param string $name 搜索的关键字
     * @return object 
     * @author  gaoliming 
     */
    public function ListUsers($name)
    {

        //分页每页的大小
        $PageSize = 5;

        //取出数据库中的数据
        $User = new User;
        return $User->where('name', 'like', '%' . $name . '%')->paginate($PageSize);
    }

    /**
     * 保存user数据
     * @param   array $data v层获取的数据
     * @param   int $id 用户的id
     * @return bool
     * @author gaoliming
     */
    public function UserSave($data,$id)
    {
    	//判断两次密码是否一样
        if ($data['password'] !== $data['newpassword']) {
            return $this->error('两次密码不一样');
        }

        //判断是新增还是更新
        if (null === $id) {
            
            //新增
            $User = new User;
        } else {

            //更新
            $User = User::get($id);
        }

        //获取传过来的数据
        $datas = array(
                'username' => $data['username'],
                'name' => $data['name'],
                'password' => $data['password'],
                'email' => $data['email'],
         );

         //保存并验证
        if (false === $User->validate()->save($datas)) {
            return false ;
        }
        return true;
    }
}