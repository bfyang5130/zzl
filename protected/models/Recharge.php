<?php

/**
 * This is the model class for table "{{recharge}}".
 *
 * The followings are the available columns in table '{{recharge}}':
 * @property string $id
 * @property string $trade_no
 * @property integer $user_id
 * @property integer $status
 * @property string $money
 * @property string $payment
 * @property string $return
 * @property string $type
 * @property string $remark
 * @property string $fee
 * @property string $bankcode
 * @property integer $verify_userid
 * @property integer $verify_time
 * @property string $verify_remark
 * @property integer $addtime
 * @property string $addip
 */
class Recharge extends CActiveRecord {

    /**
     * 
     * 保存数据之前进行处理
     */
    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->addtime = time();
                $this->addip = Yii::app()->request->userHostAddress;
                $this->status = 0;
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
        return '{{recharge}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, status, verify_userid, verify_time, addtime', 'numerical', 'integerOnly' => true),
            array('trade_no, payment, bankcode', 'length', 'max' => 100),
            array('money', 'length', 'max' => 20),
            array('type', 'length', 'max' => 10),
            array('remark, verify_remark', 'length', 'max' => 250),
            array('fee', 'length', 'max' => 12),
            array('addip', 'length', 'max' => 15),
            array('return', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, trade_no, user_id, status, money, payment, return, type, remark, fee, bankcode, verify_userid, verify_time, verify_remark, addtime, addip', 'safe', 'on' => 'search'),
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
            'trade_no' => '订单号',
            'user_id' => '用户ID',
            'status' => '状态',
            'money' => '金额',
            'payment' => '所属银行',
            'return' => 'Return',
            'type' => '类型',
            'remark' => '备注',
            'fee' => 'Fee',
            'bankcode' => '银行代码',
            'verify_userid' => '审核人',
            'verify_time' => '审核时间',
            'verify_remark' => '审核备注',
            'addtime' => 'Addtime',
            'addip' => 'Addip',
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
        $criteria->compare('trade_no', $this->trade_no, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('status', $this->status);
        $criteria->compare('money', $this->money, true);
        $criteria->compare('payment', $this->payment, true);
        $criteria->compare('return', $this->return, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('fee', $this->fee, true);
        $criteria->compare('bankcode', $this->bankcode, true);
        $criteria->compare('verify_userid', $this->verify_userid);
        $criteria->compare('verify_time', $this->verify_time);
        $criteria->compare('verify_remark', $this->verify_remark, true);
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
     * @return Recharge the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
