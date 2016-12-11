<?php
/**

 * [Gimoo!] (C)2006-2009 Gimoo Inc. (http://Fend.Gimoo.Net)
 *
 * 301重定向
 * 默认定向到来访页面
 *
 * @param string $url 转向的URL地址
 * @return void
 *



 * @version $Id: fend.dobreak.php 3 2011-12-29 15:01:09Z gimoo $
 */

function doBreak($url=null)
{
    header('location:'.(!$url ? $_SERVER['HTTP_REFERER'] : $url));exit;
}
?>