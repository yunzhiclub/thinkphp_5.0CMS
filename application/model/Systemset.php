<?php
namespace app\model;

use think\Model;

class Systemset extends Model
{
	/**
	 * 显示是公司名称是否显示
	 * @author gaoliming
	 */
	public function getIsShowAttr($value)
	{
		$status = array('0' => '否',
			'1' => '是',
		 );

		if ($value === 0 || $value === 1) {
			
			return $status[$value];
		}

		return $status['0'];
	}

	/**
	 * 显示页脚名称是否显示
	 * @author  gaoliming 
	 */
	public function getIsDisplayAttr($value)
	{
		$status = array('0' => '否',
			'1' => '是',
		 );

		if ($value === 0 || $value === 1) {
			
			return $status[$value];
		}

		return $status['0'];
	}
}