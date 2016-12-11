<?php
/**

 * [Gimoo!] (C)2006-2009 Eduu Inc. (http://www.eduu.com)
 *
 * 检测是否为正常的URL
 *
 * @param string $url 需要处理的URL
 * @return bool
 * @--------------------------------

 * @Support http://bbs.eduu.com

 * @version $Id: fend.isurl.php 3 2011-12-29 15:01:09Z gimoo $
 */

function isUrl($url)
{
    return preg_match('/^(http|https):\/\/([\w-]+\.)+[\w-]+([\/|?]?[^\s]*)*$/i', $url) ? true : false;
}
?>