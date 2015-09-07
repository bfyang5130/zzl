<?php

/**
 * This is the model class for table "{{payarea}}".
 *
 * The followings are the available columns in table '{{payarea}}':
 * @property integer $id
 * @property string $name
 * @property integer $p_code
 * @property integer $a_code
 * @property string $nid
 * @property integer $pid
 * @property string $domain
 * @property integer $order
 */
class Payarea extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{payarea}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, p_code, a_code, nid, pid, domain, order', 'required'),
			array('p_code, a_code, pid, order', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('nid', 'length', 'max'=>200),
			array('domain', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, p_code, a_code, nid, pid, domain, order', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'p_code' => 'P Code',
			'a_code' => 'A Code',
			'nid' => 'Nid',
			'pid' => 'Pid',
			'domain' => 'Domain',
			'order' => 'Order',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('p_code',$this->p_code);
		$criteria->compare('a_code',$this->a_code);
		$criteria->compare('nid',$this->nid,true);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('domain',$this->domain,true);
		$criteria->compare('order',$this->order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Payarea the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
