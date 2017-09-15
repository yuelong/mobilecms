<?php

/**

 *
 * 定时任务API - 自动运行
 *
 * 请不要再这个文件中写入测试信息
 * 临时、测试使用的脚本请写到wwwtest.php文件中
 *
 * php cli_cron.php www.mobilecms.cn -hgys_tag > /dev/null
 * @Author  Yuelong <admin@hyl.me>
 * @version $Id$
 */
$_SERVER['HTTP_HOST'] = @$_SERVER['argv'][1];
$_SERVER['REQUEST_URI'] = '';
require_once(dirname(dirname(__FILE__)) . "/router.php");

set_time_limit(1800);
if (php_sapi_name() == 'cli') {
    $mod = @$_SERVER['argv'][2];
    switch ($mod) {
        //hgys-tag生成 每两个小时执行一次
        case '-hgys_tag':
            Caiji_Hgys_Write::Factory()->addTags();
            break;

        //hgys-点击量 每小时
        case '-hgys_click':
            Caiji_Hgys_Write::Factory()->addClick();
            break;

        //php cli_cron.php mobilecms.cn -lofter2typecho '/Applications/XAMPP/xamppfiles/htdocs/mobilecms.cn/data/cache/LOFTER-2046-2016.12.31.xml'
        case '-lofter2typecho':
            $file = @$_SERVER['argv'][3];
            if ($file) {
                Misc_Lofter_Typecho::Factory()->ReadXml($file);
            } else {
                echo 'no file.' . PHP_EOL;
            }
        default:
            die('no');
            break;
    }
} else {
    die('cNO');
}