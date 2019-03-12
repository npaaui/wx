<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 2019/1/25
 * Time: 11:15
 */

namespace app\api\controller;

class ApiBaseController extends ErrorCodeController
{
    protected $offset = 0;
    protected $limit = 10;

    public function _setPage($page, $pageSize = 10)
    {
        if ($page < 1) $page = 1;
        if ($pageSize < 1) $pageSize = 10;
        $this->offset = ($page - 1) * $pageSize;
        $this->limit = $pageSize;
    }

    public function _in()
    {
        $content = file_get_contents('php://input');
        $data = json_decode($content, true);
        return $data;
    }

    public function _out($code, $data, $msg = '')
    {
        $this->setCodeMsg($code, $msg);
        $out = array(
            'error'  => $this->errorCode,
            'msg'   => $this->msg,
            'data'  => $data
        );
        return json_encode($out);
    }
}