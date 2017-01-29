<?php

namespace RebieKong\MpTools\ResponseWorker;

use PreviewFramework\Utils\ArrayUtils;
use RebieKong\MpTools\WeChatComponent\WXBizMsgCrypt;

abstract class AbstractMp
{

    private static $crypt;
    private $encodingAesKey;
    private $appId;
    private $appSecret;
    private $token;
    private static $encryptMode = false;

    public function __construct($appId, $appSecret, $token, $encodingAesKey = '')
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->encodingAesKey = $encodingAesKey;
        $this->token = $token;
        self::$crypt = new WXBizMsgCrypt($this->token, $this->encodingAesKey, $this->appId);
    }

    /**
     * @return string
     */
    public function getEncodingAesKey()
    {
        return $this->encodingAesKey;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

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

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
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

    /**
     * @return mixed
     */
    public function getAppSecret()
    {
        return $this->appSecret;
    }

    public function isEncryptMode()
    {
        return boolval(self::$encryptMode);
    }

    public function setEncryptMode($encryptMode)
    {
        self::$encryptMode = boolval($encryptMode);
    }

    public function validateSign()
    {
        $msgSignature = ArrayUtils::get($_GET,'signature');
        $timestamp = ArrayUtils::get($_GET,'timestamp');
        $nonce = ArrayUtils::get($_GET,'nonce');

        return $this->getCrypt()->validateSign($msgSignature, $timestamp, $nonce);
    }

    protected function getCrypt()
    {
        if (is_null(self::$crypt)) {
            self::$crypt = new WXBizMsgCrypt($this->token, $this->encodingAesKey, $this->appId);
        }

        return self::$crypt;
    }
}