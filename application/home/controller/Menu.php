<?php
namespace app\home\controller;

use app\home\controller\Parenter;

class Menu extends Parenter
{
	public function index()
	{
		return $this->fetch();
	}

	public function add()
	{
		return $this->fetch();
	}
    
    public function insert()
    {
    	return $this->redirect("index");
    }

	public function edit()
	{
		return $this->fetch();
	}
     
    public function update()
    {
    	return $this->redirect('index');
    }

    public function delete()
    {
       return $this->redirect('index');
    }

}