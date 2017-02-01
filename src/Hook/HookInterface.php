<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-29
 * Time: 上午9:09
 */

namespace RebieKong\MpTools\Hook;


interface HookInterface
{

    const HOOK_MSG_TEXT = 'text';
    const HOOK_MSG_IMAGE = 'image';
    const HOOK_MSG_VIDEO = 'video';
    const HOOK_MSG_SHORT_VIDEO = 'short_video';
    const HOOK_MSG_VOICE = 'voice';
    const HOOK_MSG_LINK = 'link';
    const HOOK_MSG_LOCATION = 'location';
    const HOOK_FUNCTION_NOT_EXIST='HOOK_NOT_EXIST';
    const HOOK_FUNCTION_CALL_ERROR='HOOK_CALL_ERROR';

    public function hook($tag, callable $function, $extParam = []);

    public function hookForce($tag, callable $function, $extParam = []);

    public function call($tag,$params);
}