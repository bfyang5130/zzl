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
                <td colspan=2 style="border-top:none;color:red;"><?php echo $form->errorSummary($thisbank); ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td class="qys_publish_td_left">真实姓名：</td>
            <td class="qys_publish_td_right">
                <div class="form-group">
                    <div class="col-lg-5">
                        <?php
                        echo $thisuser->realname;
                        ?>
                    </div>
                    <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 真实姓名必须与银行卡一致！</label>
                </div><!-- /.form-group -->
            </td>
        </tr>
        <tr>
            <td class="qys_publish_td_left">所属银行：</td>
            <td class="qys_publish_td_right">
                <div class="form-group">
                    <div class="col-lg-5">
                        <?php
                        echo $form->dropDownList($thisbank, 'bank', Linkage::getValueChina("qys_none", "cash_bank"), array('class' => 'form-control', 'id' => 'bankcode'));
                        echo $form->hiddenField($thisbank, 'bank_name', array('class' => 'form-control', 'id' => 'bank_name'));
                        ?>
                    </div>
                    <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 选择您的性别</label>
                </div><!-- /.form-group -->
            </td>
        </tr>
        <tr>
            <td class="qys_publish_td_left">银行帐号：</td>
            <td class="qys_publish_td_right">
                <div class="form-group">
                    <div class="col-lg-5">
                        <?php echo $form->textField($thisbank, 'account', array('class' => 'form-control')); ?>
                    </div>
                    <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 请填写你的银行帐号(不允许有空格)</label>
                </div><!-- /.form-group -->
            </td>
        </tr>
        <tr>
            <td class="qys_publish_td_left">帐号类型：</td>
            <td class="qys_publish_td_right">
                <div class="form-group">
                    <div class="col-lg-5">
                        <?php echo $form->dropDownList($thisbank, 'bank_type', Linkage::getValueChina("qys_none", "bank_type"), array('class' => 'form-control')); ?>
                    </div>
                    <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 选择您的银行是私人或者公司</label>
                </div><!-- /.form-group -->
            </td>
        </tr>
        <tr>
            <td class="qys_publish_td_left">开户所在地：</td>
            <td class="qys_publish_td_right">
                <div class="form-group">
                    <div class="col-lg-12">
                        <table style="width:100%;padding:5px;">
                            <tr>
                                <td style="padding:5px;">
                                    <?php
                                    echo $form->dropDownList($thisbank, 'province', CHtml::listData(CActiveRecord::model('Province')->findAll(), 'provinceID', 'province'), array(
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
                                    echo $form->dropDownList($thisbank, 'city', CHtml::listData(CActiveRecord::model('City')->findAll(), 'cityID', 'city'), array(
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
                                    echo $form->dropDownList($thisbank, 'area', CHtml::listData(CActiveRecord::model('Area')->findAll(), 'areaID', 'area'), array('prompt' => '选择区域',
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
            <td class="qys_publish_td_left">支行地址：</td>
            <td class="qys_publish_td_right">
                <div class="form-group">
                    <div class="col-lg-5">
                        <?php echo $form->textField($thisbank, 'branch', array('class' => 'form-control')); ?>
                    </div>
                    <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 填写详细支行地址。如：(广东省东莞市南城支行)</label>
                </div><!-- /.form-group -->
            </td>
        </tr>
        <tr>
            <td  class="qys_publish_td_left"></td>
            <td class="qys_publish_td_right">
                <?php
                if (isset($thisbank->id)) {
                    echo '<input class="publish_submit" id="publish_submit_submit" type="submit" name="publish_submit" value="更改银行卡"/>';
                } else {
                    echo '<input class="publish_submit" id="publish_submit_submit" type="submit" name="publish_submit" value="添加银行卡"/>';
                }
                ?>
            </td>
        </tr>
    </table>
    <?php $this->endWidget(); ?>
</div>
<script type="text/javascript">
    $("#bankcode").change(function () {
        var selectbank_name = $(this).find("option:selected").text();
        $("#bank_name").val(selectbank_name);
    });
</script>