<?php $this->renderPartial('//layouts/html5_header') ?>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.twbsPagination.min.js');
?>
<div class="container">
    <div class="row" style="margin-top:25px;">
        <div class="col-xs-12 col-sm-2 col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title qys_member_panel_title">
                        <strong>会员中心</strong>
                    </h3>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked" role="tablist">
                        <li class="qys_member_left_menu_t"><strong>我的筹资</strong></li>
                        <li><a style="padding:7px 10px;" class="qys_member_left_menu_item" href="<?php echo Yii::app()->createUrl('/publish') ?>"><span>发布项目</span></a></li>
                        <li><a style="padding:7px 10px;" class="qys_member_left_menu_item" href="<?php echo Yii::app()->createUrl('/member/projects/publishing') ?>"><span>正在筹资</span></a></li>
                        <li><a style="padding:7px 10px;" class="qys_member_left_menu_item" href="<?php echo Yii::app()->createUrl('/member/projects/success') ?>"><span>成功筹资</span></a></li>
                        <li><a style="padding:7px 10px;" class="qys_member_left_menu_item" href="<?php echo Yii::app()->createUrl('/member/projects/fail') ?>"><span>失败筹资</span></a></li>
                        <li class="qys_member_left_menu_t"><strong>我的赞助</strong></li>
                        <li><a style="padding:7px 10px;" class="qys_member_left_menu_item" href="<?php echo Yii::app()->createUrl('/member/tender/tendering') ?>"><span>正在赞助</span></a></li>
                        <li><a style="padding:7px 10px;" class="qys_member_left_menu_item" href="<?php echo Yii::app()->createUrl('/member/tender/tsuccess') ?>"><span>成功赞助</span></a></li>
                        <li><a style="padding:7px 10px;" class="qys_member_left_menu_item" href="<?php echo Yii::app()->createUrl('/member/tender/tfail') ?>"><span>失败赞助</span></a></li>
                        <li class="qys_member_left_menu_t"><strong>资金信息</strong></li>
                        <li><a style="padding:7px 10px;" class="qys_member_left_menu_item" href="<?php echo Yii::app()->createUrl('/member/index') ?>"><span>资金信息</span></a></li>
                        <li><a style="padding:7px 10px;" class="qys_member_left_menu_item" href="<?php echo Yii::app()->createUrl('/member/index/log') ?>"><span>资金记录</span></a></li>
                        <li><a style="padding:7px 10px;" class="qys_member_left_menu_item" href="<?php echo Yii::app()->createUrl('/member/index/money') ?>"><span>充值提现</span></a></li>
                        <li class="qys_member_left_menu_t"><strong>我的信息</strong></li>
                        <li><a style="padding:7px 10px;" class="qys_member_left_menu_item" href="<?php echo Yii::app()->createUrl('/member/user/index') ?>"><span>基本信息</span></a></li>
                        <li><a style="padding:7px 10px;" class="qys_member_left_menu_item" href="<?php echo Yii::app()->createUrl('/member/user/safe') ?>"><span>安全认证</span></a></li>
                        <li><a style="padding:7px 10px;" class="qys_member_left_menu_item" href="<?php echo Yii::app()->createUrl('/member/user/credit') ?>"><span>信誉等级</span></a></li>
                        <li class="qys_member_left_menu_t"><strong>站内信息</strong></li>
                        <li><a style="padding:7px 10px;" class="qys_member_left_menu_item" href="<?php echo Yii::app()->createUrl('/member/message/index') ?>"><span>站内信</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-10 col-md-10">
            <?php echo $content; ?>
        </div>
    </div>
</div>

<?php $this->renderPartial('//layouts/html5_footer') ?>