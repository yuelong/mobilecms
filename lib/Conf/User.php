<?php
/**
 * 用户相关配置
 *
 * @version $Id$
 */

final class Conf_User
{
    const UC_IPCODE_MAX = 5; //设置每个IP提交三次以内不需要验证码

    //获取头像地址或URL
    public static function getPic($uid, $tp = 's', $p = 0)
    {
        static $tps = array('s' => '_small.jpg', 'm' => '_middle.jpg', 'b' => '_big.jpg');
        $ex = isset($tps[$tp]) ? $tps[$tp] : $tps['s'];
        $uid = str_pad($uid, 9, 0, STR_PAD_LEFT);
        $tmp = preg_replace("/^(\d{3})(\d{2})(\d{2})(\d{2,})/i", "avatar/\\1/\\2/\\3/\\4_avatar", $uid) . $ex;

        // 测试环境
        if (defined('XD_LOCAL') && XD_LOCAL) {
            $tmp=str_replace('avatar/', 'avatar/test/', $tmp);
        }

        // 仅仅测试
        $tmp=str_replace('avatar/', 'avatar/test/', $tmp);

        $p == 1 && $tmp = $GLOBALS['_dm']['atth'] . $tmp;
        return $tmp;
    }

    /**
     * 校验密码
     *
     * @param  str $passwd  密码
     * @param  str $salt    加密串
     * @param  int $pwdtype 密码类型，0明文、1MD5
     *
     * @return str 加密后的密码串
      */
    public static function getPasswd($passwd,$salt='',$pwdtype=0)
    {
        // 校验密码
        $md5 = $pwdtype ? $passwd : md5($passwd);
        !empty($salt) && $md5 = md5($md5.$salt);
        return $md5;
    }

    /**
     * 检查用户名
     *
     * @param  str $str  昵称
     *
     * @return str or bool
      */
    public static function checkUser($str)
    {
        // 用户昵称
        $len = Conf_User::strLength($str);
        if ($len<4 || $len>15) {
            return '昵称长度不允许';
        }elseif (!preg_match("/^([\x{4e00}-\x{9fa5}a-z]+)([\x{4e00}-\x{9fa5}a-z0-9_\-]*)$/iu", $str)) {
            return '昵称支持：汉字、字母、数字，且不能以数字开头';
        }

        // 敏感词验证
        $censorexp = preg_quote(trim(Conf_UserReg::$rexp), '/');
        $censorexp = '/^('.str_replace(array('\\*', "\n", ' '), array('.*', '|', ''), $censorexp).')$/i';
        if ( preg_match($censorexp, $str) ) {
            return '昵称包含不允许的敏感词';
        }

        return true;
    }

    /**
     * 检查手机号
     *
     * @param  str $str  手机号
     * @return str or bool
      */
    public static function checkPhone($str)
    {
        // 用户昵称
        if (!is_numeric($str) || strlen("{$str}")!=11 ) {
            return '手机号不合法';
        }elseif (!preg_match("/^(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/", $str)) {
            return '手机号不合法';
        }
        return true;
    }

    /**
     * 检查邮箱地址--暂时未使用
     *
     * @param  str $str  手机号
     * @return str or bool
      */
    public static function checkEmail($str)
    {
        return false!==filter_var($user, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    /**
     * 计算昵称长度（汉字用2个字符表示）
     *
     * @param  str $str  昵称
     * @return str
      */
    public static function strLength($str)
    {
        $len  = strlen($str);
        $znum = 0;
        for($i=0;$i<$len;$i++){
            $znum++;
            if(ord(substr($str,$i+1,1))>127){
                $znum++;
                $i+=2;
            }
        }
        return $znum;
    }
}
