<?php

class MemberController extends AbsWechatController {

    public $layout = '//layouts/wechat_common';

    public function actionIndex() {
        $this->pageTitle = "会员中心";
        $this->render('member_index');
    }

    /**
     * 用户基本信息
     */
    public function actionUserinfo() {

        $thisuser = Users::model()->findByPk(Yii::app()->user->getId());
        if (isset($_POST['Users'])) {
            $thisuser->setAttributes($_POST['Users']);
            foreach ((array) $_POST['Users'] as $key => $value) {
                if (trim($value) == '') {
                    $thisuser->addError($key, "字段不能为空");
                    break;
                }
            }
            if (!$thisuser->getErrors()) {

                if ($thisuser->validate()) {
                    $thisuser->setAttribute("real_status", 1);
                    if (!$thisuser->update()) {
                        $thisuser->addError("realname", "更新失败");
                    }
                } else {

                    $thisuser->addError("realname", "更新失败");
                }
            }
        }
        $this->pageTitle = "基本资料";
        $this->render('member_userinfo', array("thisuser" => $thisuser));
    }

    /**
     * 用户银行卡信息
     */
    public function actionBankCard() {
        $user_id = Yii::app()->user->getId();
        $bankCard = Bankcard::model()->find("user_id=:user_id", array(":user_id" => $user_id));
        if (!$bankCard) {
            $bankCard = new Bankcard();
        }
        if (isset($_POST['Bankcard'])) {
            $bankCard = MemberService::saveBankCard($bankCard, $user_id);
        }
        $this->pageTitle = "银行卡";
        $this->render('member_bankcard', array("bankCard" => $bankCard));
    }

    /**
     * 用户收货地址
     */
    public function actionProAddress() {
        $user_id = Yii::app()->user->getId();
        $userprodaddress = UserProudctAddress::model()->find("user_id=:user_id", array(":user_id" => $user_id));
        if (!$userprodaddress) {
            $userprodaddress = new UserProudctAddress();
        }
        if (isset($_POST['UserProudctAddress'])) {
            $userprodaddress = MemberService::saveProAddress($userprodaddress, $user_id);
        }
        $this->pageTitle = "收货地址";
        $this->render('member_proaddress', array("userprodaddress" => $userprodaddress));
    }

    /**
     * 物流进度
     */
    public function actionProProess() {
        $this->pageTitle = "物流进度";
        $this->render('member_proproess');
    }

    /**
     * 用户已购商品
     */
    public function actionMyProduct() {
        $this->pageTitle = "已购商品";
        $this->render('member_myproduct');
    }

    /**
     * 系统信息
     */
    public function actionMessage() {
        $this->pageTitle = "系统信息";
        $this->render('member_accountlog');
    }

    /**
     *  资金信息
     */
    public function actionAccountlog() {
        $this->pageTitle = "资金明细";
        $this->render('member_accountlog');
    }

    /**
     * 分享与收益
     */
    public function actionSharp() {
        $this->pageTitle = "分享与收益";
        $this->render('member_sharp');
    }

}
