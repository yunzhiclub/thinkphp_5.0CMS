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
	 * @return string <0 冻结,1 解冻>
	 * @author  gaoliming
	 */
	public function getStatusAttr($value)
	{
		$Status = array('0' => '冻结' ,
			'1' => '解冻',
		 );
		if(0 === $value || 1 === $value)
		{
			return $Status[$value];
		}

		return $Status['0'];
	}

	/**
	 * 显示性别
	 * @return string <0 男, 1女>
	 * @author  gaoliming
	 */
	public function getSexAttr($value)
	{
		$Status = array('0' => '男',
			'1' => '女',
		 );

		if (0 === $value || 1 === $value) {
			
			return $Status[$value];
		}

		return $Status['0'];
	}
}