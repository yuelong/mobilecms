<?php

/**
 * 通用读取
 *
 * @Author  Yuelong <admin@hyl.me>
 * @version $Id$
 */
class Hyl_Mp_Members_Read extends Db_Init
{

    private $table = 'hyl_mp_members';

    public static function Factory()
    {
        static $in = null;
        if (null === $in) {
            $in = new self();
        }
        return $in;
    }

}
