<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-29
 * Time: 上午9:09
 */

namespace RebieKong\MpTools;


interface HookInterface
{

    public function hook($tag, callable $function, $extParam = []);

    public function hookForce($tag, callable $function, $extParam = []);

    public function call($tag,$params);
}