{include file="pub_header.tpl"}

<!--content begin-->
<div class="msgdiv dh">
    <div class="dmsg">
        <table class="dicon" align="center" width="90%">
            <tr>
                <td width="120px">&nbsp;</td>
                <td >
                    <p class="f20">{if $tmy.msg}{$tmy.msg}{else}操作成功{/if}</p><br /><br /><br />
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    {if $tmy.url}
                    <p class="f14">
                        <a href="{$tmy.url}" target="_self">&#9666;3秒钟之后自动跳转</a>
                    </p>
                    <script type="text/javascript">
                    setTimeout(function(){
                        window.location.href='{$tmy.url}';
                    },3000);
                    </script>
                    {else}
                    <p class="f16">
                        <a href="{$smarty.fend.dm.self}" target="_self">&#9666;返回首页</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a target="_self" href="javascript:;" onClick="javascript:history.back(-1);">&#9666;返回上一页</a>
                    </p>
                    {/if}
                    <ul>
                        <li>不要返回吗 ?</li>
                        <li>确定不要返回吗 ?</li>
                        <li>真的真的确定不要返回吗 ?</li>
                        <li>好吧.还是随便你要不要真的确定返回吧 ! ~</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
</div>
<!--content end-->


{include file="pub_footer.tpl"}