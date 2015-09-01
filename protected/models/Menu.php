<?php

/**
 * This is the model class for table "{{menu}}".
 *
 * The followings are the available columns in table '{{menu}}':
 * @property integer $menu_id
 * @property string $menu_name
 * @property string $menu_ename
 * @property string $menu_description
 * @property string $menu_style
 * @property integer $menu_order
 * @property integer $menu_addtime
 * @property integer $menu_updatetime
 */
class Menu extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{menu}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('menu_name, menu_ename', 'required'),
            array('menu_order, menu_addtime, menu_updatetime', 'numerical', 'integerOnly' => true),
            array('menu_name, menu_ename, menu_style', 'length', 'max' => 100),
            array('menu_description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('menu_id, menu_name, menu_ename, menu_description, menu_style, menu_order, menu_addtime, menu_updatetime', 'safe', 'on' => 'search'),
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
            'menu_id' => '自动增长id',
            'menu_name' => '菜单名称',
            'menu_ename' => '菜单识别名',
            'menu_description' => '菜单描述',
            'menu_style' => '菜单样式',
            'menu_order' => '菜单排序',
            'menu_addtime' => '菜单添加时间',
            'menu_updatetime' => '菜单更新时间',
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

        $criteria->compare('menu_id', $this->menu_id);
        $criteria->compare('menu_name', $this->menu_name, true);
        $criteria->compare('menu_ename', $this->menu_ename, true);
        $criteria->compare('menu_description', $this->menu_description, true);
        $criteria->compare('menu_style', $this->menu_style, true);
        $criteria->compare('menu_order', $this->menu_order);
        $criteria->compare('menu_addtime', $this->menu_addtime);
        $criteria->compare('menu_updatetime', $this->menu_updatetime);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * 菜单样式的类别
     */
    public static function getMenuStyle() {
        return array(
            'common' => '普通样式',
            'twolevel' => '两层样式',
        );
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->menu_addtime = time();
                $this->menu_updatetime = time();
                $this->menu_order = $this->count();
            } else {
                $this->menu_updatetime = time();
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Menu the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
