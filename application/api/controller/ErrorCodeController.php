<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 2019/1/27
 * Time: 19:50
 */

namespace app\api\controller;

class ErrorCodeController
{
    protected $errorCode;

    protected $msg;

    const SUCCESS = 0000;
    const SYSTEM_ERROR = 0001;
    const PARAM_VALIDATE_ERROR = 0002;

    private $msgArray = array(
        self::SUCCESS => "成功",
        self::SYSTEM_ERROR => "系统内部错误",
        self::PARAM_VALIDATE_ERROR => "非法参数请求",
    );

    public function setCodeMsg($code, $msg = '')
    {
        if (array_key_exists($code, $this->msgArray) && is_string($msg)){
            $this->errorCode = $code;
            $this->msg = $msg === '' ? $this->msgArray[$code] : $msg;

        } else {
            $this->errorCode = self::SYSTEM_ERROR;
            $this->msg = $this->msgArray[$this->errorCode];
        }
    }
}