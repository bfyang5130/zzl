<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/member.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/publish.css"/>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default qys_member_panel">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <strong>淘宝项目发布</strong>
                    </h5>
                </div>
                <div class="panel-body">
                    <form method="post" id="publish_submit" enctype="multipart/form-data">
                        <table class="table table-bordered table-striped">
                            <tr 
                            <?php
                            if (empty($publish_error)) {
                                echo 'style="height:1px"';
                            }
                            ?>
                                >
                                <td class="qys_publish_td_left">
                                    <?php
                                    if (!empty($publish_error)) {
                                        echo '<font style="color:red">错误信息：</font>';
                                    }
                                    ?>
                                </td>
                                <td class="qys_publish_td_right">
                                    <?php
                                    if (!empty($publish_error)) {
                                        echo '<font style="color:red">' . $publish_error . '</font>';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="qys_publish_td_left">项目名称：</td>
                                <td class="qys_publish_td_right"><input id="publish_title" name="title" class="input_title" type="text" value=""/><span class="qys_publish_dec"><font style="color:red;">*</font> 详细填写您的项目名称（10个字以上）</span></td>
                            </tr>
                            <tr>
                                <td class="qys_publish_td_left">项目类型：</td>
                                <td class="qys_publish_td_right">
                                    <?php
                                    echo QCHtml::dropDownList("type", "3", Linkage::getValueChina("qys_none", "project_type"), array(
                                        "class" => "input_select", "disabled" => true,
                                    ));
                                    ?> 
                                    <span class="qys_publish_dec">筹资项目所属的类型</span></td>
                            </tr>
                            <tr>
                                <td class="qys_publish_td_left">筹资方式：</td>
                                <td class="qys_publish_td_right">
                                    <?php
                                    echo CHtml::dropDownList("collection_type", "0", Linkage::getValueChina("qys_none", "collection_type"), array(
                                        "class" => "input_select", "disabled" => true,
                                    ));
                                    ?> 
                                    <span class="qys_publish_dec">筹资时是否直接冻结用户资金</span></td>
                            </tr>
                            <tr>
                                <td class="qys_publish_td_left">单次筹资金额：</td>
                                <td class="qys_publish_td_right"><input id="publish_account_one" name="account_one" class="input_account" type="text" value="50"/><span class="qys_publish_dec"><font style="color:red;">*</font> 单次筹资的金额（50元至500万之间）</span></td>
                            </tr>
                            <tr>
                                <td class="qys_publish_td_left">筹资次数：</td>
                                <td class="qys_publish_td_right"><input id="publish_choutimes" name="choutimes" class="input_account" type="text" value="1"/><span class="qys_publish_dec"><font style="color:red;">*</font> 总共允许筹资多少次</span></td>
                            </tr>
                            <tr>
                                <td class="qys_publish_td_left">收益金额：</td>
                                <td class="qys_publish_td_right"><input id="publish_account_lixi" name="account_lixi" class="input_account" type="text" value="5"/><span class="qys_publish_dec"><font style="color:red;">*</font> 给每个筹资者的收益</span></td>
                            </tr>
                            <tr>
                                <td class="qys_publish_td_left">资金详情：</td>
                                <td class="qys_publish_td_right">总筹资金额 <span id="total_money" style="color:green;font-size: 15px;font-weight: 900;">50</span> 元,担保金额 <span id="total_danbao" style="color:red;font-size: 15px;font-weight: 900;">105</span> 元。</td>
                            </tr>
                            <tr>
                                <td class="qys_publish_td_left">筹资地区限制：</td>
                                <td class="qys_publish_td_right">
                                    <?php
                                    echo CHtml::dropDownList("area_limit", "1", Linkage::getValueChina("qys_none", "area_limit"), array(
                                        "class" => "input_select"
                                    ));
                                    ?>
                                    <input id="publish_iplimit" name="iplimit" class="input_account" type="text" value="1"/><span class="qys_publish_dec">个人</span></td>
                            </tr>
                            <tr>
                                <td class="qys_publish_td_left">筹资期限：</td>
                                <td class="qys_publish_td_right">
                                    <?php
                                    echo CHtml::dropDownList("intime", "1", Linkage::getValueChina("qys_none", "collection_day"), array(
                                        "class" => "input_select"
                                    ));
                                    ?>
                                    <span class="qys_publish_dec">需在多少天内完成筹资</span></td>
                            </tr>
                            <tr>
                                <td class="qys_publish_td_left">最低筹资：</td>
                                <td class="qys_publish_td_right">
                                    <?php
                                    echo CHtml::dropDownList("low_account", "50", Project::getLowAccountLimitValue(), array(
                                        "class" => "input_select", "disabled" => true,
                                    ));
                                    ?>
                                    <span class="qys_publish_dec">每人最低需筹资的金额</span></td>
                            </tr>
                            <tr>
                                <td  class="qys_publish_td_left">形象图片：</td>
                                <td class="qys_publish_td_right">
                                    <div class="form-group">
                                        <input class="col-xs-12 col-sm-4" type="file" name="picname"/>
                                        <label class="hidden-xs col-sm-8 qys_publish_dec">( 规格为 350x224 PX )</label>
                                    </div></td>
                            </tr>
                            <tr>
                                <td  class="qys_publish_td_left">筹资详情：</td>
                                <td class="qys_publish_td_right" style="line-height: 20px;">
                                    <textarea name="content" id="publish_content"></textarea>
                                    <?php
                                    $this->widget('ext.ueditor.UeditorWidget', array(
                                        'id' => 'publish_content', //页面中输入框（或其他初始化容器）的ID
                                        'name' => 'editor', //指定ueditor实例的名称,个页面有多个ueditor实例时使用
                                        'options' => BaseTool::defaultEditer(),
                                        "initialFrameWidth" => "98%",
                                            )
                                    );
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td  class="qys_publish_td_left"></td>
                                <td class="qys_publish_td_right"><input class="publish_submit" id="publish_submit_submit" type="button" name="publish_submit" value="发布项目"/></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var dialogdir = "<?php echo Yii::app()->theme->baseUrl; ?>/src";
    (function () {
        $("#publish_submit_submit").click(function () {
            //判断数据是否填写正确
            var commitstatus = true;
            var msg = "<font color=blue><strong>发布中...</strong></font>";
            var username = $.trim($("#publish_title").val());
            var password = $.trim($("#publish_account_one").val());

            if (username === "" || password === "") {
                msg = "<font color=red><strong>项目标题及筹资金额不能为空!</strong></font>";
                commitstatus = false;
            }
            seajs.use(['jquery', dialogdir + '/dialog-plus'], function ($, dialog) {
                var d = dialog({
                    title: '发布项目',
                    content: msg,
                    cancelValue: '知道了',
                    cancel: function () {
                    }
                });
                d.width(300).height(50).showModal();

                if (commitstatus === true) {
                    $("#publish_submit").submit();
                }
            });

        });
    })();
    function toGetMoneyShow() {
        var oneAccount = parseInt($("#publish_account_one").val());
        var choutimes = parseInt($("#publish_choutimes").val());
        var accountlixi = parseInt($("#publish_account_lixi").val());
        total_money = oneAccount * choutimes;
        $("#total_money").html(total_money);
        total_danbao = oneAccount * 2 + accountlixi * choutimes;
        $("#total_danbao").html(total_danbao);
    }
    $("#publish_account_one").keyup(function () {
        toGetMoneyShow();
    });
    $("#publish_choutimes").keyup(function () {
        toGetMoneyShow();
    });
    $("#publish_account_lixi").keyup(function () {
        toGetMoneyShow();
    });

</script>