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
}