<?php

/**
 * This is the model class for table "{{tender}}".
 *
 * The followings are the available columns in table '{{tender}}':
 * @property string $id
 * @property integer $project_id
 * @property integer $user_id
 * @property string $money
 * @property string $tender_lixi
 * @property integer $status
 * @property integer $is_lock
 * @property integer $type
 * @property integer $buy_status
 * @property integer $arealimit
 * @property string $trade_no
 * @property integer $addtime
 * @property string $addip
 */
class Tender extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{tender}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_id, user_id, money', 'required'),
			array('project_id, user_id, status, is_lock, type, buy_status, arealimit, addtime', 'numerical', 'integerOnly'=>true),
			array('money, tender_lixi', 'length', 'max'=>20),
			array('trade_no', 'length', 'max'=>255),
			array('addip', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, user_id, money, tender_lixi, status, is_lock, type, buy_status, arealimit, trade_no, addtime, addip', 'safe', 'on'=>'search'),
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
            'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '自增ID',
			'project_id' => '项目ID',
			'user_id' => '用户id',
			'money' => '赞助金额',
			'tender_lixi' => '投资利息',
			'status' => '是否赞助成功',
			'is_lock' => '是否被锁定',
			'type' => '赞助类型',
			'buy_status' => '是否真实购买',
			'arealimit' => '地区限制代号',
			'trade_no' => '确认订单号',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('money',$this->money,true);
		$criteria->compare('tender_lixi',$this->tender_lixi,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('is_lock',$this->is_lock);
		$criteria->compare('type',$this->type);
		$criteria->compare('buy_status',$this->buy_status);
		$criteria->compare('arealimit',$this->arealimit);
		$criteria->compare('trade_no',$this->trade_no,true);
		$criteria->compare('addtime',$this->addtime);
		$criteria->compare('addip',$this->addip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tender the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
