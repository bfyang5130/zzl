<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/login.css"/>
<div class="container">
    <div class="row">
        <div class="hidden-xs col-sm-6 col-md-8">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/login_bannar.png"/>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="col-xs-12 col-sm-12 col-md-12 login_form">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <strong>新用户注册</strong>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" id="JS-user_login_form" role="form">
                            <div class="form-group">
                                <label for="loginusername">用户名</label>
                                <input type="text" class="form-control"  name="username" id="loginusername"  placeholder="请输入6-20位数字字母组合的用户名">
                            </div>
                            <div class="form-group">
                                <label for="loginpwd">密码</label>
                                <input type="password" class="form-control" id="loginpwd"  name="user_pwd"  placeholder="请输入8-20位密码">
                            </div>
                            <div class="form-group">
                                <label for="loginpwd">邮箱</label>
                                <input type="text" class="form-control" id="loginemail"  name="user_email"  placeholder="输入您的邮箱">
                            </div>
                            <div class="form-group">
                                <label for="loginpwd">验证码</label>
                                <input type="text" class="form-control" id="loginverifycode"  name="verifyCode"  placeholder="输入下面的验证码">
                                <?php $this->widget('CCaptcha', array('showRefreshButton' => false, 'clickableImage' => true, 'imageOptions' => array('alt' => '点击换图', 'title' => '点击换图', 'style' => 'cursor:pointer'))); ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default btn-info">注册</button>
                                <span class="pull-right"><label style="margin-bottom: 0px;"><a href="/user/forgetpwd.html">忘记密码?</a></label></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var dialogdir = "<?php echo Yii::app()->theme->baseUrl; ?>/src";
    (function() {
        $("#JS-user_login_form").bind("submit", function() {
            //判断数据是否填写正确
            var commitstatus = true;
            var msg = "<font color=blue><strong>注册中...</strong></font>";
            var username = $.trim($("#loginusername").val());
            var password = $.trim($("#loginpwd").val());
            var email = $.trim($("#loginemail").val());
            var vecode = $.trim($("#loginverifycode").val());
            if (username === "" || password === "" || email === "" || vecode === "") {
                msg = "<font color=red><strong>请填写完整注册信息!</strong></font>";
                commitstatus = false;
            }
            seajs.use(['jquery', dialogdir + '/dialog-plus'], function($, dialog) {
                var d = dialog({
                    title: '注册信息',
                    content: msg,
                    cancelValue: '知道了',
                    cancel: function() {
                    }
                });

                d.width(300).height(50).showModal();
                if (!commitstatus) {
                    return false;
                }
                var ajaxurl = '/user/register.html';
                var query = new Object();
                query.username = username;
                query.password = password;
                query.email = email;
                query.verifyCode = vecode;
                $.ajax({
                    url: ajaxurl,
                    dataType: "json",
                    data: query,
                    type: "POST",
                    success: function(ajaxobj) {
                        if (ajaxobj.status == 1)
                        {
                            d.content(ajaxobj.info).showModal();
                            window.location.href = "/member/index.html";
                        }
                        else
                        {
                            d.content(ajaxobj.info).showModal();
                        }
                    },
                    error: function(ajaxobj)
                    {
                        d.content("<font color=red><strong>注册失败，请重试!</stonr></font>").showModal();
                    }
                });
            });
            //ajax提交登录数据


            return false;
        });
    })();
</script>