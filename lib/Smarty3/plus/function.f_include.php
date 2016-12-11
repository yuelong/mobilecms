<?php
/**

 * [Gimoo!] (C)2006-2009 Gimoo Inc. (http://fend.gimoo.net)
 *
 * 载入其他模板并编译
 *



 * @version $Id: function.f_include.php 3 2011-12-29 15:01:09Z gimoo $
 *
 *
 * @param integer $pars 传递进的参数
 * @param boolean $sty  Smarty对象
 */

function smarty_function_f_include($pars,&$sty,&$tpl)
{
    static $_cmsDIR=null;
    $_tem=null;
    if(isset($pars['file'])){
        !isset($pars['fn']) && $pars['fn']=0;
        switch($pars['fn']){
            case '0'://取得当前目录
                if(null===$_cmsDIR){
                    $_cmsDIR=dirname($tpl->template_resource);
                    in_array($_cmsDIR,array('.','\\','/')) && $_cmsDIR='';
                    $_cmsDIR && $_cmsDIR.='/';
                }
                $_tem=$sty->fetch($_cmsDIR.$pars['file']);
                break;
            case '1'://模块目录
                $fpath=$sty->template_dir.$GLOBALS['_uri'][1].'/'.$pars['file'];
                $_tem=$sty->fetch($fpath);
                break;
            default://指定的目录
                $fpath=$sty->template_dir.$pars['fn'].'/'.$pars['file'];
                $_tem=$sty->fetch($fpath);
                break;
        }
    }
    return $_tem;
}
?>
