<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-19
 * Time: 下午4:36
 */

namespace RebieKong\MpTools\Core;


use PreviewFramework\Utils\ObjectTrait;
use RebieKong\MpTools\Entity\MessageBean;

abstract class AbstractResponseWorker
{

    use TGenResult;
    use ObjectTrait;

    abstract public function _getResult(MessageBean $bean);
}