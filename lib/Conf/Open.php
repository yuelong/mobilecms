<?php

/**

 * 用户相关配置
 *
 * @version $Id$
 * */
final class Conf_Open
{

    //新浪微博
    const WB_APP_TYPE = 'weibo';                           //数据库标识
    const WB_APP_KEY = '111';                      //App Key
    const WB_APP_SECRET = '222'; //App Secret
    const WB_APP_UID = '333';                      //微博ID
    //QQ
    const QQ_APP_TYPE = 'qq';                              //数据库标识
    // const QQ_APP_KEY    ='111';                       //App Key
    // const QQ_APP_SECRET ='222';//App Secret
    const QQ_APP_KEY = '333';                       //App Key
    const QQ_APP_SECRET = '444'; //App Secret
    //QQ
    const WX_APP_TYPE = 'weixin';                              //数据库标识
    const WX_APP_KEY = '111';                       //App Key
    const WX_APP_SECRET = '222'; //App Secret

    //生成URL

    public static function getUrl($type)
    {
        $url = "{$GLOBALS['_dm']['self']}open/callback?type={$type}";
        return $url;
    }

    // 检测type是否配置
    public static function checkType($t)
    {
        $arr = array(Conf_Open::WB_APP_TYPE, Conf_Open::QQ_APP_TYPE);
        return in_array($t, $arr);
    }

    /**
     * 追加URL参数
     * 检测是?&追加
     *
     * @param  string $url  url地址
     * @param  string $pars 需要追加的参数
     * @return string
     * */
    public static function subUrl($url, $pars)
    {
        if (false === strpos($url, '?')) {
            $url.='?';
        } else {
            $url.='&';
        }
        $url.=$pars;
        return $url;
    }

}

?>