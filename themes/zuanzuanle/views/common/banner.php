<div class="banner" pbid="banner">
    <div class="wrap">
        <style>
            #JS-banner_ul{position:relative;}
            #JS-banner_ul li{float:left}
        </style>
        <div class="wrap" style="overflow:hidden;">
            <ul id="JS-banner_ul" class="clearfix" style="height:392px;width:960px;">
                <?php
                for ($i = 1; $i <= 3; $i++) {
                    ?>
                    <li>
                        <a target="_blank" href="#" pbtag="bannerimg<?php echo ($i - 1); ?>" >
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bannar/b<?php echo $i; ?>.png" width="960" height="392">
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <div class="focus-btn">
            <a id="JS-banner_pre" class="prev common-sprite ie6fixpic" href="javascript:void(0);">上一张</a>
            <a id="JS-banner_next" class="next common-sprite ie6fixpic" href="javascript:void(0);">下一张</a>
        </div>
    </div>
</div>
<script>
    (function() {
        var len = 7;
        var banner = $("#JS-banner_ul");
        banner.css("width", len * 960);
        var sindex = 0;
        var inanimate = false;
        var inHover = false;

        function moveByDirect(to_right) {
            if (inanimate)
                return;
            inanimate = true;
            var start = 0;
            var end = -960;
            if (!to_right) {
                start = -960;
                end = 0;
                loadBannerImg(banner.children().last().prev());
                banner.children().last().insertBefore(banner.children().first());
            } else {
                loadBannerImg(banner.children().first().next());
            }
            banner.css("margin-left", start);
            banner.animate({"margin-left": end}, 500, function() {
                inanimate = false;
                if (to_right) {
                    banner.children().first().insertAfter(banner.children().last());
                }
                banner.css("margin-left", 0);
                autoScroll();
            });
        }

        $("#JS-banner_pre").bind("click", function() {
            moveByDirect(false);
        });
        $("#JS-banner_next").bind("click", function() {
            moveByDirect(true);
        });
        $("#JS-banner_ul").bind("mouseover", function() {
            inHover = true;
        });
        $("#JS-banner_ul").bind("mouseout", function() {
            inHover = false;
        });
        $("#JS-banner_ul img").bind("load", function() {
            $(this).attr("data-load", "ok");
        });

        var timer = null;
        function clearAutoScroll() {
            if (timer) {
                clearTimeout(timer);
                timer = null;
            }
        }
        window.loadBannerImg = function(p) {
            var o = p.children().children("img");
            if (o.attr("data-init") != "ok") {
                o.attr({"src": o.data("src"), "data-init": "ok"});
            }
        }

        function autoScroll(init) {
            clearAutoScroll();
            timer = setTimeout(function() {
                if (inHover || banner.children().first().next().children().children("img").attr("data-load") != "ok") {
                    autoScroll();
                } else {
                    moveByDirect(true);
                }
            }, 5000);
            if (!init) {
                loadBannerImg(banner.children().first().next());
            }
        }
        autoScroll(1);
    })();
    $(function() {
        loadBannerImg($("#JS-banner_ul").children().first().next());
        $("#JS-banner_ul img").each(function() {
            //$(this).attr("src",$(this).attr("data-src"));
        });
    });
</script>