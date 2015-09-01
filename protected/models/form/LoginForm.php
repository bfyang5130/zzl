<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel {

    public $username;
    public $password;
    public $rememberMe;
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('username,password', 'required'),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
            // password needs to be authenticated
            array('password', 'authenticate'),
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
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {
        $this->_identity = new UserIdentity($this->username, $this->password);
        if (!$this->_identity->authenticate())
            $this->addError('password', '用户名或者密码错误！');
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login() {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            #登录成功后，更新用户登录的信息
            $lasttime=  time();
            $lastip=Yii::app()->request->userHostAddress;
            Yii::app()->db->createCommand("update web_user set logintime=logintime+1,uptime=lasttime,upip=lastip,lasttime=:lasttime,lastip=:lastip where user_id=:user_id")
                    ->execute(array(":lasttime"=>  $lasttime,":lastip"=>$lastip,":user_id"=>Yii::app()->user->getId()));
            return true;
        }
        else
            return false;
    }

}
