<?php

class NoticeController extends Controller {

    public $layout = '//layouts/wechat_common';
    
    function __construct($id, $module = null) {
        $this->defaultAction='errors';
        parent::__construct($id, $module);
    }

    /**
     * 黑夜错误地址
     */
    public function actionErrors() {
        $this->pageTitle = '错误提示';
        $this->render('notice_errors');
    }

}
