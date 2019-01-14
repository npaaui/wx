<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 2019/1/11
 * Time: 09:59
 */

namespace app\index\controller;


use app\index\util\Http;
use think\Cache;
use think\facade\Config;

class WxApi
{
    /**
     * 开发者配置相关
     */
    private $appID;         // 开发者ID(AppID)

    private $appSecret;     // 开发者密码(AppSecret)

    public function __construct()
    {
        $this->appID = Config::get('wx.common.appId');
        $this->appSecret = Config::get('wx.common.appSecret');
    }

    public function getAccessToken()
    {
        $cache = new Cache();
        $accessToken = $cache->get('wx_access_token');
        if (empty($accessToken)) {
            $params = array(
                'grant_type' => 'client_credential',
                'appid' => $this->appID,
                'secret' => $this->appSecret,
            );
            $ret = $this->_call('accessTokenUrl', $params);
            $accessToken = $ret['access_token'];
            $cache->set('wx_access_token', $accessToken, 3600);
        }
        return $accessToken;
    }

    public function _call($request, $params)
    {
        $query = http_build_query($params);
        //获取请求host
        $host = Config::get('wx.wxApiUrl.' . $request);
        $url = $host . $query;
        //发送请求
        $ret = Http::get($url);
        //转换成数组
        $arr = json_decode($ret, true);
        return $arr;
    }

}