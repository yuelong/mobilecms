<?php
/**

 * [Gimoo!] (C)2006-2009 Gimoo Inc. (http://Fend.Gimoo.Net)
 *
 * 获取GET参数
 * 检测并增加addslashes
 *



 * @version $Id: fend.dopost.php 3 2011-12-29 15:01:09Z gimoo $
 */

//$_POST = array_change_key_case($_POST);
if(get_magic_quotes_gpc()){
    function doPost($name) {
        if(isset($_POST[$name])){
            return is_array($_POST[$name]) ? $_POST[$name] : trim($_POST[$name]);
        }else{
            return null;
        }
    }
}else{
    function doPost($name) {
        if(isset($_POST[$name])){
            return is_array($_POST[$name]) ? $_POST[$name] : addslashes(trim($_POST[$name]));
        }else{
            return null;
        }
    }
}

?>