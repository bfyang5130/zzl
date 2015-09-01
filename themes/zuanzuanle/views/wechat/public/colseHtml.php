<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<div class="page-header qys_page_header">
    <div class="row" style="text-align: center;margin:0 auto;">
        <a href="#" class="page_top_logo"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png"/>赚赚乐</a>
    </div>
</div>
<div class="page_container">
    <div class="row">
        <div class="page_content" style="-webkit-transform: translate3d(0px, 0px, 0px);">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 style="color:red;">登录失败，请关闭页面后重试！</h3>
                        <br/>
                        <button id="n_colseButton" class="btn btn-danger btn-lg">关闭</button>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">异常说明</h3>
                    </div>
                    <div class="panel-body">
                        <p style="text-align: left;line-height: 25px;">
                            您没有成功登录本平台，只能关闭页面后再次点击个人中心进入。否则无法使用本平台功能。
                        </p>
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
// 微信配置
    wx.config({
        debug: false,
        appId: "wx3b55df6bdee5d3fe",
        timestamp: '上一步生成的时间戳',
        nonceStr: '上一步中的字符串',
        signature: '上一步生成的签名',
        jsApiList: ['closeWindow'] // 功能列表，我们要使用JS-SDK的什么功能
    });
// config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在 页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready 函数中。
    wx.ready(function () {
        // 获取“分享到朋友圈”按钮点击状态及自定义分享内容接口
        $("#n_colseButton").click(function () {
            wx.closeWindow();
        });
    });
</script>
