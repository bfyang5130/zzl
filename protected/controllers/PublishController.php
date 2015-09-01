<?php

class PublishController extends Controller {

    public $layout = '//layouts/member_html5';

    /**
     * 直接跳转到会员中心直接发布
     */
    public function actionIndex() {
        $this->render("index");
    }

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

}
