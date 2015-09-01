<div class="page_content" style="-webkit-transform: translate3d(0px, 0px, 0px);">
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;">
        <div class="panel panel-default" style="margin-bottom: 0px;">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-4">
                        <img style="width:100px;height:100px;" class="img-rounded img-responsive" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/wechat/huodong/product.jpg"/>
                    </div>
                    <div class="col-lg-8" style="text-align: left;">
                        <p style="font-size: 20px;"><small>用户名：</small>bfyang5130</p>
                        <p style="font-size:18px;"><small>可用资金：</small><font style="color:red;">50000</font></p>
                        <p style="font-size:18px;"><small>会员级别：</small><font style="color:red;">初级会员</font></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;">
        <div class="panel panel-default" style="margin-bottom: 0px;">
            <div class="panel-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">所属银行</label>
                        <input type="email" class="form-control text-center" id="exampleInputEmail1" placeholder="请输入开户银行">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">真实姓名</label>
                        <input type="password" class="form-control text-center" id="exampleInputPassword1" placeholder="请输入开户银行的真实姓名">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">银行卡号</label>
                        <input type="password" class="form-control text-center" id="exampleInputPassword1" placeholder="请输入银行的卡号">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">银行所在地</label>
                        <input type="password" class="form-control text-center" id="exampleInputPassword1" placeholder="选择银行所在地">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">支行名称</label>
                        <input type="password" class="form-control text-center" id="exampleInputPassword1" placeholder="请输入支行名称">
                    </div>
                    <button type="submit" class="btn btn-block btn-danger">更改</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;height: 10px;">
    </div>
    <?php $this->renderPartial('//wechat/common/fonterend') ?>
</div>