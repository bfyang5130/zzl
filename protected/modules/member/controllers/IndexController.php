<?php

class IndexController extends AbscontentController {

    public $layout = '//layouts/member_common';

    /**
     * 资金信息
     */
    public function actionIndex() {
        //生成一个是否已经有资金信息的表缓冲，如果没有，就生成，有就不生成
        $user_id = Yii::app()->user->getId();
        $this->checkUserAccount($user_id);
        $thisuser = Users::model()->findByPk($user_id);

        $this->render('index', array("thisuser" => $thisuser));
    }

    /**
     * 资金记录
     */
    public function actionLog() {
        $thisuser = Users::model()->findByPk(Yii::app()->user->getId());
        $this->render('log', array("thisuser" => $thisuser));
    }

    /**
     * 充值提现
     */
    public function actionMoney() {

        $user_id = Yii::app()->user->getId();
        $thisuser = Users::model()->findByPk($user_id);
        #获得用户的银行卡
        $thisbank = Bankcard::model()->find("user_id=:user_id", array(":user_id" => $user_id));
        if (!$thisbank) {
            $thisbank = new Bankcard();
        }
        if (isset($_POST['Bankcard'])) {
            if (empty($_POST['Bankcard']['bank_name'])) {
                $_POST['Bankcard']['bank_name'] = "工商银行";
            }
            $thisbank->setAttributes($_POST['Bankcard']);
            //赋值真实姓名
            $thisbank->setAttribute("realname", $thisuser->realname);
            if ($thisbank->validate()) {
                if ($thisbank->isNewRecord) {
                    $thisbank->save();
                } else {
                    $thisbank->update();
                }
            }
            $_REQUEST['tab'] = "tab2";
        }

        $this->render('money', array("thisuser" => $thisuser, "thisbank" => $thisbank));
    }

    /**
     * 申请提现
     */
    public function actionGotocash() {
        if (!isset($_POST['Cash']['total'])) {
            $this->redirect(Yii::app()->createUrl("/member/index/cash/tab/tab1"));
            Yii::app()->end();
        }
        $user_id = Yii::app()->user->getId();
        $money = $_POST['Cash']['total'];
        $addip = Yii::app()->request->userHostAddress;
        if (is_numeric($money) && $money >= 100) {
            try{
                //调用存储过程进行处理
                $conn = Yii::app()->db;
                $command = $conn->createCommand('call p_cash(:in_user_id,:in_money,:in_addip,@out_status,@out_remark)');
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
        } else {
            //跳转到错误的页面 
            Yii::app()->user->setFlash('fail', "金额填写不正确，或者提现少于100元！");
            Yii::app()->user->setFlash('reurl', Yii::app()->request->urlReferrer);
            $this->redirect("/notice/errors.html");
        }
    }

    /**
     * 
     * @param type $user_id
     * 检查是否初始化资金帐号
     */
    private function checkUserAccount($user_id) {
        $result = Yii::app()->cache->get("isset_account" . $user_id);
        if (!$result) {
            $oneaccount = Account::model()->find("user_id=:user_id", array(":user_id" => $user_id));
            if (!$oneaccount) {
                $newoneaccount = new Account();
                $newoneaccount->setAttribute("user_id", $user_id);
                $newoneaccount->save();
                Yii::app()->cache->set("isset_account" . $user_id, $newoneaccount);
            }
        }
    }

}
