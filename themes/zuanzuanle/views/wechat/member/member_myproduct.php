<div class="page_content" style="-webkit-transform: translate3d(0px, 0px, 0px);">
    <?php $this->renderPartial('//wechat/common/usertop') ?>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;min-height:350px;">
        <table class="table table-striped table-hover text-left" style="background-color:#f0f0f0;">
            <tr>
                <th>商品图片</th>
                <th>商品名称</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            <?php
            #获得用户资金记录
            $accountlog = ProductOrder::model()->findAll("user_id=:user_id order by order_id desc limit 10", array(":user_id" => Yii::app()->user->getId()));
            if ($accountlog) {
                foreach ($accountlog as $values) {
                    ?>
                    <tr>
                        <td><?php echo $values->product->product_s_img; ?></td>
                        <td><?php echo $values->product->product_name; ?></td>
                        <td><?php echo $values->order_status; ?></td>
                        <td>查看</td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="4">暂无数据</td></tr>';
            }
            ?>
        </table>
    </div>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;height: 10px;">
    </div>
    <?php $this->renderPartial('//wechat/common/fonterend') ?>
</div>