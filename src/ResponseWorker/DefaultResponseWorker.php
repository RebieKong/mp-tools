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

class DefaultResponseWorker extends AbstractResponseWorker
{

    public function _getResult(MessageBean $bean)
    {
        return $this->genTextResult("[400]服务器收到你的请求，但不能正确理解你的请求", $bean);
    }
}