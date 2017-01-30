<?php
namespace RebieKong\MpTools\Core;

use PreviewFramework\Utils\ArrayUtils;
use PreviewFramework\Utils\RandomUtils;
use RebieKong\MpTools\Exception\EncryptException;

/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-6
 * Time: 上午9:42
 */
class MpCore extends AbstractMp
{

    public function encrypt($text)
    {
        if ($this->isEncryptMode()) {
            $timeStamp = time();
            $nonce = RandomUtils::string(16);
            $encryptMsg = '';
            $errCode = $this->getCrypt()->encryptMsg($text, $timeStamp, $nonce, $encryptMsg);
            if ($errCode == 0) {
                $text = $encryptMsg;
            } else {
                throw new EncryptException("Decrypt Error For code:".$errCode);
            }
        }

        return $text;
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
        if ($errCode != 0) {
            throw new EncryptException("Decrypt Error For code:".$errCode);
        }

        return $msg;
    }
}