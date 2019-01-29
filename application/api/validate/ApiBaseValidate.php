<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 2019/1/25
 * Time: 17:46
 */

namespace app\api\validate;


use app\api\controller\ApiBaseController;
use think\Request;
use think\Validate;

class ApiBaseValidate extends Validate
{

    public function _filterRule($fields = [])
    {
        $rule = [];
        $message = [];
        foreach ($fields as $field) {
            if (array_key_exists($field, $this->rule)) {
                $rule[$field] = $this->rule[$field];
            }
            if (array_key_exists($field, $this->message)) {
                $message[$field] = $this->message[$field];
            }
        }
        $this->rule = $rule;
        $this->message = $message;
        return $this;
    }

    //进行参数校验
    public function goCheck()
    {
        // 获取http参数
        $request = new Request();
        $params = $request->param();

        //参数校验
        $result = $this->check($params);
        if (!$result) {
            $outCont = new ApiBaseController();
            exit($outCont->_out($outCont::PARAM_VALIDATE_ERROR,'', $this->error));
        } else {
            return true;
        }
    }

    //判断是否是正整数
    protected function isPositiveInteger($value, $rule = '', $data = '', $field = '')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return false;
        }
    }

}