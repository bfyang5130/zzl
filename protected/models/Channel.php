<?php

/**
 * This is the model class for table "{{channel}}".
 *
 * The followings are the available columns in table '{{channel}}':
 * @property string $id
 * @property integer $cl_parent_id
 * @property integer $cl_type
 * @property integer $cl_att
 * @property string $cl_name
 * @property string $cl_en_name
 * @property integer $cl_menu_id
 * @property integer $cl_sort
 * @property string $cl_exturl
 * @property string $cl_info
 * @property string $cl_thumb
 * @property string $cl_keyword
 * @property string $cl_description
 * @property string $cl_domain
 * @property string $cl_tplclass
 * @property integer $cl_left
 * @property integer $cl_right
 * @property integer $cl_depth
 * @property integer $cl_childs
 * @property integer $cl_pstatus
 * @property string $cl_tplcontent
 * @property integer $cl_status
 * @property integer $cl_addtime
 */
class Channel extends CActiveRecord {

    /**
     * 获得菜单列表
     */
    public static function getMenu() {
        $menulist = Menu::model()->findAll();
        if (!empty($menulist)) {
            $newMenuArray = array();
            foreach ($menulist as $key => $value) {
                $newMenuArray[$value->menu_id] = $value->menu_name;
            }
            return $newMenuArray;
        } else {
            return array("1" => '主菜单');
        }
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->cl_status = 0;
                $this->cl_addtime = time();
                $this->cl_sort = $this->count();
                $this->cl_left = $this->cl_sort * 2 + 1;
                $this->cl_right = $this->cl_sort * 2 + 2;
                $this->cl_depth = 0;
                $this->cl_pstatus = 0;
                $this->cl_childs = 0;
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
        return '{{channel}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cl_name', 'required'),
            array('cl_parent_id, cl_type, cl_att, cl_menu_id, cl_sort, cl_left, cl_right, cl_depth, cl_childs, cl_pstatus, cl_status, cl_addtime', 'numerical', 'integerOnly' => true),
            array('cl_name, cl_exturl, cl_thumb, cl_keyword, cl_domain', 'length', 'max' => 255),
            array('cl_en_name, cl_tplclass, cl_tplcontent', 'length', 'max' => 100),
            array('cl_info', 'length', 'max' => 500),
            array('cl_description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, cl_parent_id, cl_type, cl_att, cl_name, cl_en_name, cl_menu_id, cl_sort, cl_exturl, cl_info, cl_thumb, cl_keyword, cl_description, cl_domain, cl_tplclass, cl_left, cl_right, cl_depth, cl_childs, cl_pstatus, cl_tplcontent, cl_status, cl_addtime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'menu' => array(self::BELONGS_TO, 'Menu', 'cl_menu_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'cl_parent_id' => '所属栏目',
            'cl_type' => '类型',
            'cl_att' => '属性',
            'cl_name' => '栏目名称',
            'cl_en_name' => '栏目英文名',
            'cl_menu_id' => '所属菜单id',
            'cl_sort' => '排序',
            'cl_exturl' => '外链地址',
            'cl_info' => '栏目简介',
            'cl_thumb' => '栏目缩略图',
            'cl_keyword' => '栏目关键字',
            'cl_description' => '栏目描述',
            'cl_domain' => '栏目域名',
            'cl_tplclass' => '栏目模板',
            'cl_left' => '左值',
            'cl_right' => '右值',
            'cl_depth' => '栏目深度',
            'cl_childs' => '子栏目数',
            'cl_pstatus' => '左右值处理时的判断',
            'cl_tplcontent' => '内容模板',
            'cl_status' => '是否显示',
            'cl_addtime' => '添加时间',
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
        $criteria->compare('cl_parent_id', $this->cl_parent_id);
        $criteria->compare('cl_type', $this->cl_type);
        $criteria->compare('cl_att', $this->cl_att);
        $criteria->compare('cl_name', $this->cl_name, true);
        $criteria->compare('cl_en_name', $this->cl_en_name, true);
        $criteria->compare('cl_menu_id', $this->cl_menu_id);
        $criteria->compare('cl_sort', $this->cl_sort);
        $criteria->compare('cl_exturl', $this->cl_exturl, true);
        $criteria->compare('cl_info', $this->cl_info, true);
        $criteria->compare('cl_thumb', $this->cl_thumb, true);
        $criteria->compare('cl_keyword', $this->cl_keyword, true);
        $criteria->compare('cl_description', $this->cl_description, true);
        $criteria->compare('cl_domain', $this->cl_domain, true);
        $criteria->compare('cl_tplclass', $this->cl_tplclass, true);
        $criteria->compare('cl_left', $this->cl_left);
        $criteria->compare('cl_right', $this->cl_right);
        $criteria->compare('cl_depth', $this->cl_depth);
        $criteria->compare('cl_childs', $this->cl_childs);
        $criteria->compare('cl_pstatus', $this->cl_pstatus);
        $criteria->compare('cl_tplcontent', $this->cl_tplcontent, true);
        $criteria->compare('cl_status', $this->cl_status);
        $criteria->compare('cl_addtime', $this->cl_addtime);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Channel the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
