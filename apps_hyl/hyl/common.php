<?php

/**
 *
 * 公共处理对象
 * 用于处理公共计算问题,应用于本模块全局
 *
 * @version $Id$
 */
Fend_Func::Init('doget', 'dopost');

//User_Auth_PassPort::Factory()->regInit();
class Common extends Router
{

    protected $uid = 0; //当前登录用户UID
    protected $lib, $act;

    public function Init()
    {
        //验证登录
        if ($this->reg['login']) {
            $this->uid = $this->reg['uid'];
        }
        $this->lib = isset($this->url[2]) ? $this->url[2] : '';
        $this->act = isset($this->url[3]) ? $this->url[3] : '';
        self::regVar(Conf_Hyl::$header_menu, 'tmy_header_menu');
        self::regVar(Conf_Hyl::$header_menu_more, 'tmy_header_menu_more');
        self::regVar(Conf_Hyl::$footer_menu, 'tmy_footer_menu');
        self::regVar($this->lib, 'tmy_lib');
        self::regVar($this->act, 'tmy_act');
        $menu = array_merge(Conf_Hyl::$header_menu, Conf_Hyl::$header_menu_more, Conf_Hyl::$footer_menu);
        $title = isset($menu["{$this->lib}_{$this->act}"]['name']) ? $menu["{$this->lib}_{$this->act}"]['name'] : '';
        self::gHead('sitename', '回忆了么(HYL.ME)');
        self::gHead('title', $title);
        self::gHead('slogan', '回忆点滴，提升技能');
        self::gHead('keyw', '回忆了么,回忆,亲子平台,亲子,个人提升,技术提升,免费,开源,移动,高效');
        self::gHead('desc', '随着碎片化阅读越来越多,浪费时间也越来越多,这个平台的想法就是让你把碎片化阅读整合起来,形成自己的体系和网站,如果用来记录宝宝的回忆,就成了很好的亲子平台');
    }

    /**
     * 提交表单数据处理
     *
     * @param  array $res   资源数组
     * @param  int   $total 状态值，默认为0
     * @param  int   $msg   是否直接输出,1为返回值
     * @return array
     */
    public function comMsg($res, $state = 0, $msg = null)
    {
        $ajax = (int) doget('_ajax');
        if ($ajax == 1) {
            self::showMsg($res, $state);
        } else {
            self::showAlert($res, $state);
        }
        exit;
    }

}

?>