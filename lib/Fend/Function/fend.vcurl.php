<?php

/**
 * CURL封装函数
 *
 * @param string $url 请求的url
 * @param array $postData post数据，空数组则为get请求
 * @param string $cookie
 * @param string $cookiejar
 * @param string $referer
 * @param int $header 是否显示header
 * @param int $timeout 超时时间
 * @return string 返回请求数据
 *

 * @Support http://www.kaoyan.com
 * @Author  Yuelong <yuelonghu@100tal.com>
 * @version $Id$
 */
function vcurl($url, $postData = array(), $header = array(), $cookie = '', $cookiejar = '', $referer = '', $isheader = 0, $timeout = 5)
{
    $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36';
    $info = '';
    $cookiepath = getcwd() . './' . $cookiejar;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
    if ($referer) {
        curl_setopt($curl, CURLOPT_REFERER, $referer);
    } else {
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
    }
    if ($postData) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
    }
    if ($cookie) {
        curl_setopt($curl, CURLOPT_COOKIE, $cookie);
    }
    if ($cookiejar) {
        curl_setopt($curl, CURLOPT_COOKIEJAR, $cookiepath);
        curl_setopt($curl, CURLOPT_COOKIEFILE, $cookiepath);
    }
    //curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, $timeout); //超时时间5秒
    curl_setopt($curl, CURLOPT_HEADER, $isheader); //此处为1可以使返回值加上header
    if ($header) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $info = curl_exec($curl);
    if (curl_errno($curl)) {
//        echo 'curl error: ' . curl_error($curl);
        return false;
    }
    curl_close($curl);
    return $info;
}

?>