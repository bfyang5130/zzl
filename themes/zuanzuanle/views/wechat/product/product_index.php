<?php
$user_id = Yii::app()->user->getId();
$user = Users::model()->findByPk($user_id);
?>
<div class="page_content" style="-webkit-transform: translate3d(0px, 0px, 0px);">
    <?php if ($user->super_type_id == 1): ?>
        <div class="col-lg-12" style="padding:10px 25px 0px 25px;">
            <a href="<?php echo Yii::app()->createUrl('/wechat/product/addProduct') ?>" class="btn btn-qys btn-danger btn-block">添加商品</a>
        </div>
    <?php endif; ?>
    <div class="col-lg-12 qys_col_12" style="margin-top:25px;">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php
                #获得所有用户的商品
                $produtlists = Product::model()->findAll("1=1 order by product_id desc limit 20;");
                $product = new Product();
                foreach ($produtlists as $key => $value) {
                    $product->setAttributes($value->getAttributes());
                    if ($key % 2 == 0):
                        ?>
                        <div class="row qys_product_row_list">
                        <?php endif; ?>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div><img class="img-rounded" style="width:100%;" src="<?= $product->product_s_img ?>"/></div>
                            <div>
                                <h5><?= $product->product_name ?></h5>
                                <p><?= $product->product_description ?></p>
                                <p><button class="btn btn-block btn-danger">￥<?= $product->product_price ?> 购买产品</button></p>
                            </div>
                        </div>
                        <?php if ($key % 2 == 1): ?>
                        </div>
                    <?php endif; ?>

                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>