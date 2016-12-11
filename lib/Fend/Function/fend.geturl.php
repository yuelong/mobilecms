<?php
/**

 * [Gimoo!] (C)2006-2009 Gimoo Inc. (http://Fend.Gimoo.Net)
 *
 * 获取URL
 * 取得父或当前URL的全部字符串表示
 *
 * @param int $tx 为0时当前URL,为1时父URL
 * @return string
 * @--------------------------------



 * @version $Id: fend.geturl.php 3 2011-12-29 15:01:09Z gimoo $
 */

function getUrl($tx=0)
{
    if($tx) return empty($_SERVER['HTTP_REFERER']) ? '' : $_SERVER['HTTP_REFERER'];
    $url='http://'.$_SERVER['HTTP_HOST'];
    if(isset($_SERVER['REQUEST_URI'])){
        $url.=$_SERVER['REQUEST_URI'];
    }else{
        $url.=$_SERVER['PHP_SELF'].(!empty($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : '');
    }
    return $url;
}
?>