<?php
$user_id = Yii::app()->user->getId();
$user = Users::model()->findByPk($user_id);
$useraccount = Account::model()->find("user_id=:user_id", array(":user_id" => $user_id));
?>
<div class="col-lg-12" style="padding:10px 25px 0px 25px;">
    <div class="panel panel-default" style="margin-bottom: 0px;">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-4">
                    <img style="width:100px;height:100px;" class="img-rounded img-responsive" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/wechat/huodong/product.jpg"/>
                </div>
                <div class="col-lg-8" style="text-align: left;">
                    <p style="font-size: 20px;"><small>用户名：</small><?php echo BaseTool::truncate_utf8_string($user->username, 4) ?></p>
                    <p style="font-size:18px;"><small>可用资金：</small><font style="color:red;"><?php echo $useraccount->use_money ?></font></p>
                    <p style="font-size:18px;"><small>安全级别：</small><font style="color:red;"><?php echo $user->getSafeLevelLabel(); ?></font></p>
                </div>
            </div>
        </div>
    </div>
</div>