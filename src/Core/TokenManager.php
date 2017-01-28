<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-12
 * Time: 下午5:55
 */


namespace RebieKong\MpTools\Core;



class TokenManager extends AbstractMp
{

    public function getAccessToken($force = false, callable $cacheFunction = null)
    {
        $token = null;
        if (is_callable($cacheFunction)) {
            $tokenCacheKey = sprintf("%s_mp_token", $this->getAppId());
            $token         = @call_user_func($cacheFunction, 'get', $tokenCacheKey, null);
            if (is_null($token) || $force) {
                $tokenInfo = $this->getAccessTokenInfo();
                @call_user_func($cacheFunction, 'set', $tokenCacheKey, $tokenInfo['access_token'], $tokenInfo['expires_in']);
                $token = $tokenInfo['access_token'];
            }
        } else {
            $tokenInfo = $this->getAccessTokenInfo();
            $token = $tokenInfo['access_token'];
        }

        return $token;
    }


    private function getAccessTokenInfo()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/token';
        $url .= '?'.http_build_query([
                'grant_type' => 'client_credential',
                'appid'      => $this->getAppId(),
                'secret'     => $this->getAppSecret(),
            ]);

        $result = json_decode(file_get_contents($url), true);

        return $result;
    }


}