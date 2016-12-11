<?php
/**

 * IP白名单设置
 *

 * @version $Id$
 */

final class Conf_Ip
{
    // 允许ip
    public static $allows = array(
        '127.0.0.1',
    );

    // 检测当前ip是否被允许
    public static function check($ip)
    {
        return in_array($ip,Conf_Ip::$allows);
    }
}
?>