<?php $this->renderPartial('//common/html5_top_secondnav') ?>
<?php

Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.twbsPagination.min.js');
//获得当前项目信息
$oneProject = Project::model()->findByPk(intval($_GET['id']), "status!=0");
if (!$oneProject) {
    Yii::app()->request->redirect("/project/index.html");
    exit;
}
if ($oneProject->type == 3) {
    $this->renderPartial('//project/taobao', array("oneProject" => $oneProject));
} else {
    $this->renderPartial('//project/detail_common', array("oneProject" => $oneProject));
}