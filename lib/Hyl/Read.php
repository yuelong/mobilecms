<?php

/**
 * 通用读取
 *
 * @Author  Yuelong <admin@hyl.me>
 * @version $Id$
 */
class Hyl_Read extends Db_Init
{

    private $db;

    public static function Factory()
    {
        static $in = null;
        if (null === $in) {
            $in = new self();
        }
        return $in;
    }

    public function __construct()
    {
        $this->db = Db_Hyl::Factory('r');
    }

    /**
     * 获取单条信息
     *
     * @param int $id 信息ID
     * @return array
     * */
    public function get($id, $e = '*')
    {
        $rs = $this->db->get("SELECT {$e} FROM {$this->table} WHERE id={$id}");
        return empty($rs) ? array() : $rs;
    }

    /**
     * 列表查询
     *
     * @param  int $psize 每页显示条目
     * @param  int $skip  跳过多少条
     * @return array
     * */
    public function getList($psize = 10, $skip = 0, $reset = 1)
    {
        $item = array();

        // 查询列表
        $q = $this->db->query("SELECT {$this->_field} FROM {$this->_table} {$this->_where} {$this->_order} LIMIT {$skip},{$psize}");
        while ($rs = $this->db->fetch($q)) {
            $item[] = $rs;
        }

        if ($reset) {
            $this->reSet();
        }
        return $item;
    }

    /**
     * 获取列表-文章ID
     *
     * @param int $aid   文章ID
     * @return int
     * */
    public function getTotal()
    {
        $count = (int) $this->db->get("SELECT COUNT(*) FROM {$this->_table} {$this->_where} ", 1);
        return $count;
    }

}
