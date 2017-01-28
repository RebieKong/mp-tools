<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-19
 * Time: 下午4:48
 */

namespace app\mp\core;


class MpInterfaces
{

    public static function getShortUrl($accessToken, $url)
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => 'https://api.weixin.qq.com/cgi-bin/shorturl?access_token='.$accessToken,
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => json_encode([
                'action'   => 'long2short',
                'long_url' => $url,
            ]),
        ]);
        $data = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($data, true);
        if ( ! empty($data) && $data['errcode'] == 0) {
            return $data['short_url'];
        }

        return $data;

    }
}