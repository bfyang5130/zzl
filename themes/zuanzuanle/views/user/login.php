<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/login.css"/>
<?php $this->renderPartial('//common/html5_top_main') ?>
<div class="main" style="min-height: 700px;">
    <div class="wrap">
        <div class="main-inner" style="background-image:url(<?php echo Yii::app()->theme->baseUrl; ?>/images/login_bannar.png)"> </div>
        <div class="login-block" style="position:absolute; right:0; top:60px;">
            <div class="login-func">
                <ul class="clearfix">
                    <li id="Js-pcbtn" class="select" style="width:350px;cursor:default;"><span>用户登录</span></li>
                </ul>
            </div>
            <div id="Js-pclogin" class="login-form">
                <form method="post" id="JS-user_login_form">
                    <div class="login-form-ipt">
                        <input class="uid icon-login ie6fixpic" type="text" placeholder="请输入用户名/手机号/邮箱" id="loginusername" name="username">
                    </div>
                    <div class="login-form-ipt">
                        <input class="ped icon-login ie6fixpic" type="password" placeholder="请输入密码" id="loginpwd" name="user_pwd">
                    </div>
                    <div class="login-form-btn">
                        <input type="submit" value="登录">
                    </div>
                </form>
                <div class="pass-login clearfix">
                    <div class="fl">
                        <a class="weibo icon-login" href="#">新浪微博</a>|
                        <a class="tqq icon-login" href="#">腾讯微博</a>
                    </div>
                    <a class="red fr" href="<?php echo Yii::app()->createUrl('/member/forgetpwd') ?>">忘记密码？</a>
                </div>
            </div>
        </div>
        <script>
            var dialogdir = "<?php echo Yii::app()->theme->baseUrl; ?>/src";
            (function() {
                $("#JS-user_login_form").bind("submit", function() {
                    //判断数据是否填写正确
                    var commitstatus = true;
                    var msg = "<font color=blue><strong>登录中...</strong></font>";
                    var username = $.trim($("#loginusername").val());
                    var password = $.trim($("#loginpwd").val());
                    if (username === "" || password === "") {
                        msg = "<font color=red><strong>用户名或者密码不能为空!</strong></font>";
                        commitstatus = false;
                    }
                    seajs.use(['jquery', dialogdir + '/dialog-plus'], function($, dialog) {
                        var d = dialog({
                            title: '登录信息',
                            content: msg,
                            cancelValue: '知道了',
                            cancel: function() {
                            }
                        });

                        d.width(300).height(50).showModal();
                        if (!commitstatus) {
                            return false;
                        }
                        var ajaxurl = '/member/login.html';
                        var query = new Object();
                        query.username = username;
                        query.password = password;
                        $.ajax({
                            url: ajaxurl,
                            dataType: "json",
                            data: query,
                            type: "POST",
                            success: function(ajaxobj) {
                                if (ajaxobj.status == 1)
                                {
                                    window.location.href = "/member/index.html";
                                }
                                else
                                {
                                    d.content(ajaxobj.info).showModal();
                                }
                            },
                            error: function(ajaxobj)
                            {
                                d.content("<font color=red><strong>登录失败，请重试!</stonr></font>").showModal();
                            }
                        });
                    });
                    //ajax提交登录数据


                    return false;
                });
            })();
        </script>
    </div>
</div>