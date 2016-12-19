{include file="hyl/header.tpl" fjs="js/form.js" fcss="css/hyl/index.css"}

<div class="get">
    <div class="am-g">
        <div class="am-u-lg-12">
            <p>
                期待你的参与，共同打造一个分享自己成长的社区
            </p>
        </div>
    </div>
</div>

<div class="detail">
    <div class="am-g am-container">
        <div class="am-u-lg-12">
            <h2 class="detail-h2">通过公众号获取知识，在这里找到和你三观相符的朋友</h2>

            <div class="am-g">
                {foreach from=$tmy.list key=key item=item}
                    <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">

                        <h3 class="detail-h3">
                            <i class="am-icon-star-o am-icon-sm"></i>
                            {$item.uname}
                        </h3>

                        <p class="detail-p">
                            {$item.intro}
                        </p>
                    </div>
                {/foreach}
            </div>
        </div>
    </div>
</div>

<div class="hope">
    <div class="am-g am-container">
        <div class="am-u-lg-4 am-u-md-6 am-u-sm-12 hope-img">
            <img src="{$smarty.fend.dm.img}i/examples/landing.png" alt="" data-am-scrollspy="{literal}{animation:'slide-left', repeat: false}{/literal}">
            <hr class="am-article-divider am-show-sm-only hope-hr">
        </div>
        <div class="am-u-lg-8 am-u-md-6 am-u-sm-12">
            <h2 class="hope-title">同我们一起打造你的阅读知识体系</h2>

            <p>
                在知识爆炸的年代，我们不愿成为知识的过客，拥抱开源文化，发挥社区的力量，踊跃参与，获得自我提升。
            </p>
        </div>
    </div>
</div>

{include file="hyl/footer.tpl"}