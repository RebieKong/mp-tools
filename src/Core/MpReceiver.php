<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-5
 * Time: 下午3:09
 */

namespace RebieKong\MpTools\Core;


use RebieKong\MpTools\Entity\MessageBean;
use RebieKong\MpTools\ResponseWorker\DefaultResponseWorker;
use RebieKong\MpTools\ResponseWorker\Event;
use RebieKong\MpTools\ResponseWorker\Msg;
use RebieKong\MpTools\ResponseWorker\ResponseGainer;

final class MpReceiver
{

    /**
     * @var \DOMDocument
     */
    private $xml;
    /**
     * @var MessageBean
     */
    private $bean;
    /**
     * @var AbstractResponseWorker
     */
    private $responseWorker;

    /**
     * MpReceiver constructor.
     *
     * @param string $data
     * @param $hook
     *
     * @internal param $hooker
     */
    public function __construct($data, $hook)
    {
        $this->setBean($data);

        $type = $this->getBean()->getMsgType();
        if (strtolower($type) === 'event') {
            $worker = Event::getResponseWorker($this->getBean(), $hook);
        } else {
            $worker = Msg::getResponseWorker($this->getBean(), $hook);
        }
        if ( ! ($worker instanceof AbstractResponseWorker)) {
            $worker = new DefaultResponseWorker($hook);
        }
        $this->responseWorker = $worker;
    }

    /**
     * @param string $data
     *
     * @throws \Exception
     */
    private function setBean($data)
    {
        if (is_null($data)) {
            throw new \Exception("DATA CAN BE NULL");
        }
        $bean = new MessageBean();
        $data = $this->getTags($data);
        foreach ($data as $key => $value) {
            $bean->$key = $value;
        }
        $this->bean = $bean;
    }

    /**
     * @param string $data
     *
     * @return string[]
     */
    private function getTags($data)
    {
        $result = [];
        $root   = $this->getXml($data)->childNodes->item(0)->childNodes;
        for ($i = 0 ; $i < $root->length ; $i++) {
            if ($root->item($i)->nodeName != '#text') {
                $result[ $root->item($i)->nodeName ] = trim($root->item($i)->nodeValue);
            }
        }

        return $result;
    }

    /**
     * @param string $data
     *
     * @return \DOMDocument|null
     */
    private function getXml($data = null)
    {
        if (is_null($data)) {
            return null;
        }

        if (is_null($this->xml)) {
            $xml = new \DOMDocument();
            $xml->loadXML($data);
            $this->xml = $xml;
        }

        return $this->xml;
    }

    /**
     * @param string $data
     *
     * @return MessageBean
     */
    private function getBean($data = null)
    {
        if (is_null($this->bean)) {
            $this->setBean($data);
        }

        return $this->bean;
    }

    /**
     * @param $data
     *
     * @param $hook
     *
     * @param \RebieKong\MpTools\Core\MpCore $decrypt
     *
     * @return static
     * @throws \Exception
     */
    public static function init($data, $hook, MpCore $decrypt = null)
    {
        $xml = new \DOMDocument();
        $xml->loadXML($data);
        if ($xml->getElementsByTagName('Encrypt')->length > 0) {
            if (is_null($decrypt)) {
                throw new \Exception("Data Is Encrypt But Decrypt Is NULL");
            }
            $data = $decrypt->decrypt($data);
            $xml  = new \DOMDocument();
            $xml->loadXML($data);
        }

        return new static($data, $hook);
    }

    public function getResult()
    {
        $response = $this->responseWorker->_getResult($this->getBean());
        if (is_null($response)) {
            $response = ResponseGainer::genTextResult("你的请求已经收到但并未被正确监听", $this->getBean());
        }

        return $response;
    }
}

/*
        Db::execute("INSERT INTO wx_message (msg_id, user_id, from_id, create_time, message_type, data, response)
VALUES (?, ?, ?, ?, ?, ?, ?)", [
            $this->getBean()->getMsgId(),
            $this->getBean()->getToUserName(),
            $this->getBean()->getFromUserName(),
            date('Y-m-d H:i:s',$this->getBean()->getCreateTime()),
            $this->getBean()->getMsgType(),
            json_encode($this->getBean()->getAttr(),JSON_UNESCAPED_UNICODE),
            ($response===false)?'':$response,
        ]);
 */