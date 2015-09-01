<?php

class PublicController extends AbsWechatController {

    public $layout = '//layouts/wechat';

    public function actionIndex() {
        $this->render('index');
    }

    /**
     * 生成免费券功能
     */
    public function actionFreeCoupon() {
        $this->layout="//layouts/wechat_common";
        $this->pageTitle = '免费券';
        $this->render('freecoupon');
    }

}
