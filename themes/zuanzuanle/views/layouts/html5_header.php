<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="keywords" content="众筹 助人 项目 投资 支持"/>
        <meta name="description" content="在赚赚乐发布需求，获得帮助，让社会聚焦于您"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link href="favicon.ico" type="image/x-icon" rel=icon>
        <link href="favicon.ico" type="image/x-icon" rel="shortcut icon">
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/bootstrap.min.css'); ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/qys_zuan.css'); ?>
        <!--[if lt IE 9]>
           <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
           <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <?php
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/sea.js');
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
        <?php $this->renderPartial('//common/html5_top_main') ?>
