<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 2018/12/14
 * Time: 17:55
 */

namespace app\index\controller;

use Npaaui\WeChat\WeChat;
use think\facade\Config;
use app\index\util\Weather;

class Wx
{
    //微信配置
    private $config;

    //微信消息类
    private $weChat;

    public function __construct()
    {
        $this->config = Config::get('wx.publicSign');
        //微信消息入口
        $this->weChat = new WeChat($this->config);
        $this->weChat->access();
    }

    public function index()
    {
        $type = $this->weChat->_getMsgType();
        //消息分发
        switch ($type) {
            case 'text':
                $responseMsg = $this->doTextMsg();
                break;
            default:
                $responseMsg = $this->weChat->getReplyMsg(array(
                    'type' => 'text',
                    'content' => Config::get('wx.errorMsg')
                ));
                break;
        }

        //消息返回
        exit($responseMsg);
    }

    public function doTextMsg()
    {
        $content = $this->weChat->_getContent();
        $message = explode(' ', $content);
        switch ($message[0]) {
            case 'tq' :
                $content = Weather::weather($message[1]);
                break;
            default :
                $content = Config::get('wx.errorMsg');
        }
        $replyMsg = $this->weChat->getReplyMsg(array(
            'type' => 'text',
            'content' => $content
        ));
        return $replyMsg;
    }

}