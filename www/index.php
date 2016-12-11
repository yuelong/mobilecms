<?php

/**
 *
 * 入口文件
 *
 * @version $Id$
 */
//--异常处理
try {
    require_once('../router.php');
    Fend_Acl::Factory()->setAcl($aclcfg);
    isset($aclmod) && Fend_Acl::Factory()->setModule($aclmod);
    Fend_Acl::Factory()->run($mods);
} catch (Fend_Exception $e) {
    if (defined('XD_LOCAL') && XD_LOCAL) {
        $e->ShowTry(FD_DEBUG);
    } else {
        Fend_Log::write($e->getMessage() . ' - ' . $mods, 'acl.log');
        Fend_Acl::Factory()->run('/default/index/error/');
    }
}