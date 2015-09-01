<table class="table table-bordered table-striped">
    <tr>
        <th>序号</th>
        <th>提现金额</th>
        <th>到帐金额</th>
        <th>手续费</th>
        <th>申请时间</th>
        <th>状态</th>
        <th>操作<span class="pull-right"><a href="/member/index/log.html?tab=tab1">更多记录</a></span></th>
    </tr>
    <?php
    #获得最新的提现记录
    $tixianlogs = Recharge::model()->findAll(array(
        'condition' => 'user_id=:user_id',
        'order' => 'id desc',
        'limit' => '8',
        'params' => array(':user_id' => Yii::app()->user->getState("_user_id"))
    ));
    ?>
    <?php
    if ($tixianlogs) {
        foreach ($tixianlogs as $value) {
            ?>
            <tr>
                <td><?php echo $value->id; ?></td>
                <td><?php echo $value->total; ?></td>
                <td><?php echo $value->credited; ?></td>
                <td><?php echo $value->fee; ?></td>
                <td><?php echo date("Y-m-d H:i:s", $value->addtime); ?></td>
                <td>
                    <?php
                    switch ($value->status) {
                        case 0:echo '处理中...';
                            break;
                        case 1:echo '提现成功';
                            break;
                        case 2:echo '提现失败';
                            break;
                        case 3:echo '已处理';
                            break;
                        default:echo '处理中...';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    switch ($value->status) {
                        case 0:echo '取消';
                            break;
                        default:echo '-';
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
        <?php
    } else {
        echo '<tr><td colspan=7><h3>暂无数据</h3></td></tr>';
    }
    ?>
</table>