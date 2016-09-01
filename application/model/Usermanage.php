<?php
namespace app\model;
use think\Model;
/**
* 用户类
*/
class Usermanage extends Model
{
	/**
	 * 显示状态
	 * @param int $value 数据表里状态数据
	 * @return string    0冻结, 1解冻
	 * @author  gaoliming
	 */
	public function getStatusAttr($value)
	{
		$Status = array(
			'0' => '冻结' ,
			'1' => '解冻',
		 );
		if (0 === $value || 1 === $value) {
			return $Status[$value];
		}
		return $Status['0'];
	}

	/**
	 * 显示性别
	 * @param int $value 数据表里性别数据
	 * @return string  0男, 1女
	 * @author  gaoliming
	 */
	public function getSexAttr($value)
	{
		$Status = array(
			'0' => '男',
			'1' => '女',
		 );

		if (0 === $value || 1 === $value) {
			return $Status[$value];
		}

		return $Status['0'];
	}

	/**
	*登录操作
	* @param string $username 用户名
	* @param string $password 密码
	* @return boolean
	* @author tangzhenjie
	*/
	static public function login($username, $password)
	{
		$map        = array('username' => $username);
		$Usermanage = self::get($map);
		if ($Usermanage === null) {
			return false;
		}
		if ($Usermanage->password === $password) {
			if ($Usermanage->getData('status') === 1) {
				session('usermanageId', $Usermanage->id);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	* 登录操作
	* @return boolean
	* @author tangzhenjie
	*/
	static public function islogin()
	{
		$userId = session('usermanageId');
		if (isset($userId)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * 显示创建时间
	 * @author gaoliming
	 */
	protected $dateFormat = 'Y年m月d日';    // 日期格式

    // 类型转换
    protected $type = [
        'create_time' => 'datetime',
        'update_time' => 'datetime',
    ];

    
}