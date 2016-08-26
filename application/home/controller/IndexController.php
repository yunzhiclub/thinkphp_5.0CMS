<?php
namespace app\home\controller;

use app\home\controller\ParenterController;

class IndexController extends ParenterController
{
    public function index()
    {
        return $this->fetch();
    }

}
