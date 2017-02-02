<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-2-1
 * Time: 下午4:53
 */

namespace RebieKong\MpTools;


use RebieKong\MpTools\Entity\MessageBean;
use RebieKong\MpTools\Hook\HookFunction;
use RebieKong\MpTools\ResponseWorker\ResponseGainer;

class MpHookFunction extends HookFunction
{

    public function run(MessageBean $bean)
    {
        return call_user_func([
            $this,
            'run',
        ], $bean);
    }

    /**
     * @var \Closure
     */
    private $function;

    public function __construct(callable $function = null)
    {
        if ( ! is_null($function) && is_callable($function)) {
            $this->setFunction($function);
        }
    }

    public function setFunction(callable $function)
    {
        if (is_callable($function)) {
            $this->function = $function;
        }
    }

    public static function getNullFunction()
    {
        $function = new static();
        $function->setFunction(function ($bean) {
            return ResponseGainer::nullResult();
        });

        return $function;
    }
}