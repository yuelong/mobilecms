<?php

/**
 * 跳转email地址
 *
 * @version $Id$
 */
final class Conf_Email
{

    //数组定义
    public static $email_server = array(
        '@163.com'        => 'http://mail.163.com/',
        '@126.com'        => 'http://mail.126.com/',
        '@yeah.net'       => 'http://www.yeah.net/',
        '@vip.163.com'    => 'http://vip.163.com/',
        '@vip.188.com'    => 'http://www.188.com/',
        '@sina.com'       => 'http://mail.sina.com.cn',
        '@sina.cn'        => 'http://mail.sina.com.cn',
        '@vip.sina.com'   => 'http://mail.sina.com.cn',
        '@my3ia.sina.com' => 'http://mail.sina.com.cn',
        '@2008.sina.com'  => 'http://mail.2008.sina.com.cn',
        '@sohu.com'       => 'http://mail.sohu.com',
        '@vip.sohu.com'   => 'http://vip.sohu.com',
        '@139.com'        => 'http://mail.10086.cn',
        '@189.cn'         => 'http://webmail5.189.cn/webmail',
        '@eyou.com'       => 'http://www.eyou.com',
        '@21cn.com'       => 'http://mail.21cn.com/login',
        '@qq.com'         => 'http://mail.qq.com',
        '@gmail.com'      => 'https://mail.google.com',
    );

    //取得一个邮箱的服务商地址
    public static function get($email)
    {
        $email = strpbrk($email, '@');
        if (isset(self::$email_server[$email])) {
            return self::$email_server[$email];
        } else {
            return str_replace('@', 'http://mail.', $email);
        }
    }

}
