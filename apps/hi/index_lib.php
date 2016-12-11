<?php
/**

 *
 * 登录模块
 * 获取当前应用的可升级的版本信息
 *


 * @version $Id$
 */

class indexLib extends Common
{
    // 首页
    public function indexFend()
    {
        $tmy = array();
        self::regVar($tmy);
        self::showView('index');
    }

}
