<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/member.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/publish.css"/>
<div class="main">
    <div class="index_top" style="margin-bottom:25px;">
        <!--项目发布 开始-->
        <div class="index_clum_top">
            <div class="index_clum_t1"></div>
            <div class="index_clum_t2">
                <h2 class="index_clum_title" id="ff">项目发布</h2>
            </div>
            <div class="index_clum_t3"></div>
        </div>
        <div class="index_clum_content">
            <div class="qys_publish_content">
                <form method="post" id="publish_submit" enctype="multipart/form-data">
                    <table>
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
                            <td class="qys_publish_td_left">筹资类型：</td>
                            <td class="qys_publish_td_right">
                                <?php
                                echo CHtml::dropDownList("type", "gongyi", Project::getTypeValue(), array(
                                    "class" => "input_select"
                                ));
                                ?> 
                                <span class="qys_publish_dec">筹资项目所属的类型</span></td>
                        </tr>
                        <tr>
                            <td class="qys_publish_td_left">筹资金额：</td>
                            <td class="qys_publish_td_right"><input id="publish_account" name="account" class="input_account" type="text" value=""/><span class="qys_publish_dec"><font style="color:red;">*</font> 总的要筹资的金额（10元至1000万之间）</span></td>
                        </tr>
                        <tr>
                            <td class="qys_publish_td_left">筹资期限：</td>
                            <td class="qys_publish_td_right">
                                <?php
                                echo CHtml::dropDownList("intime", "1", Project::getDayLimitValue(), array(
                                    "class" => "input_select"
                                ));
                                ?>
                                <span class="qys_publish_dec">需在多少天内完成筹资</span></td>
                        </tr>
                        <tr>
                            <td class="qys_publish_td_left">最低筹资：</td>
                            <td class="qys_publish_td_right">
                                <?php
                                echo CHtml::dropDownList("low_account", "1", Project::getLowAccountLimitValue(), array(
                                    "class" => "input_select"
                                ));
                                ?>
                                <span class="qys_publish_dec">每人最低需筹资的金额</span></td>
                        </tr>
                        <tr>
                            <td  class="qys_publish_td_left">形象图片：</td>
                            <td class="qys_publish_td_right"><input type="file" name="picname"/><span class="qys_publish_dec">( 规格为 250x250 PX )</span></td>
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
        <div class="index_clum_bottom">
            <div class="index_clum_b1"></div>
            <div class="index_clum_b2"></div>
            <div class="index_clum_b3"></div>
            <div class="clear"></div>
        </div>
        <!--我的帐号 结束-->

        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
    var dialogdir = "<?php echo Yii::app()->theme->baseUrl; ?>/src";
    (function() {
        $("#publish_submit_submit").click(function() {
            //判断数据是否填写正确
            var commitstatus = true;
            var msg = "<font color=blue><strong>发布中...</strong></font>";
            var username = $.trim($("#publish_title").val());
            var password = $.trim($("#publish_account").val());

            if (username === "" || password === "") {
                msg = "<font color=red><strong>项目标题及筹资金额不能为空!</strong></font>";
                commitstatus = false;
            }
            seajs.use(['jquery', dialogdir + '/dialog-plus'], function($, dialog) {
                var d = dialog({
                    title: '发布项目',
                    content: msg,
                    cancelValue: '知道了',
                    cancel: function() {
                    }
                });
                d.width(300).height(50).showModal();

                if (commitstatus === true) {
                    $("#publish_submit").submit();
                }
            });

        });
    })();
</script>