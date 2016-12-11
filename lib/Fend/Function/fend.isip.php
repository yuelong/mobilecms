<?php
/**

 * [Gimoo!] (C)2006-2009 Eduu Inc. (http://www.eduu.com)
 *
 * 检测一个IP地址是否正常
 * 只能进行模糊的检测
 *

 * @Support http://bbs.eduu.com

 * @version $Id: fend.isip.php 3 2011-12-29 15:01:09Z gimoo $
 */

function isIp($ip)
{
    return preg_match('/^\d{0,3}\.\d{0,3}\.\d{0,3}\.\d{0,3}$/',$ip) ? true : false;
}
?>