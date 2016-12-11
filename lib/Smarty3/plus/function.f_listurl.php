<?php
/**

 * [Gimoo!] (C)2006-2009 Gimoo Inc. (http://fend.gimoo.net)
 *
 * 处理列表的URL连接
 *



 * @version $Id: function.f_param.php 3 2011-12-29 15:01:09Z gimoo $
 * @param   $pars
 */

function smarty_function_f_ListUrl($pars)
{
    static $u = null;
    if (null === $u) {
        $u=array();
        $u = array_pad($u, Movie_Conf::LIST_ARGV_LEN, 0);
    }

    // 类型
    if (isset($pars['type'])) {
        $tid = $pars['type'];
        $u[0] = @Movie_Conf::$type_txt[$tid];
    }else{
        $u[0] = Movie_Conf::$type_txt[Movie_Conf::TP_TV];
    }

    //年代
    if (isset($pars['year'])) {
        $u[1] = $pars['year'];
    }

    // 字母
    if (isset($pars['en'])) {
        $u[2] = $pars['en'];
    }

    // 地区
    if (isset($pars['area'])) {
        $u[3] = $pars['area'];
    }

    // 标签
    if (isset($pars['tag'])) {
        $u[4] = $pars['tag'];
    }

    // 排序
    if (isset($pars['order'])) {
        $u[5] = $pars['order'];
    }

    // 分页
    if (isset($pars['page'])) {
        $u[6] = $pars['page'];
    }else{
        $u[6] = 1;
    }

    $_tmp = 'list/'.join('-',$u).'.html';
    return $GLOBALS['_dm']['index'].$_tmp;
}
?>
