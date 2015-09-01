<?php

/**
 * This is the model class for table "{{project_lunbo}}".
 *
 * The followings are the available columns in table '{{project_lunbo}}':
 * @property string $id
 * @property string $projects_id
 * @property string $pic_address
 * @property string $pic_remark
 * @property integer $pic_status
 * @property string $pic_addtime
 * @property string $pic_addip
 */
class ProjectLunbo extends CActiveRecord {

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->pic_addtime = date("Y-m-d H:i:s",time());
                $this->pic_addip = Yii::app()->request->userHostAddress;
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
        return '{{project_lunbo}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('projects_id', 'required'),
            array('pic_status', 'numerical', 'integerOnly' => true),
            array('projects_id', 'length', 'max' => 11),
            array('pic_address', 'length', 'max' => 255),
            array('pic_remark', 'length', 'max' => 500),
            array('pic_addip', 'length', 'max' => 100),
            array('pic_addtime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, projects_id, pic_address, pic_remark, pic_status, pic_addtime, pic_addip', 'safe', 'on' => 'search'),
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
            'id' => '增长ID',
            'projects_id' => '所属项目ID',
            'pic_address' => '轮播图片地址',
            'pic_remark' => '轮播图片的描述',
            'pic_status' => '是否显示',
            'pic_addtime' => '添加时间',
            'pic_addip' => '添加的IP',
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
        $criteria->compare('projects_id', $this->projects_id, true);
        $criteria->compare('pic_address', $this->pic_address, true);
        $criteria->compare('pic_remark', $this->pic_remark, true);
        $criteria->compare('pic_status', $this->pic_status);
        $criteria->compare('pic_addtime', $this->pic_addtime, true);
        $criteria->compare('pic_addip', $this->pic_addip, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ProjectLunbo the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
