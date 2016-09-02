<?php
namespace app\model;

use think\Model;

class Menu extends Model
{
	/**
	 * 数字转化为显示的问题
	 * @param  int $value 
	 * @return string 显示/不显示
	 * @author liuxi 
	 */
	public function getStatusAttr($value)
	{
		$data = array(
			'0' =>'不显示',
			'1' =>'显示'
			);
		$status = $data[$value];
		if(isset($status))
		{
			return $status;
		}else{
			return $data[0];
		}
	}

	/**
	 * 数字转化
	 * @param  into $value
	 * @return string 所有用户/注册用户
	 * @author  liuxi 
	 */
	public function getIspermissionAttr($value)
	{
		$data = array(
			'0' =>'所有用户',
			'1' =>'注册用户'
			);
		$status = $data[$value];
		if(isset($status))
		{
			return $status;
		}else{
			return $data[0];
		}
	}
}