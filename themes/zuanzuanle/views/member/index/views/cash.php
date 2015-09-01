<div class="table-responsive">
    <form name="cash_form" onSubmit="return checkCash();" class="form-horizontal" method="post" action="/member/index/gotocash.html">
        <table class="table table-bordered table-striped" style="border-top:none;">
            <tr>
                <td colspan=2 style="border-top:none;color:red;"></td>
            </tr>
            <tr>
                <td class="qys_publish_td_left">提现帐号：</td>
                <td class="qys_publish_td_right">
                    <div class="form-group">
                        <div class="col-lg-5">
                            <?php
                            echo $thisbank->account;
                            ?>
                        </div>
                        <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 提现到的银行帐号！</label>
                    </div><!-- /.form-group -->
                </td>
            </tr>
            <tr>
                <td class="qys_publish_td_left">所属银行：</td>
                <td class="qys_publish_td_right">
                    <div class="form-group">
                        <div class="col-lg-5">
                            <?php echo $thisbank->bank_name; ?>
                        </div>
                        <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 提现到那一个银行</label>
                    </div><!-- /.form-group -->
                </td>
            </tr>
            <tr>
                <td class="qys_publish_td_left">支行地址：</td>
                <td class="qys_publish_td_right">
                    <div class="form-group">
                        <div class="col-lg-5">
                            <?php
                            echo $thisbank->branch;
                            ?>
                        </div>
                        <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 支行开户名称！</label>
                    </div><!-- /.form-group -->
                </td>
            </tr>
            <tr>
                <td class="qys_publish_td_left">真实姓名：</td>
                <td class="qys_publish_td_right">
                    <div class="form-group">
                        <div class="col-lg-5">
                            <?php echo $thisuser->realname; ?>
                        </div>
                        <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 与开户银行一致的姓名</label>
                    </div><!-- /.form-group -->
                </td>
            </tr>
            <?php
            $oneuser = Account::model()->find("user_id=:user_id", array(":user_id" => $thisuser->user_id));
            ?>
            <tr>
                <td class="qys_publish_td_left">可用金额：</td>
                <td class="qys_publish_td_right">
                    <div class="form-group">
                        <div class="col-lg-5">
                            <?php echo $oneuser->use_money; ?>
                        </div>
                        <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 你的可提现金额</label>
                    </div><!-- /.form-group -->
                </td>
            </tr>
            <tr>
                <td class="qys_publish_td_left">提现金额：</td>
                <td class="qys_publish_td_right">
                    <div class="form-group">
                        <div class="col-lg-5">
                            <?php echo QCHtml::textField("Cash[total]", '0.00', array('id' => 'cashmoney', 'class' => 'form-control')); ?>
                        </div>
                        <label class="control-label col-lg-7" style="text-align: left;"><font style="color:red;">*</font> 填写你要提现的金额</label>
                    </div><!-- /.form-group -->
                </td>
            </tr>
            <tr>
                <td  class="qys_publish_td_left"></td>
                <td class="qys_publish_td_right"><input class="publish_submit" id="publish_submit_submit" type="submit" name="publish_submit" value="申请提现"/></td>
            </tr>
        </table>
    </form>
</div>
<script type="text/javascript">
    var dialogdir = "<?php echo Yii::app()->theme->baseUrl; ?>/src";
    function checkCash() {
        var price = $("#cashmoney").val();
        if (!checkPrice(price)) {
            alert('请输入正确的金额');
            return false;
        }
    }
</script>