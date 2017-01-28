<?php

namespace RebieKong\MpTools\Core;

use RebieKong\MpTools\WeChatComponent\WXBizMsgCrypt;

abstract class AbstractMp
{

    private $encodingAesKey;
    private $appId;
    private $appSecret;
    private $token;

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
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @return mixed
     */
    public function getAppSecret()
    {
        return $this->appSecret;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    private static $crypt;

    protected function getCrypt()
    {
        if (is_null(self::$crypt)) {
            self::$crypt = new WXBizMsgCrypt($this->token, $this->encodingAesKey, $this->appId);
        }

        return self::$crypt;
    }
}