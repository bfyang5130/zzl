<?php $this->renderPartial('//common/html5_top_secondnav') ?>
<div class="warp qys_color_gr">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-sm-12 col-md-12">
                <div id="myCarousel" class="carousel slide">
                    <!-- 轮播（Carousel）指标 -->  
                    <!-- 轮播（Carousel）项目 -->
                    <div class="carousel-inner">
                        <?php
                        for ($i = 1; $i <= 3; $i++) {
                            $class = 'class="item"';
                            if ($i == 1) {
                                $class = 'class="item active"';
                            }
                            ?>
                            <div <?php echo $class; ?>>
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bannar/b<?php echo $i; ?>.png" alt="<?php echo $i; ?>">
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- 轮播（Carousel）导航 -->
                    <a class="carousel-control left" style="background-image: none;" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                    <a class="carousel-control right" style="background-image: none;" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="warp qys_color_F3F3F3">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-sm-12 col-md-12">
                <h3><strong>最新项目</strong></h3>
                <div class="row">
                    <?php
                    //#获得最新的4个项目
                    $newslists = Project::model()->findAll(array(
                        'select' => "t.id,t.title,t.account,t.account_yes,t.status,t.intime,t.addtime,t.litt_pic",
                        'condition' => 't.status!=0',
                        'order' => 't.id DESC',
                        'limit' => 4,
                    ));
                    if ($newslists) {
                        $i = 1;
                        foreach ($newslists as $value) {
                            $show = "";
                            if ($i == 4) {
                                $show = "hidden-sm";
                            }
                            $com_per = ceil($value->account_yes / $value->account * 100);
                            $startdate = strtotime(date("Y-m-d", time()));
                            $enddate = strtotime(date('Y-m-d', $value->addtime + $value->intime * 86400));
                            $days = round(($enddate - $startdate) / 3600 / 24);
                            ?>
                            <div class="col-xs-12 col-sm-4 col-md-3<?php echo " " . $show; ?>">
                                <div class="col-xs-12 col-sm-12 col-md-12 qys_index_pad">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="row">
                                                <img class="img-responsive img-rounded" src="<?php echo $value->litt_pic; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row qys_index_pad_t">
                                        <h5 class="qys_project_tittle"><strong><a href="<?php echo Yii::app()->createUrl("/project/details/id/".$value->id); ?>"><?php echo $value->title; ?></a></strong></h5>
                                    </div>
                                    <div class="row qys_index_pad_t">
                                        <span class="pull-left"><span class="qys_little_tittle">目标：</span><span class="qys_little_number"><strong><?php echo $value->intime; ?></strong></span><small class="qys_little_style"> 天 </small><span class="qys_little_number"><strong><?php echo intval($value->account); ?></strong></span><small class="qys_little_style"> 元 </small></span><span class="pull-right label label-info">众筹中</span>
                                    </div>
                                    <div class="row">
                                        <div class="progress qys_index_progress">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" 
                                                 aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $com_per; ?>%;">
                                                <span class="sr-only"><?php echo $com_per; ?>% 完成</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div row qys_index_pad_t>
                                        <ul class="list-inline">
                                            <li><span class="qys_little_tittle">完成筹资</span><br/><span class="qys_little_number"><?php echo intval($value->account_yes); ?></span></li>
                                            <li><span class="qys_little_tittle">还需筹资</span><br/><?php echo intval($value->account - $value->account_yes); ?></li>
                                            <li><span class="qys_little_tittle">剩余时间</span><br/><span class="qys_little_number"><?php echo $days; ?></span><small class="qys_little_style"> 天 </small></li>
                                            <li><span class="qys_little_tittle">进度</span><br/><span class="qys_little_number"><?php echo $com_per; ?></span><small class="qys_little_style"> % </small></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="warp qys_color_F8F8F8">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-sm-12 col-md-12">
                <h3><strong>热门项目</strong></h3>
                <div class="row">
                    <?php
                    //#获得最新的4个项目
                    $newslists = Project::model()->findAll(array(
                        'select' => "t.id,t.title,t.account,t.account_yes,t.status,t.intime,t.addtime,t.litt_pic",
                        'condition' => 't.status!=0',
                        'order' => 't.choutimes DESC,t.id DESC',
                        'limit' => 12,
                    ));
                    if ($newslists) {
                        foreach ($newslists as $value) {
                            $com_per = ceil($value->account_yes / $value->account * 100);
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
                                        <h5 class="qys_project_tittle"><strong><a href="<?php echo Yii::app()->createUrl("/project/details/id/".$value->id); ?>"><?php echo $value->title; ?></a></strong></h5>
                                    </div>
                                    <div class="row qys_index_pad_t">
                                        <span class="pull-left"><span class="qys_little_tittle">目标：</span><span class="qys_little_number"><strong><?php echo $value->intime; ?></strong></span><small class="qys_little_style"> 天 </small><span class="qys_little_number"><strong><?php echo intval($value->account); ?></strong></span><small class="qys_little_style"> 元 </small></span><span class="pull-right label label-info">众筹中</span>
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
                                            <li><span class="qys_little_tittle">完成筹资</span><br/><span class="qys_little_number"><?php echo intval($value->account_yes); ?></span></li>
                                            <li><span class="qys_little_tittle">还需筹资</span><br/><?php echo intval($value->account - $value->account_yes); ?></li>
                                            <li><span class="qys_little_tittle">剩余时间</span><br/><span class="qys_little_number"><?php echo $days; ?></span><small class="qys_little_style"> 天 </small></li>
                                        <li><span class="qys_little_tittle">进度</span><br/><span class="qys_little_number"><?php echo $com_per; ?></span><small class="qys_little_style"> % </small></li>
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
        <div class="row text-center">
            <a class="btn btn-lg btn-danger"><strong>查看更多项目</strong></a>
        </div>
    </div>
</div>