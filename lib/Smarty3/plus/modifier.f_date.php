<?php
/**

 * [Gimoo!] (C)2006-2009 Eduu Inc. (http://www.eduu.com)
 *
 * 格式化时间戳
 *

 * @Support http://bbs.eduu.com

 * @version $Id: modifier.f_date.php 3 2011-12-29 15:01:09Z gimoo $
 */

function smarty_modifier_f_date($string, $format = 'Y-m-d')
{
    $string=(int)$string;
    $string==0 && $string=time();
    return date($format, $string);
}
?>