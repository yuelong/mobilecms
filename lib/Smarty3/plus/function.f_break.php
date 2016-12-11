<?php
/**

 * [Gimoo!] (C)2006-2009 Gimoo Inc. (http://fend.gimoo.net)
 *
 * 获取来访URL,用于跳转使用
 *



 * @version $Id: function.f_break.php 3 2011-12-29 15:01:09Z gimoo $
 * @param   $params
 */

function smarty_function_f_Break($pars)
{
    $key=empty($pars['fn']) ? '__url' : $pars['fn'];
    if(empty($_POST[$key])){
        $url=@$_SERVER['HTTP_REFERER'];
    }else{
        $url=$_POST[$key];
    }
    return $url;
}
?>
