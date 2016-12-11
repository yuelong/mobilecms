<?php
/**
 *
 * 首页
 *

 * @version $Id$
 */

class IndexLib extends Router
{
    public function IndexFend()
    {
        self::showMsg('No meide',0);
    }

    // 模块不存在
    public function errorFend()
    {
        self::showMsg('ni fang wen de madou bu cun zai',0);
    }
}
?>