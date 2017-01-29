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
use RebieKong\MpTools\ResponseWorker\ResponseGainer;

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
            switch ($exception->getCode()) {
                case HookException::HOOK_NOT_EXIST:
                    $response = ResponseGainer::genTextResult("没有哦相关监听",$bean);
                    break;
                case HookException::HOOK_CALL_ERROR:
                    $response = ResponseGainer::genTextResult("钩子程序调用异常",$bean);
                    break;
                default:
                    $response = 'success';
                    break;
            }
        }
        return $response;

    }
}