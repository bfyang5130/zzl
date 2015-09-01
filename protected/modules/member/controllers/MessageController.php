<?php

class MessageController extends AbscontentController {

    public $layout = '//layouts/member_common';
    public $defaultaction = "publish";

    /**
     * 站内信
     */
    public function actionIndex() {
        $this->pageTitle = Yii::app()->name;
        $this->render('message_index');
    }

}
