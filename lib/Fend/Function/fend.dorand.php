<?php
/**

 * [Gimoo!] (C)2006-2009 Gimoo Inc. (http://Fend.Gimoo.Net)
 *
 * 获取一个自定义字符集合的随机数
 *
 * @param int    $len  随机取得长度
 * @param string $chr  只能为单字节字符
 * @return string
 * @--------------------------------



 * @version $Id: fend.dorand.php 3 2011-12-29 15:01:09Z gimoo $
 */

function doRand($len,$chr = '0123456789abcdefghigklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWSYZ')
{
    $hash = null;
    $max = strlen($chr) - 1;
    for($i = 0; $i < $len; $i++){
        $hash .= $chr{mt_rand(0, $max)};
    }
    return $hash;
}
?>