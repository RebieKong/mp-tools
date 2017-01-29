<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-28
 * Time: 下午10:22
 */


namespace RebieKong\MpTools;


use PreviewFramework\Utils\ArrayUtils;
use RebieKong\MpTools\Core\MpCore;
use RebieKong\MpTools\Core\MpReceiver;
use RebieKong\MpTools\Hook\HookInterface;

class MpTask
{

    private $hook;

    public function __construct(HookInterface $hook)
    {
        $this->hook = $hook;
    }

    public function run($appId, $appSecret, $token, $aesKey)
    {
        $mp   = new MpCore($appId, $appSecret, $token, $aesKey);
        $data = file_get_contents("php://input");
        if ( ! $mp->validateSign()) {
            $result = 'some thing wrong';
        } else {
            if (empty($data)) {
                $result = ArrayUtils::get($_GET, 'echostr');
            } else {
                $receiver = MpReceiver::init($data, $this->hook,$mp);
                $result   = $receiver->getResult();
                if ($result === false) {
                    $result = 'success';
                } else {
                    $result = $mp->encrypt($result);
                }
            }
        }

        return $result;
    }

}