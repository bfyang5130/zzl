<?php

class PicController extends Controller {

    public $layout = '//layouts/picshow';

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
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * Displays the contact page
     */
    public function actionIndex() {
        $this->pageTitle = Yii::app()->name;
        $this->render('html5_index');
    }

    /**
     * 显示中奖用户的奖励数据
     */
    public function actionWechatfree() {
        $this->render('wechatfree');
    }

}
