<?php

namespace app\common\validate;

use think\Validate;

class Systemset extends Validate
{
	protected $rule = [
        'name'        =>  'require|max:50',
        'is_show'     => 'require|in:0,1',
        'is_display'  => 'require|in:0,1',
        'footer_name' => 'require',
        'url'         => 'require',
    ];
}