<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ProjectForm extends CFormModel {

    public $title;
    public $type;
    public $collection_type;
    public $intime;
    public $account;
    public $low_account;
    public $content;
    public $account_one;
    public $account_lixi;
    public $area_limit;
    public $choutimes;
    public $iplimit;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('title,type,low_account', 'required', 'message' => '必填项不能为空'),
            array('account', 'required', 'on' => 'gongyi,art,bankcard', 'message' => '筹资总额不能为空'),
            array('title', 'length', 'min' => 6, 'max' => 30, 'message' => '项目标题应在6到30字符之间'),
            array('account', 'length', 'min' => 4, 'max' => 7, 'message' => '筹款金额应在1000元至500万之间'),
            array('low_account', 'numerical', 'integerOnly' => true, 'message' => '金额必须为整数'),
            array('collection_type', 'in', 'range' => array("0", "1"), 'message' => '筹资方式错误'),
            array('intime', 'in', 'range' => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15,30,60,90,120,150,180,210,240,270,300,330,360), 'message' => '筹资时间有误'),
            array('account_one', 'checkAccountOne', 'on' => 'taobao'),
            array('account_lixi', 'checkAccounLixi', 'on' => 'taobao'),
            array('choutimes', 'checkChoutimes', 'on' => 'taobao'),
            array('area_limit', 'in', 'range' => array(1, 2, 3), 'on' => 'taobao', 'message' => '地区限制不正确'),
            array('iplimit', 'checkIplimit', 'on' => 'taobao'),
        );
    }

    /**
     * 单个区域人数的限制
     */
    public function checkIplimit() {
        if (!is_numeric($this->iplimit)) {
            $this->addError("iplimit", "区域限制最少为1人");
            return false;
        }
        if ($this->iplimit < 1) {
            $this->addError("iplimit", "区域限制最少为1人");
            return false;
        }
    }

    /**
     * 筹资次数
     */
    public function checkChoutimes() {
        if (!is_numeric($this->choutimes)) {

            $this->addError("choutimes", "筹资次数最少为1次");
            return false;
        }
        if ($this->choutimes < 1) {
            $this->addError("choutimes", "筹资次数最少为1次");
            return false;
        }
    }

    /**
     * 收益预计
     */
    public function checkAccounLixi() {
        if (!is_numeric($this->account_lixi)) {
            $this->addError("account_lixi", "利息填写不正确");
            return false;
        }
        if ($this->account_lixi < 5 || $this->account_lixi > 5000000) {
            $this->addError("account_lixi", "利息应该在5元至500万元之间");
            return false;
        }
    }

    /**
     * 单个资金的验证
     */
    public function checkAccountOne() {
        if (!is_numeric($this->account_one)) {
            $this->addError("account_one", "单笔筹资金额不正确");
            return false;
        }
        if ($this->account_one < 50 || $this->account_one > 5000000) {
            $this->addError("account_one", "单笔筹资金额应该在50元至500万元之间");
            return false;
        }
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'title' => '项目标题',
            'type' => '项目类型',
            'collection_type' => '筹资方式',
            'intime' => '筹资时间',
            'account' => '筹资金额',
            'low_account' => '最低筹资',
            'content' => '详细描述',
        );
    }

    /**
     * 保存项目
     */
    public function save($data = array()) {

        $oneProject = new Project();
        $data['user_id'] = Yii::app()->user->getId();

        $oneProject->setAttributes($data);
        $oneProject->save();
    }

    /**
     * 淘宝项目的发布
     */
    public function taobaoSave($data = array()) {
        $addip = Yii::app()->request->userHostAddress;
        $user_id = Yii::app()->user->getId();
        try {
            $conn = Yii::app()->db;
            $command = $conn->createCommand('call p_taobaoSave(:user_id,:title,:account_one,:choutimes,:account_lixi,:area_limit,:iplimit,:intime,:content,:type,:low_account,:litt_pic,:in_addip,@out_status,@out_remark)');
            $command->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $command->bindParam(":title", $data['title'], PDO::PARAM_STR);
            $command->bindParam(":account_one", $data['account_one'], PDO::PARAM_STR);
            $command->bindParam(":choutimes", $data['choutimes'], PDO::PARAM_INT);
            $command->bindParam(":account_lixi", $data['account_lixi'], PDO::PARAM_STR);
            $command->bindParam(":area_limit", $data['area_limit'], PDO::PARAM_INT);
            $command->bindParam(":iplimit", $data['iplimit'], PDO::PARAM_INT);
            $command->bindParam(":intime", $data['intime'], PDO::PARAM_INT);
            $command->bindParam(":content", $data['content'], PDO::PARAM_STR);
            $command->bindParam(":type", $data['type'], PDO::PARAM_INT);
            $command->bindParam(":low_account", $data['low_account'], PDO::PARAM_INT);
            $command->bindParam(":litt_pic", $data['litt_pic'], PDO::PARAM_STR);
            $command->bindParam(":in_addip", $addip, PDO::PARAM_STR, 50);
            $command->execute();
            $result = $conn->createCommand("select @out_status as status,@out_remark as remark")->queryRow(true);
            if ($result['status'] == 1) {
                return true;
            } else {
                $this->addError("title", $result['remark']);
                return false;
            }
        } catch (Exception $e) {
            $this->addError("title", "系统繁忙，无法发布项目！");
            return false;
        }
    }

}
