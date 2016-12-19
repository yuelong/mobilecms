<?php

/**
 *
 * 热门
 *
 * @version $Id$
 */
class HotLib extends Common
{

    public function indexFend()
    {
        $tmy = array();
        $act = $this->act;
        $a_permit = ['members', 'articles', 'mps', 'books', 'children'];
        if (in_array($act, $a_permit)) {
            //存在私有方法再调用
            if (method_exists($this, $act)) {
                $tmy['list'] = $this->$act();
            }
            self::regVar($tmy);
            self::showView('hot/' . $this->act);
            return;
        }
        self::regVar($tmy);
        self::showView('index');
    }

    /*
     * 热门用户
     */

    private function members()
    {
        $func = __FUNCTION__;
    }

    /*
     * 热门文章
     */

    private function articles()
    {
        $func = __FUNCTION__;
    }

    /*
     * 热门公众号
     */

    private function mps()
    {
        $func = __FUNCTION__;
        $field = '*';
        return Hyl_Read::Factory()->table('hyl_mp_members')->field($field)->getlist(20, 0);
    }

    /*
     * 热门图书
     */

    private function books()
    {
        $func = __FUNCTION__;
    }

    /*
     * 热门图书
     */

    private function children()
    {
        $func = __FUNCTION__;
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
