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

    public function Init()
    {
        //验证登录
        if ($this->reg['login']) {
            $this->uid = $this->reg['uid'];
        }
        self::gHead('title', '移动内容管理系统_免费、开源、移动、高效');
        self::gHead('keyw', 'mobilecms,移动内容管理系统,免费,开源,移动,高效,mobile,cms,sms,短信系统,聊天系统,采集系统,教育系统');
        self::gHead('desc', 'MobileCMS顾名思义就是在移动端的内容管理系统（CMS），在移动设备越来越普及的今天越来越多的人用移动设备来访问网站，MobileCMS就是为了方便用户轻松的建立移动内容管理系统');
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