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
		$map = array('id' => $username);
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
		    $User->last_time_on = $time;
		    $User->save();
		    return true;
		              
	    }else{
		    return false;
	    }
	
	}
}