<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-29
 * Time: 上午9:17
 */

namespace RebieKong\MpTools;


use PreviewFramework\Utils\ArrayUtils;
use RebieKong\MpTools\Hook\HookInterface;

class MpHook implements HookInterface
{

    private $hooks = [];

    public function hook($tag, callable $function, $extParam = [])
    {
        if (!ArrayUtils::constanceKey($this->hooks, $tag)) {
            $this->hooks[ $tag ] = [
                'function' => $function,
                'ext'      => $extParam,
            ];

            return true;
        }

        return false;
    }

    public function hookForce($tag, callable $function, $extParam = [])
    {
        $this->hooks[ $tag ] = [
            'function' => $function,
            'ext'      => $extParam,
        ];
    }

    public function call($tag, $params)
    {
        if ( ! ArrayUtils::constanceKey($this->hooks, $tag)) {
            return null;
        }

        $c        = ArrayUtils::get($this->hooks, $tag);
        $callable = ArrayUtils::get($c, 'function');
        $params   = array_merge($params, ArrayUtils::get($c, 'ext'));

        if ( ! is_callable($callable)) {
            return false;
        }

        return @call_user_func_array($callable, $params);
    }
}