<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8"/>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="keywords" content="众筹,助人,项目,投资,支持"/>
        <meta name="description" content="在赚赚乐发布需求，获得帮助，让社会聚焦于您"/>
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/bootstrap.min.css'); ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/qys_mobile.css'); ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/sider.css'); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/zepto/zepto.min.js'); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/zepto/widget.1.0.2.js'); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/zepto/sidebar.1.0.1.js'); ?>
        <?php
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/sea.js');
        ?>
    </head>
    <body>
        <?php echo $content; ?>
    </body>
</html>