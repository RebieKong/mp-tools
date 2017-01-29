<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-30
 * Time: 上午12:31
 */

namespace RebieKong\MpTools\Exception;


class HookException extends MpException
{

    const HOOK_NOT_EXIST = 1;
    const HOOK_CALL_ERROR = 2;

    public function __construct($code, $message = '')
    {
        parent::__construct($message, $code, null);
    }
}