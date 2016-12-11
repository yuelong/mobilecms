<?php
/**

 * [Gimoo!] (C)2006-2009 Gimoo Inc. (http://fend.gimoo.net)
 *
 * 送出日期选择器
 * 单个送出
 * {f_html_date type=1 start=2012 end=0 id='year' name='year'}
 *

 * @version $Id$
 * @param   $pars
 */

function smarty_function_f_html_date($pars,&$sty,&$tpl)
{
    // 类型 0年 1月 2日
    $_tmp   = '';
    $type   = (int)$pars['type'];
    $start  = isset($pars['start']) ? (int)$pars['start'] : 0;
    $end    = isset($pars['end']) ? (int)$pars['end'] : 0;
    $name   = isset($pars['name']) ? $pars['name'] : 'name_'.$type;

    if ($type == 1) {
        $start<=0 && $start =1;
        $end<=0 && $end = 12;
        $_tmp .= "<option value='0'>月</option>";
        for ($i=$start; $i <= $end; $i++) {
            $_tmp .= "<option value='{$i}'>{$i}月</option>";
        }
    }elseif ($type == 2) {
        $start<=0 && $start =1;
        $end<=0 && $end = 31;
        $_tmp .= "<option value='0'>日</option>";
        for ($i=$start; $i <= $end; $i++) {
            $_tmp .= "<option value='{$i}'>{$i}日</option>";
        }
    }else{
        $start<=0 && $start =1970;
        $end<=0 && $end = date("Y");
        $_tmp .= "<option value='0'>年</option>";
        for ($i=$end; $i >= $start; --$i) {
            $_tmp .= "<option value='{$i}'>{$i}年</option>";
        }
    }

    $_tmp = "<select".(isset($pars['id']) ? " id='{$pars['id']}'" : '' )." name='{$name}'>{$_tmp}</select>";
    return $_tmp;
}
?>
