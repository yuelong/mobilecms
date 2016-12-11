<?php

/**
 *
 * Cache公共初始化方法
 * 主要是为了解决每个需要cache的对象多次实例化暂用redis服务器的连接资源
 *
 * @version $Id$
 */
class Misc_Cache
{

    /**
     * 值得注意
     * 该方法主要是用于解决连接REDIS过多造成瓶颈而设置的
     * 利用$m+$pre作为主键,通常情况下尽量避免传递pre,也避免在外层使用setOption设置前缀
     *
     * @param  string $m    DB库标识
     * @param  string $pre  前缀
     * @return result
     */
    public static function Factory($m, $pre = null)
    {
        static $in = array();
        $k = $m . $pre;
        if (!isset($in[$k])) {
            if ($m === XD_REDIS_TMP && null === $pre) {
                $in[$k] = Fend_Cache_Redis::Factory()->mc;
            } else {
                $in[$k] = Fend_Cache_Redis::Factory()->mc;
                $in[$k]->select($m);
                null !== $pre && $in[$k]->setOption(Redis::OPT_PREFIX, $pre);
            }
        }
        return $in[$k];
    }

}
