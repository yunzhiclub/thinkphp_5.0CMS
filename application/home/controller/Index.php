<?php
namespace app\admin\controller;

use think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function flot()
    {
      return $this->fetch('Template/flot');
    }

    public function forms()
    {
      return $this->fetch('Template/forms');
    }

    public function buttons()
    {
      return $this->fetch('Template/buttons');
    }

    public function icons()
    {
      return $this->fetch('Template/icons');
    }

    public function notifications()
    {
      return $this->fetch('Template/notifications');
    }

    public function tables()
    {
      return $this->fetch('Template/tables');
    }

    public function typography()
    {
      return $this->fetch('Template/typography');
    }
}
