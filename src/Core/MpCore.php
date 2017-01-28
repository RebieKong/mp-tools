<?php
namespace RebieKong\MpTools\Core;

use PreviewFramework\Utils\ArrayUtils;
use PreviewFramework\Utils\RandomUtils;

/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-6
 * Time: 上午9:42
 */
class MpCore extends AbstractMp
{

    private $encryptMode = false;

    public function setEncryptMode($encryptMode)
    {
        $this->encryptMode = boolval($encryptMode);
    }

    public function isEncryptMode()
    {
        return boolval($this->encryptMode);
    }

    public function send($text)
    {
        if ($this->isEncryptMode()) {
            $timeStamp = time();
            $nonce = RandomUtils::string(16);
            $encryptMsg = '';
            $errCode = $this->getCrypt()->encryptMsg($text, $timeStamp, $nonce, $encryptMsg);
            if ($errCode == 0) {
                return $encryptMsg;
            } else {
                throw new \Exception("Decrypt Error For code:".$errCode);
            }
        } else {
            return $text;
        }
    }

    public function decrypt($data)
    {
        $this->setEncryptMode(true);
        $xmlTree = new \DOMDocument();
        $xmlTree->loadXML($data);
        $msgSignature = ArrayUtils::get($_GET,'msg_signature');
        $timestamp = ArrayUtils::get($_GET,'timestamp');
        $nonce = ArrayUtils::get($_GET,'nonce');
        $msg = '';
        $errCode = $this->getCrypt()->decryptMsg($msgSignature, $timestamp, $nonce, $data, $msg);
        if ($errCode == 0) {
            return $msg;
        } else {
            throw new \Exception("Decrypt Error For code:".$errCode);
        }

    }


    public function validateSign()
    {
        $msgSignature = ArrayUtils::get($_GET,'msg_signature');
        $timestamp = ArrayUtils::get($_GET,'timestamp');
        $nonce = ArrayUtils::get($_GET,'nonce');

        return $this->getCrypt()->validateSign($msgSignature, $timestamp, $nonce);
    }

}