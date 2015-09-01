<?php

/**
 * This is the model class for table "{{cash}}".
 *
 * The followings are the available columns in table '{{cash}}':
 * @property string $id
 * @property integer $user_id
 * @property string $realname
 * @property integer $status
 * @property string $package_id
 * @property string $submittocaifutong_time
 * @property string $return_result
 * @property string $account
 * @property string $bank
 * @property string $branch
 * @property integer $province
 * @property integer $city
 * @property string $total
 * @property string $credited
 * @property string $fee
 * @property integer $verify_userid
 * @property integer $verify_time
 * @property string $verify_remark
 * @property integer $addtime
 * @property string $addip
 * @property integer $acc_type
 */
class Cash extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{cash}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('total', 'required'),
			array('user_id, status, province, city, verify_userid, verify_time, addtime, acc_type', 'numerical', 'integerOnly'=>true),
			array('realname, package_id, branch', 'length', 'max'=>100),
			array('submittocaifutong_time, total', 'length', 'max'=>20),
			array('return_result', 'length', 'max'=>500),
			array('account', 'length', 'max'=>50),
			array('bank', 'length', 'max'=>302),
			array('credited, fee', 'length', 'max'=>12),
			array('verify_remark', 'length', 'max'=>250),
			array('addip', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, realname, status, package_id, submittocaifutong_time, return_result, account, bank, branch, province, city, total, credited, fee, verify_userid, verify_time, verify_remark, addtime, addip, acc_type', 'safe', 'on'=>'search'),
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
			'realname' => '真实姓名',
			'status' => '0状态,1成功，2失败，3提交到财付通。4，撤消',
			'package_id' => 'Package',
			'submittocaifutong_time' => 'Submittocaifutong Time',
			'return_result' => 'Return Result',
			'account' => '账号',
			'bank' => '所属银行',
			'branch' => '支行',
			'province' => 'Province',
			'city' => 'City',
			'total' => 'Total',
			'credited' => '到账总额',
			'fee' => '手续费',
			'verify_userid' => 'Verify Userid',
			'verify_time' => 'Verify Time',
			'verify_remark' => 'Verify Remark',
			'addtime' => 'Addtime',
			'addip' => 'Addip',
			'acc_type' => '帐号提现类型',
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
		$criteria->compare('realname',$this->realname,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('package_id',$this->package_id,true);
		$criteria->compare('submittocaifutong_time',$this->submittocaifutong_time,true);
		$criteria->compare('return_result',$this->return_result,true);
		$criteria->compare('account',$this->account,true);
		$criteria->compare('bank',$this->bank,true);
		$criteria->compare('branch',$this->branch,true);
		$criteria->compare('province',$this->province);
		$criteria->compare('city',$this->city);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('credited',$this->credited,true);
		$criteria->compare('fee',$this->fee,true);
		$criteria->compare('verify_userid',$this->verify_userid);
		$criteria->compare('verify_time',$this->verify_time);
		$criteria->compare('verify_remark',$this->verify_remark,true);
		$criteria->compare('addtime',$this->addtime);
		$criteria->compare('addip',$this->addip,true);
		$criteria->compare('acc_type',$this->acc_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cash the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
