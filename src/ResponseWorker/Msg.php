<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-5
 * Time: 下午3:09
 */

namespace RebieKong\MpTools\ResponseWorker;


use RebieKong\MpTools\Core\AbstractResponseWorker;
use RebieKong\MpTools\Core\ResponseWorkerFactoryInterface;
use RebieKong\MpTools\Entity\MessageBean;
use RebieKong\MpTools\Hook\HookInterface;
use RebieKong\MpTools\ResponseWorker\Message\Image;
use RebieKong\MpTools\ResponseWorker\Message\Link;
use RebieKong\MpTools\ResponseWorker\Message\Location;
use RebieKong\MpTools\ResponseWorker\Message\ShortVideo;
use RebieKong\MpTools\ResponseWorker\Message\Text;
use RebieKong\MpTools\ResponseWorker\Message\Video;
use RebieKong\MpTools\ResponseWorker\Message\Voice;

class Msg implements ResponseWorkerFactoryInterface
{

    public static function getResponseWorker(MessageBean $bean,HookInterface $hook)
    {
        $workerList = [
            'text'       => Text::getClassName(),
            'location'   => Location::getClassName(),
            'voice'      => Voice::getClassName(),
            'image'      => Image::getClassName(),
            'shortvideo' => ShortVideo::getClassName(),
            'video'      => Video::getClassName(),
            'link'       => Link::getClassName(),
        ];

        /** @var AbstractResponseWorker $worker */
        if (key_exists(strtolower($bean->msgType), $workerList)) {
            $worker = new $workerList[ $bean->msgType ]($hook);
        } else {
            $worker = new DefaultResponseWorker($hook);
        }

        return $worker;
    }
}