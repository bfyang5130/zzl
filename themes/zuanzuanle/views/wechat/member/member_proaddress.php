<div class="page_content" style="-webkit-transform: translate3d(0px, 0px, 0px);">
    <?php $this->renderPartial('//wechat/common/usertop') ?>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;">
        <div class="panel panel-default" style="margin-bottom: 0px;">
            <div class="panel-heading">
                <h3 class="panel-title">收货地址</h3>
            </div>
            <div class="panel-body">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'channel-form',
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => false
                ));
                ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">收货人真实姓名</label>
                    <?php echo $form->textField($userprodaddress, 'realname', array('class' => 'form-control text-center', 'placeholder' => '请输入收货人的真实姓名', 'maxlength' => 50)); ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">收货人的联系电话</label>
                    <?php echo $form->textField($userprodaddress, 'phone', array('class' => 'form-control text-center', 'placeholder' => '请输入收货人的电话或手机', 'maxlength' => 30)); ?>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="exampleInputPassword1">收货人所在地</label>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                            <select class="form-control">
                                <option>省份</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                            <select name="city_code" id="city_code" class="form-control">
                                <option value="10">北京市</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                            <select name="city_code" id="city_code" class="form-control">
                                <option value="10">南城区</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">收货人的详细地址</label>
                    <?php echo $form->textField($userprodaddress, 'address', array('class' => 'form-control text-center', 'placeholder' => '请输入收货人的电话或手机', 'maxlength' => 30)); ?>
                </div>
                <button type="submit" class="btn btn-block btn-danger">更改</button>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;height: 10px;">
    </div>
    <?php $this->renderPartial('//wechat/common/fonterend') ?>
</div>