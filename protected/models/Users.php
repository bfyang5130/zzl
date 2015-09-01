<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $user_id
 * @property integer $type_id
 * @property integer $super_type_id
 * @property integer $credit
 * @property string $purview
 * @property string $username
 * @property string $nickname 昵称
 * @property string $password
 * @property string $paypassword
 * @property integer $islock
 * @property integer $real_status
 * @property string $card_type
 * @property string $card_id
 * @property string $card_pic1
 * @property string $card_pic2
 * @property string $nation
 * @property string $realname
 * @property integer $email_status
 * @property string $phone_status
 * @property integer $video_status
 * @property string $email
 * @property string $sex
 * @property string $litpic
 * @property string $tel
 * @property string $phone
 * @property string $qq
 * @property string $wangwang
 * @property string $question
 * @property string $answer
 * @property string $birthday
 * @property string $province
 * @property string $city
 * @property string $area
 * @property string $address
 * @property string $remind
 * @property string $privacy
 * @property string $regtaken
 * @property integer $regativetime
 * @property string $repstaken
 * @property integer $repsativetime
 * @property integer $logintime
 * @property string $addtime
 * @property string $addip
 * @property string $uptime
 * @property string $upip
 * @property string $lasttime
 * @property string $lastip
 */
class Users extends CActiveRecord {

    /**
     * 根据不同的条件验证不同的用户
     */
    public function checkUser($data = array()) {
        if (isset($data['phoneyezheng'])) {
            //手机认证
            //判断手机跟验证码是否正确
            ###########待完成##############
            //验证密码是否正确
            if ($this->validatePassword($data['password'], $this->password)) {
                return array(
                    "phone" => $data['phone'],
                    "phone_status" => 1,
                );
            } else {
                $this->addError("password", "密码不正确！");
            }
        } elseif (isset($data['email'])) {
            //邮箱的认证
            //验证邮箱
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $this->addError("email", "邮箱格式不正确！");
                return $data;
            }
            //登录密码不正确
            if (!$this->validatePassword($data['password'], $this->password)) {
                $this->addError("email", "密码不正确！");
                return $data;
            }
            //验证邮箱重复
            if (Users::model()->count("email=:email AND email_status=1", array(":email" => $data['email'])) > 0) {
                $this->addError("email", "邮箱已经被占用！");
                return $data;
            }
            //发送激活邮件
            //发送邮件
            $activecode = BaseTool::getActiveMailCode($this->username);
            $message = MailTemplet::getActiveEmail($this->username, $activecode);
            $mail = Yii::app()->Smtpmail;
            $mail->SetFrom(Yii::app()->params['adminEmail']);
            $mail->Subject = "好帮贷测试邮件";
            $mail->MsgHTML($message);
            $mail->AddAddress($this->email);

            if ($mail->Send()) {
                $this->updateAll(array("regtaken" => $activecode, "regativetime" => time() + 60 * 60), "username=:username", array(":username" => $this->username));
                Yii::app()->user->setFlash('success', "恭喜，邮件激活成功！，请尽快激活您的邮箱");
                Yii::app()->user->setFlash('reurl', Yii::app()->request->urlReferrer);
                Yii::app()->request->redirect("/notice/success.html");
            } else {
                $this->addError("email", "激活邮箱发送失败，请重试！");
                return $data;
            }
        } elseif (isset($data['oldanswer'])) {
            if (empty($this->answer) && $data['answer'] != $data['oldanswer']) {
                $this->addError("password", "初始设置密保时，新答案应跟旧答案一样！");
                return $data;
            }
            if (!empty($this->answer) && $this->answer != $data['oldanswer']) {
                $this->addError("password", "旧答案错误！");
                return $data;
            }
            return array(
                "answer" => $data['answer'],
                "question" => $data['question'],
            );
        } elseif (isset($data['oldpassword'])) {
            if (!$this->validatePassword($data['oldpassword'], $this->password)) {
                $this->addError("password", "旧密码输入不正确！");
                return $data;
            }
            if ($data['password'] != $data['repassword']) {
                $this->addError("password", "两次密码不一致！");
                return $data;
            }
            if (strlen(trim($data['password'])) < 8) {
                $this->addError("password", "新密码最少要8位！");
                return $data;
            }
            return array(
                "password" => BaseTool::ENPWD($data['password'])
            );
        } elseif (isset($data['oldpaypassword'])) {
            if (empty($this->paypassword) && !$this->validatePassword($data['oldpaypassword'], $this->password)) {
                $this->addError("paypassword", "原始交易密码不正确！");
                return $data;
            }
            if (!empty($this->paypassword) && !$this->validatePassword($data['oldpaypassword'], $this->paypassword)) {
                $this->addError("paypassword", "原始交易密码不正确！");
                return $data;
            }
            if ($data['paypassword'] != $data['repaypassword']) {
                $this->addError("paypassword", "两次密码不一致！");
                return $data;
            }
            if (strlen(trim($data['paypassword'])) < 8) {
                $this->addError("paypassword", "新密码最少要8位！");
                return $data;
            }
            return array(
                "paypassword" => BaseTool::ENPWD($data['paypassword'])
            );
        } else {
            return $data;
        }
    }

    /**
     * 处理证件类型
     */
    public static function getCardType($value = null) {
        $returnarray = array(
            "0" => '身份证',
            '1' => '其他证件'
        );
        if ($value == null) {
            return $returnarray;
        } else {
            if (!isset($returnarray[$value])) {
                return '';
            } else {
                return $returnarray[$value];
            }
        }
    }

    /**
     * 获得是否实名认证
     */
    public static function getRealstate() {
        return '是';
    }

    /**
     * 获得用户安全等级
     */
    public function getSafeLevel() {
        $level = 0;
        if ($this->real_status == 1) {
            $level++;
        }
        if ($this->email_status == 1) {
            $level++;
        }
        if ($this->phone_status == 1) {
            $level++;
        }
        if ($this->answer != '') {
            $level++;
        }
        if ($this->paypassword != '') {
            $level++;
        }
        return $level;
    }
    /**
     * 获得用户安全等级
     */
    public function getSafeLevelLabel() {
        $level=$this->getSafeLevel();
        switch ($level){
            case 5:return '非常安全';
            case 4:return '安全';
            case 3:return '一般';
            case 2:return '差';
            case 1:return '很差';
            default :return '非常差';
        }
    }

    /**
     * 
     * @param type $string
     * @param type $string1
     * @return boolean
     * 验证密码是否正确
     */
    public function validatePassword($string = '', $string1 = "") {
        if (BaseTool::ENPWD($string) === $string1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type_id, super_type_id, credit, islock, real_status, email_status, video_status, regativetime, repsativetime, logintime', 'numerical', 'integerOnly' => true),
            array('purview,nickname, email, wangwang, answer', 'length', 'max' => 100),
            array('username, password, paypassword, card_id, phone_status, tel, phone, qq, addtime, addip, uptime, upip, lasttime', 'length', 'max' => 50),
            array('card_type, nation, sex, question', 'length', 'max' => 10),
            array('card_pic1, card_pic2', 'length', 'max' => 150),
            array('realname, province, city, area, lastip', 'length', 'max' => 20),
            array('litpic', 'length', 'max' => 250),
            array('birthday', 'length', 'max' => 11),
            array('address, regtaken, repstaken', 'length', 'max' => 200),
            array('remind, privacy', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_id, nickname,type_id, super_type_id, credit, purview, username, password, paypassword, islock, real_status, card_type, card_id, card_pic1, card_pic2, nation, realname, email_status, phone_status, video_status, email, sex, litpic, tel, phone, qq, wangwang, question, answer, birthday, province, city, area, address, remind, privacy, regtaken, regativetime, repstaken, repsativetime, logintime, addtime, addip, uptime, upip, lasttime, lastip', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'user_id' => 'User',
            'type_id' => 'Type',
            'super_type_id' => 'Super Type',
            'credit' => 'credit',
            'purview' => 'Purview',
            'username' => 'Username',
            'nickname'=>'昵称',
            'password' => 'Password',
            'paypassword' => 'Paypassword',
            'islock' => 'Islock',
            'real_status' => 'Real Status',
            'card_type' => 'Card Type',
            'card_id' => 'Card',
            'card_pic1' => 'Card Pic1',
            'card_pic2' => 'Card Pic2',
            'nation' => 'Nation',
            'realname' => 'Realname',
            'email_status' => 'Email Status',
            'phone_status' => 'Phone Status',
            'video_status' => 'Video Status',
            'email' => 'Email',
            'sex' => 'Sex',
            'litpic' => 'Litpic',
            'tel' => 'Tel',
            'phone' => 'Phone',
            'qq' => 'Qq',
            'wangwang' => 'Wangwang',
            'question' => 'Question',
            'answer' => 'Answer',
            'birthday' => 'Birthday',
            'province' => 'Province',
            'city' => 'City',
            'area' => 'Area',
            'address' => 'Address',
            'remind' => 'Remind',
            'privacy' => 'Privacy',
            'regtaken' => 'Regtaken',
            'regativetime' => 'Regativetime',
            'repstaken' => 'Repstaken',
            'repsativetime' => 'Repsativetime',
            'logintime' => 'Logintime',
            'addtime' => 'Addtime',
            'addip' => 'Addip',
            'uptime' => 'Uptime',
            'upip' => 'Upip',
            'lasttime' => 'Lasttime',
            'lastip' => 'Lastip',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('user_id', $this->user_id, true);
        $criteria->compare('type_id', $this->type_id);
        $criteria->compare('super_type_id', $this->super_type_id);
        $criteria->compare('credit', $this->credit);
        $criteria->compare('purview', $this->purview, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('nickname', $this->nickname, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('paypassword', $this->paypassword, true);
        $criteria->compare('islock', $this->islock);
        $criteria->compare('real_status', $this->real_status);
        $criteria->compare('card_type', $this->card_type, true);
        $criteria->compare('card_id', $this->card_id, true);
        $criteria->compare('card_pic1', $this->card_pic1, true);
        $criteria->compare('card_pic2', $this->card_pic2, true);
        $criteria->compare('nation', $this->nation, true);
        $criteria->compare('realname', $this->realname, true);
        $criteria->compare('email_status', $this->email_status);
        $criteria->compare('phone_status', $this->phone_status, true);
        $criteria->compare('video_status', $this->video_status);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('sex', $this->sex, true);
        $criteria->compare('litpic', $this->litpic, true);
        $criteria->compare('tel', $this->tel, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('qq', $this->qq, true);
        $criteria->compare('wangwang', $this->wangwang, true);
        $criteria->compare('question', $this->question, true);
        $criteria->compare('answer', $this->answer, true);
        $criteria->compare('birthday', $this->birthday, true);
        $criteria->compare('province', $this->province, true);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('area', $this->area, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('remind', $this->remind, true);
        $criteria->compare('privacy', $this->privacy, true);
        $criteria->compare('regtaken', $this->regtaken, true);
        $criteria->compare('regativetime', $this->regativetime);
        $criteria->compare('repstaken', $this->repstaken, true);
        $criteria->compare('repsativetime', $this->repsativetime);
        $criteria->compare('logintime', $this->logintime);
        $criteria->compare('addtime', $this->addtime, true);
        $criteria->compare('addip', $this->addip, true);
        $criteria->compare('uptime', $this->uptime, true);
        $criteria->compare('upip', $this->upip, true);
        $criteria->compare('lasttime', $this->lasttime, true);
        $criteria->compare('lastip', $this->lastip, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * 
     * 保存数据之前进行处理
     */
    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->addtime = time();
                $this->uptime = $this->addtime;
                $this->lasttime = $this->addtime;
                $this->upip = isset(Yii::app()->request->userHostAddress)?Yii::app()->request->userHostAddress:'10.10.10.1';;
                $this->addip = $this->upip;
                $this->lastip = $this->upip;
                $this->type_id = 2;
                $this->logintime = 1;
                $this->birthday = 0;
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
