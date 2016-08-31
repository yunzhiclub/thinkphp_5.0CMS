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

	public function getheader()
	{
		$Systemset = new Systemset;
		$Systemsets = $Systemset->where('is_show', '=', 1)->find();
		
		if(null === $Systemsets)
        {
        	return '';
        }
        else
        {
            return $Systemsets->getData('name');
        }
	}

	public function getfooter()
	{
		$Systemset = new Systemset;
		$Systemsets = $Systemset->where('is_display', '=', 1)->find();
		
		if(null === $Systemsets)
        {
        	return '';
        }
        else
        {
        	return $Systemsets->getData('footer_name');

        }
	}

    public function getUrl()
    {

        if(array() === $data = Systemset::all())
        {
            return '';
        }
        else
        {
            $data = $data[0];
            return $data->getData('url');
        }
    }

}