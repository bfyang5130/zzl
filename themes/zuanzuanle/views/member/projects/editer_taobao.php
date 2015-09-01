<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/ajaxfileupload.js');
if (!isset($_REQUEST['tab'])) {
    $_REQUEST['tab'] = '';
}
?>
<ul class="nav nav-tabs" role="tablist">
    <li <?php echo ($_REQUEST['tab'] == '') ? 'class="active"' : ''; ?>><a href="#project_base" role="tab" data-toggle="tab">基本信息修改</a></li>
    <li <?php echo ($_REQUEST['tab'] == 'project_pic') ? 'class="active"' : ''; ?>><a href="#project_pic" role="tab" data-toggle="tab">形象图片及轮播图</a></li>
    <li <?php echo ($_REQUEST['tab'] == 'project_content') ? 'class="active"' : ''; ?>><a href="#project_content" role="tab" data-toggle="tab">项目详细描述修改</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane <?php echo ($_REQUEST['tab'] == '') ? 'active' : ''; ?>" id="project_base">
        <div class="table-responsive">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'channel-form',
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'htmlOptions' => array(
                    "class" => 'form-horizontal',
                ),
            ));
            ?>
            <table class="table table-bordered table-striped" style="border-top:none;">
                <?php
                if ($thisproject) {
                    ?>
                    <tr>
                        <td colspan=2 style="border-top:none;"><?php echo $form->errorSummary($thisproject); ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td class="qys_publish_td_left">项目名称：</td>
                    <td class="qys_publish_td_right">
                        <div class="form-group">
                            <div class="col-lg-5">
                                <?php echo $form->textField($thisproject, 'title', array('id' => 'publish_title', 'class' => 'form-control')); ?>
                            </div>
                            <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 详细填写您的项目名称（10个字以上）</label>
                        </div><!-- /.form-group -->
                    </td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">筹资类型：</td>
                    <td class="qys_publish_td_right">
                        <div class="form-group">
                            <div class="col-lg-5">
                                <?php
                                echo Linkage::getValueChina($thisproject->type, "project_type");
                                ?>
                            </div>
                            <label class="control-label col-lg-7" style="text-align: left;">筹资项目所属的类型</label>
                        </div><!-- /.form-group -->
                    </td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">筹资方式：</td>
                    <td class="qys_publish_td_right">
                        <div class="form-group">
                            <div class="col-lg-5">
                                <?php
                                if ($thisproject->type = 3) {
                                    echo Linkage::getValueChina($thisproject->collection_type, "collection_type");
                                } else {
                                    echo $form->dropDownList($thisproject, 'collection_type', Linkage::getValueChina("qys_none", "collection_type"), array('class' => 'form-control'));
                                }
                                ?>
                            </div>
                            <label class="control-label col-lg-7" style="text-align: left;">筹资时是否直接冻结用户资金</label>
                        </div><!-- /.form-group -->
                    </td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">筹资金额：</td>
                    <td class="qys_publish_td_right">
                        <div class="form-group">
                            <div class="col-lg-5">
                                <?php
                                echo round($thisproject->account, 2);
                                ?>
                            </div>
                            <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 总的要筹资的金额（10元至1000万之间）</label>
                        </div><!-- /.form-group -->
                    </td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">筹资期限：</td>
                    <td class="qys_publish_td_right">
                        <div class="form-group">
                            <div class="col-lg-5">
                                <?php echo $form->dropDownList($thisproject, 'intime', Project::getDayLimitValue(), array('class' => 'form-control')); ?>
                            </div>
                            <label class="control-label col-lg-7" style="text-align: left;">需在多少天内完成筹资</label>
                        </div><!-- /.form-group -->
                    </td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">筹资次数：</td>
                    <td class="qys_publish_td_right">
                        <div class="form-group">
                            <div class="col-lg-5">
                                <?php echo $thisproject->choutimes; ?>
                            </div>
                            <label class="control-label col-lg-7" style="text-align: left;">总共需要支持多少次筹资</label>
                        </div><!-- /.form-group -->
                    </td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">单笔金额：</td>
                    <td class="qys_publish_td_right">
                        <div class="form-group">
                            <div class="col-lg-5">
                                <?php echo round($thisproject->account_one, 2); ?>
                            </div>
                            <label class="control-label col-lg-7" style="text-align: left;">单笔筹资金额</label>
                        </div><!-- /.form-group -->
                    </td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">单笔支出：</td>
                    <td class="qys_publish_td_right">
                        <div class="form-group">
                            <div class="col-lg-5">
                                <?php echo round($thisproject->account_lixi, 2); ?>
                            </div>
                            <label class="control-label col-lg-7" style="text-align: left;">单笔支付金额</label>
                        </div><!-- /.form-group -->
                    </td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">项目担保金：</td>
                    <td class="qys_publish_td_right">
                        <div class="form-group">
                            <div class="col-lg-5">
                                <?php echo round($thisproject->account_danbao, 2); ?>
                            </div>
                            <label class="control-label col-lg-7" style="text-align: left;">发布项目需要的担保金额</label>
                        </div><!-- /.form-group -->
                    </td>
                </tr>
                <tr>
                    <td  class="qys_publish_td_left"></td>
                    <td class="qys_publish_td_right"><input class="publish_submit" id="publish_submit_submit" type="submit" name="publish_submit" value="更改基本信息"/></td>
                </tr>
            </table>
            <?php $this->endWidget(); ?>
        </div> 
    </div>
    <div class="tab-pane <?php echo ($_REQUEST['tab'] == 'project_pic') ? 'active' : ''; ?>" id="project_pic">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="border-top:none;">
                <tr>
                    <td colspan=4  style="border-top:none;"></td>
                </tr>
                <tr>
                    <td>形象图：</td>
                    <td>
                        <img tval="<?php echo $thisproject->id; ?>" class="img-responsive img-rounded" src="<?php echo Yii::app()->params['main_site'] . "/" . $thisproject->litt_pic; ?>"/>
                    </td>
                    <td><input id="fileToUpload_base" type="file" size="20" name="fileToUpload" class="input"></td>
                    <td><input name="lunbouploadbutton" class="btn btn-default pic_upload" tval="base" type="button" value="更改"/></td>
                </tr>
                <?php
                #获得已经存在的轮播图
                $thisprojcetlunbopics = ProjectLunbo::model()->findAll("projects_id=:projects_id order by id asc", array(":projects_id" => $thisproject->id));
                if ($thisprojcetlunbopics) {
                    foreach ($thisprojcetlunbopics as $value) {
                        ?>
                        <tr>
                            <td>轮播图：</td>
                            <td>
                                <img tval="<?php echo $value->id; ?>" class="img-responsive img-rounded" src="<?php echo Yii::app()->params['main_site'] . "/" . $value->pic_address; ?>"/>
                            </td>
                            <td>
                                <input id="fileToUpload_<?php echo $value->id; ?>" type="file" size="20" name="fileToUpload" class="input">
                                <h4>图片描述：</h4>
                                <div class="well"><?php echo $value->pic_remark; ?></div>
                                <p>
                                    <?php
                                    switch ($value->pic_status) {
                                        case 0: echo '<span class="btn btn-info">验证中</span>';
                                            break;
                                        case 1: echo '<span class="btn btn-success">通过验证</span>';
                                            break;
                                        case 2: echo '<span class="btn btn-danger">验证失败</span>';
                                            break;
                                        default: echo '<span class="btn btn-info">验证中</span>';
                                    }
                                    ?>
                                </p>
                            </td>
                            <td>
                                <input name="lunbouploadbutton" class="btn btn-default pic_upload" tval="<?php echo $value->id; ?>" type="button" value="更改"/>
                                <h3></h3>
                                <a href="javascript:if(confirm('确实要删除吗?'))location='<?php echo Yii::app()->createUrl('/member/projects/lubopic/id/' . $thisproject->id . '/luobo_id/' . $value->id); ?>'" class="btn btn-danger">删除</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <tr>
                    <td>轮播图<br/>(900x450)</td>
                    <td>
                        <textarea name="remark" id="lunbo_remark" class="form-control"></textarea>
                    </td>
                    <td>
                        <input id="fileToUpload_new" type="file" size="20" name="fileToUpload" class="input">
                    </td>
                    <td>
                        <input name="lunbouploadbutton" class="btn btn-default pic_upload" tval="new" type="button" value="确定上传"/>
                    </td>
                </tr>
            </table>
        </div>
        <script type="text/javascript">
            $("input[class='btn btn-default pic_upload']").click(function () {
                var tval = $(this).attr("tval");
                //上传文件
                var contentremark = $("#lunbo_remark").val();
                if (contentremark === "") {
                    alert("请在最下面的描述框里填写当前图片的描述");
                    return false;
                }
                $.ajaxFileUpload({
                    url: '/member/projects/picupload.html?id=' + tval + '&type=' + tval + '&content=' + contentremark + '&pro_id=<?php echo $thisproject->id; ?>', //处理图片脚本
                    secureuri: false,
                    fileElementId: 'fileToUpload_' + tval, //file控件id                     dataType: 'json',
                    success: function (data, status) {
                        if (typeof (data.error) != 'undefined') {
                            if (data.error != '') {
                                alert(data.error);
                            } else {
                                window.location.href = "/member/projects/editer/id/<?php echo $thisproject->id; ?>.html?tab=project_pic";
                            }
                        }
                    },
                    error: function (data, status, e) {
                        alert(e);
                    }
                });
                return false;
            });
        </script>
    </div>
    <div class="tab-pane <?php echo ($_REQUEST['tab'] == 'project_content') ? 'active' : ''; ?>" id="project_content">
        <div class="table-responsive">
            <form name="one_content" action="#" method="post" encType="multipart/form-data">
                <table class="table table-bordered table-striped" style="border-top:none;">
                    <tr>
                        <td  style="border-top:none;">项目详情</td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->textArea($thisproject, 'content', array('id' => 'publish_content')); ?>
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
                        <td>
                            <input class="publish_submit" id="publish_submit_content_submit" type="submit" name="publish_submit_content" value="更新项目详情"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
