<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="hidden-xs col-sm-3 col-md-3"></div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="panel panel-default qys_member_panel">
            <div class="panel-heading">
                <h5 class="panel-title">
                    <strong><font style="color:red;">错误信息</font></strong>
                </h5>
            </div>
            <div class="panel-body">
                <div style="text-align:left;padding-left:10px;height:75px;">
                    <p class="error">
                        <?php
                        $result = Yii::app()->user->getFlash('fail');
                        echo!empty($result) ? $result : "错误的操作";
                        ?>
                    </p>
                    <p class="detail"></p>

                </div>
                <p class="jump">
                    <?php
                    $result = Yii::app()->user->getFlash('reurl')
                    ?>
                    页面自动 <a style="color:blue;" id="href" href="<?php echo!empty($result) ? $result : "/index.html"; ?>">跳转</a> 等待时间： <b id="wait">5</b>
                </p>
            </div>
        </div>
    </div>
    <div class="hidden-xs col-sm-3 col-md-3"></div>
</div>


<style type="text/css">
    *{ padding: 0; margin: 0; }
    body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
    .jump{ padding-right:10px;height:25px;line-height:25px;font-size:14px;background-color:#e6e6e1 ; display:block;text-align:right;}
    .jump a{ color: #333;}
    .error{ line-height: 1.8em; font-size: 15px;color:red; }
    .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
</style>
<script type="text/javascript">

    (function () {
        var wait = document.getElementById('wait'), href = document.getElementById('href').href;
        totaltime = parseInt(wait.innerHTML);
        var interval = setInterval(function () {
            var time = --totaltime;
            wait.innerHTML = "" + time;
            if (time === 0) {
                location.href = href;
                clearInterval(interval);
            }
            ;
        }, 1000);
    })();

</script>