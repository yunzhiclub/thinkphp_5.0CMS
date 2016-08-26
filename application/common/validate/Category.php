<?php

namespace app\common\validate;

use think\Validate;

class Category extends Validate
{
	protected $rule = [
        'name'  =>  'require|max:25',
    ];
}