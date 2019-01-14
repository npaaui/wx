<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 2019/1/14
 * Time: 10:41
 */

namespace app\index\controller;


class Cooking
{
    public function getCookingList()
    {
        $data = array(
            'code' => 0000,
            'data' => array(
                array(
                    'id' => 1,
                    'name' => '清炒土豆丝',
                    'cook_id' => 1,
                    'img' => 'image',
                    'price' => 2.99,
                ),
                array(
                    'id' => 2,
                    'name' => '西红柿炒蛋',
                    'cook_id' => 1,
                    'img' => 'image',
                    'price' => 4.59,
                ),
            ),
        );
        $jsonData = json_encode($data);
        return $jsonData;
    }
}