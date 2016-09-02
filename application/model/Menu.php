<?php
namespace app\model;

use think\Model;

class Menu extends Model
{
	/**
	 * 输出样式转换
	 * @param  int $value 数据表中status数据
	 * @return string 
	 * @author tangzhenjie
	 */
	public function getStatusAttr($value)
	{
		$data = array(
			'0' =>'不显示',
			'1' =>'显示'
			);
		$status = $data[$value];

		//判断$status是否有值
		if(isset($status))
		{
			return $status;
		}else{
			return $data[0];
		}
	}

	/**
	 * 输出样式转换
	 * @param  int $value 数据表中ispermiss数据
	 * @return string 
	 * @author tangzhenjie
	 */
	public function getIspermissionAttr($value)
	{
		$data = array(
			'0' =>'所有用户',
			'1' =>'注册用户'
			);

		//判断$status是否有值
		$status = $data[$value];
		if(isset($status))
		{
			return $status;
		}else{
			return $data[0];
		}
	}
}