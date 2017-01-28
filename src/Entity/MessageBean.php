<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-12
 * Time: 下午4:00
 */

namespace RebieKong\MpTools\Entity;


class MessageBean
{

    /**
     * @var string
     */
    public $msgId;
    /**
     * @var string
     */
    public $toUserName;
    /**
     * @var string
     */
    public $fromUserName;
    /**
     * @var string
     */
    public $createTime;
    /**
     * @var string
     */
    public $receiverTime;
    /**
     * @var string
     */
    public $msgType;
    /**
     * @var string[]
     */
    private $attr = [];

    /**
     * @return string
     */
    public function getMsgId()
    {
        return $this->msgId;
    }

    /**
     * @param string $msgId
     */
    public function setMsgId($msgId)
    {
        $this->msgId = $msgId;
    }

    /**
     * @return string
     */
    public function getToUserName()
    {
        return $this->toUserName;
    }

    /**
     * @param string $toUserName
     */
    public function setToUserName($toUserName)
    {
        $this->toUserName = $toUserName;
    }

    /**
     * @return string
     */
    public function getFromUserName()
    {
        return $this->fromUserName;
    }

    /**
     * @param string $fromUserName
     */
    public function setFromUserName($fromUserName)
    {
        $this->fromUserName = $fromUserName;
    }

    /**
     * @return string
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * @param string $createTime
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;
    }

    /**
     * @return string
     */
    public function getReceiverTime()
    {
        return $this->receiverTime;
    }

    /**
     * @param string $receiverTime
     */
    public function setReceiverTime($receiverTime)
    {
        $this->receiverTime = $receiverTime;
    }

    /**
     * @return string
     */
    public function getMsgType()
    {
        return $this->msgType;
    }

    /**
     * @param string $msgType
     */
    public function setMsgType($msgType)
    {
        $this->msgType = $msgType;
    }

    public function __get($key)
    {
        $key = lcfirst($key);
        if (property_exists($this, $key)) {
            return $this->$key;
        } else {
            return $this->attr[$key];
        }
    }

    public function __set($key, $value)
    {
        $key = lcfirst($key);
        if (property_exists($this, $key)) {
            $this->$key = $value;
        } else {
            $this->attr[$key] = $value;
        }
    }

    /**
     * @return string[]
     */
    public function getAttr()
    {
        return $this->attr;
    }

}