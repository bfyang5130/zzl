<?php
$errorMessages = Yii::app()->user->getFlash('wechat_fail');
$msgtitle = '提示信息';
if ($errorMessages) {
    $errorMessage=$errorMessages[0];
    $msgtitle = $errorMessage['msgtitle'];
    $msg = $errorMessage['message'];
} else {
    $msg = '异常的操作！';
}
?>
<div class="page_content" style="-webkit-transform: translate3d(0px, 0px, 0px);">
    <div class="col-lg-12" style="margin-top:25px;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= $msgtitle ?></h3>
            </div>
            <div class="panel-body">
                <div style="text-align: center;line-height: 25px;min-height: 350px;">
                    <?php
                    if ($errorMessage) {
                        switch ($errorMessage['type']) {
                            case 1:echo '<p>' . $msg . '</p>';
                                break;
                            case 2:
                                echo '<p>' . $msg . '</p>';
                                ?>
                                <a class="btn btn-danger" href="<?= $errorMessage['backurl'] ?>"><?= $errorMessage['backtitle'] ?></a>
                                <?php
                                break;
                            case 3:
                                echo '<p>' . $msg . '</p>';
                                ?>
                                <a class="btn btn-danger" href="<?= $errorMessage['backurl'] ?>"><?= $errorMessage['backtitle'] ?></a>
                                <a class="btn btn-success" href="<?= $errorMessage['tourl'] ?>"><?= $errorMessage['totitle'] ?></a>
                                <?php
                                break;
                            default :echo '<p>' . $msg . '</p>';
                                break;
                        }
                    } else {
                        echo $msg;
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>
</div>