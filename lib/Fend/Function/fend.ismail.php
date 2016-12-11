<?php
/**

 * [Gimoo!] (C)2006-2009 Eduu Inc. (http://www.eduu.com)
 *
 * 检测是否为Email
 *
 * @param string $str 电子邮件Email
 * @return bool 成功则是true
 * @--------------------------------

 * @Support http://bbs.eduu.com

 * @version $Id: fend.ismail.php 3 2011-12-29 15:01:09Z gimoo $
 */

function ismail($str)
{
    return preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $str);
}

?>