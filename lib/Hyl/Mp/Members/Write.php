<?php

/**
 * 评论-写入
 * @Author  Yuelong <admin@hyl.me>
 * @version $Id$
 * */
class Hyl_Mp_Members_Write extends Fend
{

    private $table = 'hyl_mp_members';

    public static function Factory()
    {
        return new self();
    }

    /**
     * 添加&修改
     *
     * @param array $item 信息集合
     * @return int 特别数据ID
     * */
    public function add($item)
    {
        $rs = array(
            'id'      => 0, //评论ID
            'aid'     => 0, //文章ID
            'uid'     => 0, //用户UID
            'uname'   => '', //用户名
            'pid'     => 0, //父级id
            'atid'    => 0, //@id
            'atuname' => '', //@的用户名
            'replys'  => 0, //评论回复数
            'isvip'   => 0, //是否是vip
            'content' => '', //信息描述
            'uuid'    => '', //设备唯一id
            'useip'   => '', //IP地址
            'tops'    => 0, //点赞
            'state'   => 0, //状态
            'ctime'   => 0, //创建时间
        );

        //连接DB
        $db = Db_Club::Factory('w');

        //赋值集合数据
        foreach ($rs as $k => $v) {
            if (isset($item[$k])) {
                $rs[$k] = is_numeric($v) ? (int) $item[$k] : $db->escape($item[$k]);
            } else {
                unset($rs[$k]);
            }
        }

        //我很努力的发掘，但还是为找到符合profile表的字段
        if (count($rs) <= 0)
            return 0;

        //默认时间
        if (empty($rs['id'])) {
            !isset($rs['useip']) && $rs['useip'] = $this->func->getIP();
            $rs['ctime'] = time();
        }

        //准备保持入库
        $res = $db->doQuery($rs, $this->table, 'ifupdate');

        if (empty($rs['id'])) {
            if ($res) {
                $rs['id'] = $db->getId();
                News_Article_Write::Factory()->incrComment($rs['aid']);
                // 统计
                Analysis_Write::Factory()->incrNewsComment();
            } else {
                $res = 0;
            }
        }
        return $res ? $rs['id'] : 0;
    }

    /**
     * 增加主评论的回复数
     * @param type $id
     * @return boolean
     */
    public function addReplys($id)
    {
        Db_Club::Factory('w')->query("UPDATE {$this->table} SET replys=replys+1 WHERE id={$id} and pid=0");
        return true;
    }

    /**
     * 状态
     *
     * @param   $id 信息ID
     * @param   $r  排序
     * @return bool
     * */
    public function setState($id, $r)
    {
        $r = (int) $r;
        Db_Club::Factory('w')->query("UPDATE {$this->table} SET state={$r} WHERE id={$id}");
        return true;
    }

    /**
     * 清理文章下评论
     *
     * @param   $id   文章ID
     * @return bool
     * */
    public function delForAid($id)
    {
        Db_Club::Factory('w')->query("DELETE FROM {$this->table} WHERE aid={$id}");
        return true;
    }

    /**
     * 删除
     * 删除以后就不在清理文章数了
     *
     * @param   $id 信息ID
     * @return bool
     * */
    public function del($id)
    {
        $db = Db_Club::Factory('w');
        $rs = $db->get("SELECT id,aid FROM {$this->table} WHERE id={$id}");
        if ($rs) {
            $db->query("DELETE FROM {$this->table} WHERE id={$id}");
            $db->afrows() && News_Article_Write::Factory()->incrComment($rs['aid'], -1);
        }
        return true;
    }

}

?>