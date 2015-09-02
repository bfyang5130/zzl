<?php

class HelpController extends Controller {

    public $layout = '//layouts/wechat_common';

    public function actionIndex() {
        $this->pageTitle = '说明';
        $this->render('help_index');
    }

    /**
     * 联系我们控制器
     */
    public function actionContact() {
        $this->pageTitle = '联系我们';
        $this->render('help_contact');
    }

    /**
     * 介绍代理商获得奖励
     */
    public function actionDaili() {
        $this->pageTitle = '代理商奖励';
        $this->render('help_daili');
    }

    /**
     * 没有登录的错误页面
     */
    public function actionNologin() {
        $this->pageTitle = '用户没有登录';
        $this->render('help_nologin');
    }

    /**
     * 没有登录的错误页面
     */
    public function actionLogin() {
        if (!Yii::app()->user->isGuest) {
            $this->redirect('/wechat/public/index.html');
        }


        $this->pageTitle = '自动登录跳转';
        $time = time();
        $time=$time-10;
        if (isset($_GET['id']) && isset($_GET['stoken'])) {
            $user_id = (int) $_GET['id'];
            $stoken = $_GET['stoken'];
                //$user = Users::model()->find(" user_id=:id AND repstaken=:repstaken AND repsativetime>=:time", array(":id"=>$user_id,":repstaken" => $stoken, ":time" => $time));
                $user = Users::model()->find(" user_id=:id", array(":id"=>$user_id));
                
            if ($user) {
                Yii::import("application.models.form.LoginForm", true);
                $loginform = new LoginForm();
                $loginform->setAttributes(array(
                    'username' => $user->username,
                    'password' => $user->privacy,
                    'rememberMe' => FALSE,
                ));
                if ($loginform->validate() && $loginform->login()) {
                    $this->redirect('/wechat/member/index.html');
                }
            }
        }
        $this->redirect('/wechat/help/nologin.html');
    }

}
