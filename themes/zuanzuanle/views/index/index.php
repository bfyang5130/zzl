<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/index.css"/>
<?php $this->renderPartial('//common/banner') ?>
<div class="site-focus" pbid="众筹制造">
    <div class="wrap">
        <div class="mod-title clearfix">
            <h2>众筹项目</h2>
            <div class="title-sub">
                <?php
                #获得项目下的分类项目
                $project = Channel::model()->find("cl_en_name=:cl_en_name", array(":cl_en_name" => 'project'));
                if ($project) {
                    $projectlist = Channel::model()->findAll("cl_class=:cl_class AND cl_status=1 order by cl_left asc ", array(":cl_class" => $project->id));
                    if ($projectlist) {
                        foreach ($projectlist as $key => $value) {
                            echo '<a href="' . Yii::app()->createUrl('/project/' . $value->id) . '" title="' . QCHtml::encode($value->cl_name) . '">' . QCHtml::encode($value->cl_name) . '</a>';
                        }
                    }
                }
                ?>
                <a href="http://www.10000rmb.com" alt="中国网赚平台" title="中国网赚平台" pbtag="hangye,hangye_zuzhou">中国网赚平台</a>
            </div>
        </div>
        <div class="focus-box" style="overflow:hidden;">
            <ul id="JS-recommend_ul" class="focus-con clearfix" style="width:980px;">
                <!--Deal Card Module-->
                <li>
                    <div class="list-item">
                        <a class="item-figure" href="/deal-show/id-12466" target="_blank">
                            <img src="http://zrstatic.wangxingroup.com/attachment/201407/22/12/53cde8564bbd5_223x168.jpg" alt="独立电商品牌大卫之选选址“床吧”，建立中国也可能是世界首家电商咖啡馆，将名噪一时的O2O做成双向，在这里把咖啡与四合院混搭，将美食与世界链接。" title="独立电商品牌大卫之选选址“床吧”，建立中国也可能是世界首家电商咖啡馆，将名噪一时的O2O做成双向，在这里把咖啡与四合院混搭，将美食与世界链接。" />
                        </a>
                        <div class="item-upvote">
                            <a class="icons " href="javascript:void(0);" rel="653" onclick="like_deal_v2(12466, this)" >653</a>
                        </div>
                        <h3><a href="/deal-show/id-12466" target="_blank">【大卫咖啡】国内首家电商咖啡馆</a></h3>
                        <div class="item-caption">
                            <span class="caption-title">目标：<em>90天</em> <em><i class="font-yen">&yen;</i>300000</em></span>
                            <span class="btn-base btn-red-h20 common-sprite">
                                <span class="common-sprite">众筹中</span>
                            </span>
                        </div>
                        <div class="progress-bar">
                            <span class="progress bg-red" style="width:28%;"></span>
                        </div>
                        <div class="item-rate clearfix">
                            <span class="rate1">
                                <em>28%</em><br>已达
                            </span>
                            <span class="rate2">
                                <em>￥84,120</em><br>已筹资
                            </span>
                            <span class="rate3">
                                <em>70天</em><br>剩余时间			</span>
                        </div>
                    </div>
                </li>
            </ul>
            <ul id="JS-recommend_btns" class="focus-btn clearfix">
                <li id="JS-recommend_pre" class="prev"><span class="common-sprite">prev</span></li>
                <li id="JS-recommend_next" class="next"><span class="common-sprite">next</span></li>
            </ul>
        </div>
    </div>
</div>

<div class="main wrap" pbid="热门项目">
    <div class="hot-project-box">
        <!--mod tit start-->
        <div class="mod-title clearfix">
            <h2>热门项目</h2>
            <div class="title-sub">
            </div>
        </div>
        <!--mod tit end-->
        <div class="hot-project">
            <ul class="clearfix">
                <li>
                    <!--Deal Card Module-->
                    <div class="list-item">
                        <a class="item-figure" href="/deal-show/id-13850" pbtag="remen_0,remenimg_0" target="_blank">
                            <img class="lzload" data-src="http://zrstatic.wangxingroup.com/attachment/201408/06/17/53e1f80c6d62d_223x168.jpg" src="http://zcstatic.wangxingroup.com/zhongchou/images/grey.gif?v=1" alt="budiu，不止是安全
                                 ---全球第一款集安全、舒适、时尚于一体的GPS智能定位童鞋" title="budiu，不止是安全
                                 ---全球第一款集安全、舒适、时尚于一体的GPS智能定位童鞋" />
                        </a>
                        <div class="item-upvote">
                            <a class="icons " href="javascript:void(0);" rel="126" onclick="like_deal_v2(13850, this)" >126</a>
                        </div>
                        <h3><a href="/deal-show/id-13850" target="_blank" pbtag="remen_0,rementxt_0">budiu 全球第一款GPS智能定位童鞋</a></h3>
                        <div class="item-caption">
                            <span class="caption-title">目标：<em>45天</em> <em><i class="font-yen">&yen;</i>100000</em></span>
                            <span class="btn-base btn-red-h20 common-sprite">
                                <span class="common-sprite">众筹中</span>
                            </span>
                        </div>
                        <div class="progress-bar">
                            <span class="progress bg-red" style="width:3%;"></span>
                        </div>
                        <div class="item-rate clearfix">
                            <span class="rate1">
                                <em>3%</em><br>已达
                            </span>
                            <span class="rate2">
                                <em>￥3,378</em><br>已筹资
                            </span>
                            <span class="rate3">
                                <em>40天</em><br>剩余时间			</span>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="project-more"><a class="more-btn" href="/browse" alt="查看更多项目",title="查看更多项目">查看更多项目</a></div>
        </div>
    </div>
</div>

<div class="support">
    <div class="wrap">
        <div class="mod-title clearfix">
            <h2>我们已经做到 ···</h2>
        </div>
        <div class="support-con clearfix">
            <ul class="support-big clearfix">
                <li><span class="icon-sup sup-sum"></span>
                    <h3>6,270,680<em>元</em></h3>
                    <p><a target="_blank" href="/deal-show/id-1199" alt="爱情保险" title="爱情保险">爱情保险</a></p>
                </li>
                <li><span class="icon-sup sup-time"></span>
                    <h3>41<em>分钟</em></h3>
                    <p><a target="_blank" href="/deal-show/id-12933" alt="让我们一起开书店，寻找属于字里行间的人" title="让我们一起开书店，寻找属于字里行间的人">让我们一起开书店，寻找…</a></p>
                </li>
                <li><span class="icon-sup sup-per"></span>
                    <h3>39563<em>人</em></h3>
                    <p><a target="_blank" href="/deal-show/id-829" alt="2013快乐男声主题电影" title="2013快乐男声主题电影">2013快乐男声主题电…</a></p>
                </li>
            </ul>
            <ul class="support-sm clearfix">
                <li><span class="icon-sup pro-sum"></span>
                    <h3>项目总数</h3>
                    <p class="red">2797<em>个</em></p>
                </li>
                <li><span class="icon-sup pro-per"></span>
                    <h3>累计支持人</h3>
                    <p class="violet">105153<em>人</em></p>
                </li>
                <li><span class="icon-sup pro-money"></span>
                    <h3>累计筹资金额</h3>
                    <p class="yellow"><em>&yen;</em>36,585,929</p>
                </li>
            </ul>
        </div>
    </div>
</div>
<script>
    $("#Js-recommend").find("li").hover(function() {
        $(this).find("span").not("[name='more']").show();
    },
            function() {
                $(this).find("span").not("[name='more']").hide();
            });

    ;
    (function($, window) {
        $.fn.lately = function(options) {
            options = $.extend({}, {container: window, gapX: 0, gapY: 0}, options);
            var $win = $(options.container), self = this;
            this.one("lately", function() {
                var src = this.getAttribute("data-src");
                this.setAttribute("src", src);
                this.removeAttribute("data-src")
            });
            function lately() {
                var inview = self.filter(function() {
                    var el = $(this), elW = el.outerWidth() + options.gapX, elH = el.outerHeight() + options.gapY, scroll = {y: $win.scrollTop(), x: $win.scrollLeft()}, viewport = {x: $win.width() + options.gapX, y: $win.height() + options.gapY};
                    return(el.offset().top < (scroll.y + viewport.y) && el.offset().left < (scroll.x + viewport.x) && (el.offset().top + elH) > scroll.y && (el.offset().left + elW) > scroll.x)
                });
                var loaded = inview.trigger("lately");
                self = self.not(loaded)
            }
            ;
            $win.on('resize scroll', lately);
            lately();
            return this
        }
    }(jQuery, window));

    $(function() {
        $("img.lzload").show().lately({"gapX": 400});
    });
</script>
