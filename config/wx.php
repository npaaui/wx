<?php

// +----------------------------------------------------------------------
// | 微信设置
// +----------------------------------------------------------------------

return [
    'errorMsg' => '感谢您的来访，辰砂会立即回复您～',

    /**
     * WeChat 公众号配置
     */
    'common' => [
        // 开发者ID(AppID)
        'appId' => 'wxaae1b4a00c222a29',

        // 令牌(Token)
        'token' => 'alice',

        //开发者密码（AppSecret）
        'appSecret' => '37f64260f7ecb6b48a4ad68c1abe87f7'
    ],

    /**
     * WeChat 小程序配置
     */
    'miniProgram' => [
        'appId' => 'wxdffa5183841ebfd7',
        'secret' => 'dfb7a8d8fd977bd3e6d4b63bd3a26df7',
    ],

    /**
     * WeChat Api Url
     */
    'wxApiUrl' => [
        //获取Access_token
        'accessTokenUrl' => 'https://api.weixin.qq.com/cgi-bin/token?',

    ],

];