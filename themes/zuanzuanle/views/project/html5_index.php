<?php $this->renderPartial('//common/html5_top_secondnav') ?>
<div class="warp qys_color_F8F8F8">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-sm-12 col-md-12">
                <?php
                $lanmustring = "浏览全部";
                if (isset($_REQUEST['list_id'])) {
                    $typeone = Channel::model()->findByPk($_REQUEST['list_id']);
                    if ($typeone) {
                        $lanmustring = $typeone->cl_name;
                    }
                }
                ?>
                <h3><strong><?php echo $lanmustring; ?></strong></h3>
                <div class="row">
                    <?php
                    //#获得最新的4个项目
                    if (isset($_REQUEST['list_id'])) {
                        if ($typeone) {
                            switch ($typeone->cl_en_name) {
                                case 'help':$list_type_id = 1;
                                    break;
                                case 'personart':$list_type_id = 2;
                                    break;
                                case 'taobao':$list_type_id = 3;
                                    break;
                                case 'bankcard':$list_type_id = 4;
                                    break;
                                default :$list_type_id = 1;
                            }
                        }
                        $conditionstraing = "t.status!=0 AND t.type=:type_id";
                        $params = array(":type_id" => $list_type_id);
                    } else {
                        $conditionstraing = "t.status!=0";
                        $params = array();
                    }
                    $newslists = Project::model()->findAll(array(
                        'select' => "t.id,t.title,t.account,t.account_yes,t.status,t.intime,t.addtime,t.litt_pic",
                        'condition' => $conditionstraing,
                        'order' => 't.id DESC',
                        'params' => $params,
                        'limit' => 20,
                    ));
                    if ($newslists) {
                        foreach ($newslists as $value) {
                            $com_per = ceil($value->account_yes / $value->account * 100) / 100;
                            $startdate = strtotime(date("Y-m-d", time()));
                            $enddate = strtotime(date('Y-m-d', $value->addtime + $value->intime * 86400));
                            $days = round(($enddate - $startdate) / 3600 / 24);
                            ?>
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <div class="col-xs-12 col-sm-12 col-md-12 qys_index_pad">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="row">
                                                <img class="img-responsive img-rounded" src="<?php echo $value->litt_pic; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row qys_index_pad_t">
                                        <h5 class="qys_project_tittle"><strong><a href="<?php echo Yii::app()->createUrl("/project/details/id/" . $value->id); ?>"><?php echo $value->title; ?></a></strong></h5>
                                    </div>
                                    <div class="row qys_index_pad_t">
                                        <span class="pull-left"><span class="qys_little_tittle">目标：</span><span class="qys_little_number"><strong><?php echo $value->intime; ?></strong></span><small class="qys_little_style"> 天 </small><span class="qys_little_number"><strong><?php echo $value->account; ?></strong></span><small class="qys_little_style"> 元 </small></span><span class="pull-right label label-info">众筹中</span>
                                    </div>
                                    <div class="row">
                                        <div class="progress qys_index_progress">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" 
                                                 aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $com_per; ?>%;">
                                                <span class="sr-only"><?php echo $com_per; ?>% 完成</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row qys_index_pad_t">
                                        <ul class="list-inline">
                                            <li><span class="qys_little_tittle">完成筹资</span><br/><span class="qys_little_number"><strong><?php echo $value->account_yes; ?></strong></span></li>
                                            <li><span class="qys_little_tittle">还需筹资</span><br/><strong><?php echo $value->account - $value->account_yes; ?></strong></li>
                                            <li><span class="qys_little_tittle">剩余时间</span><br/><span class="qys_little_number"><strong><?php echo $days; ?></strong></span><small class="qys_little_style"> 天 </small></li>
                                        </ul>
                                        </ul>
                                    </div>
                                </div>
                            </div>
        <?php
    }
}
?>
                </div>
            </div>
        </div>
    </div>
</div>