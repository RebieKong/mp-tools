# 微信公众号开发组件
---------------------

### QuickStart
---------------------

composer require rebie-kong/mp-tools
```php
// Hooker.php
class Hooker extends MpHook
{
    public function __construct()
    {
        parent::__construct();

        $function = new MpHookFunction(function(MessageBean $bean){
            if ($bean->content =='不理我'){
                return ResponseGainer::nullResult();
            }
            return ResponseGainer::genTextResult(sprintf("你发送的消息是：%s",$bean->content),$bean);
        });
        $this->hook(HookInterface::HOOK_MSG_TEXT,$function);
    }
}
```
```php
// Controller.php
class Controller
{
    public function action(){
        $mpConfig = [];
        $hooker = new Hooker();
        $runner = new MpTask($hooker);

        $response = $runner->run($mpConfig['app_id'], $mpConfig['app_secret'], $mpConfig['token'],
            $mpConfig['aes_key']);
    }
}
```
上述代码实现了当用户发送文字信息时回复```你发送的消息是：%s```

当发送```不理我```时不回复

其他消息事件将会因为没有被hook而报告错误

### Business Support
-------------------------------

本组件仅许可非商业开源，如用于商用请联系[开发者邮箱](mailto:main@rebiekong.com)