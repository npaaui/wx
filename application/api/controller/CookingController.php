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
        $ret = $this->cookingModel->get($id);

        return $this->_out(self::SUCCESS, $ret);
    }

    /**
     * @param string $q
     * @param int $page
     * @param int $pageSize
     * @return string
     * @throws \think\Exception\DbException
     */
    public function getCookingList($q = '', $page = 1, $pageSize = 10)
    {
        $this->_setPage($page, $pageSize);

        $ret['list'] = $this->cookingModel
            ->where('name', 'like',"%$q%")
            ->limit($this->offset, $this->limit)
            ->all();

        return $this->_out(self::SUCCESS, $ret);
    }
}