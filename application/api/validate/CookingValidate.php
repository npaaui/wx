<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 2019/1/25
 * Time: 18:00
 */

namespace app\api\validate;


class CookingValidate extends ApiBaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger',
        'page' => 'require|isPositiveInteger',
    ];

    protected $message = [
        'id' => 'id必须是正整数',
        'page' => 'page必须是正整数',
    ];

}