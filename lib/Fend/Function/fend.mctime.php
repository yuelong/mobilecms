<?php
/**

 * [Gimoo!] (C)2006-2009 Gimoo Inc. (http://Fend.Gimoo.Net)
 *
 * 取得Microtime精确时间
 *
 * @return float
 * @--------------------------------



 * @version $Id: fend.mctime.php 3 2011-12-29 15:01:09Z gimoo $
 */

function mcTime()
{
   list($usec, $sec) = explode(' ', microtime());
   return ((float)$usec + (float)$sec);
}
?>