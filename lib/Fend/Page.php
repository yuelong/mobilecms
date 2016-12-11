<?php
/**

 * [Gimoo!] (C)2006-2009 Gimoo Inc. (http://fend.gimoo.net)
 *
 * 工厂模式 激活分页对象
 * 用于动态载入及激活对象
 *



 * @version $Id: Page.php 13 2012-02-12 15:36:56Z gimoo $
 */

class Fend_Page
{
    /**
     * 工厂模式 静态激活对象
     * @param  string $name  数据库类型
     * @return object $in       数据库对象
     */
    public static function factory($name)
    {
        $obj='Fend_Page_'.ucfirst($name);
        $obj=new $obj;

        if(func_num_args()>1){
            $args=func_get_args();unset($args[0]);
            foreach($args as $v){
                $v=explode(':',$v,2);
                if(!isset($v[1])) continue;
                $obj->$v[0]=$v[1];
            }
        }
        return $obj;
    }
}
?>