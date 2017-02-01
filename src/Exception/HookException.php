<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-30
 * Time: 上午12:31
 */

namespace RebieKong\MpTools\Exception;


use RebieKong\MpTools\Entity\MessageBean;
use RebieKong\MpTools\Hook\HookInterface;

class HookException extends MpException
{

    const HOOK_NOT_EXIST = 1;
    const HOOK_CALL_ERROR = 2;

    public function __construct($code, $message = '')
    {
        parent::__construct($message, $code, null);
    }

    /**
     * @param MessageBean $bean
     * @param HookInterface $hook
     *
     * @return string
     */
    public function handle($bean, $hook)
    {

        switch ($this->getCode()) {
            case HookException::HOOK_NOT_EXIST:
                $response = $hook->call('HOOK_NOT_EXIST', ['bean' => $bean]);
                break;
            case HookException::HOOK_CALL_ERROR:
                $response = $hook->call('HOOK_CALL_ERROR', ['bean' => $bean]);
                break;
            default:
                $response = 'success';
                break;
        }
        return $response;
    }
}