<?php $this->renderPartial('//layouts/html5_common_footer') ?>
<?php
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap.min.js');
?>
</body>
</html>