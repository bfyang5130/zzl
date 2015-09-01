<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/uploadify.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/imgareaselect-default.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.uploadify.min.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.imgareaselect.pack.js');
if (!isset($_REQUEST['tab'])) {
    $_REQUEST['tab'] = '';
}
?>
<ul class="nav nav-tabs" role="tablist">
    <li <?php echo ($_REQUEST['tab'] == '') ? 'class="active"' : ''; ?>><a href="#tab0" role="tab" data-toggle="tab">充值记录</a></li>
    <li <?php echo ($_REQUEST['tab'] == 'tab1') ? 'class="active"' : ''; ?>><a href="#tab1" role="tab" data-toggle="tab">提现记录</a></li>
    <li <?php echo ($_REQUEST['tab'] == 'tab2') ? 'class="active"' : ''; ?>><a href="#tab2" role="tab" data-toggle="tab">记录明细</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane <?php echo ($_REQUEST['tab'] == '') ? 'active' : ''; ?>" id="tab0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="border-top:none;">
                <caption style="border-bottom: 1px solid #ddd;height:35px;line-height: 35px;"><strong>充值记录</strong></caption>
                <thead>
                    <tr>
                        <th>序号</th>
                        <th>充值金额</th>
                        <th>充值银行</th>
                        <th>充值时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    #获得栏目数据
                    $dataProvider = new CActiveDataProvider('Recharge', array(
                        'criteria' => array(
                            'select' => 't.*',
                            'condition' => 't.user_id=:user_id',
                            'order' => 't.id DESC',
                            'params' => array(":user_id" => Yii::app()->user->getId()),
                        ),
                        'pagination' => array(
                            'pageSize' => 20,
                        ),
                    ));
                    ?>
                    <?php
                    if ($dataProvider->getData()) {
                        foreach ($dataProvider->getData() as $value) {
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
                        $totalpages = ceil($dataProvider->getTotalItemCount() / 20);
                        ?>
                        <tr><td colspan=6>
                                <div class="text-center">
                                    <ul id="pagination-memerlog" class="pagination-sm"></ul>
                                </div>
                            </td>
                    <script type="text/javascript">
                        $('#pagination-memerlog').twbsPagination({
                            totalPages: <?php echo $totalpages; ?>,
                            visiblePages: <?php echo ($totalpages >= 5) ? 5 : $totalpages; ?>,
                            href: '/member/index/log/<?php echo $dataProvider->getId() ?>_page/{{number}}.html',
                            onPageClick: function (event, page) {
                                window.location.href = '/member/index/log/<?php echo $dataProvider->getId() ?>_page/' + page + '.html';
                            }
                        });
                        $('a').popover({
                            trigger: 'click'
                        });
                    </script>
                    <?php
                } else {
                    echo '<tr><td colspan=6>暂无数据</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div> 
    </div>
    <div class="tab-pane <?php echo ($_REQUEST['tab'] == 'tab1') ? 'active' : ''; ?>" id="tab1">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="border-top:none;">
                <caption style="border-bottom: 1px solid #ddd;height:35px;line-height: 35px;"><strong>提现记录</strong></caption>
                <thead>
                    <tr>
                        <th>序号</th>
                        <th>提现金额</th>
                        <th>到帐金额</th>
                        <th>手续费</th>
                        <th>申请时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    #获得栏目数据
                    $dataProvider = new CActiveDataProvider('Cash', array(
                        'criteria' => array(
                            'select' => 't.*',
                            'condition' => 't.user_id=:user_id',
                            'order' => 't.id DESC',
                            'params' => array(":user_id" => Yii::app()->user->getId()),
                        ),
                        'pagination' => array(
                            'pageSize' => 20,
                        ),
                    ));
                    ?>
                    <?php
                    if ($dataProvider->getData()) {
                        foreach ($dataProvider->getData() as $value) {
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
                        $totalpages = ceil($dataProvider->getTotalItemCount() / 20);
                        ?>
                        <tr><td colspan=7>
                                <div class="text-center">
                                    <ul id="pagination-memerlog" class="pagination-sm"></ul>
                                </div>
                            </td>
                    <script type="text/javascript">
                        $('#pagination-memerlog').twbsPagination({
                            totalPages: <?php echo $totalpages; ?>,
                            visiblePages: <?php echo ($totalpages >= 5) ? 5 : $totalpages; ?>,
                            href: '/member/index/log/<?php echo $dataProvider->getId() ?>_page/{{number}}.html?tab=tab1',
                            onPageClick: function (event, page) {
                                window.location.href = '/member/index/log/<?php echo $dataProvider->getId() ?>_page/' + page + '.html?tab=tab1';
                            }
                        });
                        $('a').popover({
                            trigger: 'click'
                        });
                    </script>
                    <?php
                } else {
                    echo '<tr><td colspan=7>暂无数据</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div> 
    </div>
    <div class="tab-pane <?php echo ($_REQUEST['tab'] == 'tab2') ? 'active' : ''; ?>" id="tab2">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="border-top:none;">
                <caption style="border-bottom: 1px solid #ddd;height:35px;line-height: 35px;"><strong>记录明细</strong></caption>
                <thead>
                    <tr>
                        <th>序号</th>
                        <th>金额</th>
                        <th>到帐金额</th>
                        <th>手续费</th>
                        <th>申请时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    #获得栏目数据
                    $dataProvider = new CActiveDataProvider('Cash', array(
                        'criteria' => array(
                            'select' => 't.*',
                            'condition' => 't.user_id=:user_id',
                            'order' => 't.id DESC',
                            'params' => array(":user_id" => Yii::app()->user->getId()),
                        ),
                        'pagination' => array(
                            'pageSize' => 20,
                        ),
                    ));
                    ?>
                    <?php
                    if ($dataProvider->getData()) {
                        foreach ($dataProvider->getData() as $value) {
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
                        $totalpages = ceil($dataProvider->getTotalItemCount() / 20);
                        ?>
                        <tr><td colspan=7>
                                <div class="text-center">
                                    <ul id="pagination-memerlog" class="pagination-sm"></ul>
                                </div>
                            </td>
                    <script type="text/javascript">
                        $('#pagination-memerlog').twbsPagination({
                            totalPages: <?php echo $totalpages; ?>,
                            visiblePages: <?php echo ($totalpages >= 5) ? 5 : $totalpages; ?>,
                            href: '/member/index/log/<?php echo $dataProvider->getId() ?>_page/{{number}}.html?tab=tab1',
                            onPageClick: function (event, page) {
                                window.location.href = '/member/index/log/<?php echo $dataProvider->getId() ?>_page/' + page + '.html?tab=tab1';
                            }
                        });
                        $('a').popover({
                            trigger: 'click'
                        });
                    </script>
                    <?php
                } else {
                    echo '<tr><td colspan=7>暂无数据</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>