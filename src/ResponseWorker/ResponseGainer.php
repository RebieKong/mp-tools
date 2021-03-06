<?php
/**
 * Created by PhpStorm.
 * User: rebie
 * Date: 17-1-13
 * Time: 下午4:31
 */

namespace RebieKong\MpTools\ResponseWorker;


use RebieKong\MpTools\Entity\MessageBean;

class ResponseGainer
{

    public static function genNewResult($articles, MessageBean $dataBean)
    {
        $articleItemXml = <<<XML
<item>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>
XML;
        $xml = <<<XML
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>%d</ArticleCount>
<Articles>
%s
</Articles>
</xml>
XML;
        $article = '';
        foreach ($articles as $item) {
            $article .= sprintf($articleItemXml, $item['title'], $item['description'], $item['pic_url'], $item['url']);
        }

        return sprintf($xml, $dataBean->fromUserName, $dataBean->toUserName, time(), count($articles),
            $article);
    }

    public static function genTextResult($content, MessageBean $dataBean)
    {
        $xml = <<<XML
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>
XML;

        return sprintf($xml, $dataBean->fromUserName, $dataBean->toUserName, time(), $content);
    }


    private static $nullStr = null;

    public static function nullResult()
    {
        if (is_null(self::$nullStr)) {
            self::$nullStr = md5(mt_rand(0, 1000));
        }

        return self::$nullStr;
    }
}