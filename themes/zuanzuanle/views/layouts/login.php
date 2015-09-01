<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="keywords" content="众筹 助人 项目 投资 支持"/>
        <meta name="description" content="在赚赚乐发布需求，获得帮助，让社会聚焦于您"/>
        <link rel="bookmark" type="image/x-icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.png?v=1">
        <link rel="shortcut icon" type="image/png" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.png?v=1">
        <link rel="icon" type="image/png" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.png?v=1">
        <!--public js&css start-->                                           
        <!--public js&css end -->    
        <script type="text/javascript">
            var APP_ROOT = '';
            //var LOADER_IMG = 'http://zcstatic.wangxingroup.com/zhongchou/images/lazy_loading.gif?v=1';
            //var ERROR_IMG = 'http://zcstatic.wangxingroup.com/zhongchou/images/image_err.gif?v=1';
            var LOADER_IMG = '';
            var ERROR_IMG = '';
            var lst = {'t0': new Date().getTime()};
            var domain = document.domain;</script>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/global.css"/>
        <?php 
        Yii::app()->clientScript->registerCoreScript('jquery'); 
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/sea.js');
        ?>
        <script type="text/javascript">
            seajs.config({
                alias: {
                    "jquery": "jquery-1.10.2.js"
                }
            });
        </script>
    </head>

    <body>
        <!--header static-->
        <div class="header">
            <div class="wrap clearfix" pbid="header">
                <div class="img-logo">
                    <h1>
                        <a alt="赚赚乐" class="ie6fixpic" title="赚赚乐" href="/index">赚赚乐</a>
                    </h1>
                </div>
                <!--menu start-->
                <div class="menu">
                    <ul class="clearfix">
                        <li class="select"><a href="/index">首页 </a></li>
                        <li><a href="/browse">浏览项目 </a></li>
                        <li><a href="/open">开放平台 </a></li>
                        <li><a href="/partake">新手帮助 </a></li>
                        <li><a href="/project">发起项目 </a></li>
                        <!--<li><a href="/help-about/id-1">关于众筹 </a></li>-->
                        <!-- <li><a href="/browse-showstock">股权众筹 </a></li> -->
                    </ul>
                </div>
                <!--menu end-->
                <!--search start-->
                <div class="search common-sprite ie6fixpic sw">
                    <form action="/deals" method="post" id="header_new_search_form" wx-validator>
                        <input type="text" name="k" wx-validator-placeholder="搜索" wx-validator-rule="required" class="search-key gray" wx-validator-notip />
                        <input id="Js-search-submit" type="submit" class="btn-search ie6fixpic" />
                    </form>
                </div>
                <!--search end-->

                <!--login start-->
                <div class="login-wrap">
                    <?php $this->renderPartial('//common/login') ?>
                </div>
                <!--login end-->

            </div>
        </div>
        <!--header-end-->
        <?php echo $content; ?>
        <!--footer static-->
        <div class="footer" pbid="footer" style="background: none;text-align: center;">
            <p>&copy;2014  中国网赚平台   zuanzuanle.com  版权所有  </p>
        </div>
        <!--footer section start-->

    </div>

    <!--[if IE 6]>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/DD_belatedPNG_0.0.8a.js"></script>
    <![endif]-->
</html> 