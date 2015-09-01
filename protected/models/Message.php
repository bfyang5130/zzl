<?php

/**
 * This is the model class for table "{{message}}".
 *
 * The followings are the available columns in table '{{message}}':
 * @property string $id
 * @property string $title
 * @property string $content
 * @property integer $user_id
 * @property integer $sent_user_id
 * @property integer $status
 * @property integer $type_id
 * @property integer $addtime
 * @property string $addip
 */
class Message extends CActiveRecord {

    public static function getMessageNumbers($user,$num){
        return 1;
    }
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{message}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, sent_user_id', 'required'),
            array('user_id, sent_user_id, status, type_id, addtime', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 255),
            array('content', 'length', 'max' => 1000),
            array('addip', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, content, user_id, sent_user_id, status, type_id, addtime, addip', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'sentuser' => array(self::BELONGS_TO, 'Users', 'sent_user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => '自增ID',
            'title' => '标题',
            'content' => '具体内容',
            'user_id' => '接收用户ID',
            'sent_user_id' => '发送人ID',
            'status' => '是否已经阅读',
            'type_id' => '信息类型',
            'addtime' => '添加时间',
            'addip' => '添加ID',
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('sent_user_id', $this->sent_user_id);
        $criteria->compare('status', $this->status);
        $criteria->compare('type_id', $this->type_id);
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
     * @return Message the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
