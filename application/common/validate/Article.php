<?php

namespace app\common\validate;

use think\Validate;

class Article extends Validate
{
	protected $rule = [
        'title'        => 'require|max:100',
        'is_recomment' => 'require',
        'is_top'       => 'require',
        'content'      => 'require',
        'category_id'  => 'require',
    ];
}