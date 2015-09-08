
<div class="page_content" style="-webkit-transform: translate3d(0px, 0px, 0px);">
    <?php $this->renderPartial('//wechat/common/usertop') ?>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;">
        <a class="btn btn-qys btn-success btn-block">充值</a>
        <a class="btn btn-qys btn-warning btn-block">提现</a>
    </div>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;">
        <div class="btn-group-vertical btn-block" role="group" aria-label="...">
            <a href="<?php echo Yii::app()->createUrl('/wechat/member/sharp') ?>" class="btn btn-qys btn-default btn-block"><span class="glyphicon glyphicon-qrcode" aria-hidden="true"></span> 快速分享</a>
            <a href="<?php echo Yii::app()->createUrl('/wechat/member/userinfo') ?>" class="btn btn-qys btn-default btn-block"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 基本信息</a>
            <a href="<?php echo Yii::app()->createUrl('/wechat/member/bankCard') ?>" class="btn btn-qys btn-default btn-block"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span> 我的银行</a>
            <a href="<?php echo Yii::app()->createUrl('/wechat/member/proAddress') ?>" class="btn btn-qys btn-default btn-block"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span> 收货地址</a>
            <a href="<?php echo Yii::app()->createUrl('/wechat/member/accountlog') ?>" class="btn btn-qys btn-default btn-block"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> 资金明细</a>
        </div>
    </div>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;">
        <div class="btn-group-vertical btn-block" role="group" aria-label="...">
            <a href="<?php echo Yii::app()->createUrl('/wechat/member/myProduct') ?>" class="btn btn-qys btn-default btn-block"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> 已购商品</a>
            <a href="<?php echo Yii::app()->createUrl('/wechat/member/proProess') ?>" class="btn btn-qys btn-default btn-block"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> 物流进度</a>
        </div>
    </div>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;">
        <div class="btn-group" role="group" aria-label="...">
            <a href="<?php echo Yii::app()->createUrl('/wechat/public/index') ?>" class="btn btn-default">首页</a>
            <a href="<?php echo Yii::app()->createUrl('/wechat/help/index') ?>" class="btn btn-default">帮助中心</a>
            <a href="<?php echo Yii::app()->createUrl('/wechat/help/contact') ?>" class="btn btn-default">联系我们</a>
        </div>
    </div>
</div>