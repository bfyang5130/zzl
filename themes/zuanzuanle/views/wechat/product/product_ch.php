<div class="page_content" style="-webkit-transform: translate3d(0px, 0px, 0px);">
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
                <div class="row qys_addp_row">
                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 text-left">商品名称：</div>
                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6"><?php echo $form->textField($product, 'product_name', array('class' => 'form-control text-right', 'placeholder' => '输入商品的名称', 'maxlength' => 30)); ?></div>   
                </div>
                <div class="row qys_addp_row">
                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 text-left">商品价格(元)：</div>
                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6"><?php echo $form->textField($product, 'product_price', array('class' => 'form-control text-right', 'placeholder' => '输入商品的价格', 'maxlength' => 20)); ?></div>
                </div>
                <div class="row qys_addp_row">
                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 text-left">商品数量：</div>
                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6"><?php echo $form->textField($product, 'product_num', array('class' => 'form-control text-right', 'placeholder' => '输入商品的数量', 'maxlength' => 10)); ?></div>
                </div>
                <div class="row qys_addp_row">
                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 text-left">商品简介：</div>
                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6"></div>
                </div>
                <div class="row">
                    <div class="col-lg-12"><?php echo $form->textArea($product, 'product_description', array('class' => 'form-control text-left', 'placeholder' => '输入商品简介', 'row' => 3)); ?></div>
                </div>
                <div class="row qys_addp_row">
                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 text-left">商品详情：</div>
                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6"></div>
                </div>
                <div class="row">
                    <div class="col-lg-12"><?php echo $form->textArea($product, 'product_info', array('class' => 'form-control text-left', 'placeholder' => '输入商品的详细信息', 'row' => 5)); ?></div>
                </div>
                <div class="row qys_addp_row">
                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 text-left">产品图片：</div>
                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6"></div>
                </div>
                <div class="row">
                    <div class="col-lg-12" style="text-align: left;">
                        <?php
                        if($product->product_s_img){
                         echo  '<img src="'.$product->product_s_img.'"/>';  
                        }else{
                            echo '暂无图片';
                        }
                        ?>
                    </div>
                </div>
                <div class="row qys_addp_row">
                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 text-left">更换产品图片：</div>
                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6"></div>
                </div>
                <div class="row">
                    <div class="col-lg-12" style="text-align: left;">
                        <?php
                        #获得当前用户的图片
                        $user_id=Yii::app()->user->getId();
                        $imagelist=  Pic::model()->findAll("user_id=:user_id",array(":user_id"=>$user_id));
                        foreach ($imagelist as $key => $value) {
                          ?>
                        <label class="radio-inline">
                            <input type="radio" name="pic_id" value="<?php echo $value->id ?>"> <img style="width:60px;height:40px;" src="<?php echo $value->pic_s_img ?>"/>
                        </label>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-default btn-warning">提交</button>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>