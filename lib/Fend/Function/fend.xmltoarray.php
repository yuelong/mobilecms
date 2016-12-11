<?php
/**

 * [Gimoo!] (C)2006-2009 Gimoo Inc. (http://Fend.Gimoo.Net)
 *
 * 格式化连续的ID集合
 * 格式化连续的ID集合结果集为: 1,2,3,4,5,6...
 *
 * @param string $id 一个字符串ID集合
 * @return string 得到一个使用逗号隔开的ID串集合
 * @--------------------------------



 * @version $Id: fend.dosetid.php 142 2014-08-10 15:05:35Z gimoo $
 */

function xmlToArray($xml)
{
    $reg = "/<(\\w+)[^>]*?>([\\x00-\\xFF]*?)<\\/\\1>/";
    if(preg_match_all($reg, $xml, $matches))
    {
        $count = count($matches[0]);
        $arr = array();
        for($i = 0; $i < $count; $i++)
        {
            $key= $matches[1][$i];
            $val = xmlToArray( $matches[2][$i] );  // 递归
            if(array_key_exists($key, $arr))
            {
                if(is_array($arr[$key]))
                {
                    if(!array_key_exists(0,$arr[$key]))
                    {
                        $arr[$key] = array($arr[$key]);
                    }
                }else{
                    $arr[$key] = array($arr[$key]);
                }
                $arr[$key][] = $val;
            }else{
                $arr[$key] = $val;
            }
        }
        return $arr;
    }else{
        return $xml;
    }
}
?>