<?php

/**
 * 格式化处理
 * @Author  Yuelong <admin@hyl.me>
 * @version $Id$
 */
class Misc_Format extends Fend
{

    public static function Factory()
    {
        return new self();
    }

    /**
     * 资讯内容过滤
     *
     * @param  string  $string 资讯内容
     * @return string
     */
    public static function newsToString($string)
    {
        $string = stripslashes($string);
        self::replaceADR($string);

        // return $string;
        $string = str_replace('&hellip;', '…', $string);
        $string = str_replace('&amp;', '&', $string);

        //  js过滤
        $string = preg_replace('/<(script|style)(.*?)<\/(script|style)>/is', '', $string);

        // 过滤样式
        $string = preg_replace('/ style="(.*?)"/is', '', $string);

        // 过滤多余的样式
        $string = preg_replace('/<(p|br|table|tr|th)(.*?)>/is', "<\\1>", $string); //td的中的暂时不过滤
        //去掉除p和img之外的html标签
        $string = strip_tags($string, "<p><br><img><table><tr><td><th><a>");

        //过滤掉img中的图片高度属性
        $string = preg_replace('/<img(.*?) src=(.*?)[\s](.*?)>/', "<p><img src=\\2></p>", $string);

        //过滤HTML源码：&nbsp;&lt;...
        //需要替换成空格，否则英文单词之间的空格会被替换掉
        $string = preg_replace('/(&[a-z]{2,6};)/is', " ", $string);

        // 过滤多余的空白
        $string = preg_replace('/([\s]+)/', " ", $string);

        // 过滤全角空格
        $string = str_replace(array("　", "\t", "\n", "\r", '[!--empirenews.page--]'), '', $string);

        //过滤那种tab
        $string = str_replace(array("<p></p>", "<p><p>", "</p></p>", '</table>', '</td>', '</tr>', '<tr>', '<table>', '<p><br>'), array('', '<p>', '</p>', "</table>\n", "</td>\n", "</tr>\n", "<tr>\n", "<table>\n", "<p>"), $string);
        $string = str_replace("</p>", "</p>\n", $string);

        //a标签替换为应用内跳转-论坛发贴-先关闭
        //$string = preg_replace('/href=[\'|\"].*?mod=post&action=newthread&fid=(\d.)[\'|\"]/',"href=\"kaoyan://?act=club_addthread&fid=\\1\"",$string);
        // 清楚两边空白
        $string = trim($string);
        return $string;
    }

    /**
     * 获取文章内容中所有图片地址
     * @param type $string
     * @return string
     */
    public static function getTextImage($string)
    {
        $img_src = [];
        $thumbUrl[0][0] = '';
        //通过正则表达式获取图片地址
        preg_match_all("/(http:\/\/|https:\/\/)[^>]*?.(png|jpg|jpeg|bmp|gif)/i", $string, $thumbUrl);
        $img_counter = count($thumbUrl[0]);  //一个src地址的计数器
        for ($i = 0; $i < $img_counter; $i++) {
            $img_src[] = $thumbUrl[0][$i];
        }
        return $img_src;
    }

    /**
     * 获取HTML内容中图片
     *
     * @param  string  $string 资讯内容
     * @return string
     */
    public static function getHtmlImage($string)
    {
        $img = '';
        if (false === stripos($string, '<img')) {
            return $img;
        }

        $string = stripslashes($string);
        if (preg_match('/<img(.*?) src=[\'\"](.*?)[\'\"](.*?)>/', $string, $res)) {
            $img = $res[2];

            // 非http或者https开头增加前缀
            if (substr($img, 0, 5) != 'http:' || substr($img, 0, 6) != 'https:') {
                $img = '';
            }
        }
        return $img;
    }

    /**
     * 获取Markdown内容中的图片
     *
     * @param  string  $string 资讯内容
     * @return string
     */
    public static function getMdImage($string)
    {
        $img = '';
        if (false === stripos($string, '<img')) {
            return $img;
        }

        $string = stripslashes($string);
        if (preg_match('/<img(.*?) src=[\'\"](.*?)[\'\"](.*?)>/', $string, $res)) {
            $img = $res[2];

            // 非http开头不要
            if (substr($img, 0, 5) != 'http:') {
                $img = '';
            }
        }
        return $img;
    }

    function img_postthumb($cid)
    {
        $db = Typecho_Db::get();
        $rs = $db->fetchRow($db->select('table.contents.text')
                        ->from('table.contents')
                        ->where('table.contents.cid=?', $cid)
                        ->order('table.contents.cid', Typecho_Db::SORT_ASC)
                        ->limit(1));
        $final = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($rs);
        preg_match_all("/(http:\/\/)[^>]*?.(png|jpg)/i", $final['text'], $thumbUrl);  //通过正则式获取图片地址
        $img_src = $thumbUrl[0][0];  //将赋值给img_src
        $img_counter = count($thumbUrl[0]);  //一个src地址的计数器
        switch ($img_counter > 0) {
            case $allPics = 1:
                echo $img_src;  //当找到一个src地址的时候，输出缩略图
                break;
            default:
                echo "nopic.png";  //没找到(默认情况下)，不输出任何内容
        };
    }

    /**
     * 截取内容摘要
     *
     * @param  string  $string 资讯内容
     * @param  int     $len    截取字符数
     * @return string
     */
    public static function getIntro($string, $len = 140)
    {
        $string = stripslashes($string);
        $string = strip_tags($string);
        $string = str_replace(array('　', '“', '”'), '', $string); //双字节的字符处理
        $string = preg_replace('/([\s]+)|(&[#0-9a-z]+;)+/is', ' ', $string); //过滤空白字符
        strlen($string) > $len && $string = mb_strcut($string, 0, $len, 'utf-8');
        return $string;
    }

    /*
     * 过滤html标签会留下内容
     */

    public static function strip_html($str)
    {
        $str = preg_replace("/<([a-zA-Z]+)[^>]*>/", "", $str);
        $str = preg_replace("/<\/([a-zA-Z]+)[^>]*>/", "", $str);
        $str = str_replace('<', '＜', $str); //剩下的尖括号ios会出问题，替换成全角的
        $str = str_replace('>', '＞', $str);
        return $str;
    }

    /**
     * 解析论坛帖子里面的table标签
     *
     * @param  string  $string 资讯内容
     * @return string
     */
    public static function parseThreadTable($width, $bgcolor, $message)
    {
        if (strpos($message, '[/tr]') === FALSE && strpos($message, '[/td]') === FALSE) {
            $rows = explode("\n", $message);
            $s = '<table cellspacing="0" ' .
                    ($width == '' ? NULL : 'style="width:' . $width . '"');
            foreach ($rows as $row) {
                $s .= '<tr><td>' . str_replace(array('\|', '|', '\n'), array('&#124;', '</td><td>', "\n"), $row) . '</td></tr>';
            }
            $s .= '</table>';
            return $s;
        } else {
            if (!preg_match("/^\[tr(?:=([\(\)\s%,#\w]+))?\]\s*\[td([=\d,%]+)?\]/", $message) && !preg_match("/^<tr[^>]*?>\s*<td[^>]*?>/", $message)) {
                return str_replace('\\"', '"', preg_replace("/\[tr(?:=([\(\)\s%,#\w]+))?\]|\[td([=\d,%]+)?\]|\[\/td\]|\[\/tr\]/", '', $message));
            }
            if (substr($width, -1) == '%') {
                $width = substr($width, 0, -1) <= 98 ? intval($width) . '%' : '98%';
            } else {
                $width = intval($width);
                $width = $width ? ($width <= 560 ? $width . 'px' : '98%') : '';
            }
            return '<table cellspacing="0"  ' .
                    ($width == '' ? NULL : 'style="width:' . $width . '"') .
                    str_replace('\\"', '"', preg_replace(array(
                        "/\[tr(?:=([\(\)\s%,#\w]+))?\]\s*\[td(?:=(\d{1,4}%?))?\]/ie",
                        "/\[\/td\]\s*\[td(?:=(\d{1,4}%?))?\]/ie",
                        "/\[tr(?:=([\(\)\s%,#\w]+))?\]\s*\[td(?:=(\d{1,2}),(\d{1,2})(?:,(\d{1,4}%?))?)?\]/ie",
                        "/\[\/td\]\s*\[td(?:=(\d{1,2}),(\d{1,2})(?:,(\d{1,4}%?))?)?\]/ie",
                        "/\[\/td\]\s*\[\/tr\]\s*/i"
                                    ), array(
                        "Misc_Format::parseThreadTrTd('\\1', '0', '0', '\\2')",
                        "Misc_Format::parseThreadTrTd('td', '0', '0', '\\1')",
                        "Misc_Format::parseThreadTrTd('\\1', '\\2', '\\3', '\\4')",
                        "Misc_Format::parseThreadTrTd('td', '\\1', '\\2', '\\3')",
                        '</td></tr>'
                                    ), $message)
                    ) . '</table>';
        }
    }

    /**
     * 解析论坛帖子里面的td与tr标签
     *
     * @param  string  $string 资讯内容
     * @return string
     */
    public static function parseThreadTrTd($bgcolor, $colspan, $rowspan, $width)
    {
        return ($bgcolor == 'td' ? '</td>' : '<tr>') . '<td' . ($colspan > 1 ? ' colspan="' . $colspan . '"' : '') . ($rowspan > 1 ? ' rowspan="' . $rowspan . '"' : '') . ($width ? ' width="' . $width . '"' : '') . '>';
    }

}
