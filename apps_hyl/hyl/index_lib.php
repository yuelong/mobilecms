<?php

/**
 *
 * 首页
 *
 * @version $Id$
 */
class IndexLib extends Common
{

    public function IndexFend()
    {
        $tmy = array();
        self::regVar($tmy);
        self::showView('index');
    }

    // 模块不存在
    public function errorFend()
    {
        if (substr($this->host, 0, 4) == 'mapi') {
            self::showMsg(null, 0, '你访问的模块不存在');
        } else {
            header('Expires: 0');
            header("HTTP/1.0 404 Not Found");
            self::showError();
            // die('404');
        }
    }

}
