<?php
/**

 * [Gimoo!] (C)2006-2009 Gimoo Inc. (http://fend.gimoo.net)
 *
 * 获取URL Params分析并处理
 *



 * @version $Id: function.f_param.php 3 2011-12-29 15:01:09Z gimoo $
 * @param   $pars
 */

function smarty_function_f_param($pars)
{
    if(!isset($GLOBALS['_URLparam'])){
        parse_str($_SERVER['QUERY_STRING'],$GLOBALS['_URLparam']);
    }
    $_tem=(array)$GLOBALS['_URLparam'];
    foreach($pars as $k=>&$v) $_tem[$k]=$v;
    $_tem=http_build_query($_tem);
    return $_tem;
}
?>
