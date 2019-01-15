<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 2019/1/14
 * Time: 10:41
 */

namespace app\index\controller;

use app\index\model\cookingModel;

class Cooking
{
    /**
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getCookingList()
    {
        $data = cookingModel::cookingList();

        $jsonData = json_encode($data);
        return $jsonData;
    }
}