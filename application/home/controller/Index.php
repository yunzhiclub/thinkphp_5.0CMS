<?php
namespace app\home\controller;

use app\home\controller\Parenter

class Index extends Parenter
{
    public function index()
    {
        return $this->fetch();
    }
     public function buttons()
    {
        return $this->fetch('template/buttons');
    }

    public function chart()
    {
        return $this->fetch('template/chart');
    }

    public function forms()
    {
        return $this->fetch('template/forms');
    }

    public function grid()
    {
        return $this->fetch('template/grid');
    }

    public function icons()
    {
        return $this->fetch('template/icons');
    }



}
