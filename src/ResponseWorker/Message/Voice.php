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

class Voice extends AbstractResponseWorker
{

    public function _getResult(MessageBean $bean)
    {
        return '';
    }
}