<?php

/**
 *
 * 标签筛选器
 * 通过分词,对比标签库取得相关标签关键字
 *
 * 调用说明：
 * string $content   需要处理的内容
 * int    $rank      限定级别，1只有找到违禁词才停止,2找到待审词即停止，3找到时政词停止，0不会终止会扫描全文
 * int    $mx        扫描到的敏感词保存返回的条目
 * $res = Misc_Ban::Factory()->get($content,$rank,$mx);
 *
 * 结果
 * $res['res']=fasle | true ;true包括违禁词，false不包括
 * $res['msg']=array('匕首','假币');  敏感词列表
 * $res['msgs']=89;    搜寻到敏感词的个数，不一定是全文的总敏感词总数
 *
 * @version $Id$
 */
class Misc_Ban
{

    private static $in;

    /**
     * 工厂模式: 激活对象
     *
     * @param  object  static $in
     * @return object
     */
    public static function Factory()
    {
        if (null === self::$in) {
            if (is_file($GLOBALS['_cfg']['sys_dict'] . 'dban.xdb')) {
                self::$in = new Fend_Fcws_Split;
                self::$in->setChar('utf-8');
                self::$in->open($GLOBALS['_cfg']['sys_dict'] . 'dban.xdb');
            } else {
                self::$in = new self();
            }
        }
        return self::$in;
    }

    /**
     * 检测是否不包含中文字符
     *
     * @param  string  $str 需要处理的字符集
     * @return bool
     */
    public static function isEn($str)
    {
        $item = true;
        $len = strlen($str);
        for ($i = 0; $i < $len; ++$i) {
            if (ord($str[$i]) >= 0x80) {//单字节
                $item = false;
                break;
            }
        }
        return $item;
    }

    /**
     * 广告挖掘机
     * 注意preg_match 的返回值是0次（不匹配）或1次
     *
     * @param  string  $str 需要处理的字符集
     * @return bool
     */
    public static function gg($str)
    {
        // 过滤空白及允许kaoyan.com域名正常通过
        $str = preg_replace(array('/[\s]/', '/(t|f|#)[0-9]+(p[0-9]+)?/i', '/\[attach\]([0-9]+)\[\/attach\]/i'), '', $str);
        $str = str_replace('kaoyan.com', '', $str);

        $preg = array(
            'url'    => '/(ftp:|http:|https:|thunder:)([0-9a-z_\-\/\.]+)?/is',
            'email'  => '/[0-9a-z-_]+@[a-z0-9-_]{4,}\.[a-z0-9-_\.]+/is',
            'domain' => '/[0-9a-z\.]+\.([a-z]+)/is',
            'tel'    => '/([0-9]{4}-)?([0-9]{6,})/',
        );

        // 是否包含超链接
        if (preg_match($preg['url'], $str, $cc)) {
            print_R($cc);
            return 1;
        }

        // email
        if (preg_match($preg['email'], $str, $cc)) {
            // print_R($cc);
            return 2;
        }

        // 检测是否包含域名
        $alow = array('pdf', 'mp3', 'doc', 'jpg', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'gif', 'png', 'txt');
        if (preg_match($preg['domain'], $str, $cc) && !in_array($cc[1], $alow)) {
            // print_R($cc);
            return 3;
        }

        // 检测QQ号,电话号
        if (preg_match($preg['tel'], $str, $cc)) {
            // print_R($cc);
            return 4;
        }
        return 0;
    }

    /**
     * 解决调用时无词典不报错
     *
     * @return bool
     */
    public function get()
    {
        $item = array(
            'res'  => false, //大于0为找到词，值词的级别
            'msg'  => array(), //敏感词列表，最后一个词总是禁用词
            'msgs' => 0, //找到的敏感词个数
        );
        return $item;
    }

}
