<?php

namespace app\common\validate;

use think\Validate;

class Menu extends Validate
{
	protected $rule = [
       	'name'          => 'require',
       	'module'        => 'require',
       	'controller'    => 'require',
       	'action'        => 'require',
       	'is_permission' => 'require',
       	'status'        => 'require',
    ];
}