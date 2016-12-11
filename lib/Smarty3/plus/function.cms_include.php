<?php
/**

 * [Gimoo!] (C)2006-2009 Gimoo Inc. (http://fend.gimoo.net)
 *
 * 载入其他模板并编译
 *



 * @version $Id: function.cms_include.php 3 2011-12-29 15:01:09Z gimoo $
 *
 *
 * @param integer $pars 传递进的参数
 * @param boolean $sty  Smarty对象
 */

function smarty_function_CMS_include($pars, &$sty,&$tpl){
    $_tem=null;
    if(isset($pars['file'])){
        !isset($pars['fn']) && $pars['fn']=0;
        switch($pars['fn']){
            case '0'://取得当前目录
                if(!isset($sty->_cmsTPLdir)){
                    $sty->_cmsTPLdir=dirname($tpl->template_resource);
                    in_array($sty->_cmsTPLdir,array('.','\\','/')) && $sty->_cmsTPLdir='';
                    $sty->_cmsTPLdir && $sty->_cmsTPLdir.='/';
                }
                $_tem=$sty->fetch($sty->_cmsTPLdir.$pars['file']);
                break;
            case 'cache'://缓存目录下
                $_tem=@file_get_contents($sty->cache_dir.$pars['file']);
                break;
            case '1'://模块目录
                $fpath=@$GLOBALS['_uri'][1];
                $fpath=$sty->template_dir.$fpath.'/'.$pars['file'];
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
