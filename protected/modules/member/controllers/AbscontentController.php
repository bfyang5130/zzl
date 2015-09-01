<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AbscontentController extends Controller {

    /**
     * @var string the default layout for the controller view. Defaults to 'column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = 'column1';

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
                'actions' => array('captcha'),
                'users' => array('*'),
            ),
            array('allow', // @代表有角色的
                'actions' => array('index', 'publish', 'editer', 'publishing',
                    'picupload', 'lubopic','ending','fittenders','fittenderstatus','success','manage','fail','tendering','tsuccess','tfail','safe',
                    'updateCities','updateDistricts','credit','uploadify','log','money','gotocash','gongyi','personart','taobao','fitTenderTradeno','lock','toolLogs'
                    ),
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