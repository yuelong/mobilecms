<?php
/**
 * 讯搜
 * @Author  Yuelong <yuelonghu@100tal.com>
 * @version $Id$
 */
define('SCRIPT_ROOT',  dirname(__FILE__).'/');
require_once(SCRIPT_ROOT . 'sdk/php/lib/XS.php');

class Vendor_XunSearch_Init extends Fend
{

    private $xs = null;

    public static function Factory($t = 'demo')
    {
        return new self($t);
    }

    //配置环境
    public function __construct($t)
    {
        $this->xs = new XS($t);
    }

}
?>