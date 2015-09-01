<div class="page_content" style="-webkit-transform: translate3d(0px, 0px, 0px);">
    <div class="col-lg-12" style="margin-top:25px;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">错误提示</h3>
            </div>
            <div class="panel-body">
                <p style="text-align: center;line-height: 25px;min-height: 350px;">
                    <?php
                    $errorMessage = Yii::app()->user->getFlash('wechat_fail');
                    if ($errorMessage) {
                        echo $errorMessage;
                    } else {
                        echo '异常的操作！';
                    }
                    ?>
                </p>

            </div>
        </div>

    </div>
</div>