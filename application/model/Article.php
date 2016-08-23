<?php
namespace app\model;

use think\Model;

class Article extends Model
{
	public function getIstopAttr($value)
    {
        $status = array('0'=>'否','1'=>'是');
        $istop = $status[$value];
        if (isset($istop))
        {
            return $istop;
        } else {
            return $status[0];
        }
    }
    public function getIsrecommentAttr($value)
    {
        $status = array('0'=>'否','1'=>'是');
        $isrecomment = $status[$value];
        if (isset($isrecomment))
        {
            return $isrecomment;
        } else {
            return $status[0];
        }
    }
	public function category()
	{
		return $this->belongsTo("category");
	}
}