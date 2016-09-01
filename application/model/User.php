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
	static public function islogin()
	{
		$userId = session('userId');
		if(isset($userId))
		{
			return true;
		}else{
			return false;
		}
	}

	static public function login($username , $password)
	{
		$map = array('username' => $username);
		$User = self::get($map);
		$time = time();
		//判断是否取出对应的对象
		if($User === null)
		{
			return false;
		}
	    if($User->password === $password)
		{
		    session('userId', $User->getData('id'));
		    $User->last_time_on = $User->login_time_on;
		    $User->login_time_on = $time;
		    $User->save();
		    return true;
		              
	    }else{
		    return false;
	    }
	
	}

	/**
     * @param  $name [<搜索的关键字>]
     * @return paginate object usermanages
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
     * @param  $[data] <post数组> $id [编辑的键值]
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
        $datas = array('username' => $data['username'],
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