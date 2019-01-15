<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 2019/1/14
 * Time: 10:42
 */

namespace app\index\model;


use think\Db;

class cookingModel
{
    /**
     * 获取烹饪列表
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function cookingList()
    {
        $data = Db::table('n_cooking')
            ->select();
        return $data;
    }
}