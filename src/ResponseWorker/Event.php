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

class Event extends AbstractResponseWorker
{

    public function _getResult(MessageBean $bean)
    {
        $event = $bean->event;
        $event = ucfirst(strtolower($event));
        // TODO 封装一个基于命名空间的自动唤起类的方法
        $class = '\app\mp\core\Event\\'.$event;
        if (class_exists($class)) {
            $ref = new \ReflectionClass($class);
            if ($ref->getParentClass()->getName() == 'app\mp\WxApp\ResponseWorker') {
                /** @var AbstractResponseWorker $eventObject */
                $eventObject = new $class;
                return $eventObject->_getResult($bean);
            }
        }
        return false;
    }
}