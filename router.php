<?php
/**

 */
 *
 * 代理器
 * 负责与框架之间的接口设置与路由配置
 *



 * @version $Id: router.php 128 2012-04-16 16:05:14Z gimoo $
 */

require_once('config.php');//基本配置
require_once(FD_ROOT.'Fend.php');//Fend框架

//路由层
class Router extends Fend
{
    /**
     * 处理模板并回显
     * 继承Fend::showView方法
     *
     * @param  string $tplVar 模板标识
     * @param  string $tplDir 模板目录
     * @param  string $tplPre 模板后缀
     */
    public function showView($tplVar,$tplPre='.tpl')
    {
        //传递一个变量到Smarty模版内部
        $tplVar=empty($this->uri[1]) ? $tplVar : $this->uri[1].'/'.$tplVar;
        parent::showView($tplVar.$tplPre);
    }

    /**
     * 发送提示信息
     * $aUrl 为空直接返回 为1返回根模块 非空返回到指定模块
     *
     * @param  string $txt  提示信息
     * @param  string $aUrl 为空直接返回 为1返回根模块 非空返回到指定模块
     */
    public function showError($msg=null)
    {
        header('Expires: 0');
        header("HTTP/1.0 404 Not Found");
        $tmy = array('msg'=>$msg);
        self::gHead('title','你访问的页面不存在');
        parent::regVar($tmy);
        parent::showView('index_error.tpl');
        exit;
    }

    /**
     * 发送提示信息
     * $aUrl 为空直接返回 为1返回根模块 非空返回到指定模块
     *
     * @param  string $txt  提示信息
     * @param  string $aUrl 为空直接返回 为1返回根模块 非空返回到指定模块
     */
    public function showAlert($msg,$url=null)
    {
        $tmy = array('msg'=>$msg,'url'=>$url);
        parent::regVar($tmy);
        parent::showView('index_alert.tpl');
        exit;
    }

    /**
     * 解析并送出JSON
     * 200101
     * @param  array $res   资源数组，如果是一个字符串则当成错误信息输出
     * @param  int   $state 状态值，默认为0
     * @param  int   $msg   是否直接输出,1为返回值
     * @return array
     */
    public function showMsg($res,$state=0)
    {
        // 构造数据
        $item=array('errmsg'=>'','state'=>(int)$state,'res'=>null);
        if (is_array($res) && !empty($res)) {
            $item['res'] = $res;
        }elseif(is_string($res)){
            $item['errmsg'] = $res;
        }

        if(isset($_GET['debug']) && $_GET['debug']=='1'){
            echo "<pre>";
            print_r($item);
        }else{
            //编码
            $item  = json_encode($item);

            // 是否为jsonp访问
            if (isset($_GET['callback']) && !empty($_GET['callback'])) {
                $item = "{$_GET['callback']}($item)";
            }

            // 送出信息
            echo "{$item}";
        }
    }

    /**
     * 设置页面头信息[Meta信息]
     *
     * @param  string $k   配置类型适用于Meta中的类型如 CSS/JS/TITLE等
     * @param  string $str 写入的信息
     */
    public function gHead($k,$str)
    {
        static $ghead;
        //初始化头信息变量并送入到模板中
        if(!isset($ghead)){
            $ghead=&$this->meta[$this->uri[1]];
            self::refVar($ghead,'meta');
        }

        !isset($ghead[$k]) && $ghead[$k]=null;
        switch($k){
            case 'js'://JS写入
                $ghead[$k].="<script type=\"text/javascript\" src=\"{$this->dm['img']}{$str}\" ></script>\n";
                break;
            case 'link'://CSS写入
                $ghead[$k].="<link href=\"{$this->dm['img']}{$str}\" rel=\"stylesheet\" type=\"text/css\" />\n";
                break;
            case 'title':
                $ghead[$k]=(empty($str) ? null : $str.'_' ).$ghead[$k];
                break;
            default:
                $ghead[$k]=$str;
                break;
        }
    }
}
?>