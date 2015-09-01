<div class="panel panel-default" style="background-color: #f0f0f0;">
    <dl class="dl-horizontal" style="margin:10px;">
        <?php
        $user_id = Yii::app()->user->getId();
        //获得用户的资金信息
        $oneaccountinfo = Account::model()->find("user_id=:user_id", array(":user_id" => $user_id));

        $defaultimg = Yii::app()->theme->baseUrl . "/images/defaultpic.jpg";
        if (Yii::app()->user->getState("_litpic")) {
            $defaultimg = Yii::app()->user->getState("_litpic");
        }
        $realname = Yii::app()->user->getState("_realname") ? Yii::app()->user->getState("_realname") : "无名氏";
        $time = date("H") + 1;
        if ($time > 22) {
            $welcomestring = "夜深了，";
            $saystring = "准备早点休息吧!";
        } elseif ($time > 20) {
            $welcomestring = "晚上好呀，";
            $saystring = "晚上玩得开心哦!";
        } elseif ($time > 17) {
            $welcomestring = "傍晚好呀，";
            $saystring = "准备晚饭咯，不要饿肚子了啦!";
        } elseif ($time > 13) {
            $welcomestring = "下午好呀，";
            $saystring = "喝杯咖啡休息一下吧!";
        } elseif ($time > 11) {
            $welcomestring = "中午好呀，";
            $saystring = "好好休息，睡个午觉吧!";
        } elseif ($time > 6) {
            $welcomestring = "早上好，";
            $saystring = "一天之计在于晨，加油!努力";
        } else {
            $welcomestring = "夜猫子！";
            $saystring = "快点去休息，熬夜容易老。身体又差，妈妈会担心的!";
        }
        $safelevle = $oneaccountinfo->user->getSafeLevel();
        $showword = '<font style="color:red">非常差</font>';
        switch ($safelevle) {
            case 0:
            case 1:
            case 2: break;
            case 3: $showword = '<font style="color:yellow">一般</font>';
                break;
            case 4: $showword = '<font style="color:blue">高</font>';
                break;
            case 5: $showword = '<font style="color:green">非常高</font>';
                break;
        }
        ?>
        <dt style="width:100px;"><img class="img-rounded" style="width:100px;height:100px;" src="<?php echo $defaultimg; ?>"></dt>
        <dd style="margin-left: 120px;">
            <h3 style="border-bottom: 1px solid #ddd;height:35px;"><?php echo $welcomestring . $realname; ?> <small><?php echo $saystring; ?></small></h3>
            <span>帐号名：<?php echo Yii::app()->user->getState("_username"); ?></span>
            <span>&nbsp;<a href="/member/user/safe.html" style="color:green;font-weight:900;"><img alt="实名认证" src="/themes/zuanzuanle/images/<?php echo (Yii::app()->user->getState("_realstatus") == 1) ? 'real_status_t' : 'real_status_f'; ?>.png"/></a>&nbsp;</span>
            <span> <img alt="站内信" src="/themes/zuanzuanle/images/email.png"/><span> (<a href="/member/message/index.html" style="color:green;font-weight:900;"> <?php echo Message::getMessageNumbers(Yii::app()->user->getState("_user_id"), 1); ?> </a>) </span></span>
            <span> | 安全等级：<?php echo $showword ?></span>
            <span> | 上次登录 <font style="color:red;font-weight:900;">时间：</font><?php echo date("Y.m.d H:i:s", Yii::app()->user->getState("_uptime")); ?> <font style="color:red;font-weight:900;">IP：</font><?php echo Yii::app()->user->getState("_upip"); ?></span>
        </dd>
    </dl>
</div>
<div class="panel panel-default">
    <ul class="list-unstyled" style="margin:10px;">
        <li><h4 style="border-bottom: 1px solid #ddd;height:30px;font-weight: 600;">资金信息</h4><span style="cursor: pointer;position: relative;top:5px;">总金额：<font style="color:red;font-weight: 900;font-size: 18px;"><?php echo round($oneaccountinfo->total, 2); ?></font></span><span style="position: relative;top:5px;"> 可用金额：<font style="color:#333;font-weight: 900;font-size: 18px;"><?php echo round($oneaccountinfo->use_money, 2); ?></font></span><span style="position: relative;top:5px;"> 冻结金额：<font style="color:skyblue;font-weight: 900;font-size: 18px;"><?php echo round($oneaccountinfo->no_use_money, 2); ?></font></span><span style="margin-left: 20px;"> <a class="btn btn-sm btn-success" href="/member/index/money.html">充值</a></span><span>  <a class="btn btn-sm btn-primary" href="/member/index/money.html?tab=tab1">提现</a></span></li>
    </ul>
</div>
<div class="panel panel-default qys_member_index" style="height:440px;min-height: 440px;">
    <ul class="list-unstyled" style="margin:10px;">
        <li><h4 style="border-bottom: 1px solid #ddd;height:30px;font-weight: 600;">最近交易记录</h4>
            <span class="qys_memberindex_log" style="color:red;cursor: pointer;" tval="zijin">资金记录</span> | <span class="qys_memberindex_log" style="cursor: pointer;" tval="chongzhi">充值记录</span> | <span style="cursor: pointer;" class="qys_memberindex_log" tval="tixian">提现记录</span></li>
    </ul>
    <ul class="list-unstyled" style="margin:10px;">
        <li id="qys_member_index_logs">
            <?php $this->renderPartial('//member/index/pad/pad_zijinlogs'); ?>
        </li>
    </ul>
</div>
<script type="text/javascript">
    $(function () {
        $(".qys_memberindex_log").click(function () {
            var tval = $(this).attr("tval");
            $.ajax({
                url: '/member/tool/toolLogs/id/' + tval + '.html',
                dataType: "html",
                type: "POST",
                success: function (ajaxobj) {
                    $('#qys_member_index_logs').html(ajaxobj);
                },
                error: function (ajaxobj)
                {
                    $('#page-qys_member_index_logs').html("<font color=red><strong>获取数据失败，请重试!</stonr></font>");
                }
            });
            $(".qys_memberindex_log").css("color", "black");
            $(this).css("color", "red");
        });
    });
</script>