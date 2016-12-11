<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>{$meta.title}MobileCMS.cn</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="format-detection" content="telephone=no">
        <meta name="renderer" content="webkit">
        <meta http-equiv="Cache-Control" content="no-siteapp">
        {if $meta.keyw}<meta name="keywords" content="{$meta.keyw}">
        {/if}
        {if $meta.desc}<meta name="Description" content="{$meta.desc}">
        {/if}
        <link rel="alternate icon" type="image/png" href="{$smarty.fend.dm.img}i/favicon.png">
        <link rel="stylesheet" href="{$smarty.fend.dm.img}css/amazeui.min.css">
        {if $fcss}
            {if is_array($fcss)}
                {foreach item=v from=$fcss}
                    <link rel="stylesheet" type="text/css" href="{$smarty.fend.dm.img}{$v}?v={$ver}">
                {/foreach}
            {else}
                <link rel="stylesheet" type="text/css" href="{$smarty.fend.dm.img}{$fcss}?v={$ver}">
            {/if}
        {/if}
    </head>
    <body>
        <header class="am-topbar am-topbar-fixed-top">
            <div class="am-container">
                <h1 class="am-topbar-brand">
                    <a href="/">MobileCMS</a>
                </h1>
                {literal}
                    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-secondary am-show-sm-only"
                        data-am-collapse="{target: '#collapse-head'}"><span class="am-sr-only">导航切换</span> <span
                        class="am-icon-bars"></span></button>
                {/literal}
                <div class="am-collapse am-topbar-collapse" id="collapse-head">
                    <ul class="am-nav am-nav-pills am-topbar-nav">
                        {*<li class="am-active"><a href="/">首页</a></li>*}
                        <li><a href="/product">产品介绍</a></li>
                        <li><a href="/case">解决方案</a></li>
                        <li><a href="/buy">产品购买</a></li>
                        <li><a href="/contact">联系我们</a></li>
                        <li class="am-dropdown" data-am-dropdown>
                            <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                                更多 <span class="am-icon-caret-down"></span>
                            </a>
                            <ul class="am-dropdown-content">
                                {*<li class="am-dropdown-header">标题</li>*}
                                <li><a href="/sms">短信系统</a></li>
                                <li><a href="/chat">聊天系统</a></li>
                                <li><a href="/caiji">采集系统</a></li>
                                <li><a href="/edu">教学系统</a></li>
                            </ul>
                        </li>
                    </ul>

                    <div class="am-topbar-right">
                        <button class="am-btn am-btn-secondary am-topbar-btn am-btn-sm"><span class="am-icon-pencil"></span> 注册</button>
                    </div>

                    <div class="am-topbar-right">
                        <button class="am-btn am-btn-primary am-topbar-btn am-btn-sm"><span class="am-icon-user"></span> 登录</button>
                    </div>
                </div>
            </div>
        </header>