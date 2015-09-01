<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegeditForm extends CFormModel {

    public $username;
    public $password;
    public $email;
    public $verifyCode;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('username,password,email,verifyCode', 'required'),
            array('username', 'length', 'max' => 20, 'min' => 6, 'message' => '用户名应该在6到20位之间'),
            array('username', 'testUsername'),
            array('password', 'length', 'max' => 20, 'min' => 8, 'message' => '密码应该在8到20位之间'),
            array('username', 'match', 'pattern' => '/^[a-z0-9\-_]+$/', 'message' => '用户名由数字与字母或者下线划组成'),
            // rememberMe needs to be a boolean
            array("email", "email", "allowEmpty" => false, "message" => "邮箱格式不正确"),
            array("email", "testUniquEmail", "message" => "邮箱已经被注册。"),
            array('verifyCode', 'captcha', 'on' => 'login', 'allowEmpty' => !extension_loaded('gd')),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'rememberMe' => 'Remember me next time',
        );
    }

    /**
     * 唯一用户名验证
     */
    public function testUsername() {
        if (empty($this->username)) {
            $this->addError('username', "用户名不能为空");
        }
        $oneuser = Users::model()->find("username=:username", array(":username" => $this->username));
        if ($oneuser) {
            $this->addError('username', "用户名被占用");
        }
    }

    /**
     * 唯一邮箱验证
     */
    public function testUniquEmail() {
        if (empty($this->email)) {
            $this->addError('email', "邮箱不能为空");
        }
        $oneuser = Users::model()->find("email=:email AND email_status=1", array(":email" => $this->email));
        if ($oneuser) {
            $this->addError('email', "邮箱已经存在");
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function save() {
        $user = new Users();
        $user->setAttributes($this->attributes);
        $user->setAttribute("password", BaseTool::ENPWD($this->password));
        if ($user->validate() && $user->save()) {
            $accountarray = array(
                'user_id' => Yii::app()->db->getLastInsertID(),
                'total' => 0,
                'use_money' => 0,
                'no_use_money' => 0,
                'newworth' => 0,
            );
            $newAccount = new Account();
            $newAccount->setAttributes($accountarray);
            $newAccount->save();
            //发送邮件
            $activecode = BaseTool::getActiveMailCode($this->username);
            $message = MailTemplet::getActiveEmail($this->username, $activecode);
            $mail = Yii::app()->Smtpmail;
            $mail->SetFrom(Yii::app()->params['adminEmail']);
            $mail->Subject = "好帮贷测试邮件";
            $mail->MsgHTML($message);
            $mail->AddAddress($this->email);

            if ($mail->Send()) {
                $user->updateAll(array("regtaken" => $activecode, "regativetime" => time() + 60 * 60), "username=:username", array(":username" => $this->username));
            }
            Yii::import("application.models.form.LoginForm", true);
            $loginform = new LoginForm();
            $loginarray = array(
                'rememberMe' => false,
                'username' => $this->username,
                'password' => $this->password,
            );
            $loginform->setAttributes($loginarray);
            if ($loginform->validate() && $loginform->login()) {
                
            }
            return true;
        } else {
            $usererror = $user->errors;
            $this->addError("username", current(current($usererror)));
            return false;
        }
    }

}
