<?php

namespace app\common\validate;

use think\Validate;

class User extends Validate
{
	protected $rule = [
        'name'  =>  'require|length:2,35',
        'email' =>  'require|email',
        'username' => 'require|length:2,35',
        'password' => 'require',
    ];
}