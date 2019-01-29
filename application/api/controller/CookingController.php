<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 2019/1/25
 * Time: 10:29
 */

namespace app\api\controller;

use app\api\validate\CookingValidate;
use app\common\model\CookingModel;
use app\common\model\CookingStepModel;

class CookingController extends ApiBaseController
{
    private $cookingModel;
    private $cookingValidate;
    public function __construct()
    {
        $this->cookingModel = new CookingModel();
        $this->cookingValidate = new CookingValidate();
    }

    /**
     * @param $id
     * @return string
     * @throws \think\Exception\DbException
     */
    public function getCookingOne($id)
    {
        $ret = $this->cookingModel
            ->field('n_cooking.*,n_user.name as user_name')
            ->join('n_user', 'n_user.id=n_cooking.user_id')
            ->get($id);

        $cookingStepM = new CookingStepModel();
        $ret['step'] = $cookingStepM->where('cooking_id', $ret['id'])
            ->all();

        return $this->_out(self::SUCCESS, $ret);
    }

    /**
     * @param string $q
     * @param int $page
     * @param int $pageSize
     * @return string
     * @throws \think\Exception\DbException
     */
    public function getCookingList($q = '', $page = 1, $pageSize = 5)
    {
        $this->_setPage($page, $pageSize);

        $ret['total'] = $this->cookingModel
            ->where('name', 'like',"%$q%")
            ->count();

        $ret['list'] = $this->cookingModel
            ->field('n_cooking.*,n_user.name as user_name')
            ->join('n_user', 'n_user.id=n_cooking.user_id')
            ->where('n_cooking.name', 'like',"%$q%")
            ->limit($this->offset, $this->limit)
            ->all();


        return $this->_out(self::SUCCESS, $ret);
    }
}