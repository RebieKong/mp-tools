<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-28
 * Time: 上午1:05
 */

namespace RebieKong\MpTools\ResponseWorker\Message;

use RebieKong\MpTools\ResponseWorker\AbstractResponseWorker;

class ShortVideo extends AbstractResponseWorker
{
    protected function getTag()
    {
        return 'short_video';
    }
}