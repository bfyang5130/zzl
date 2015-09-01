<?php

/**
 * This is the model class for table "{{product_coupon}}".
 *
 * The followings are the available columns in table '{{product_coupon}}':
 * @property integer $id
 * @property integer $cash_id
 * @property integer $user_id
 * @property integer $obtain_time
 * @property integer $used_time
 * @property integer $off_rate
 * @property integer $status
 * @property string $type
 * @property integer $addtime
 */
class ProductCoupon extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{product_coupon}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('cash_id, user_id, obtain_time, used_time, off_rate, status, addtime', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cash_id, user_id, obtain_time, used_time, off_rate, status, type, addtime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cash_id' => 'Cash',
			'user_id' => 'User',
			'obtain_time' => 'Obtain Time',
			'used_time' => 'Used Time',
			'off_rate' => 'Off Rate',
			'status' => 'Status',
			'type' => 'Type',
			'addtime' => 'Addtime',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('cash_id',$this->cash_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('obtain_time',$this->obtain_time);
		$criteria->compare('used_time',$this->used_time);
		$criteria->compare('off_rate',$this->off_rate);
		$criteria->compare('status',$this->status);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('addtime',$this->addtime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductCoupon the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
