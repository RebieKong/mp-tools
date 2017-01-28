<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-28
 * Time: 上午1:05
 */


namespace RebieKong\MpTools\ResponseWorker\Message;

use RebieKong\MpTools\Core\AbstractResponseWorker;
use RebieKong\MpTools\Entity\MessageBean;

class Text extends AbstractResponseWorker
{

    public function _getResult(MessageBean $bean)
    {
        return $this->genTextResult("[203]系统已经接受到你的文字消息，但并未使用业务钩子进行监听", $bean);
    }
}