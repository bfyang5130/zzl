<div class="panel panel-default" style="background-color:#f5f5f5;">
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <caption style="border-bottom: 1px solid #ddd;height:35px;line-height: 35px;"><strong>筹资中的项目</strong></caption>
            <thead>
                <tr>
                    <th>序号</th>
                    <th>项目标题</th>
                    <th>项目发布人</th>
                    <th>类型</th>
                    <th>筹资方式</th>
                    <th>筹资金额</th>
                    <th>已筹金额</th>
                    <th>我的赞助</th>
                    <th>订单号</th>
                    <th>状态</th>
                </tr>
            </thead>
            <tbody>
                <?php
                #获得栏目数据
                $dataProvider = new CActiveDataProvider('Tender', array(
                    'criteria' => array(
                        'select' => 't.*',
                        'condition' => 't.user_id=:user_id AND t.status =0',
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
                            <td title="<?php echo $value->project->title; ?>"><?php echo BaseTool::truncate_utf8_string($value->project->title, 8); ?></td>
                            <td><?php echo $value->project->user->username; ?></td>
                            <td><?php echo Project::getTypeValue($value->project->type); ?></td>
                            <td><?php echo Project::getCollectionValue($value->project->collection_type); ?></td>
                            <td><?php echo round($value->project->account, 2); ?></td>
                            <td><?php echo round($value->project->account_yes, 2); ?></td>
                            <td><?php echo $value->money; ?></td>
                            <td>
                                <?php
                                if ($value->project->type == 3) {
                                    if ($value->is_lock == 1) {
                                        if ($value->trade_no != 0 && !empty($value->trade_no)) {
                                            echo '<div>' . $value->trade_no . '</div>';
                                            if ($value->status == 0) {
                                                echo '<span tval="' . $value->id . '" class="btn btn-sm btn-success">修改订单</span>';
                                            }
                                        } else {
                                            if ($value->status == 0) {
                                                echo '<div></div>';
                                                echo '<span tval="' . $value->id . '" class="btn btn-sm btn-success">输入订单</span>';
                                            } else {
                                                echo '无';
                                            }
                                        }
                                    } else {
                                        if ($value->status == 0) {
                                            echo '<font style="color:red">待锁定</font>';
                                        } else {
                                            echo '已处理';
                                        }
                                    }
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                switch ($value->status) {
                                    case 0:echo '筹资中';
                                        break;
                                    case 1:echo '筹资成功';
                                        break;
                                    case 2:echo '筹资失败';
                                        break;
                                    default:echo '筹资中';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                    $totalpages = ceil($dataProvider->getTotalItemCount() / 20);
                    ?>
                    <tr><td colspan=9>
                            <div class="text-center">
                                <ul id="pagination-memerlog" class="pagination-sm"></ul>
                            </div>
                        </td>
                <script type="text/javascript">
                    $('#pagination-memerlog').twbsPagination({
                        totalPages: <?php echo $totalpages; ?>,
                        visiblePages: <?php echo ($totalpages >= 5) ? 5 : $totalpages; ?>,
                        href: '/member/tender/tendering/<?php echo $dataProvider->getId() ?>_page/{{number}}.html',
                        onPageClick: function (event, page) {
                            window.location.href = '/member/tender/tendering/<?php echo $dataProvider->getId() ?>_page/' + page + '.html';
                        }
                    });
                    $('a').popover({
                        trigger: 'click'
                    });
                    var dialogdir = "<?php echo Yii::app()->theme->baseUrl; ?>/src";
                    (function () {
                        $("span[class='btn btn-sm btn-success']").live('click', function () {
                            var obj = $(this);
                            var thismenu_id = $(this).attr("tval");
                            //获得订单号
                            var al_trade_no = $(this).prev("div").html();
                            //判断数据是否填写正确
                            var commitstatus = true;
                            var msg = "<font color=blue><strong>订单号码：</strong></font><input type='text' id='enter_trade_no' name='trade_no' value='" + al_trade_no + "'/>";
                            seajs.use(['jquery', dialogdir + '/dialog-plus'], function ($, dialog) {
                                var d = dialog({
                                    title: '订单信息',
                                    content: msg,
                                    okValue: '提交',
                                    ok: function () {
                                        var trade_no = $("#enter_trade_no").val();
                                        if ($.trim(trade_no) == "") {
                                            alert("订单号不能为零");
                                        } else {
                                            if (!commitstatus) {
                                                return false;
                                            }
                                            var ajaxurl = '/member/tender/fitTenderTradeno.html';
                                            var query = new Object();
                                            query.tender_id = thismenu_id;
                                            query.trade_no = trade_no;
                                            $.ajax({
                                                url: ajaxurl,
                                                dataType: "json",
                                                data: query,
                                                type: "POST",
                                                success: function (ajaxobj) {
                                                    if (ajaxobj.status == 1)
                                                    {
                                                        alert("提交成功！");
                                                        $(obj).prev("div").html(trade_no);
                                                        $(obj).html("修改订单");
                                                        d.close().remove();
                                                    }
                                                    else
                                                    {
                                                        alert(ajaxobj.info);
                                                    }
                                                },
                                                error: function (ajaxobj)
                                                {
                                                    d.content("<font color=red><strong>登录失败，请重试!</stonr></font>").showModal();
                                                }
                                            });
                                        }
                                        return false;
                                    }
                                });

                                d.width(300).height(50).showModal();
                                return false;

                            });
                            //ajax提交登录数据
                            return false;

                        });
                    })();
                </script>
                <?php
            } else {
                echo '<tr><td colspan=9>暂无数据</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>  	
</div>