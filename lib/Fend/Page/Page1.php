<?php
/**

 * [Gimoo!] (C)2006-2009 Gimoo Inc. (http://fend.gimoo.net)
 *
 * 分页对象
 * 适用于动态URL分页 采用当前所在行作为分页标识
 *



 * @version $Id: Page1.php 13 2012-02-12 15:36:56Z gimoo $
 */

class Fend_Page_Page1 extends Fend
{
    public $psize=0;    //每页记录数
    public $total=0;    //总记录数
    public $pmax=10;    //输出的最大页数
    public $limit='';   //送出SQL分页标识
    public $pname='pg'; //分页变量
    public $preg='[*]'; //替换母体

    /**
     * 获取分页连接
     * @param integer $psize 每页显示数
     * @param string  $pname 分页标识
     * @return string
     */
    public function getPage($psum,$psize=20,$url,$cpage=0)
    {
        $this->total=&$psum;
        $this->psize=&$psize;
        $this->psize<=0 && $this->psize=20;
        $this->pmax<=5 && $this->pmax=10;

        //得到当前分页游标-并计算当前页号
        $total=ceil($psum/$this->psize);//总页数
        $cpage>$total && $cpage=$total;//当前页数最大不能超过总页数
        $cpage<=0 && $cpage=1;

        //得到查询SQL
        $this->limit='LIMIT '.(($cpage-1)*$this->psize).','.$this->psize;

        $stem=null;
        if($total<=1 || $psum<=$this->psize) return $stem;//分页总数小于分页基数

        //分布显示方式
        $txpg=empty($this->cfg['sys_pgtx'])?'&lt;&lt;':$this->cfg['sys_pgtx'];
        $nxpg=empty($this->cfg['sys_pgnx'])?'&gt;&gt;':$this->cfg['sys_pgnx'];

        if($total<=($this->pmax+2)){ //不存在缩进-直接显示所有分页
            $stem.=' <a'.(($cpage-1)>0 ? ' href="'.str_replace($this->preg,$cpage-1,$url).'"' : '').">{$txpg}</a>";
            for($i=1;$i<=$total;$i++){
                $stem.=($i==$cpage) ? " <b>{$i}</b>" : ' <a href="'.str_replace($this->preg,$i,$url)."\">{$i}</a>" ;
            }
            $stem.=' <a'.(($cpage+1)<=$total ? ' href="'.str_replace($this->preg,$cpage+1,$url).'"' : '').">{$nxpg}</a>";

        }elseif($cpage<=($this->pmax-2)){//尾部缩进
            $stem.=' <a'.(($cpage-1)>0 ? ' href="'.str_replace($this->preg,$cpage-1,$url).'"' : '').">{$txpg}</a>";
            for($i=1;$i<=$this->pmax;$i++){
                $stem.=($i==$cpage) ? ' <b>'.$i.'</b>' : ' <a href="'.str_replace($this->preg,$i,$url).'" >'.$i.'</a>';
            }
            $stem.=' <span>...</span>';
            $stem.=' <a href="'.str_replace($this->preg,$total-1,$url).'" >'.($total-1).'</a>';
            $stem.=' <a href="'.str_replace($this->preg,$total,$url).'" >'.$total.'</a>';
            $stem.=' <a'.(($cpage+1)<=$total ? ' href="'.str_replace($this->preg,$cpage+1,$url).'"' : '').">{$nxpg}</a>";

        }elseif($cpage>2 && $cpage<($total-$this->pmax+3)){//首尾双向缩进
            $stem.=' <a'.(($cpage-1)>0 ? ' href="'.str_replace($this->preg,$cpage-1,$url).'"' : '').">{$txpg}</a>";
            $stem.=' <a href="'.str_replace($this->preg,1,$url).'" >1</a>';
            $stem.=' <a href="'.str_replace($this->preg,2,$url).'" >2</a>';
            $stem.=' <span>...</span>';
            for($i=($cpage-(ceil($this->pmax/2)-1));$i<=($cpage+(ceil($this->pmax/2)-2));$i++){
                $stem.=($i==$cpage) ? ' <b>'.$i.'</b>' : ' <a href="'.str_replace($this->preg,$i,$url).'" >'.$i.'</a>';
            }
            $stem.=' <span>...</span>';
            $stem.=' <a href="'.str_replace($this->preg,$total-1,$url).'" >'.($total-1).'</a>';
            $stem.=' <a href="'.str_replace($this->preg,$total,$url).'" >'.$total.'</a>';
            $stem.=' <a'.(($cpage+1)<=$total ? ' href="'.str_replace($this->preg,$cpage+1,$url).'"' : '').">{$nxpg}</a>";

        }else{//首部缩进
            $stem.=' <a'.(($cpage-1)>0 ? ' href="'.str_replace($this->preg,$cpage-1,$url).'"' : '').">{$txpg}</a>";
            $stem.=' <a href="'.str_replace($this->preg,1,$url).'" >1</a>';
            $stem.=' <a href="'.str_replace($this->preg,2,$url).'" >2</a>';
            $stem.=' <span>...</span>';
            for($i=($total-$this->pmax+1);$i<=$total;$i++){
                $stem.=($i==$cpage) ? ' <b>'.$i.'</b>' : ' <a href="'.str_replace($this->preg,$i,$url).'" >'.$i.'</a>';
            }
            $stem.=' <a'.(($cpage+1)<=$total ? ' href="'.str_replace($this->preg,$cpage+1,$url).'"' : '').">{$nxpg}</a>";
        }
        return $stem;
    }
}
?>