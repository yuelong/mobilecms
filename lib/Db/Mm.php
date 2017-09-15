<?php

/**
 * mm.2046.in DB
 *
 * @version $Id$
 */
class Db_Mm extends Fend_Db_Mysqli
{

    static $in = array();

    public static function Factory($r)
    {
        !isset(self::$in[$r]) && self::$in[$r] = new self($r);
        return self::$in[$r];
    }

    //初始化Mysql对象并进行连接服务器尝试
    public function __construct($r)
    {
        $this->_cfg = $this->db_mm[$r];
        !isset($this->_cfg['port']) && $this->_cfg['port'] = '3306';
        $this->_db = new mysqli($this->_cfg['host'], $this->_cfg['user'], $this->_cfg['pwd'], $this->_cfg['name'], $this->_cfg['port']);

        if (mysqli_connect_errno()) {
            self::showMsg("Connect failed: " . mysqli_connect_error());
        }

        $this->_db->query("SET character_set_connection={$this->_cfg['lang']},character_set_results={$this->_cfg['lang']},character_set_client=binary,sql_mode='';");
    }

    //清理DB连接
    public static function clean()
    {
        //关闭库连接
        foreach (self::$in as $obj) {
            $obj->_db->close();
        }

        //销毁变量
        self::$in = array();
    }

}
