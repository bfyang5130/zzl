<?php

class NoticeController extends Controller {

    public $layout = '//layouts/user_html5';

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
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        $wechatPos = strpos(Yii::app()->request->urlReferrer, '.com/wechat/');
        $error = Yii::app()->errorHandler->error;
        if ($wechatPos < 0) {
            if ($error) {
                if (Yii::app()->request->isAjaxRequest)
                    echo $error['message'];
                else
                    $this->render('error', $error);
            }
        }else {
            #msg类型：type=1错误信息2指示跳转3返回跳转
            $notices=array('type'=>1,'msgtitle'=>'错误信息','message'=>$error['message']);
            Yii::app()->user->setFlash('wechat_fail',$notices);
            $this->redirect(Yii::app()->createUrl('wechat/notice/errors'));
        }
    }

    /**
     * 操作成功显示的页面
     */
    public function actionSuccess() {
        $this->render('success');
    }

    /**
     * 操作失败显示的页面
     */
    public function actionErrors() {
        print_r(Yii::app()->errorHandler->error);
        exit;
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('errors', $error);
        }
    }

}
