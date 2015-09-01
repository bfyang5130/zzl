<nav class="navbar navbar-fixed-bottom" role="navigation">
    <?php $this->renderPartial('//layouts/html5_common_footer') ?>
</nav>
<?php
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap.min.js');
?>
</body>
</html>