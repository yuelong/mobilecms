<?php
/**

 * [Gimoo!] (C)2006-2009 KaoYan Inc. (http://www.kaoyan.com)
 *
 * 发送邮件服务
 *
 * @version $Id$
 */

require_once(dirname(__FILE__).'/Phpmailer/class.smtp.php');
require_once(dirname(__FILE__).'/Phpmailer/class.phpmailer.php');
class Misc_Mail_Init extends Fend
{
    public $host=''; //邮件服务器
    public $user=''; //账户
    public $pwd=''; //密码

    // 工厂模式
    public static function Factory()
    {
        static $in=null;
        if(null===$in) $in=new self;
        return $in;
    }

    /**
     * 初始化在线状态
     *
     * @param  int   $tid 模板ID
     * @param  array $rs  模板替换变量
     * @return void
     */
    public function send($tid,array $rs)
    {
        // 检测账户是否已经配置
        if (!isset($this->mlcfg) || empty($this->mlcfg)) {
            return -100;
        }

        //检测并载入模板
        $tpl="{$this->cfg['sys_rootdir']}data/mail/m_{$tid}.tpl";
        if(!is_file($tpl)){
            return -101;
        }
        $tbody=file_get_contents($tpl);

        //模板处理
        !isset($rs['date']) && $rs['date']=date('Y-m-d H:i');
        $rs['tid']=$tid;
        $reg=array();
        foreach($rs as $k=>&$v){
            $reg[0][]="[-".strtoupper($k)."-]";
            $reg[1][]=$v;
        }

        // 域名
        foreach($this->dm as $k=>$v){
            $reg[0][]="[-DM-".strtoupper($k)."-]";
            $reg[1][]=$v;
        }
        $tbody=str_replace($reg[0],$reg[1],$tbody);

        //从模板中获取发送标题
        $_tmp=explode("\n",$tbody,2);
        $subject=trim($_tmp[0]);
        $tbody=nl2br(trim($_tmp[1]));

        //实例化Mail对象
        $mail = $this->phpMail();

        //设置发送邮箱
        $mail->From = "service@mobilecms.cn";
        $mail->FromName = "MobileCMS";
        $mail->AddReplyTo("service@mobilecms.cn", "MobileCMS");

        //设置发件主机
        $mail->IsSMTP(); //设置SMTP发送
        $mail->SMTPAuth   = true;// 启用 SMTP 验证功能

        $cfg = self::getEmailConf();
        $mail->Host       = $cfg['host'];// SMTP 服务器
        if(isset($cfg['port'])){
            $mail->Port  = $cfg['port'];// SMTP服务器的端口号
            $cfg['port']!=25 && $mail->SMTPSecure = "ssl";// 安全协议
        }
        $mail->Username   = $cfg['user'];// SMTP服务器用户名
        $mail->Password   = $cfg['pwd'];// SMTP服务器密码

        //设置收件人
        $mail->AddAddress($rs['email'], $rs['uname']);
        $mail->WordWrap = 50;    // set word wrap
        $mail->Subject = $subject;
        $mail->MsgHTML($tbody);
        $mail->CharSet = 'utf-8';
        //$mail->SMTPDebug   = true;// 启用 SMTP 验证功能

        //开始发送
        if($mail->Send()){
            return true;
        }else{
            return $mail->ErrorInfo;
        }
    }

    /**
     * 初始化PHPmailer对象
     *
     * @return object
     */
    public function phpMail()
    {
        return new phpmailer();
    }

    // 随机获取邮件配置，mlcfg可以配置多个host的组
    public function getEmailConf()
    {
        static $t=null;
        if (isset($this->mlcfg['host'])) {
            return $this->mlcfg;
        }else{
            $t===null && $t=count($this->mlcfg);
            $k=$t<=1 ? 0 : mt_rand(0,$t-1);
            return $this->mlcfg[$k];
        }
    }
}
