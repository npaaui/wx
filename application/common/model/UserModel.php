<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 2019/2/27
 * Time: 09:02
 */

namespace app\common\model;


use think\Model;

class UserModel extends BaseModel
{
    const fieldRule = array(
        'open_id' => 'string',
        'union_id' => 'string',
        'name' => 'string',
        'nickname' => 'string',
        'type' => 'string',
        'gender' => 'string',
        'avatar_url' => 'string',
        'country' => 'string',
        'province' => 'string',
        'city' => 'string',
        'first_login_time' => 'string',
        'last_login_time' => 'string',
        'login_cnt' => 'int',
    );

    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->fieldRule = self::fieldRule;
    }

}