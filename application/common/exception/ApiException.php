<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 2019/1/26
 * Time: 13:01
 */

namespace app\common\exception;


class ApiException extends BaseException
{
    // HTTP 状态码 400,200
    public $code = 400;
    // 错误信息
    public $msg = '请求的资源不存在';
    //自定义错误码
    public $errorCode = 30000;
}