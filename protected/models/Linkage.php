<?php

/**
 * This is the model class for table "{{linkage}}".
 *
 * The followings are the available columns in table '{{linkage}}':
 * @property string $id
 * @property integer $type_id
 * @property string $ename
 * @property string $eaname
 * @property string $cvalue
 */
class Linkage extends CActiveRecord {

    /**
     * 
     * @param type $value
     * @return string
     * 获得值与中文名,
     */
    public static function getValueChina($value = "qys_none", $stringtype = "question") {
        $questid = LinkageType::model()->find("ename=:ename", array(":ename" => $stringtype));
        if ($value === "qys_none") {
            $result = Yii::app()->db->createCommand("select eaname,cvalue from {{linkage}} where type_id=" . $questid->id)->queryAll(true);
            if ($result) {
                $newarray = array();
                foreach ($result as $key => $value) {
                    $newarray[$value['cvalue']] = $value['eaname'];
                }
                return $newarray;
            } else {
                return array("1" => '无数据');
            }
        } else {
            $result = Linkage::model()->find("type_id=:type_id AND cvalue=:cvalue", array(":type_id" => $questid->id, ":cvalue" => $value));
            if (!$result) {
                return '';
            } else {
                return $result->eaname;
            }
        }
#
    }

    /**
     * 
     * @param type $value
     * @return string
     * 获得问答分类类型
     */
    public static function getQuestion($value = "qys_none") {
        $questid = LinkageType::model()->find("ename='question'");
        if ($value === "qys_none") {
            $result = Yii::app()->db->createCommand("select eaname,cvalue from {{linkage}} where type_id=" . $questid->id)->queryAll(true);
            if ($result) {
                $newarray = array();
                foreach ($result as $key => $value) {
                    $newarray[$value['cvalue']] = $value['eaname'];
                }
                return $newarray;
            } else {
                return array("1" => '无数据');
            }
        } else {
            $result = Linkage::model()->find("type_id=:type_id AND cvalue=:cvalue", array(":type_id" => $questid->id, ":cvalue" => $value));
            if (!$result) {
                return '';
            } else {
                return $result->eaname;
            }
        }
#
    }

    /**
     * 
     * @param type $value
     * @return string
     * 获得问答分类类型
     */
    public static function getMessage($value = "qys_none") {
        $questid = LinkageType::model()->find("ename='message'");
        if ($value === "qys_none") {
            $result = Yii::app()->db->createCommand("select eaname,cvalue from {{linkage}} where type_id=" . $questid->id)->queryAll(true);
            if ($result) {
                $newarray = array();
                foreach ($result as $key => $value) {
                    $newarray[$value['cvalue']] = $value['eaname'];
                }
                return $newarray;
            } else {
                return array("1" => '无数据');
            }
        } else {
            $result = Linkage::model()->find("type_id=:type_id AND cvalue=:cvalue", array(":type_id" => $questid->id, ":cvalue" => $value));
            if (!$result) {
                return '';
            } else {
                return $result->eaname;
            }
        }
#
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{linkage}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type_id', 'required'),
            array('type_id', 'numerical', 'integerOnly' => true),
            array('ename, eaname, cvalue', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, type_id, ename, eaname, cvalue', 'safe', 'on' => 'search'),
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
            'id' => '自增ID',
            'type_id' => '标识名',
            'ename' => '英文名',
            'eaname' => 'e名称',
            'cvalue' => '中文名',
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
        $criteria->compare('type_id', $this->type_id);
        $criteria->compare('ename', $this->ename, true);
        $criteria->compare('eaname', $this->eaname, true);
        $criteria->compare('cvalue', $this->cvalue, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Linkage the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
