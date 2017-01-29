<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-29
 * Time: 上午9:24
 */

namespace RebieKong\MpTools\ResponseWorker;


use RebieKong\MpTools\Entity\MessageBean;
use RebieKong\MpTools\HookInterface;

interface ResponseWorkerFactoryInterface
{

    public static function getResponseWorker(MessageBean $bean,HookInterface $hook);
}