<?php

/**
 * This is the model class for table "{{account_log}}".
 *
 * The followings are the available columns in table '{{account_log}}':
 * @property string $id
 * @property integer $user_id
 * @property string $type
 * @property string $total
 * @property string $money
 * @property string $use_money
 * @property string $no_use_money
 * @property string $collection
 * @property integer $to_user
 * @property string $remark
 * @property integer $addtime
 * @property string $addip
 * @property string $checkid
 * @property integer $moneyactiontype
 */
class AccountLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{account_log}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, to_user, addtime, moneyactiontype', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>100),
			array('total, collection', 'length', 'max'=>11),
			array('money', 'length', 'max'=>20),
			array('use_money, no_use_money', 'length', 'max'=>10),
			array('remark', 'length', 'max'=>250),
			array('addip', 'length', 'max'=>15),
			array('checkid', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, type, total, money, use_money, no_use_money, collection, to_user, remark, addtime, addip, checkid, moneyactiontype', 'safe', 'on'=>'search'),
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
			'user_id' => '用户ID',
			'type' => '类型',
			'total' => 'Total',
			'money' => '金额',
			'use_money' => '可用金额',
			'no_use_money' => '冻结金额',
			'collection' => 'Collection',
			'to_user' => '交易对方',
			'remark' => '备注',
			'addtime' => 'Addtime',
			'addip' => 'Addip',
			'checkid' => '用来记录资金操作某个流程的标识',
			'moneyactiontype' => '金额操作是增加还是减少',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('money',$this->money,true);
		$criteria->compare('use_money',$this->use_money,true);
		$criteria->compare('no_use_money',$this->no_use_money,true);
		$criteria->compare('collection',$this->collection,true);
		$criteria->compare('to_user',$this->to_user);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('addtime',$this->addtime);
		$criteria->compare('addip',$this->addip,true);
		$criteria->compare('checkid',$this->checkid,true);
		$criteria->compare('moneyactiontype',$this->moneyactiontype);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AccountLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
