<?php
/**

 * [Gimoo!] (C)2006-2009 Gimoo Inc. (http://fend.gimoo.net)
 *
 * 数据库加载器,通过该模块进行加载与切换数据库应用
 * 如MYSQL MYSQLI Sqlserver等
 * 注意: 所有对象必须符合Fend_Db_Base标准
 *



 * @version $Id: Db.php 13 2012-02-12 15:36:56Z gimoo $
 */
!defined('FD_DBC') && define('FD_DBC', 'Mysqli');

class Fend_Db
{
    /**
     * 工厂模式 静态激活对象
     * @param  string $dbc 数据库类型
     * @param  string $r   连接标识
     * @return object
     */
    public static function factory($r=null,$dbc=null)
    {
        static $_obj=array();
        null===$r && $r='-1';

        //是否需要重新连接
        if(!isset($_obj[$r])){

            null===$dbc && $dbc=FD_DBC;
            $dbc='Fend_Db_'.ucfirst($dbc);

            $_obj[$r]= & new $dbc();
            $r>=0 && $_obj[$r]->getConn($r);

        }

        return $_obj[$r];
    }
}
?>