<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8"/>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="keywords" content="众筹,助人,项目,投资,支持"/>
        <meta name="description" content="在赚赚乐发布需求，获得帮助，让社会聚焦于您"/>
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/bootstrap.min.css'); ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/qys_mobile.css'); ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/sider.css'); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/zepto/zepto.min.js'); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/zepto/widget.1.0.2.js'); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/zepto/sidebar.1.0.1.js'); ?>
        <?php
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/sea.js');
        ?>
    </head>
    <body>
        <div class="page-header qys_page_header">
            <div class="row" style="text-align: center;margin:0 auto;">
                <a href="index.html" class="pull-left page_left_show"></a>
                <a href="#" class="pull-right page_right_show" data-display="overlay"></a>
                <a href="#" class="page_top_logo"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png"/><?php echo $this->pagetitle; ?>-赚赚乐</a>
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
                <?php echo $content; ?>
                <div class="col-lg-12" style="padding:10px 25px 0px 25px;">
                    <p>
                        版权所有：深圳寻想网络科技有限公司
                    </p>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var sidebar = new Sidebar({
                element: '.page_sidebar',
                autoplay_interval_ms: 1000,
                contentSelector: '.page_content'
            });
            $('.page_right_show').on('tap', function () {
                sidebar.toggle($(this).data('display'), 'right');
            });
        </script>
    </body>
</html>