<div class="panel panel-default" style="background-color:#f5f5f5;">
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <caption style="border-bottom: 1px solid #ddd;height:35px;line-height: 35px;"><strong>失败的项目</strong></caption>
            <thead>
                <tr>
                    <th>序号</th>
                    <th>项目标题</th>
                    <th>类型</th>
                    <th>筹资方式</th>
                    <th>筹资金额</th>
                    <th>已筹金额</th>
                    <th>状态</th>
                </tr>
            </thead>
            <tbody>
                <?php
                #获得栏目数据
                $dataProvider = new CActiveDataProvider('Project', array(
                    'criteria' => array(
                        'select' => 't.*',
                        'condition' => 't.user_id=:user_id AND t.status in(2,4,5)',
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
                            <td><?php echo Project::getTypeValue($value->type); ?></td>
                            <td><?php echo Project::getCollectionValue($value->collection_type); ?></td>
                            <td><?php echo $value->account; ?></td>
                            <td><?php echo $value->account_yes; ?></td>
                            <td>
                                <?php
                                switch ($value->status) {
                                    case 2;
                                        echo "初审失败";
                                        break;
                                    case 4;
                                        echo "复审失败";
                                        break;
                                    case 5;
                                        echo "已撤消";
                                        break;
                                    default :echo '初审失败';
                                        break;
                                }
                                ?>
                            </td>
                        </tr>
        <?php
    }
    $totalpages = ceil($dataProvider->getTotalItemCount() / 20);
    ?>
                    <tr><td colspan=8>
                            <div class="text-center">
                                <ul id="pagination-memerlog" class="pagination-sm"></ul>
                            </div>
                        </td>
                <script type="text/javascript">
                    $('#pagination-memerlog').twbsPagination({
                        totalPages: <?php echo $totalpages; ?>,
                        visiblePages: <?php echo ($totalpages >= 5) ? 5 : $totalpages; ?>,
                        href: '/member/projects/publishing/<?php echo $dataProvider->getId() ?>_page/{{number}}.html',
                        onPageClick: function(event, page) {
                            window.location.href = '/member/projects/publishing/<?php echo $dataProvider->getId() ?>_page/' + page + '.html';
                        }
                    });
                    $('a').popover({
                        trigger: 'click'
                    });
                </script>
    <?php
} else {
    echo '<tr><td colspan=8>暂无数据</td></tr>';
}
?>
            </tbody>
        </table>
    </div>  	
</div>