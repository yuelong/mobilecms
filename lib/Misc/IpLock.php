<?php

/**
 * IP锁定校验
 *
 * @version $Id$
 */
Fend_Func::Init('getIP');

class Misc_IpLock
{

    /**
     * 值得注意
     * 该方法主要是用于解决连接REDIS过多造成瓶颈而设置的
     * 利用$m+$pre作为主键,通常情况下尽量避免传递pre,也避免在外层使用setOption设置前缀
     *
     * @param  string $ip  当前IP地址
     * @param  string $key 缓存主键
     *
     * @return void
     */
    public static function check($key = null, $ip = null)
    {
        !$ip && $ip = getIP();

        // 校验白名单
        if (Conf_Ip::check($ip)) {
            return 0;
        }

        $key = !$key ? 'login:' . $ip : $key . $ip;
        $s = (int) Fend_Cache::obj()->get($key);
        return $s;
    }

    /**
     * 技术IP地址
     *
     * @param  string $ip  当前IP地址
     * @param  string $key 缓存主键
     *
     * @return void
     */
    public static function add($key = null, $ip = null)
    {
        !$ip && $ip = getIP();
        $key = !$key ? 'login:' . $ip : $key . $ip;

        $s = Fend_Cache::obj()->incr($key);
        Fend_Cache::obj()->setTimeout($key, 60 * 15);
        return $s;
    }

    /**
     * 清理
     *
     * @param  string $ip  当前IP地址
     * @param  string $key 缓存主键
     *
     * @return void
     */
    public static function del($key = null, $ip = null)
    {
        !$ip && $ip = getIP();
        $key = !$key ? 'login:' . $ip : $key . $ip;

        Fend_Cache::obj()->del($key);
    }

}
