<?php

/**
 * @Support http://www.mobilecms.cn
 * @Author  Yuelong <admin@hyl.me>
 * @version $Id$
 */
function xmlToArray($xml)
{
    $reg = "/<(\\w+)[^>]*?>([\\x00-\\xFF]*?)<\\/\\1>/";
    if (preg_match_all($reg, $xml, $matches)) {
        $count = count($matches[0]);
        $arr = array();
        for ($i = 0; $i < $count; $i++) {
            $key = $matches[1][$i];
            $val = xmlToArray($matches[2][$i]);  // 递归
            if (array_key_exists($key, $arr)) {
                if (is_array($arr[$key])) {
                    if (!array_key_exists(0, $arr[$key])) {
                        $arr[$key] = array($arr[$key]);
                    }
                } else {
                    $arr[$key] = array($arr[$key]);
                }
                $arr[$key][] = $val;
            } else {
                $arr[$key] = $val;
            }
        }
        return $arr;
    } else {
        return $xml;
    }
}
