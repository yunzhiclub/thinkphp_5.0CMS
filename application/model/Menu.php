<?php
namespace app\model;

use think\Model;

class Menu extends Model
{
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