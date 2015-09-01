<table class="table table-bordered table-striped">
    <tr>
        <td>序号</td>
        <td>资金类型</td>
        <td>交易金额</td>
        <td>交易方</td>
        <td>备注</td>
        <td>交易时间<span class="pull-right"><a href="/member/index/log.html?tab=tab2">更多记录</a></span></td>
    </tr>
    <?php
    #获得最新的资金记录
    $zijinlogs = AccountLog::model()->findAll(array(
        'condition' => 'user_id=:user_id',
        'order' => 'id desc',
        'limit' => '8',
        'params' => array(':user_id' => Yii::app()->user->getState("_user_id"))
    ));
    if ($zijinlogs) {
        foreach ($zijinlogs as $onezijin) {
            ?>
            <tr>
                <td><?php echo $onezijin->id; ?></td>
                <td><?php echo FileCacheInitSet::$_linkage['account_type'][$onezijin->type]; ?></td>
                <td><?php echo $onezijin->money; ?></td>
                <td><?php echo $onezijin->touser->username; ?></td>
                <td><?php echo $onezijin->remark; ?></td>
                <td><?php echo date("Y-m-d H:i:s", $onezijin->addtime); ?></td>
            </tr>
            <?php
        }
    } else {
        ?>

        <tr>
            <td colspan="6"><h3>暂无记录</h3></td>
        </tr>
        <?php
    }
    ?>
</table>