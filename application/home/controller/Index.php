<?php
namespace app\home\controller;

use app\home\controller\Parenter

class Index extends Parenter
{
    public function index()
    {
        return $this->fetch();
    }
     public function about()
    {
        return $this->fetch('template/about');
    }

    public function contact()
    {
        return $this->fetch('template/contact');
    }

    public function portfolio()
    {
        return $this->fetch('template/portfolio');
    }

    public function pricing()
    {
        return $this->fetch('template/pricing');
    }

    public function services()
    {
        return $this->fetch('template/services');
    }



}
