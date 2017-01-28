<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-5
 * Time: 下午3:09
 */

namespace RebieKong\MpTools\ResponseWorker;


use RebieKong\MpTools\Core\AbstractResponseWorker;
use RebieKong\MpTools\Entity\MessageBean;

class Msg extends AbstractResponseWorker
{

    public function _getResult(MessageBean $bean)
    {
        return $this->genTextResult("[400]服务器收到你的请求，但不能正确理解你的请求", $bean);
    }
}