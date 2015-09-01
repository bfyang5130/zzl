<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AbsWechatController extends Controller {
    /**
     * @var string the default layout for the controller view. Defaults to 'column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    //public $layout = 'column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    /**
     * 上传图片
     */
    protected function Uploadpic($picdir = "") {
        $res['error'] = "";
        if (is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
            $info = explode('.', strrev($_FILES['fileToUpload']['name']));
            //配置要上传目录地址
            $datadir = date("Y-m-d");
            $picdir = $picdir . "/" . $datadir;
            $picname = "user_" . intval($_REQUEST['project_id']) . "_" . time() . "." . strrev($info[0]);
            $fullname = $picdir . "/" . $picname;
            if (BaseTool::createABFolder($picdir)) {
                if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $fullname)) {
                    $res["msg"] = "success";
                    $res["dir"] = $datadir . "/" . $picname;
                } else {
                    $res["error"] = "上传失败";
                }
            } else {
                $res['error'] = "上传失败";
            }
        } else {
            $res['error'] = '上传的文件不存在';
        }
        return $res;
    }

    /**
     * 跳转到对应的页面
     */
    protected static function toUrl($data = array()) {
        Yii::app()->user->setFlash($data[0], $data[1]);
        Yii::app()->user->setFlash($data[2], $data[3]);
        Yii::app()->request->redirect($data[4]);
    }

    public function beforeAction($action) {
        if (Yii::app()->user->isGuest) {
            $this->redirect('/wechat/help/nologin');
        }
        return parent::beforeAction($action);
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
