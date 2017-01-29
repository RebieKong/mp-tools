<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-29
 * Time: 下午3:40
 */

namespace RebieKong\MpTools\Hook;


use RebieKong\MpTools\Entity\MessageBean;

abstract class HookFunction
{
    abstract public function run(MessageBean $bean);
}