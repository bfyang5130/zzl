<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/ajaxfileupload.js');
?>
<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#project_pic" role="tab" data-toggle="tab">赞助人列表</a></li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="project_pic">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="border-top:none;">
                <tr>
                    <td colspan="8"  style="border-top:none;"><h5><?php echo $thisproject->title; ?></h5></td>
                </tr>

                <?php
                #得到筹资众人的列表
                $dataProvider = new CActiveDataProvider('Tender', array(
                    'criteria' => array(
                        'select' => 't.*',
                        'condition' => 'project_id=:projects_id',
                        'order' => 't.id asc,t.status asc',
                        'params' => array(":projects_id" => $thisproject->id),
                    ),
                    'pagination' => array(
                        'pageSize' => 15,
                    ),
                ));
                if ($dataProvider->getData()) {
                    ?>
                    <tr><td colspan="8" id="page-content">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>序号</th>
                                    <th>赞助资金</th>
                                    <th>赞助类型</th>
                                    <th>用户名</th>
                                    <th>赞助时间</th>
                                    <th>订单号</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                <?php
                                foreach ($dataProvider->getData() as $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $value->id; ?></td>
                                        <td>
                                            <?php echo $value->money; ?>
                                        </td>
                                        <td>
                                            <?php echo Linkage::getValueChina($value->project->collection_type, "collection_type"); ?>
                                        </td>
                                        <td>
                                            <?php echo $value->user->username; ?>
                                        </td>
                                        <td>
                                            <?php echo date("Y/m/d H:i:s", $value->addtime); ?>
                                        </td>
                                        <td>
                                            <?php echo $value->trade_no; ?>
                                        </td>
                                        <td>
                                            <?php
                                            switch ($value->status) {
                                                case 0: echo '<span style="color:blue;">处理中</span>';
                                                    break;
                                                case 1: echo '<span style="color:green;">已汇款</span>';
                                                    break;
                                                case 2: echo '<span style="color:red;">失信</span>';
                                                    break;
                                                default:'<span style="color:blue;">处理中</span>';
                                                    break;
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($value->is_lock == 1) {
                                                ?>
                                                <span tval="<?php echo $value->id; ?>" class="btn btn-sm btn-success">已汇款</span>
                                                <span tval="<?php echo $value->id; ?>" class="btn btn-sm btn-warning">失信</span>
                                                <?php
                                            } else {
                                                if ($value->status == 1) {
                                                    echo '-';
                                                } else {
                                                    echo '<a href="' . Yii::app()->createUrl("/member/projects/lock/projectid/" . $thisproject->id . "/tenderid/" . $value->id) . '"  class="btn btn-sm btn-danger"><span tval="<?php echo $value->id; ?>">锁定</span></a>';
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                $totalpages = ceil($dataProvider->getTotalItemCount() / 15);
                                ?></table>
                        </td></tr>
                    <tr>
                        <td colspan="8">
                            <div class="text-center">
                                <ul id="pagination-memerlog" class="pagination-sm"></ul>
                            </div>
                        </td>
                    <script type="text/javascript">
                        $('#pagination-memerlog').twbsPagination({
                            totalPages: <?php echo $totalpages; ?>,
                            visiblePages: <?php echo ($totalpages >= 5) ? 5 : $totalpages; ?>,
                            href: '/member/projects/fittenders/id/<?php echo $thisproject->id; ?>/page/{{number}}.html',
                            onPageClick: function (event, page) {
                                $.ajax({
                                    url: '/member/projects/fittenders/id/<?php echo $thisproject->id; ?>/page/' + page + '.html',
                                    dataType: "html",
                                    type: "POST",
                                    success: function (ajaxobj) {
                                        $('#page-content').html(ajaxobj);
                                    },
                                    error: function (ajaxobj)
                                    {
                                        $('#page-content').html("<font color=red><strong>获取数据失败，请重试!</stonr></font>");
                                    }
                                });
                                    
                            }
                        });
                    </script>
                    </tr>
                    <?php
                } else {
                    echo '<tr><td colspan=7>暂无数据</td></tr>';
                }
                ?>
            </table>
        </div>
        <script type="text/javascript">
            $("span[class='btn btn-sm btn-success']").live('click', function () {
                var obj = $(this);
                var thismenu_id = $(this).attr("tval");
                $.ajax({
                    type: "POST",
                    url: "/member/projects/fittenderstatus/id/<?php echo $thisproject->id; ?>/status/1.html",
                    data: "lunbo_id=" + thismenu_id,
                    success: function (msg) {
                        if (msg == 1) {
                            obj.parent().prev().html("<span style='color:green;'>已汇款</span>");
                            obj.parent().html("-");
                        } else {
                            alert(msg);
                        }
                    },
                    error: function () {
                        alert("处理失败");
                    }
                });
            });
            $("span[class='btn btn-sm btn-warning']").live('click', function () {
                var obj = $(this);
                var thismenu_id = $(this).attr("tval");
                $.ajax({
                    type: "POST",
                    url: "/member/projects/fittenderstatus/id/<?php echo $thisproject->id; ?>/status/2.html",
                    data: "lunbo_id=" + thismenu_id,
                    success: function (msg) {
                        if (msg == 1) {
                            obj.parent().prev().html("<span style='color:red;'>失信</span>");
                            obj.parent().html("-");
                        } else {
                            alert(msg);
                        }
                    },
                    error: function () {
                        alert("处理失败！");
                    }
                });
            });
        </script>
    </div>
</div>
</div>
