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
use RebieKong\MpTools\Exception\HookException;
use RebieKong\MpTools\Hook\HookInterface;

abstract class AbstractResponseWorker
{
    use ObjectTrait;

    abstract protected function getTag();

    /**
     * @var HookInterface
     */
    protected $hook;

    public function __construct($hook)
    {
        $this->hook = $hook;
    }

    public function _getResult(MessageBean $bean)
    {
        try {
            $response = $this->hook->call($this->getTag(), ['bean' => $bean]);
        } catch (HookException $exception) {
            $response = $exception->handle();
        }
        return $response;

    }
}