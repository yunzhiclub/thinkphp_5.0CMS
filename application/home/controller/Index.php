<?php
namespace app\home\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function flot()
    {
      return $this->fetch('template/flot');
    }

    public function forms()
    {
      return $this->fetch('template/forms');
    }

    public function buttons()
    {
      return $this->fetch('template/buttons');
    }

    public function icons()
    {
      return $this->fetch('template/icons');
    }

    public function notifications()
    {
      return $this->fetch('template/notifications');
    }

    public function tables()
    {
      return $this->fetch('template/tables');
    }

    public function typography()
    {
      return $this->fetch('template/typography');
    }
}
