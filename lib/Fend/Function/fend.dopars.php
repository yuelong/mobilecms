<?php
/**

 * [Gimoo!] (C)2006-2009 Eduu Inc. (http://www.eduu.com)
 *
 * 重新处理URL信息
 *
 * @param string $key   赋值的键
 * @param string $value 赋予的值
 * @return string
 * @--------------------------------

 * @Support http://bbs.eduu.com

 * @version $Id: fend.dopars.php 3 2011-12-29 15:01:09Z gimoo $
 */

function dopars($key,$value)
{
    parse_str($_SERVER['QUERY_STRING'],$pars);
    $pars[$key]=$value;
    $pars=http_build_query($pars);
    return $pars;
}

?>