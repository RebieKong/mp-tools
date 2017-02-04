<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-29
 * Time: 上午9:17
 */

namespace RebieKong\MpTools;


use PreviewFramework\Utils\ArrayUtils;
use RebieKong\MpTools\Exception\HookException;
use RebieKong\MpTools\Hook\HookFunction;
use RebieKong\MpTools\Hook\HookInterface;
use RebieKong\MpTools\ResponseWorker\ResponseGainer;

class MpHook implements HookInterface
{

    public function __construct()
    {
        $this->addHookNotExistFunction(function ($bean) {
            $response = ResponseGainer::genTextResult("没有的相关监听事件", $bean);
            return $response;
        });
        $this->addHookCallErrorFunction(function ($bean) {
            $response = ResponseGainer::genTextResult("钩子程序调用异常", $bean);
            return $response;
        });
    }

    private $hooks = [];

    public function hook($tag, $function, $extParam = [])
    {
        if (!ArrayUtils::constanceKey($this->hooks, $tag)) {
            $this->hookForce($tag, $function, $extParam);
            return true;
        }

        return false;
    }

    public function hookForce($tag, $function, $extParam = [])
    {
        $this->hooks[ $tag ] = [
            'function' => $function,
            'ext'      => $extParam,
        ];
    }

    public function call($tag, $params)
    {
        if ( ! ArrayUtils::constanceKey($this->hooks, $tag)) {
            throw new HookException(HookException::HOOK_NOT_EXIST);
        }

        $c        = ArrayUtils::get($this->hooks, $tag);
        $callable = ArrayUtils::get($c, 'function');
        $params   = array_merge($params, ArrayUtils::get($c, 'ext'));

        if ($callable instanceof HookFunction) {
            $callable = [
                $callable,
                'run',
            ];
        }

        if ( ! is_callable($callable) || empty($response = @call_user_func_array($callable, $params))) {
            throw new HookException(HookException::HOOK_CALL_ERROR);
        }

        return $response;
    }

    public function addHookNotExistFunction($function)
    {
        $this->hookForce(HookInterface::HOOK_FUNCTION_NOT_EXIST, $function);
    }

    public function addHookCallErrorFunction($function)
    {
        $this->hookForce(HookInterface::HOOK_FUNCTION_CALL_ERROR, $function);
    }
}