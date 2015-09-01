<?php

/**
 * This is the model class for table "{{project_use}}".
 *
 * The followings are the available columns in table '{{project_use}}':
 * @property string $id
 * @property string $project_id
 * @property string $user_id
 * @property string $remark
 * @property string $money
 * @property integer $agreetimes
 * @property integer $status
 * @property integer $addtime
 * @property string $addip
 */
class ProjectUse extends CActiveRecord
{
        /**
     * @return boolen
     * 申请一个项目的资金用途
     */
    public function qys_save() {
        try {
            $project_id = $this->project_id;
            $user_id = $this->user_id;
            $money = $this->money;
            $addip = $this->addip;
            $remark=$this->remark;
            $conn = Yii::app()->db;
            $command = $conn->createCommand('call p_Money_use(:in_project_id,:in_user_id,:in_money,:in_remark,:in_addip,@out_status,@out_remark)');
            $command->bindParam(":in_project_id", $project_id, PDO::PARAM_INT);
            $command->bindParam(":in_user_id", $user_id, PDO::PARAM_INT);
            $command->bindParam(":in_money", $money, PDO::PARAM_STR);
            $command->bindParam(":in_remark", $remark, PDO::PARAM_STR, 500);
            $command->bindParam(":in_addip", $addip, PDO::PARAM_STR, 50);
            $command->execute();
            $result = $conn->createCommand("select @out_status as status,@out_remark as remark")->queryRow(true);
            if ($result['status'] == 1) {
                Yii::app()->user->setFlash('success', $result['remark']);
                Yii::app()->user->setFlash('reurl', Yii::app()->request->urlReferrer);
                Yii::app()->request->redirect("/notice/success.html");
            } else {
                //跳转到错误的页面
                Yii::app()->user->setFlash('fail', $result['remark']);
                Yii::app()->user->setFlash('reurl', Yii::app()->request->urlReferrer);
                Yii::app()->request->redirect("/notice/errors.html");
            }
        } catch (Exception $e) {
            //跳转到错误的页面 
            print_r($e);exit;
            Yii::app()->user->setFlash('fail', "系统繁忙，无法进行赞助！");
            Yii::app()->user->setFlash('reurl', Yii::app()->request->urlReferrer);
            Yii::app()->request->redirect("/notice/errors.html");
        }
    }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{project_use}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_id, user_id, remark', 'required'),
			array('agreetimes, status, addtime', 'numerical', 'integerOnly'=>true),
			array('project_id, user_id', 'length', 'max'=>11),
			array('remark', 'length', 'max'=>500),
			array('money', 'length', 'max'=>16),
			array('addip', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, user_id, remark, money, agreetimes, status, addtime, addip', 'safe', 'on'=>'search'),
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
			'user_id' => '用户ID',
			'remark' => '资金用途',
			'money' => '使用资金',
			'agreetimes' => '赞同率',
			'status' => '是否通过',
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
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('money',$this->money,true);
		$criteria->compare('agreetimes',$this->agreetimes);
		$criteria->compare('status',$this->status);
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
	 * @return ProjectUse the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
