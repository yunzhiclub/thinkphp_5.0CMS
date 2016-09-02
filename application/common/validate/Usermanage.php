<?php
namespace app\common\validate;

use think\Validate;     // 内置验证类

class Usermanage extends Validate
{
    protected $rule = [
        'username' => 'require|length:4,25',
        'name'  => 'require|length:2,25',
        'sex' => 'require|in:0,1',
        'email' => 'require|email',
        'status' => 'require|in:0,1',
        'password' => 'require',
    ];
}