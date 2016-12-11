<?php
/**

 * [Gimoo!] (C)2006-2009 Gimoo Inc. (http://fend.gimoo.net)
 *
 * 获取头像路径
 * {f_pic uid=$uid tp='s' fp=1}
 *


 * @version $Id: function.f_pic.php 3 2011-12-29 15:01:09Z gimoo $
 * @param   $params
 */

function smarty_function_f_pic($pars)
{
    static $tps = array('s' => '_small.gif', 'm' => '_middle.gif', 'b' => '_big.gif');

    $tp=empty($pars['tp']) ? 'b' : $pars['tp'];
    $uid=isset($pars['uid']) ? (int)$pars['uid'] : 0;

    // 如果uid为0则是默认图片
    if ($uid<=0) {
        $ex = isset($tps[$tp]) ? $tps[$tp] : $tps['s'];
        $url= $GLOBALS['_dm']['atth'].'avatar/noavatar'.$ex;
    }else{
        $url=Conf_User::getPic($uid, $tp, 1);
    }
    return $url;
}
?>
