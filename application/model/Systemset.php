<?php
namespace app\model;

use think\Model;

class Systemset extends Model
{
	/**
	 * 数据显示变换
	 * @param  int $value 数据表里面isshow的数据
	 * @return string
	 * @author tangzhenjie
	 */
	public function getIsShowAttr($value)
	{
		$status = array(
			'0' => '否',
			'1' => '是',
		 );

		if ($value === 0 || $value === 1) {
			
			return $status[$value];
		}

		return $status['0'];
	}

	/**
	 * 数据显示变换
	 * @param  int $value 数据表里面isdisplay的数据
	 * @return string
	 * @author tangzhenjie
	 */
	public function getIsDisplayAttr($value)
	{
		$status = array(
			'0' => '否',
			'1' => '是',
		 );

		if ($value === 0 || $value === 1) {
			
			return $status[$value];
		}

		return $status['0'];
	}

	/**
	 * 获得公司的名字
	 * @return string 
	 * @author liuxi
	 */
	public function getheader()
	{
		$Systemset  = new Systemset;
		$Systemsets = $Systemset->where('is_show', '=', 1)->find();
		
		if (null === $Systemsets) {
        	return '';
        } else {
            return $Systemsets->getData('name');
        }
	}

	/**
	 * 获得公司的页脚
	 * @return string 
	 * @author liuxi
	 */
	public function getfooter()
	{
		$Systemset  = new Systemset;
		$Systemsets = $Systemset->where('is_display', '=', 1)->find();
		
		if (null === $Systemsets) {
        	return '';
        } else {
        	return $Systemsets->getData('footer_name');
        }
	}

	/**
	 * 获得公司的图片地址
	 * @return string 
	 * @author liuxi
	 */
    public function getUrl()
    {
        if (array() === $data = Systemset::all()) {
            return '';
        } else {
            $data = $data[0];
            return $data->getData('url');
        }
    }
}