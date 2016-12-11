<?php
/**
 *
 * 截取字符串
 *
 * @Package Fend
 * @version $Id: function.f_substr.php 901 2013-07-04 05:46:09Z liushuai $
  */

function smarty_modifier_f_substr($string,$len,$replace='')
{
    $str=strip_tags($string);
    $len=(int)$len;
    $result= '';
    $string=html_entity_decode(trim(strip_tags($str)),ENT_QUOTES,'UTF-8');
    $strlen=strlen($string);

    for($i=0; (($i<$strlen)&& ($len> 0));$i++){
        $number=strpos(str_pad(decbin(ord(substr($string,$i,1))), 8, '0', STR_PAD_LEFT), '0');
        if($number){
            if($len<1.0){
                break;
            }
            $result.=substr($string, $i, $number);
            $len-=1.0;
            $i+=$number-1;
        }else{
            $result.=substr($string,$i,1);
            $len-=0.5;
        }
    }

    $result=htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
    if(substr($string,$i)){
        if(!empty($replace)){
            $result.=$replace;
        }else{
            $result.='...';
        }
    }
    return $result;
}

?>