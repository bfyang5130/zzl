<?php

class UserController extends Controller {

    public $layout = '//layouts/user_html5';
    public $defaultAction = "login";

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CaptchaAction',
                'backColor' => 0xFFFFFF,
                'maxLength' => '6', // 最多生成几个字符
                'minLength' => '6', // 最少生成几个字符
                'height' => '40'
            ),
        );
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionLogin() {
        if (!Yii::app()->user->isGuest) {
            $this->redirect('/member/index.html');
        }
        $this->pageTitle = "登录中心 - " . Yii::app()->name;
        if (isset($_POST['username'])) {
            $status = array();
            if (!isset($_POST['username']) || !isset($_POST['password'])) {
                $status = array(
                    'status' => 0,
                    "info" => '用户名或者密码错误!');
            } else {
                Yii::import("application.models.form.LoginForm", true);
                $loginform = new LoginForm();
                if (!isset($_POST['rememberMe'])) {
                    $_POST['rememberMe'] = false;
                }
                $loginform->setAttributes(array(
                    'username' => $_POST['username'],
                    'password' => $_POST['password'],
                    'rememberMe' => $_POST['rememberMe'],
                ));
                if ($loginform->validate() && $loginform->login()) {
                    $status = array(
                        'status' => 1,
                        "info" => '登录');
                } else {
                    $status = array(
                        'status' => 0,
                        "info" => '用户名或者密码错误!');
                }
            }

            echo json_encode($status);
            Yii::app()->end();
        }
        $this->render('html5_login');
    }

    /**
     * 会员退出
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->createUrl('/user/login'));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionRegister() {
        if (!Yii::app()->user->isGuest) {
            $this->redirect('/member/index.html');
        }
        $this->pageTitle = "注册用户 - " . Yii::app()->name;
        if (isset($_POST['username'])) {
            $status = array();
            if (!isset($_POST['username']) || !isset($_POST['password'])) {
                $status = array(
                    'status' => 0,
                    "info" => '用户名或者密码错误!');
            } else {
                Yii::import("application.models.form.RegeditForm", true);
                $loginform = new RegeditForm();
                $loginform->setAttributes($_POST);
                if ($loginform->validate() && $loginform->save()) {
                    $status = array(
                        'status' => 1,
                        "info" => '已经给你发送了激活邮件，如没有收到，可在会员中心重新发送。');
                } else {
                    $error = $loginform->errors;
                    $status = array(
                        'status' => 0,
                        "info" => current(current($error)));
                }
            }

            echo json_encode($status);
            Yii::app()->end();
        }
        $this->render('html5_regedit');
    }

    /**
     * 激活邮件
     */
    public function actionActiveMail() {
        if (isset($_REQUEST['token'])) {
            $oneUser = Users::model()->findByAttributes(array("regtaken" => $_REQUEST['token']));
            if ($oneUser) {
                $now = time();
                if ($now < $oneUser->regativetime) {
                    //查询是否已经被激活了。
                    $activuser = Users::model()->find("email=:email AND email_status=1", array(":email" => $oneUser->email));
                    if (!$activuser) {
                        $oneUser->updateByPk($oneUser->user_id, array("email_status" => 1));
                        Yii::app()->user->setFlash('success', "恭喜，邮件激活成功！");
                        Yii::app()->user->setFlash('reurl', Yii::app()->createAbsoluteUrl("/member/index"));
                        $this->redirect("/notice/success.html");
                    } else {
                        //邮箱已经被激活，不能再激活
                        Yii::app()->user->setFlash('fail', "邮箱已经被激活，不能再激活。");
                        Yii::app()->user->setFlash('reurl', Yii::app()->createAbsoluteUrl("/member/index"));
                        $this->redirect("/notice/errors.html");
                    }
                } else {
                    //激活超时
                    Yii::app()->user->setFlash('fail', "激活时间失效，请重新发送激活邮件！");
                    Yii::app()->user->setFlash('reurl', Yii::app()->createAbsoluteUrl("/user/sendActiveMail"));
                    $this->redirect("/notice/errors.html");
                }
            } else {
                //显示错误的信息
                Yii::app()->user->setFlash('fail', "错误的操作！");
                Yii::app()->user->setFlash('reurl', Yii::app()->createAbsoluteUrl("/user/login"));
                $this->redirect("/notice/errors.html");
            }
        } else {
            Yii::app()->user->setFlash('fail', "错误的操作！");
            Yii::app()->user->setFlash('reurl', Yii::app()->createAbsoluteUrl("/user/login"));
            $this->redirect("/notice/errors.html");
        }
        Yii::app()->end();
    }

    /**
     * @return array 过滤器列表，会顺序执行
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // ?代表来宾用户
                'actions' => array('login', 'logout', 'register', 'activeMail', 'captcha'),
                'users' => array('*'),
            ),
            array('allow', // @代表有角色的
                'actions' => array('index', 'publish', 'project'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // *代表所有的用户
                'users' => array('*'),
            ),
        );
    }

}
