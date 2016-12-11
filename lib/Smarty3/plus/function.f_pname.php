<?php
/**

 * [Gimoo!] (C)2006-2009 Gimoo Inc. (http://fend.gimoo.net)
 *
 * 直接获取权限名称
 * 输出为页面名称/标题
 *



 * @version $Id: function.f_pname.php 3 2011-12-29 15:01:09Z gimoo $
 * @param   $params
 */

function smarty_function_f_pname($pars)
{
    $_tem=isset($GLOBALS['_pwcfg']['name']) ? $GLOBALS['_pwcfg']['name'] : null;
    if(isset($pars['name'])){
        $_tem=empty($_tem) ? $pars['name'] : $_tem.' - '.$pars['name'];
    }
    return $_tem;
}
?>
