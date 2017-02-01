<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-28
 * Time: 上午1:05
 */

namespace RebieKong\MpTools\ResponseWorker\Message;

use RebieKong\MpTools\Core\AbstractResponseWorker;
use RebieKong\MpTools\Hook\HookInterface;


class Location extends AbstractResponseWorker
{


    protected function getTag()
    {
        return HookInterface::HOOK_MSG_LOCATION;
    }
}