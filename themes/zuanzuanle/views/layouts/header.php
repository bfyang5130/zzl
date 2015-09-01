<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="keywords" content="众筹 助人 项目 投资 支持"/>
        <meta name="description" content="在赚赚乐发布需求，获得帮助，让社会聚焦于您"/>
        <link rel="bookmark" type="image/x-icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.png?v=1">
        <link rel="shortcut icon" type="image/png" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.png?v=1">
        <link rel="icon" type="image/png" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.png?v=1">
        <!--public js&css start-->                                           
        <!--public js&css end -->    
        <script type="text/javascript">
            var APP_ROOT = '';
            //var LOADER_IMG = 'http://zcstatic.wangxingroup.com/zhongchou/images/lazy_loading.gif?v=1';
            //var ERROR_IMG = 'http://zcstatic.wangxingroup.com/zhongchou/images/image_err.gif?v=1';
            var LOADER_IMG = '';
            var ERROR_IMG = '';
            var lst = {'t0': new Date().getTime()};
            var domain = document.domain;</script>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/global.css"/>
        <?php
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/static/lib/sea.js');
        ?>
        <script type="text/javascript">
            seajs.config({
                alias: {
                    "jquery": "jquery-1.10.2.js"
                }
            });
        </script>
    </head>

    <body>
        <!--header static-->
        <div class="header">
            <div class="wrap clearfix" pbid="header">
                <div class="img-logo">
                    <h1>
                        <a alt="赚赚乐" class="ie6fixpic" title="赚赚乐" href="/index">赚赚乐</a>
                    </h1>
                </div>
                <!--menu start-->
                <div class="menu">
                    <ul class="clearfix">
                        <?php
                        #获得主菜单
                        $main_menu = Menu::model()->find("menu_ename='main_menu'");
                        $main_menu_id = 1;
                        if ($main_menu) {
                            $main_menu_id = $main_menu->menu_id;
                        }
                        $mainmenulist = Channel::model()->findAll("cl_menu_id=:menu_id AND cl_status=1 order by cl_left asc", array(":menu_id" => $main_menu_id));
                        if ($mainmenulist) {
                            foreach ($mainmenulist as $key => $value) {
                                ?>
                                <li 
                                <?php
                                if ($key == 0) {
                                    echo 'class="select"';
                                }
                                ?>>
                                        <?php
                                        if ($value->cl_exturl) {
                                            ?>
                                        <a target="_blank" href="<?php echo $value->cl_exturl; ?>"><?php echo CHtml::encode($value->cl_name); ?> </a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="<?php echo Yii::app()->createUrl("/" . $value->cl_en_name); ?>"><?php echo CHtml::encode($value->cl_name); ?> </a>
                                        <?php
                                    }
                                    ?>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <!--menu end-->

                <!--login start-->
                <div class="login-wrap">
                    <?php $this->renderPartial('//common/login') ?>
                </div>
                <!--login end-->

            </div>
            <div class="subnav">
                <div class="nav clearfix">
                    <ul>
                        <li class="select"><a title="浏览全部"  href="<?php echo Yii::app()->createUrl("/project/index"); ?>">浏览全部</a></li>
                            <?php
                            #获得项目下的分类项目
                            $project = Channel::model()->find("cl_en_name=:cl_en_name", array(":cl_en_name" => 'project'));
                            if ($project) {
                                $projectlist = Channel::model()->findAll("cl_class=:cl_class AND cl_status=1 order by cl_left asc ",array(":cl_class"=>$project->id));
                                if ($projectlist) {
                                    foreach ($projectlist as $key => $value) {
                                        echo '<li ><a href="' . Yii::app()->createUrl('/project/' . $value->id) . '" title="' . Chtml::encode($value->cl_name) . '">' . Chtml::encode($value->cl_name) . '</a></li>';
                                    }
                                }
                            }
                            ?>
                        <li><em>|</em><a href="http://www.10000rmb.com">中国网赚平台</a></li>
                    </ul>

                </div>
            </div>
        </div>
        <!--header-end-->