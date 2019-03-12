<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 2019/2/27
 * Time: 15:47
 */

namespace app\common\model;


use think\Model;

class BaseModel extends Model
{
    protected $fieldRule;

    public function preField($array = [])
    {
        foreach ($array as $key => $value) {
            if (array_key_exists($key, $this->fieldRule)) {
                switch ($this->fieldRule[$key]) {
                    case 'string':
                        $data[$key] = (string)$value;
                        break;
                    case 'int':
                        $data[$key] = (int)$value;
                        break;
                    default:
                        break;
                }

            }
        }
        return $data;
    }
}