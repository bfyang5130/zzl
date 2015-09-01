<table class="table table-bordered table-striped">
    <tr>
        <th>序号</th>
        <th>充值金额</th>
        <th>充值银行</th>
        <th>充值时间</th>
        <th>状态</th>
        <th>操作<span class="pull-right"><a href="/member/index/log.html">更多记录</a></span></th>
    </tr>

    <?php
    #获得最新的充值记录
    $chongzhilogs = Recharge::model()->findAll(array(
        'condition' => 'user_id=:user_id',
        'order' => 'id desc',
        'limit' => '8',
        'params' => array(':user_id' => Yii::app()->user->getState("_user_id"))
    ));
    ?>
    <?php
    if ($chongzhilogs) {
        foreach ($chongzhilogs as $value) {
            ?>
            <tr>
                <td><?php echo $value->id; ?></td>
                <td><?php echo $value->money; ?></td>
                <td><?php echo $value->bankcode; ?></td>
                <td><?php echo date("Y-m-d H:i:s", $value->addtime); ?></td>
                <td>
                    <?php
                    switch ($value->status) {
                        case 0:echo '处理中...';
                            break;
                        case 1:echo '充值成功';
                            break;
                        case 2:echo '充值失败';
                            break;
                        default:echo '处理中...';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    switch ($value->status) {
                        case 0:echo '继续支付';
                            break;
                        case 1:echo '-';
                            break;
                        case 2:echo '-';
                            break;
                        default:echo '继续支付';
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <?php
        } else {
            echo '<tr><td colspan=6><h3>暂无数据</h3></td></tr>';
        }
        ?>
</table>