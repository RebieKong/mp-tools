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

class ShortVoice extends AbstractResponseWorker
{

    public function _getResult(MessageBean $bean)
    {
        return $this->genTextResult("[203]服务器已经接收到你的小视频消息，但并未使用业务钩子进行监听", $bean);
    }
}