<div class="page_content" style="-webkit-transform: translate3d(0px, 0px, 0px);">
    <?php $this->renderPartial('//wechat/common/usertop') ?>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;">
        <div class="panel panel-default" style="margin-bottom: 0px;">
            <div class="panel-body">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'channel-form',
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => false
                ));
                ?>
                <div class="form-group">
                    <label>真实姓名</label>
                    <?php if ($thisuser->real_status == 1): ?>
                        <p><?php echo $thisuser->realname ?></p>
                    <?php else: ?>
                        <?php echo $form->textField($thisuser, 'realname', array('class' => 'form-control text-center', 'placeholder' => '请输入您的真实姓名', 'maxlength' => 11)); ?>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label>证件号码</label>
                    <?php if ($thisuser->real_status == 1): ?>
                        <p><?php echo $thisuser->card_id ?></p>
                    <?php else: ?>
                        <?php echo $form->textField($thisuser, 'card_id', array('class' => 'form-control text-center', 'placeholder' => '请输入您的证件号码', 'maxlength' => 20)); ?>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label>手机号码</label>
                    <?php if ($thisuser->phone_status == 1): ?>
                        <p><?php echo $thisuser->phone ?></p>
                    <?php else: ?>
                        <?php echo $form->textField($thisuser, 'phone', array('class' => 'form-control text-center', 'placeholder' => '请输入您常用的手机号码', 'maxlength' => 11)); ?>
                        <p></p>
                        <a >验证手机</a>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label>邮箱地址</label>
                    <?php if ($thisuser->email_status == 1): ?>
                        <p><?php echo $thisuser->email ?></p>
                    <?php else: ?>
                        <?php echo $form->textField($thisuser, 'email', array('class' => 'form-control text-center', 'placeholder' => '请输入您常用的邮箱', 'maxlength' => 40)); ?>
                        <p></p>
                        <a>验证邮箱</a>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-block btn-danger">更改</button>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;height: 55px;">
    </div>
    <?php $this->renderPartial('//wechat/common/fonterend') ?>
</div>