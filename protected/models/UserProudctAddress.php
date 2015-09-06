<?php

/**
 * This is the model class for table "{{user_proudct_address}}".
 *
 * The followings are the available columns in table '{{user_proudct_address}}':
 * @property string $id
 * @property integer $user_id
 * @property string $realname
 * @property string $phone
 * @property string $address
 * @property string $sysaddress
 * @property integer $province
 * @property integer $city
 * @property integer $area
 * @property integer $addtime
 * @property string $addip
 */
class UserProudctAddress extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_proudct_address}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, realname, phone, address, sysaddress, province, city, area, addtime, addip', 'required'),
			array('user_id, province, city, area, addtime', 'numerical', 'integerOnly'=>true),
			array('realname, addip', 'length', 'max'=>100),
			array('phone', 'length', 'max'=>35),
			array('address, sysaddress', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, realname, phone, address, sysaddress, province, city, area, addtime, addip', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'realname' => 'Realname',
			'phone' => 'Phone',
			'address' => 'Address',
			'sysaddress' => 'Sysaddress',
			'province' => 'Province',
			'city' => 'City',
			'area' => 'Area',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('realname',$this->realname,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('sysaddress',$this->sysaddress,true);
		$criteria->compare('province',$this->province);
		$criteria->compare('city',$this->city);
		$criteria->compare('area',$this->area);
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
	 * @return UserProudctAddress the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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
            }
            return true;
        } else {
            return false;
        }
    }
}
