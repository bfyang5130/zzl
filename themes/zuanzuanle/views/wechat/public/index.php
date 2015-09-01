<script src="<?php echo Yii::app()->theme->baseUrl . '/js/zepto/carousel.1.0.4.js'; ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/carousel.1.0.4.css">
<div class="page-header qys_page_header">
    <div class="row" style="text-align: center;margin:0 auto;">
        <a href="#" class="pull-right page_right_show" data-display="overlay"></a>
        <a href="#" class="page_top_logo"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png"/>赚赚乐</a>
    </div>
</div>
<div class="page_container">

    <div class="row">
        <div class="page_sidebar sidebar-push sidebar-left" data-widget-id="0" style="-webkit-transform: translate3d(-30%, 0px, 0px);">
            <ul class="nav nav-pills nav-stacked qys_page_menuUl">
                <li><a href="<?php echo Yii::app()->createUrl('/wechat/public/index') ?>">返回首页</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('/wechat/product/index') ?>">商品中心</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('/wechat/help/index') ?>">帮助中心</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('/wechat/help/contact') ?>">联系我们</a></li>
                <li></li>
                <li><a href="<?php echo Yii::app()->createUrl('/wechat/member/index') ?>">会员中心</a></li>
            </ul>
        </div>
        <div class="page_content" style="-webkit-transform: translate3d(0px, 0px, 0px);">
            <div class="row">
                <div class="nova-carousel">
                    <div class="carousel-cont">
                        <div class="cont-item">
                            <img style="width:100%;" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/wechat/huodong/sc_img_1.jpg" alt="some pic">
                        </div>
                        <div class="cont-item">
                            <img style="width:100%;" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/wechat/huodong/sc_img_2.jpg" alt="some pic">
                        </div>
                        <div class="cont-item">
                            <img style="width:100%;" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/wechat/huodong/sc_img_3.jpg" alt="some pic">
                        </div>
                        <div class="cont-item">
                            <img style="width:100%;" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/wechat/huodong/sc_img_4.jpg" alt="some pic">
                        </div>
                    </div>
                    <div class="carousel-control1">
                        <span class="control-item"></span>
                        <span class="control-item"></span>
                        <span class="control-item"></span>
                        <span class="control-item"></span>
                    </div>
                </div>
            </div>
            <div class="row" style="background-color:#efefef;margin-bottom: 25px;">
                <h3>本月限额免费产品<?php echo Yii::app()->user->getId(); ?></h3>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-lg-5">
                            <img class="img-rounded" style="width:100%;" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/wechat/huodong/product.jpg"/>
                        </div>
                        <div class="col-lg-5">
                            <h3>清爽面膜贴</h3>
                            <p>原价：130 元</p>
                            <p>免费：每个月前50位微信用户可以免费获得！</p>
                            <p><button class="btn-danger">购买产品</button></p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">产品介绍</h3>
                    </div>
                    <div class="panel-body">
                        <p style="text-align: left;line-height: 25px;">
                            <strong><font style="font-size: 20px;">面膜</font></strong><br/>
                            是护肤品中的一个类别。其最基本也是最重要的目的是弥补卸妆与洗脸仍然不足的清洁工作，在此基础上配合其它精华成分实现其它的保养功能，例如补水保湿、美白、抗衰老、平衡油脂等等。
                            <br/>
                            <strong><font style="font-size: 20px;">功能</font></strong><br/>
                            不要急着赶流行，只将重点放在除掉鼻头粉刺，使用完撕拉式面膜，随后就又忙着贴贴式保湿面膜。那种效果，绝对不等于到美容院去做脸。真正的做面膜，应当是先给肌肤做减法，即深层清洁、去角质、去除氧化油脂，再给肌肤做加法，即在补水保湿的基础上做美白、抗衰老、平衡油脂等保养工作。
                            原理<br/>
                            <strong><font style="font-size: 20px;">面膜的原理</font></strong><br/>就是利用覆盖在脸部的短暂时间，暂时隔离外界的空气与污染，提高肌肤温度，皮肤的毛孔扩张，促进汗腺分泌与新陈代谢，使肌肤的含氧量上升，有利于肌肤排除表皮细胞新陈代谢的产物和累积的油脂类物质，面膜中的水分渗入表皮的角质层，皮肤变得柔软，肌肤自然光亮有弹性。
                            形式<br/>
                            <strong><font style="font-size: 20px;">面膜的形式</font></strong><br/>主要有泥膏型、撕拉型、冻胶型、湿纸巾型四种。泥膏型面膜常见的有海藻面膜、矿泥面膜等，撕拉型面膜最常见的就是黑头粉刺专用鼻贴，冻胶型以睡眠面膜最为出名，湿纸巾式一般就是单片包装的浸润着美容液的面膜纸。伴随着美容科技的发展，出现了一种以蚕丝制成的面膜，严格来说，应当归入湿纸巾型面膜中。</p>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-12" style="padding:10px 25px 0px 25px;">
            <p>
                版权所有：深圳寻想网络科技有限公司
            </p>
        </div>
    </div>
</div>
<script type="text/javascript">
    var carousel = new Carousel({
        element: '.nova-carousel'
    });
    carousel.set('autoplay', true);
    var sidebar = new Sidebar({
        element: '.page_sidebar',
        autoplay_interval_ms: 1000,
        contentSelector: '.page_content'
    });
    $('.page_right_show').on('tap', function () {
        sidebar.toggle($(this).data('display'), 'right');
    });
</script>
