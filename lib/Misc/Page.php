<?php

/**
 * 分页API对象
 * 用于动态载入及激活对象
 *
 * @version $Id$
 */
class Misc_Page
{

    /**
     * 工厂模式 静态激活对象
     * @param  string $name  数据库类型
     * @return object $in       数据库对象
     */
    public static function factory($psum, $psize = 20, $isout = 1, $pname = 'pg')
    {
        $obj = new Fend_Page_Page;
        $obj->pname = $pname;
        $item = $obj->getPage($psum, $psize);

        if ($isout) {
            return array(
                'total' => $obj->total,
                'size'  => $obj->psize,
                'limit' => $obj->limit,
                //'pname'=>$obj->pname,
                'msg'   => $item,
            );
        } else {
            return $item;
        }
    }

    /**
     * 静态激活对象
     * @param  int $psum  总条目数
     * @param  int $psize 分页基数
     * @param  str $url   分页URL表示比如: http://www.web.com/list_[*].html
     * @param  int $cpage 当前页数
     * @return array
     */
    public static function Fnice($psum, $psize = 20, $url, $cpage = 0)
    {
        $obj = new Fend_Page_Page1;
        //$obj->preg=$preg;
        $item = $obj->getPage($psum, $psize, $url, $cpage);

        return array(
            'total' => $obj->total,
            'size'  => $obj->psize,
            'limit' => $obj->limit,
            'msg'   => $item,
        );
    }

    /**
     * 获取SQL语句的统计表示方式
     * substr_replace($sql,'SELECT COUNT(*)',0,stripos($sql,' from '))
     *
     * @param  string $sql sql语句
     * @return string
     */
    public static function getCount($sql)
    {
        $l = stripos($sql, ' from ');
        $r = strripos($sql, ' order by ');
        return 'SELECT COUNT(*)' . ($r <= 0 ? substr($sql, $l) : substr($sql, $l, $r - $l));
    }

    /**
     * 获取SQL语句的统计表示方式
     * substr_replace($sql,'SELECT COUNT(*)',0,stripos($sql,' from '))
     *
     * @param  string $sql sql语句
     * @return string
     */
    public static function checkPage($mpsize = 100, $mskip = 2000)
    {
        // 分页基数，最小为1
        $psize = (int) doget('psize');
        $psize <= 0 && $psize = 20; //默认为10条
        $psize = min($psize, $mpsize);

        // 跳过多少条
        $skip = (int) doget('skip');
        $skip <= 0 && $skip = 0;
        $skip = min($skip, $mskip); //最大不能超过2000

        return array($psize, $skip);
    }

}
