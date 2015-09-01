<?php

/**
 * This is the model class for table "{{bankcard}}".
 *
 * The followings are the available columns in table '{{bankcard}}':
 * @property string $id
 * @property integer $user_id
 * @property string $realname
 * @property string $account
 * @property string $bank
 * @property integer $bank_type
 * @property string $bank_name
 * @property string $branch
 * @property integer $province
 * @property integer $city
 * @property integer $area
 * @property integer $addtime
 * @property string $addip
 */
class Bankcard extends CActiveRecord {

    protected function beforeValidate() {
        if (parent::beforeValidate()) {
            if ($this->isNewRecord) {
                $this->addtime = time();
                $this->addip = Yii::app()->request->userHostAddress;
                $this->user_id = Yii::app()->user->getId();
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * 保存数据之前进行处理
     */
    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->addtime = time();
                $this->addip = Yii::app()->request->userHostAddress;
                $this->user_id = Yii::app()->user->getId();
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{bankcard}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('realname, account, bank, bank_name, branch, addtime, addip', 'required'),
            array('user_id, bank_type, province, city, area, addtime', 'numerical', 'integerOnly' => true),
            array('realname, account, bank_name, branch', 'length', 'max' => 100),
            array('bank', 'length', 'max' => 50),
            array('addip', 'length', 'max' => 15),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, realname, account, bank, bank_type, bank_name, branch, province, city, area, addtime, addip', 'safe', 'on' => 'search'),
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
            'id' => 'ID',
            'user_id' => '用户ID',
            'realname' => '真实姓名',
            'account' => '账号',
            'bank' => '所属银行',
            'bank_type' => '对公对私帐号',
            'bank_name' => '银行名称',
            'branch' => '支行',
            'province' => '省份',
            'city' => '城市',
            'area' => '区',
            'addtime' => '添加时间',
            'addip' => '添加IP',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('realname', $this->realname, true);
        $criteria->compare('account', $this->account, true);
        $criteria->compare('bank', $this->bank, true);
        $criteria->compare('bank_type', $this->bank_type);
        $criteria->compare('bank_name', $this->bank_name, true);
        $criteria->compare('branch', $this->branch, true);
        $criteria->compare('province', $this->province);
        $criteria->compare('city', $this->city);
        $criteria->compare('area', $this->area);
        $criteria->compare('addtime', $this->addtime);
        $criteria->compare('addip', $this->addip, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Bankcard the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
