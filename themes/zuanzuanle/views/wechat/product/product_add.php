<div class="page_content" style="-webkit-transform: translate3d(0px, 0px, 0px);">
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;">
        <a href="<?php echo Yii::app()->createUrl('/wechat/product/index') ?>" class="btn btn-qys btn-danger btn-block">商品列表</a>
    </div>
    <div class="col-lg-12 qys_col_12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">商品名称：</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="输入商品的名称">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">商品价格(元)：</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入商品的价格">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">商品数量：</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入商品的数量">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">商品简介：</label>
                        <textarea class="form-control" rows="3" placeholder="输入商品简介"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">商品详情：</label>
                        <textarea class="form-control" rows="5" placeholder="输入商品的详细信息"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default btn-warning">提交</button>
                </form>
            </div>
        </div>
    </div>
</div>