<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-30
 * Time: 上午12:31
 */

namespace RebieKong\MpTools\Exception;


use RebieKong\MpTools\ResponseWorker\ResponseGainer;

class HookException extends MpException
{

    const HOOK_NOT_EXIST = 1;
    const HOOK_CALL_ERROR = 2;

    public function __construct($code, $message = '')
    {
        parent::__construct($message, $code, null);
    }

    public function handle(){

        switch ($this->getCode()) {
            case HookException::HOOK_NOT_EXIST:
                $response = ResponseGainer::genTextResult("没有的相关监听事件", $bean);
                break;
            case HookException::HOOK_CALL_ERROR:
                $response = ResponseGainer::genTextResult("钩子程序调用异常",$bean);
                break;
            default:
                $response = 'success';
                break;
        }
        return $response;
    }
}