<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="keywords" content="众筹,助人,项目,投资,支持"/>
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
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/global.css?v=0.1"/>
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
        <div class="footer" pbid="footer">
            <!--footer section start-->
            <div class="footer-section clearfix">
                <div class="footer-wrap">
                    <!--footer map start-->
                    <div class="foot-map">
                        <dl>
                            <dt>众筹项目</dt>
                            <dd>
                            </dd><dd>                    <a href="/browse/id-12" title="科技">科技</a><em>/</em>
                                <a href="/browse/id-22" title="艺术">艺术</a><em>/</em>
                                <a href="/browse/id-13" title="设计">设计</a><em>/</em>
                                <a href="/browse/id-20" title="音乐">音乐</a><em>/</em>
                            </dd><dd>                    <a href="/browse/id-15" title="影视">影视</a><em>/</em>
                                <a href="/browse/id-16" title="出版">出版</a><em>/</em>
                                <a href="/browse/id-25" title="动漫游戏">动漫游戏</a><em>/</em>
                                <a href="/browse/id-23" title="公益">公益</a><em>/</em>
                            </dd><dd>                    <a href="/browse/id-26" title="公开课">公开课</a><em>/</em>
                                <a href="/browse/id-28" title="农业">农业</a><em>/</em>
                                <a href="/browse/id-18" title="其他">其他</a><em>/</em>

                            </dd>
                        </dl>
                        <dl>
                            <dt>关于</dt>
                            <dd>
                                <a href="/help-about/id-1" alt="关于众筹" title="关于众筹">关于众筹</a><em>/</em><a href="/help-contact" alt="联系我们" title="联系我们">联系我们</a><em>/</em><a href="/help-center" alt="帮助中心" title="帮助中心">帮助中心</a><em>/</em></dd><dd><a href="/help-team" alt="团队介绍" title="团队介绍">团队介绍</a><em>/</em><a href="/help-term" alt="服务协议" title="服务协议">服务协议</a><em>/</em><a href="/help-specification" alt="项目发起规范" title="项目发起规范">项目发起规范</a><em>/</em></dd>
                        </dl>
                        <dl>
                            <dt>关注我们</dt>
                            <dd>
                                <a target="_blank" href="http://tieba.baidu.com/f?ie=utf-8&kw=%E4%BC%97%E7%AD%B9%E7%BD%91" alt="百度贴吧" title="百度贴吧">百度贴吧</a><em>/</em>
                                <a target="_blank" href="http://user.qzone.qq.com/2357291729" alt="QQ空间" title="QQ空间">QQ空间</a><em>/</em>
                                <a target="_blank" href="http://e.weibo.com/zhongchouwang2013" alt="新浪微博" title="新浪微博">新浪微博</a>
                            </dd> 
                            <dd>
                                <a target="_blank" href="http://www.douban.com/people/zhongchou_cn/" alt="豆瓣小站" title="豆瓣小站">豆瓣小站</a><em>/</em>
                            </dd>
                        </dl>
                        <dl class="last">
                            <dt>服务</dt>
                            <dd>
                                <a target="_blank" href="/help-tourongzi" alt="投融资服务" title="投融资服务">投融资服务</a>
                            </dd> 
                        </dl>
                    </div>
                    <!--foot map end-->
                    <div class="foot-logo">
                        <h1></h1>
                    </div>
                </div>
            </div>
            <!--footer section start-->
            <div class="footer-copy">
                <div class="footer-wrap">
                    <div class="ft-links">
                        <div class="links-arrow">友情链接：</div>
                        <p>
                            <a href="http://iof.hexun.com/zhongchou/index.html" target="_blank">和讯网</a>
                            <a href="http://www.leiphone.com/" target="_blank">雷锋网</a>
                            <a href="http://www.36kr.com/   " target="_blank">36氪</a>
                            <a href="http://www.hao123.com/" target="_blank">hao123</a>
                            <a href="http://hao.360.cn/" target="_blank">360安全网址</a>
                            <a href="http://www.ynet.com/" target="_blank">北青网</a>
                            <a href="http://finance.ifeng.com/" target="_blank">凤凰网</a>
                            <a href="http://jrj.com.cn" target="_blank">金融界</a>
                            <a href="http://www.caixin.com/" target="_blank">财新网</a>
                            <a href="http://www.tmtpost.com/" target="_blank">钛媒体</a>
                            <a href="http://www.imgii.com?zhongchou" target="_blank">IMGII</a>
                            <a href="http://www.m1905.com/film/" target="_blank">电影网</a>
                            <a href="http://www.artron.net/" target="_blank">雅昌艺术网</a>
                            <a href="http://www.vmovier.com/" target="_blank">V电影</a>
                            <a href="http://www.eguan.cn" target="_blank">易观网</a>
                            <a href="http://www.pedaily.cn/" target="_blank">投资界          </a>
                            <a href="http://home.ebrun.com/" target="_blank">亿邦动力社区</a>
                            <a href="http://www.lagou.com/" target="_blank">拉勾网</a>
                            <a href="http://www.9888.cn" target="_blank">金融工场</a>
                            <a href="http://www.trchina.org/" target="_blank">投融中国联盟</a>
                            <a href="http://www.youcheng.org/" target="_blank">友成基金会</a>
                            <a href="http://life.renren.com" target="_blank">人人生活</a>
                            <a href="http://www.meng800.com/ " target="_blank">众筹导航</a>
                            <a href="http://www.diaochapai.com" target="_blank">调查派</a>
                            <a href="http://www.qidic.com" target="_blank">奇笛网</a>
                            <a href="http://www.rong360.com" target="_blank">融360</a>
                            <a href="http://www.66money.com/" target="_blank">联信财富</a>
                        </p>
                    </div>
                    <p>&copy;2014  中国网赚平台   zuanzuanle.com  版权所有  </p>
                </div>
            </div>
        </div>
    </body> 
    <!--[if IE 6]>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/DD_belatedPNG_0.0.8a.js"></script>
    <![endif]-->
</html> 