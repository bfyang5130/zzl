<?php

class ProjectController extends Controller {

    public $layout = '//layouts/html5_main';

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
     * Displays the contact page
     */
    public function actionLists() {
        $this->pageTitle = Yii::app()->name;
        $this->render('html5_index');
    }

    /**
     * 详细页面
     */
    public function actionDetails() {
        $this->pageTitle = Yii::app()->name;
        if (isset($_POST['chou_submit']) && isset($_POST['project_id'])) {
            if (Yii::app()->user->isGuest) {
                $this->redirect(Yii::app()->createUrl("/user/login"));
                Yii::app()->end();
            }
            //获得项目的信息
            $thisProject = Project::model()->findByPk($_POST['project_id']);
            if ($thisProject->status != 1) {
                Yii::app()->user->setFlash('fail', "项目不允许赞助                             ！");
                Yii::app()->user->setFlash('reurl', Yii::app()->request->urlReferrer);
                $this->redirect("/notice/errors.html");
            }
            if ($thisProject->type == 3) {
                //淘宝项目的赞助
                $user_id = Yii::app()->user->getId();
                $money = 0;
                $addip = Yii::app()->request->userHostAddress;
            } else {
                $moneerror = FALSE;
                if (!isset($_POST['input_cou_money']) || !isset($_POST['chou_money'])) {
                    $moneerror = TRUE;
                }
                if (empty($_POST['input_cou_money'])) {
                    $money = $_POST['chou_money'];
                } else {
                    $money = $_POST['input_cou_money'];
                }
                if (!is_numeric($money) || !is_int($money + 0) || $money <= 0) {
                    $moneerror = TRUE;
                }
                #资金错误
                if ($moneerror) {
                    //跳转到错误的页面
                    Yii::app()->user->setFlash('fail', "错误的金额，请不要乱操作！");
                    Yii::app()->user->setFlash('reurl', Yii::app()->request->urlReferrer);
                    $this->redirect("/notice/errors.html");
                }
                $user_id = Yii::app()->user->getId();
                $money = floatval($money);
                $addip = Yii::app()->request->userHostAddress;
            }
            //直接调用存储过程
            try {
                $conn = Yii::app()->db;
                if ($thisProject->type == 3) {
                    $buy_status=0;
                    if(isset($_POST['buy'])){
                        $buy_status=1;
                    }
                    $command = $conn->createCommand('call p_TaoBaoTender(:in_project_id,:in_user_id,:in_money,'.$buy_status.',:in_addip,@out_status,@out_remark)');
                } else {
                    $command = $conn->createCommand('call p_tender(:in_project_id,:in_user_id,:in_money,:in_addip,@out_status,@out_remark)');
                }
                $command->bindParam(":in_project_id", $_POST['project_id'], PDO::PARAM_INT);
                $command->bindParam(":in_user_id", $user_id, PDO::PARAM_INT);
                $command->bindParam(":in_money", $money, PDO::PARAM_STR);
                $command->bindParam(":in_addip", $addip, PDO::PARAM_STR, 50);
                $command->execute();
                $result = $conn->createCommand("select @out_status as status,@out_remark as remark")->queryRow(true);
                if ($result['status'] == 1) {
                    Yii::app()->user->setFlash('success', $result['remark']);
                    Yii::app()->user->setFlash('reurl', Yii::app()->request->urlReferrer);
                    $this->redirect("/notice/success.html");
                } else {
                    //跳转到错误的页面
                    Yii::app()->user->setFlash('fail', $result['remark']);
                    Yii::app()->user->setFlash('reurl', Yii::app()->request->urlReferrer);
                    $this->redirect("/notice/errors.html");
                }
            } catch (Exception $e) {
                //跳转到错误的页面 
                Yii::app()->user->setFlash('fail', "系统繁忙，无法进行赞助！");
                Yii::app()->user->setFlash('reurl', Yii::app()->request->urlReferrer);
                $this->redirect("/notice/errors.html");
            }
            //直接调用存储过程进行筹资
        }
        $this->render('details');
    }

    /**
     * 详细页面
     */
    public function actionTenders() {
        $this->renderPartial("tenderlists", $_REQUEST);
        Yii::app()->end();
    }

}
