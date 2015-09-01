<?php

class TenderController extends AbscontentController {

    public $layout = '//layouts/member_common';
    public $defaultaction = "tendering";

    /**
     * 赞助中的项目
     */
    public function actionTendering() {
        $this->pageTitle = Yii::app()->name;
        $this->render('tendering');
    }

    /**
     * 成功的赞助
     */
    public function actionTsuccess() {
        $this->pageTitle = Yii::app()->name;
        $this->render('tsuccess');
    }

    /**
     * 失败的赞助
     */
    public function actionTfail() {
        $this->pageTitle = Yii::app()->name;
        $this->render('tfail');
    }

    /**
     * 失败的赞助
     */
    public function actionFitTenderTradeno() {
        if (!isset($_POST['tender_id']) || !isset($_POST['trade_no'])) {
            $status = array(
                'status' => 0,
                "info" => '用户名或者密码错误!');
            echo json_encode($status);
            Yii::app()->end();
        }
        #更改赞助信息的状态
        $result = Tender::model()->updateByPk($_POST['tender_id'], array("trade_no" => $_POST['trade_no']), "user_id=:user_id AND status=0", array(":user_id" => Yii::app()->user->getId()));
        if ($result) {
            $status = array(
                'status' => 1,
                "info" => '提交成功');
        } else {
            $status = array(
                'status' => 0,
                "info" => '提交失败');
        }
        echo json_encode($status);
        Yii::app()->end();
    }

}
