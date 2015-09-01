<?php if (Yii::app()->user->isGuest) { ?>
    <a href="<?php echo Yii::app()->createUrl('/member/login') ?>">登录</a>
    <em>|</em>
    <a href="<?php echo Yii::app()->createUrl('/member/register') ?>">注册</a>
<?php } else { ?>
    <a href="<?php echo Yii::app()->createUrl('/member/index') ?>"><img style="width:45px;height:45px;position: relative;top:15px;border:1px solid #ccc;" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/defaultuser.png"/></a>
    <em>|</em>
    <a href="<?php echo Yii::app()->createUrl('/member/index') ?>">会员中心</a>
<?php } ?>
