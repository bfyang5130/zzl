<?php
if (!isset($_REQUEST['tab'])) {
    $_REQUEST['tab'] = '';
}
?>
<ul class="nav nav-tabs" role="tablist">
    <li <?php echo ($_REQUEST['tab'] == '') ? 'class="active"' : ''; ?>><a href="#tab0" role="tab" data-toggle="tab">实名认证</a></li>
    <li <?php echo ($_REQUEST['tab'] == 'tab1') ? 'class="active"' : ''; ?>><a href="#tab1" role="tab" data-toggle="tab">手机认证</a></li>
    <li <?php echo ($_REQUEST['tab'] == 'tab2') ? 'class="active"' : ''; ?>><a href="#tab2" role="tab" data-toggle="tab">邮箱认证</a></li>
    <li <?php echo ($_REQUEST['tab'] == 'tab3') ? 'class="active"' : ''; ?>><a href="#tab3" role="tab" data-toggle="tab">安全问答</a></li>
    <li <?php echo ($_REQUEST['tab'] == 'tab4') ? 'class="active"' : ''; ?>><a href="#tab4" role="tab" data-toggle="tab">登录密码</a></li>
    <li <?php echo ($_REQUEST['tab'] == 'tab5') ? 'class="active"' : ''; ?>><a href="#tab5" role="tab" data-toggle="tab">交易密码</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane <?php echo ($_REQUEST['tab'] == '') ? 'active' : ''; ?>" id="tab0">
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
                if ($thisuser) {
                    ?>
                    <tr>
                        <td colspan=2 style="border-top:none;color:red;"><?php echo $form->errorSummary($thisuser); ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td class="qys_publish_td_left">真实姓名：</td>
                    <td class="qys_publish_td_right">
                        <div class="form-group">
                            <div class="col-lg-5">
                                <?php echo $form->textField($thisuser, 'realname', array('class' => 'form-control')); ?>
                            </div>
                            <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 填写您的真实姓名</label>
                        </div><!-- /.form-group -->
                    </td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">性别：</td>
                    <td class="qys_publish_td_right">
                        <div class="form-group">
                            <div class="col-lg-5">
                                <?php echo $form->dropDownList($thisuser, 'sex', array("1" => '男', "2" => '女'), array('class' => 'form-control')); ?>
                            </div>
                            <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 选择您的性别</label>
                        </div><!-- /.form-group -->
                    </td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">证件类型：</td>
                    <td class="qys_publish_td_right">
                        <div class="form-group">
                            <div class="col-lg-5">
                                <?php echo $form->dropDownList($thisuser, 'card_type', Users::getCardType(), array('class' => 'form-control')); ?>
                            </div>
                            <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 填写您的证件类型</label>
                        </div><!-- /.form-group -->
                    </td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">证件号码：</td>
                    <td class="qys_publish_td_right">
                        <div class="form-group">
                            <div class="col-lg-5">
                                <?php echo $form->textField($thisuser, 'card_id', array('class' => 'form-control')); ?>
                            </div>
                            <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 填写您的证件号码</label>
                        </div><!-- /.form-group -->
                    </td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">民族：</td>
                    <td class="qys_publish_td_right">
                        <div class="form-group">
                            <div class="col-lg-5">
                                <?php echo $form->dropDownList($thisuser, 'nation', CHtml::listData(CActiveRecord::model('Nation')->findAll(), 'nationid', 'nation'), array('class' => 'form-control')); ?>
                            </div>
                            <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 填写您的民族</label>
                        </div><!-- /.form-group -->
                    </td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">证件所在地：</td>
                    <td class="qys_publish_td_right">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <table style="width:100%;padding:5px;">
                                    <tr>
                                        <td style="padding:5px;">
                                            <?php
                                            echo $form->dropDownList($thisuser, 'province', CHtml::listData(CActiveRecord::model('Province')->findAll(), 'provinceID', 'province'), array(
                                                'prompt' => '选择省份',
                                                'class' => 'form-control',
                                                'ajax' => array(
                                                    'type' => 'POST',
                                                    'url' => $this->createUrl('/member/user/updateCities'),
                                                    'dataType' => 'json',
                                                    'data' => array('idProvince' => 'js:this.value'),
                                                    'success' => 'function(data) {
                            $("#idCity").html(data.dropDownCities);
                            $("#idDistrict").html(data.dropDownDistricts);
                        }',
                                            )));
                                            ?>
                                        </td>
                                        <td style="padding:5px;">
                                            <?php
                                            echo $form->dropDownList($thisuser, 'city', CHtml::listData(CActiveRecord::model('City')->findAll(), 'cityID', 'city'), array(
                                                'prompt' => '选择城市',
                                                'id' => 'idCity',
                                                'class' => 'form-control',
                                                'ajax' => array(
                                                    'type' => 'POST',
                                                    'url' => $this->createUrl('/member/user/updateDistricts'),
                                                    'update' => '#idDistrict',
                                                    'data' => array('idCity' => 'js:this.value'),
                                            )));
                                            ?>
                                        </td>
                                        <td style="padding:5px;">
                                            <?php
                                            echo $form->dropDownList($thisuser, 'area', CHtml::listData(CActiveRecord::model('Area')->findAll(), 'areaID', 'area'), array('prompt' => '选择区域',
                                                'class' => 'form-control',
                                                'id' => 'idDistrict',
                                            ));
                                            ?>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div><!-- /.form-group -->
                    </td>
                </tr>
                <tr>
                    <td  class="qys_publish_td_left"></td>
                    <td class="qys_publish_td_right"><input class="publish_submit" id="publish_submit_submit" type="submit" name="publish_submit" value="实名认证"/></td>
                </tr>
            </table>
            <?php $this->endWidget(); ?>
        </div> 
    </div>
    <div class="tab-pane <?php echo ($_REQUEST['tab'] == 'tab1') ? 'active' : ''; ?>" id="tab1">
        <div class="table-responsive">
            <form action="?tab=tab1" method="post">
                <table class="table table-bordered table-striped" style="border-top:none;">
                    <?php
                    if ($thisuser) {
                        ?>
                        <tr>
                            <td colspan=2 style="border-top:none;color:red;"><?php echo $form->errorSummary($thisuser); ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class="qys_publish_td_left">已认证号码：</td>
                        <td class="qys_publish_td_right">
                            <?php
                            if ($thisuser->phone_status == 1) {
                                echo '<font style="color:green">' . $thisuser->phone . '</font>';
                            } else {
                                echo '<font style="color:red">未认证</font>';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="qys_publish_td_left">手机号码：</td>
                        <td class="qys_publish_td_right">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <?php echo $form->textField($thisuser, 'phone', array('class' => 'form-control', 'maxlength' => 11)); ?>
                                </div>
                                <label class="control-label col-lg-7" style="text-align: left;padding:5px;"><font style="color:red;">*</font> 填写您的手机号码</label>
                            </div><!-- /.form-group -->
                        </td>
                    </tr>
                    <tr>
                        <td class="qys_publish_td_left">手机验证码：</td>
                        <td class="qys_publish_td_right">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <?php echo QCHtml::textField("Users[phoneyezheng]", '', array('class' => 'form-control', 'maxlength' => 6)); ?>
                                </div>
                                <label class="control-label col-lg-7" style="text-align: left;padding:5px;"><button class="btn btn-sm btn-default">获取验证码</button></label>
                            </div><!-- /.form-group -->
                        </td>
                    </tr>
                    <tr>
                        <td class="qys_publish_td_left">登录密码：</td>
                        <td class="qys_publish_td_right">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <?php echo QCHtml::passwordField("Users[password]", '', array('class' => 'form-control')); ?>
                                </div>
                                <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font>填写您的登录密码来确认修改</label>
                            </div><!-- /.form-group -->
                        </td>
                    </tr>
                    <tr>
                        <td  class="qys_publish_td_left"></td>
                        <td class="qys_publish_td_right"><input class="publish_submit" id="publish_submit_submit" type="submit" name="publish_submit" value="手机认证"/></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div class="tab-pane <?php echo ($_REQUEST['tab'] == 'tab2') ? 'active' : ''; ?>" id="tab2">
        <div class="table-responsive">
            <form action="?tab=tab2" method="post">
                <table class="table table-bordered table-striped" style="border-top:none;">
                    <?php
                    if ($thisuser) {
                        ?>
                        <tr>
                            <td colspan=2 style="border-top:none;color:red;"><?php echo $form->errorSummary($thisuser); ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class="qys_publish_td_left">已认证邮箱：</td>
                        <td class="qys_publish_td_right">
                            <?php
                            if ($thisuser->email_status == 1) {
                                echo '<font style="color:green">' . $thisuser->email . '</font>';
                            } else {
                                echo '<font style="color:red">未认证</font>';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="qys_publish_td_left">邮箱：</td>
                        <td class="qys_publish_td_right">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <?php echo $form->textField($thisuser, "email", array('class' => 'form-control')); ?>
                                </div>
                                <label class="control-label col-lg-7" style="text-align: left;padding:5px;"><font style="color:red;">*</font> 填写您的邮箱</label>
                            </div><!-- /.form-group -->
                        </td>
                    </tr>
                    <tr>
                        <td class="qys_publish_td_left">登录密码：</td>
                        <td class="qys_publish_td_right">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <?php echo QCHtml::passwordField("Users[password]", '', array('class' => 'form-control')); ?>
                                </div>
                                <label class="control-label col-lg-7" style="text-align: left;padding:5px;"><font style="color:red;">*</font>填写您的登录密码来确认修改</label>
                            </div><!-- /.form-group -->
                        </td>
                    </tr>
                    <tr>
                        <td  class="qys_publish_td_left"></td>
                        <td class="qys_publish_td_right"><input class="publish_submit" id="publish_submit_submit" type="submit" name="publish_submit" value="发送激活邮件"/></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div class="tab-pane <?php echo ($_REQUEST['tab'] == 'tab3') ? 'active' : ''; ?>" id="tab3">
        <div class="table-responsive">
            <form action="?tab=tab3" method="post">
                <table class="table table-bordered table-striped" style="border-top:none;">
                    <?php
                    if ($thisuser) {
                        ?>
                        <tr>
                            <td colspan=2 style="border-top:none;color:red;"><?php echo $form->errorSummary($thisuser); ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class="qys_publish_td_left">已设置安全问题：</td>
                        <td class="qys_publish_td_right">
                            <?php
                            if ($thisuser->answer != '') {
                                echo '<font style="color:green">是</font>';
                            } else {
                                echo '<font style="color:red">否</font>';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="qys_publish_td_left">选择问题：</td>
                        <td class="qys_publish_td_right">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <?php echo $form->dropDownList($thisuser, 'question', Linkage::getQuestion(), array('class' => 'form-control')); ?>
                                </div>
                                <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 选择您的问题</label>
                            </div><!-- /.form-group -->
                        </td>
                    </tr>
                    <tr>
                        <td class="qys_publish_td_left">答案：</td>
                        <td class="qys_publish_td_right">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <?php echo QCHtml::textField("Users[answer]", '', array('class' => 'form-control')); ?>
                                </div>
                                <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 填写您的答案</label>
                            </div><!-- /.form-group -->
                        </td>
                    </tr>
                    <tr>
                        <td class="qys_publish_td_left">已往问题：</td>
                        <td class="qys_publish_td_right"><?php echo Linkage::getQuestion($thisuser->question); ?></td>
                    </tr>
                    <tr>
                        <td class="qys_publish_td_left">已往答案：</td>
                        <td class="qys_publish_td_right">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <?php echo QCHtml::textField("Users[oldanswer]", '', array('class' => 'form-control')); ?>
                                </div>
                                <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font>如果没有，请输入与当前一样的答案</label>
                            </div><!-- /.form-group -->
                        </td>
                    </tr>
                    <tr>
                        <td  class="qys_publish_td_left"></td>
                        <td class="qys_publish_td_right"><input class="publish_submit" id="publish_submit_submit" type="submit" name="publish_submit" value="设置密保"/></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div class="tab-pane <?php echo ($_REQUEST['tab'] == 'tab4') ? 'active' : ''; ?>" id="tab4">
        <div class="table-responsive">
            <form action="?tab=tab4" method="post">
                <table class="table table-bordered table-striped" style="border-top:none;">
                    <?php
                    if ($thisuser) {
                        ?>
                        <tr>
                            <td colspan=2 style="border-top:none;color:red;"><?php echo $form->errorSummary($thisuser); ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class="qys_publish_td_left">旧登录密码：</td>
                        <td class="qys_publish_td_right">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <?php echo QCHtml::passwordField("Users[oldpassword]", '', array('class' => 'form-control')); ?>
                                </div>
                                <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 填写您的登录密码</label>
                            </div><!-- /.form-group -->
                        </td>
                    </tr>
                    <tr>
                        <td class="qys_publish_td_left">新登录密码：</td>
                        <td class="qys_publish_td_right">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <?php echo QCHtml::passwordField("Users[password]", '', array('class' => 'form-control')); ?>
                                </div>
                                <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 填写您的新登录密码</label>
                            </div><!-- /.form-group -->
                        </td>
                    </tr>
                    <tr>
                        <td class="qys_publish_td_left">重复新登录密码：</td>
                        <td class="qys_publish_td_right">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <?php echo QCHtml::passwordField("Users[repassword]", '', array('class' => 'form-control')); ?>
                                </div>
                                <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font>重复一次新的登录密码</label>
                            </div><!-- /.form-group -->
                        </td>
                    </tr>
                    <tr>
                        <td  class="qys_publish_td_left"></td>
                        <td class="qys_publish_td_right"><input class="publish_submit" id="publish_submit_submit" type="submit" name="publish_submit" value="修改登录密码"/></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div class="tab-pane <?php echo ($_REQUEST['tab'] == 'tab5') ? 'active' : ''; ?>" id="tab5">
        <div class="table-responsive">
            <form action="?tab=tab5" method="post">
                <table class="table table-bordered table-striped" style="border-top:none;">
                    <?php
                    if ($thisuser) {
                        ?>
                        <tr>
                            <td colspan=2 style="border-top:none;color:red;"><?php echo $form->errorSummary($thisuser); ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class="qys_publish_td_left">旧交易密码：</td>
                        <td class="qys_publish_td_right">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <?php echo QCHtml::passwordField("Users[oldpaypassword]", '', array('class' => 'form-control')); ?>
                                </div>
                                <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 如果没有设置那么填写登录密码</label>
                            </div><!-- /.form-group -->
                        </td>
                    </tr>
                    <tr>
                        <td class="qys_publish_td_left">新交易密码：</td>
                        <td class="qys_publish_td_right">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <?php echo QCHtml::passwordField("Users[paypassword]", '', array('class' => 'form-control')); ?>
                                </div>
                                <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 填写您的新交易密码</label>
                            </div><!-- /.form-group -->
                        </td>
                    </tr>
                    <tr>
                        <td class="qys_publish_td_left">重复新交易密码：</td>
                        <td class="qys_publish_td_right">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <?php echo QCHtml::passwordField("Users[repaypassword]", '', array('class' => 'form-control')); ?>
                                </div>
                                <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font>重复您的新交易密码</label>
                            </div><!-- /.form-group -->
                        </td>
                    </tr>
                    <tr>
                        <td  class="qys_publish_td_left"></td>
                        <td class="qys_publish_td_right"><input class="publish_submit" id="publish_submit_submit" type="submit" name="publish_submit" value="更改交易密码"/></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>