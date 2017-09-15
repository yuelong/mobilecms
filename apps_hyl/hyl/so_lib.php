<?php

/**
 *
 * 搜索
 *
 * @version $Id$
 */
class SoLib extends Common
{

    public function IndexFend()
    {
        $key = urldecode(doGet('q'));
        echo $key;
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
