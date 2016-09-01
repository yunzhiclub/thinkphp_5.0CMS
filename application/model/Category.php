<?php
namespace app\model;

use think\Model;

class Category extends Model
{
	/**
    * 获取数据
    * @param string  $title 搜索的题目
    * @return object 
    * @author tangzhenjie
    */
	public function getlist($name)
    {   
        //分页条数
        $pageSize = 3;
        return $this->where('name', 'like', '%'.$name.'%')->paginate($pageSize);
    }

    /**
    * 新增和更新操作的保存
    * @param array $data 从v层传入的数据
    * @return boolean
    * @author tangzhenjie
    */
    public function insert($data)
    {
    	if (isset($data['id'])) {
    		$Category = Category::get($data['id']);
    	}else{
    		$Category = new Category;
    	}

    	$map = array('name' => $data['name']);
    	if(false === $Category->validate(true)->save($map))
    	{
    		return false;
    	}
    	return true;
    }
}