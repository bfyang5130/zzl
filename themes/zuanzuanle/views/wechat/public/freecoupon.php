<div class="page_content" style="-webkit-transform: translate3d(0px, 0px, 0px);">
    <div class="row">
        <img style="width:100%;" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/wechat/huodong/guagualebg.png"/>
    </div>
    <div class="row" style="text-align: center;">
        <style type="text/css">
            .scratch-ticket {
                background: url(/pic/wechatfree.html?id=123456);
                background-size: 300px 80px;
            }
            body{background-color: #fabf17;}
        </style>
        <h5>刮奖区</h5>
        <canvas class="scratch-ticket" width="350" height="100"></canvas>
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/zepto/scratchTicket.1.0.0.js"></script>
<script type="text/javascript">
    var scratchTicket = new ScratchTicket({
        element: '.scratch-ticket',
        img: $('.scratch-front')[0]
    });
    scratchTicket.on('scratchoff', function () {
        alert('返回');
        window.location.href="/wechat/public.html";
    });
</script>
