<div class="page_content" style="-webkit-transform: translate3d(0px, 0px, 0px);">
    <?php $this->renderPartial('//wechat/common/usertop') ?>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;">
        <div class="panel panel-default" style="margin-bottom: 0px;">
            <div class="panel-body">
                <?php
                if ($bankCard->getErrors()) {
                    $errors = $bankCard->getErrors();
                    echo '<div>' . $errors[0][0] . '</div>';
                }
                ?>
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'channel-form',
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => false
                ));
                ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">所属银行</label>
                    <?php
                    echo QCHtml::dropDownList("bank", "2", Linkage::getValueChina("qys_none", "account_bank"), array(
                        "class" => "form-control",
                    ));
                    ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">帐号类型</label>
                    <?php
                    echo QCHtml::dropDownList("bank_type", $bankCard->bank_type, $bankCard::getBankType(), array(
                        "class" => "form-control",
                    ));
                    ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">真实姓名</label>
                    <?php echo $form->textField($bankCard, 'realname', array('class' => 'form-control text-center', 'placeholder' => '请输入开户银行的真实姓名', 'maxlength' => 50)); ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">银行卡号</label>
                    <?php echo $form->textField($bankCard, 'account', array('class' => 'form-control text-center', 'placeholder' => '请输入银行的卡号', 'maxlength' => 50)); ?>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="exampleInputPassword1">银行所在地</label>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6" id="province_div">
                            <select class="form-control">
                                <option>省份</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6" id="city_div">
                            <select name="city_code" class="form-control">
                                <option value="10">北京市</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">支行名称</label>
                    <?php echo $form->textField($bankCard, 'branch', array('class' => 'form-control text-center', 'placeholder' => '请输入银行的支行名称', 'maxlength' => 200)); ?>
                </div>
                <button type="submit" class="btn btn-block btn-danger">更改</button>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;height: 10px;">
    </div>
    <?php $this->renderPartial('//wechat/common/bankpayaddressdiv') ?> 
    <script type="text/javascript">
        Zepto(function ($) {
<?php
if ($bankCard->province) {
    ?>
                $(".qys_common_pay_provice").val(<?php echo $bankCard->province; ?>);
<?php } ?>
            var newprovice = $(".qys_common_pay_provice");
            $("#province_div").html(newprovice);
<?php
if ($bankCard->city) {
    ?>
                $(".qys_common_pay_city_<?php echo $bankCard->province; ?>").val(<?php echo $bankCard->city; ?>);
                var newcity = $(".qys_common_pay_city_<?php echo $bankCard->province; ?>");
<?php } else { ?>
                var newcity = $(".qys_common_pay_city_1");
<?php } ?>
            $("#city_div").html(newcity);
            $(".qys_common_pay_provice").live('change', function () {
                var province = $(".qys_common_pay_provice").find("option").not(function () {
                    return !this.selected;
                }).val();
                $("#qys_address_show").append(newcity);
                newcity = $(".qys_common_pay_city_" + province);
                $("#city_div").html(newcity);
            });
        });
    </script>
    <?php $this->renderPartial('//wechat/common/fonterend') ?>
</div>
