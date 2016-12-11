<?php
/**

 * [Gimoo!] (C)2006-2009 XueDi Inc. (http://www.xuedi.com)
 *
 * 公共处理对象
 * 用于处理公共计算问题,应用于本模块全局
 *


 * @version $Id$
  */

Fend_Func::Init('doget','dopost');
User_Auth_PassPort::Factory()->regInit();
class Common extends Router
{
    protected $uid = 0;//当前登录用户UID
    public function Init()
    {
        //验证登录
        if(!$this->reg['login']){
            $this->func->doBreak("{$this->dm['self']}login");
            exit;
        }
        $this->uid=$this->reg['uid'];
    }
}
?>