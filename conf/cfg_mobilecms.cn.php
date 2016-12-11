<?php

/**

 *
 * 站点相关配置文件
 * 用于发布环境中的环境变量配置
 *
 * @Package
 * @Author
 * @version
 * */
ini_set('display_errors', 'on'); //线上环境改成off
error_reporting(8191); //最高错误级别
define('FD_DEBUG', 3); //启动异常处理级别
define('FD_DBLOG', $_cfg['sys_cache'] . 'sqlerr.log'); //Mysql错误日志
define('FD_CACHE_TYPE', 2); //缓存模块：0文件、1mem、2redis
define('XD_LOCAL', true); //是否为本地
//定制redis库
define('XD_REDIS_TMP', 0); //redisDB配置-临时数据-可清理
define('XD_REDIS_AUTH', 1); //redisDB配置-登录状态-可清理
// define('XD_REDIS_ANLS'  ,2);//redisDB配置-数据统计-永久
define('XD_AUTHKEY', 'mobilecms'); //私钥，用户登录加密，需要改成自己的
//DB-需要自行配置
$_db_home['r'] = array('host' => 'localhost', 'name' => 'mobilecms', 'user' => 'mobilecms', 'pwd' => 'mobilecms', 'lang' => 'utf8');
$_db_home['w'] = array('host' => 'localhost', 'name' => 'mobilecms', 'user' => 'mobilecms', 'pwd' => 'mobilecms', 'lang' => 'utf8');

//基本配置
$_fccfg = array('froot' => $_cfg['sys_cache'], 'fext' => ''); //文件缓存
$_rdscfg = array('host' => '127.0.0.1', 'port' => 6379, 'dbs' => XD_REDIS_TMP); //Redis缓存设置
$_mlcfg = array('host' => 'multi.263xmail.com', 'user' => '', 'pwd' => ''); //SMTP Mail配置
//自动创建所需目录
!is_dir($_cfg['sys_cache']) && mkdir($_cfg['sys_cache'], 0755);
!is_dir($_cfg['sys_webcache']) && mkdir($_cfg['sys_webcache'], 0755);
!is_dir($_cfg['sys_webphp']) && mkdir($_cfg['sys_webphp'], 0755);

//本站域名集合配置
$_dm['bbs'] = 'http://bbs.mobilecms.cn/'; //论坛
$_dm['www'] = 'http://www.mobilecms.cn/'; //主站
$_dm['img'] = 'http://www.mobilecms.cn/style/'; //媒介
$_dm['home'] = 'http://home.mobilecms.cn/'; //用户中心
$_dm['self'] = 'http://' . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost') . '/';

//ACL配置--加载器分发所需要的环境------------------------------------ Begin
$aclcfg = array(
    'appsDir' => $_cfg['sys_rootdir'] . 'apps/', //模块目录
);
$aclmod = array('default', 'hi', 'set', 'api'); //注册的模块
//域名定位模块配置
$_doname = array(
    // 'i.mobilecms.cn'       => '/hi',
    'api.mobilecms.cn' => '/api',
    'www.mobilecms.cn' => '/default',
    //'m.mobilecms.cn'   => '/default',
);
$mods = isset($_doname[$_host]) ? $_doname[$_host] . $_SERVER['REQUEST_URI'] : $_SERVER['REQUEST_URI'];
unset($_doname);
//ACL配置--加载器分发所需要的环境------------------------------------ End

// URL重写
if ($_host == 'www.mobilecms.cn') {
    $mods = str_replace(array('list-', 'view-', 'topic-', 'login', 'register'), array('list/', 'news/view/', 'news/topic/', 'user/login', 'user/register'), $mods);
}

//用于调试使用
if (isset($_GET['dbg']) && $_GET['dbg'] == 1) {
    $_cfg['debug'] = true;
}

// 测试一些post提交
if (isset($_GET['gp']) && $_GET['gp'] == 1)
    $_POST = $_GET;