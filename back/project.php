<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/member.css"/>
<div class="main" style="margin-bottom: 25px;">
    <div class="index_top">
        <!--我的帐号 开始-->
        <?php $this->renderPartial('/member/member_account') ?>
        <!--我的帐号 结束-->
        <!--网易推荐 开始-->
        <?php $this->renderPartial('/member/member_righttop') ?>
        <!--网易推荐 结束-->
        <div class="clear"></div>

    </div>
    <div class="custom_clum_box">
        <!--模块菜单 开始-->
        <?php $this->renderPartial('/member/member_menu') ?>
        <!--模块菜单 结束-->
        <div class="custom_clum"  style="border-top: 1px solid #e1eaee;"id="drag_area">
            <?php $this->renderPartial('/member/member_content',array("dataProvider"=>$dataProvider)); ?>
        </div>
        <div class="clear"></div>
    </div>
</div>