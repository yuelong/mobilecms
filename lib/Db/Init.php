<?php

/**
 * DB查询基类
 * @version $Id$
 * */
class Db_Init extends Fend
{

    // 排序
    protected $_order = null;
    // 条件
    protected $_where = null;
    // 字段
    protected $_field = '*';
    // 表
    protected $_table = null;

    /**
     * 设置表名字
     * @param type $table
     * @return \Db_Init
     */
    public function table($table)
    {
        if (!empty($table)) {
            $this->_table = $table;
        }
        return $this;
    }

    /**
     * 设置查询字段
     * @param type $field
     * @return \Db_Init
     */
    public function field($field)
    {
        if (!empty($field)) {
            $this->_field = $field;
        }
        return $this;
    }

    /**
     * 设置排序-降序
     *
     * @param  str $name   排序字段
     * @return void
     * */
    public function desc($name)
    {
        if (func_num_args() <= 0) {
            if (!$this->_order) {
                $this->_order = "ORDER BY {$name} DESC";
            } else {
                $this->_order .= ",{$name} DESC";
            }
        } else {
            $args = func_get_args();
            foreach ($args as $value) {
                if (!$this->_order) {
                    $this->_order = "ORDER BY {$value} DESC";
                } else {
                    $this->_order .= ",{$value} DESC";
                }
            }
        }
        return $this;
    }

    /**
     * 设置排序-升序
     *
     * @param  str $name   排序字段
     * @return void
     * */
    public function asc($name)
    {
        if (func_num_args() <= 0) {
            if (!$this->_order) {
                $this->_order = "ORDER BY {$name} ASC";
            } else {
                $this->_order .= ",{$name} ASC";
            }
        } else {
            $args = func_get_args();
            foreach ($args as $value) {
                if (!$this->_order) {
                    $this->_order = "ORDER BY {$value} ASC";
                } else {
                    $this->_order .= ",{$value} ASC";
                }
            }
        }
        return $this;
    }

    /**
     * 设置排序
     *
     * @param  str $name   排序字段
     * @param  str $type   排序方法
     * @return void
     * */
    public function order($name, $type = 'DESC')
    {
        $type = strtoupper($type);

        if ($type == 'DESC') {
            self::setOrderDesc($name);
        } elseif ($type == 'ASC') {
            self::setOrderAsc($name);
        }
        return $this;
    }

    /**
     * 设置查询-普通条件
     *
     * @param  str $name   配需字段
     * @param  str $value  查询值
     * @param  str $type   排序方式 0=and 1=or
     * @return void
     * */
    public function where($name, $value, $type = 0)
    {
        !$this->_where && $this->_where = 'WHERE 1';

        if (!$type) {
            $this->_where .= " AND";
        } else {
            $this->_where .= " OR";
        }

        // 配置查询
        if (is_int($value)) {
            $this->_where .= " {$name}={$value}";
        } elseif (is_array($value)) {
            foreach ($value as &$v) {
                !is_numeric($v) && $v = "'{$v}'";
            }
            $value = join(',', $value);
            $this->_where .= " {$name} IN ({$value})";
        } else {
            $value = mysql_escape_string($value);
            $this->_where .= " {$name}='{$value}'";
        }
        return $this;
    }

    /**
     * 设置筛选-搜索条件
     *
     * @param  str $name   配需字段
     * @param  str $value  查询值
     * @param  str $type   排序方式 0=and 1=or
     * @return void
     * */
    public function like($name, $value, $type = 0)
    {
        !$this->_where && $this->_where = 'WHERE 1';

        if (!$type) {
            $this->_where .= " AND";
        } else {
            $this->_where .= " OR";
        }

        // 配置查询
        $value = mysql_escape_string($value);
        $this->_where .= " {$name} LIKE '{$value}'";
        return $this;
    }

    /**
     * 设置筛选-findinset
     *
     * @param  str $name   配需字段
     * @param  str $value  查询值
     * @param  str $type   排序方式 0=and 1=or
     * @return void
     * */
    public function find($name, $value, $type = 0)
    {
        !$this->_where && $this->_where = 'WHERE 1';

        if (!$type) {
            $this->_where .= " AND";
        } else {
            $this->_where .= " OR";
        }

        // 配置查询
        if (is_numeric($value)) {
            $this->_where .= " FIND_IN_SET({$value},{$name})";
        } else {
            $value = mysql_escape_string($value);
            $this->_where .= " FIND_IN_SET('{$value}',{$name})";
        }
        return $this;
    }

    /**
     * 设置筛选-findinset
     *
     * @param  str $name   配需字段
     * @param  str $value  查询值
     * @param  str $type   排序方式 0=and 1=or
     * @return void
     * */
    public function other($sql, $type = 0)
    {
        !$this->_where && $this->_where = 'WHERE 1';

        if (!$type) {
            $this->_where .= " AND";
        } else {
            $this->_where .= " OR";
        }

        $this->_where .= ' ' . $sql;
        return $this;
    }

    /**
     * 重置设置
     *
     * @param  void
     * @return void
     */
    public function reSet()
    {
        $this->_field = '*';
        $this->_table = null;
        $this->_where = null;
        $this->_order = null;
        $this->_group = null;
    }

}
