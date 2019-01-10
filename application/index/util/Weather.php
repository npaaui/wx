<?php
/**
 * Created by PhpStorm.
 * User: alice
 * Date: 2019/1/10
 * Time: 12:03
 */

namespace app\index\util;


class Weather
{
    const errorMsg = "辰砂有点糊涂，请确定输入格式正确\n如「tq 南昌」";

    //获取天气
    public static function weather($city)
    {
        $key = 'fhu6uudmkpsdwklo'; //key
        $uid = 'U4BDE80927'; //用户 ID
        $api = 'https://api.seniverse.com/v3/weather/daily.json'; // 接口地址
        $location = $city; // 城市名称。除拼音外，还可以使用 v3 id、汉语等形式
        // 生成签名。文档：https://www.seniverse.com/doc#sign
        $param = [
            'ts' => time(),
            'ttl' => 300,
            'uid' => $uid,
        ];
        $sig_data = http_build_query($param); // http_build_query 会自动进行 url 编码
        // 使用 HMAC-SHA1 方式，以 API 密钥（key）对上一步生成的参数字符串（raw）进行加密，然后 base64 编码
        $sig = base64_encode(hash_hmac('sha1', $sig_data, $key, TRUE));
        // 拼接 url 中的 get 参数。文档：https://www.seniverse.com/doc#daily
        $param['sig'] = $sig; // 签名
        $param['location'] = $location;
        $param['start'] = 0; // 开始日期。0 = 今天天气
        $param['days'] = 3; // 查询天数，1 = 只查一天
        // 构造 url
        $url = $api . '?' . http_build_query($param);
        $ret = json_decode(Http::get($url), true);
        if (! isset($ret['results'])) {
            return self::errorMsg;
        }
        $daily = $ret['results'][0]['daily'];
        $content = '';
        $day = '';
        for ($i = 0; $i < 3; $i++) {
            $i != 0 || $day = '今天';
            $i != 1 || $day = '明天';
            $i != 2 || $day = '后天';
            $weather = $daily[$i]['text_day'];
            $temLow = $daily[$i]['low'];
            $temHigh = $daily[$i]['high'];
            $windD = $daily[$i]['wind_direction'];
            $windS = $daily[$i]['wind_scale'];
            $content .= "{$day}: {$weather} {$temLow}~{$temHigh}℃  {$windD}风{$windS}级";
            ($i == 0 || $i == 1) && $content .= "\n";
        }
        return $content;
    }
}