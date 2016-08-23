<?php
namespace app\index\controller;
use think\Controller;

class AboutusController extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
}