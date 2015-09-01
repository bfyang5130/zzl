<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/ajaxfileupload.js');
if (!isset($_REQUEST['tab'])) {
    $_REQUEST['tab'] = '';
}
?>
<ul class="nav nav-tabs" role="tablist">
    <li <?php echo ($_REQUEST['tab'] == '') ? 'class="active"' : ''; ?>><a href="#project_base" role="tab" data-toggle="tab">站内信</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane <?php echo ($_REQUEST['tab'] == '') ? 'active' : ''; ?>" id="project_base">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" style="border-top:none;">
                <tr><td colspan=7 style="border-top:none;"></td></tr>
                <tr style="border-top:none;">
                    <th>序号</th>
                    <th>标题</th>
                    <th>类型</th>
                    <th>内容</th>
                    <th>发送人</th>
                    <th>已阅</th>
                    <th>时间</th>
                </tr>
                <?php
                #获得栏目数据
                $dataProvider = new CActiveDataProvider('Message', array(
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
                            <td title="<?php echo $value->title; ?>"><?php echo BaseTool::truncate_utf8_string($value->title, 8); ?></td>
                            <td><?php echo Linkage::getMessage($value->type_id); ?></td>
                            <td><?php echo $value->content; ?></td>
                            <td><?php echo $value->setuser->username; ?></td>
                            <td><?php echo ($value->status == 1) ? '是' : '否'; ?>%</td>
                            <td><?php echo date("Y-m-d H:i:s", $value->addtime); ?></td>
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
                            href: '/member/message/index/<?php echo $dataProvider->getId() ?>_page/{{number}}.html',
                            onPageClick: function(event, page) {
                                window.location.href = '/member/message/index/<?php echo $dataProvider->getId() ?>_page/' + page + '.html';
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
            </table>
        </div> 
    </div>
</div>
</div>