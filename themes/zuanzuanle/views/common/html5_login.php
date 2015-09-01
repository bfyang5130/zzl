<?php if (Yii::app()->user->isGuest) { ?>
    <ul class="nav navbar-nav  qys-top_navbar">
        <li><a href="<?php echo Yii::app()->createUrl('/user/login') ?>">登录</a></li>
        <li><a href="#">/</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('/user/register') ?>">注册</a></li>
    </ul>
<?php } else { ?>
    <ul class="nav navbar-nav">
        <?php
        $defaultimg = Yii::app()->theme->baseUrl . "/images/defaultpic.jpg";
        if (Yii::app()->user->getState("_litpic")) {
            $defaultimg =Yii::app()->user->getState("_litpic");
        }
        ?>
        <li><a style="margin-bottom:0px;padding-bottom: 0px;padding-left:0px;padding-right:0px;" href="<?php echo Yii::app()->createUrl('/member/index') ?>"><img style="width:50px;height:50px;" src="<?php echo $defaultimg; ?>"/></a></li>
        <li style="margin-top:17px;">
            <a style="padding: 0px;padding-left: 15px;" href="<?php echo Yii::app()->createUrl('/member/index') ?>">会员中心</a>
            <a style="padding: 0px;padding-left: 15px;padding-top: 5px;color: red;" href="<?php echo Yii::app()->createUrl('/user/logout') ?>">退出</a>
        </li>
    </ul>
<?php } ?>
