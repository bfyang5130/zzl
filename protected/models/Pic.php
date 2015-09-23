<?php

/**
 * This is the model class for table "{{pic}}".
 *
 * The followings are the available columns in table '{{pic}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $pic_type
 * @property string $pic_s_img
 * @property string $pic_m_img
 * @property string $pic_b_img
 * @property integer $pic_addtime
 * @property string $pic_addip
 */
class Pic extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{pic}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, pic_type, pic_addtime', 'numerical', 'integerOnly'=>true),
			array('pic_s_img, pic_m_img, pic_b_img', 'length', 'max'=>255),
			array('pic_addip', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, pic_type, pic_s_img, pic_m_img, pic_b_img, pic_addtime, pic_addip', 'safe', 'on'=>'search'),
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
			'pic_type' => 'Pic Type',
			'pic_s_img' => 'Pic S Img',
			'pic_m_img' => 'Pic M Img',
			'pic_b_img' => 'Pic B Img',
			'pic_addtime' => 'Pic Addtime',
			'pic_addip' => 'Pic Addip',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('pic_type',$this->pic_type);
		$criteria->compare('pic_s_img',$this->pic_s_img,true);
		$criteria->compare('pic_m_img',$this->pic_m_img,true);
		$criteria->compare('pic_b_img',$this->pic_b_img,true);
		$criteria->compare('pic_addtime',$this->pic_addtime);
		$criteria->compare('pic_addip',$this->pic_addip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pic the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
