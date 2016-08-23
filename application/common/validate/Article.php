<?php

namespace app\common\validate;

use think\Validate;

class Article extends Validate
{
	protected $rule = [
        'title'  =>  'require|max:25',
        'is_recomment' => 'require',
        'is_top' => 'require',
    ];
}