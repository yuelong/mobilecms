<?php

/**
 *
 * 文档
 *
 * @version $Id$
 */
class DocLib extends Common
{

    public function __construct()
    {

    }

    public function indexFend()
    {
        $a_permit = ['how'];
        if (in_array($this->act, $a_permit)) {
            //self::regVar($tmy);
            self::showView('doc/' . $this->act);
            return;
        }
        $tmy = array();
        self::regVar($tmy);
        self::showView('index');
    }

    // 模块不存在
    public function errorFend()
    {
        if (substr($this->host, 0, 3) == 'api') {
            self::showMsg(null, 0, '你访问的模块不存在');
        } else {
            header('Expires: 0');
            header("HTTP/1.0 404 Not Found");
            self::showError();
            // die('404');
        }
    }

}
