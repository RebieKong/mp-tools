<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-5
 * Time: 下午3:09
 */

namespace RebieKong\MpTools\ResponseWorker;




use RebieKong\MpTools\Core\ResponseWorkerFactoryInterface;
use RebieKong\MpTools\Entity\MessageBean;
use RebieKong\MpTools\Hook\HookInterface;

class Event implements ResponseWorkerFactoryInterface
{

    public static function getResponseWorker(MessageBean $bean,HookInterface $hook)
    {
        return null;
    }
}