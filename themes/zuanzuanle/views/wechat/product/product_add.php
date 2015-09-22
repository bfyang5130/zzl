<div class="page_content" style="-webkit-transform: translate3d(0px, 0px, 0px);">
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;">
        <a href="<?php echo Yii::app()->createUrl('/wechat/product/index') ?>" class="btn btn-qys btn-danger btn-block">商品列表</a>
    </div>
    <div class="col-lg-12 qys_col_12">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php
                if ($product->getErrors()) {
                    $errors = $product->getErrors();
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
                    <label for="exampleInputEmail1">商品名称：</label>
                    <?php echo $form->textField($product, 'product_name', array('class' => 'form-control text-center', 'placeholder' => '输入商品的名称', 'maxlength' => 30)); ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">商品价格(元)：</label>
                    <?php echo $form->textField($product, 'product_price', array('class' => 'form-control text-center', 'placeholder' => '输入商品的价格', 'maxlength' => 20)); ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">商品数量：</label>
                    <?php echo $form->textField($product, 'product_num', array('class' => 'form-control text-center', 'placeholder' => '输入商品的数量', 'maxlength' => 10)); ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">商品简介：</label>
                    <?php echo $form->textArea($product, 'product_description', array('class' => 'form-control text-left', 'placeholder' => '输入商品简介', 'row' => 3)); ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">商品详情：</label>
                    <?php echo $form->textArea($product, 'product_info', array('class' => 'form-control text-left', 'placeholder' => '输入商品的详细信息', 'row' => 5)); ?>
                </div>
                <button type="submit" class="btn btn-default btn-warning">提交</button>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>