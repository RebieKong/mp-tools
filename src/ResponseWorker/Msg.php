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
use RebieKong\MpTools\ResponseWorker\Message\DefaultResponseWorker;
use RebieKong\MpTools\ResponseWorker\Message\Image;
use RebieKong\MpTools\ResponseWorker\Message\Link;
use RebieKong\MpTools\ResponseWorker\Message\Location;
use RebieKong\MpTools\ResponseWorker\Message\ShortVoice;
use RebieKong\MpTools\ResponseWorker\Message\Text;
use RebieKong\MpTools\ResponseWorker\Message\Video;
use RebieKong\MpTools\ResponseWorker\Message\Voice;

class Msg extends AbstractResponseWorker
{

    public function _getResult(MessageBean $bean)
    {
        $workerList = [
            'text'       => Text::getClassName(),
            'location'   => Location::getClassName(),
            'voice'      => Voice::getClassName(),
            'image'      => Image::getClassName(),
            'shortvideo' => ShortVoice::getClassName(),
            'video'      => Video::getClassName(),
            'link'       => Link::getClassName(),
        ];

        if (in_array($bean->getMsgType(), $workerList)) {
            /** @var AbstractResponseWorker $worker */
            $worker = new $workerList[ $bean->getMsgType() ]();
        } else {
            $worker = new DefaultResponseWorker();
        }
        $result = $worker->_getResult($bean);
        if (empty($result)) {
            $result = (new DefaultResponseWorker())->_getResult($bean);
        }

        return $result;
    }
}