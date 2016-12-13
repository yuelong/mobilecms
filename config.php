<?php

/**
 *
 * 系统基本全局基本配置项
 * 供全局使用,部分生产与实际运行环境的相关配置直接配置到cfg_domain.php中
 *
 * 参数设置
 * PHP.ini配置文件 max_input_vars = 100000
 * 下载ip库重命名放在data/dict/qqwry.dat
 *
 * @Package
 * @Support
 * @Author
 * @version $Id$
 */
ini_set('default_charset', 'utf-8'); //设置编码
date_default_timezone_set('Asia/Shanghai'); //设置时区
define('FD_DS', DIRECTORY_SEPARATOR); //根据系统设置目录分隔符
define('FD_SYSROOT', dirname(__FILE__) . FD_DS); //当前系统根
define('SMARTY_RESOURCE_CHAR_SET', 'utf-8'); //Smart字符集设置
define('FD_AUTOLOAD', 'api_Fend_AutoLoad'); //设置当前自动载入对象模块
define('FD_LIBDIR', FD_SYSROOT . 'lib' . FD_DS); //类库跟目录
define('FD_ROOT', FD_LIBDIR . 'Fend' . FD_DS); //fend框架目录
define('FD_TPLPLUS', FD_LIBDIR . 'Smarty3' . FD_DS . 'plus' . FD_DS); //Smarty扩展库
define('FD_TIME', isset($_SERVER['REQUEST_TIME']) ? $_SERVER['REQUEST_TIME'] : time());
$_cfg['debug'] = FALSE; //是否开启BUG系统
//系统设置不可替换的静态配置
$_cfg['sys_rootdir'] = FD_SYSROOT; //系统根目录
$_cfg['sys_libdir'] = $_cfg['sys_rootdir'] . 'lib' . FD_DS; //系统类库路径
$_cfg['sys_cache'] = $_cfg['sys_rootdir'] . 'data' . FD_DS . 'cache' . FD_DS; //缓存目录
$_cfg['sys_dict'] = $_cfg['sys_rootdir'] . 'data' . FD_DS . 'dict' . FD_DS; //缓存目录
$_cfg['sys_file'] = $_cfg['sys_rootdir'] . 'data' . FD_DS . 'files' . FD_DS; //缓存目录
//---------------- 系统管理平台模板编译以及缓存目录 ---------------------------//
$_cfg['sys_webcache'] = $_cfg['sys_cache'] . 'tplweb_cache' . FD_DS; //模板缓存目录
$_cfg['sys_webphp'] = $_cfg['sys_cache'] . 'tplweb_php' . FD_DS; //模板编译目录
$_cfg['sys_webtpl'] = $_cfg['sys_rootdir'] . 'data' . FD_DS . 'views' . FD_DS; //模板目录
$_cfg['sys_webcfg'] = $_cfg['sys_rootdir'] . 'data' . FD_DS . 'views' . FD_DS . '_lang' . FD_DS; //配置文件路径
$_cfg['sys_pgtx'] = '上一页';
$_cfg['sys_pgnx'] = '下一页';
$_tbpre = 'ucm_'; //数据表前缀-只有后台在使用
//注册一下常用的API进入FEND-----------------------------
$_FD_REG_FUNC = array(
    'tpl'  => 'api_Fend_Tpl',
    'func' => 'api_Fend_Func',
);

function api_Fend_Tpl()
{
    global $_cfg;
    include($_cfg['sys_libdir'] . 'Smarty3' . FD_DS . 'Smarty.class.php');
    $v = new Smarty;
    defined('FD_TPLPLUS') && $v->addPluginsDir(FD_TPLPLUS);
    $v->template_dir = &$_cfg['sys_webtpl'];
    $v->cache_dir = &$_cfg['sys_webcache'];
    $v->compile_dir = &$_cfg['sys_webphp'];
    $v->config_dir = &$_cfg['sys_webcfg'];
    $v->caching = FALSE;
    $v->compile_force = FALSE;
    return $v;
}

function api_Fend_Func()
{
    return Fend_Func::Init();
}

function api_Fend_AutoLoad($fname)
{
    $f = strtok($fname, '_');
    if ($f == 'Fend') {
        $fn = FD_ROOT . str_replace('_', FD_DS, substr($fname, 5));
    } elseif ($f == 'Smarty') {
        $fn = FD_LIBDIR . 'Smarty3' . FD_DS . 'sysplugins' . FD_DS . strtolower($fname);
    } else {
        $fn = FD_LIBDIR . str_replace('_', FD_DS, $fname);
    }

    if (!is_file($fn . '.php')) {//捕捉异常
        eval("class $fname{};"); //临时定义一个目标对象
        throw new Fend_Exception("Has Not Found Class $fname");
    } else {
        include($fn . '.php');
    }
}

//为了兼容开发版与发行版而设置--------------------------
$_host = empty($_SERVER['HTTP_HOST']) ? 'localhost' : $_SERVER['HTTP_HOST'];
$_domain = explode('.', $_host);
if (count($_domain) >= 3)
    unset($_domain[0]);
$_domain = join('.', $_domain);
$_cfg['ckdomain'] = '.' . $_domain; //COOKIE域

if (!is_file($_cfg['sys_rootdir'] . 'conf' . FD_DS . 'cfg_' . $_domain . '.php')) {
    die('cfg_' . $_domain . '.php');
}
include($_cfg['sys_rootdir'] . 'conf' . FD_DS . 'cfg_' . $_domain . '.php');
//------------------------------------------------------
