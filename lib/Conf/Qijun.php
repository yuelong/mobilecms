<?php

/**
 * 北京奇骏相关配置
 *
 * @version $Id$
 */
final class Conf_Qijun
{

    //const UC_IPCODE_MAX = 5;
    //顶部菜单
    public static $header_menu = [
        'doc_how'      => ['lib' => 'doc', 'act' => 'how', 'type' => 'index', 'name' => '开始使用'],
        'hot_members'  => ['lib' => 'hot', 'act' => 'members', 'type' => 'index', 'name' => '热门账号'],
        'hot_articles' => ['lib' => 'hot', 'act' => 'articles', 'type' => 'index', 'name' => '热门文章'],
        'hot_mps'      => ['lib' => 'hot', 'act' => 'mps', 'type' => 'index', 'name' => '热门公众号'],
    ];
    public static $header_menu_more = [
        'hot_books'    => ['lib' => 'hot', 'act' => 'books', 'type' => 'more', 'name' => '热门图书'],
        'hot_children' => ['lib' => 'hot', 'act' => 'children', 'type' => 'more', 'name' => '亲子互动'],
    ];
    //底部菜单
    public static $footer_menu = [];

    //获取头像地址或URL
    public static function getPic($uid, $tp = 's', $p = 0)
    {
        static $tps = array('s' => '_small.jpg', 'm' => '_middle.jpg', 'b' => '_big.jpg');
        $ex = isset($tps[$tp]) ? $tps[$tp] : $tps['s'];
        $uid = str_pad($uid, 9, 0, STR_PAD_LEFT);
        $tmp = preg_replace("/^(\d{3})(\d{2})(\d{2})(\d{2,})/i", "avatar/\\1/\\2/\\3/\\4_avatar", $uid) . $ex;

        // 测试环境
        if (defined('XD_LOCAL') && XD_LOCAL) {
            $tmp = str_replace('avatar/', 'avatar/test/', $tmp);
        }

        // 仅仅测试
        $tmp = str_replace('avatar/', 'avatar/test/', $tmp);

        $p == 1 && $tmp = $GLOBALS['_dm']['atth'] . $tmp;
        return $tmp;
    }

}
