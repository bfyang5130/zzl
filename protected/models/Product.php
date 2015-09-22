<?php

/**
 * This is the model class for table "{{product}}".
 *
 * The followings are the available columns in table '{{product}}':
 * @property string $product_id
 * @property integer $product_user_id
 * @property integer $product_type
 * @property string $product_name
 * @property string $product_s_img
 * @property string $product_m_img
 * @property string $product_b_img
 * @property string $product_price
 * @property string $product_description
 * @property string $product_info
 * @property integer $product_num
 * @property integer $product_status
 * @property integer $product_addtime
 * @property string $product_addip
 */
class Product extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{product}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('product_name', 'required'),
            array('product_user_id, product_type, product_num, product_status, product_addtime', 'numerical', 'integerOnly' => true),
            array('product_name, product_addip', 'length', 'max' => 100),
            array('product_s_img', 'length', 'max' => 255),
            array('product_m_img, product_b_img', 'length', 'max' => 225),
            array('product_price', 'length', 'max' => 10),
            array('product_description', 'length', 'max' => 500),
            array('product_info', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('product_id, product_user_id, product_type, product_name, product_s_img, product_m_img, product_b_img, product_price, product_description, product_info, product_num, product_status, product_addtime, product_addip', 'safe', 'on' => 'search'),
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
            'product_id' => 'Product',
            'product_user_id' => 'Product User',
            'product_type' => 'Product Type',
            'product_name' => 'Product Name',
            'product_s_img' => 'Product S Img',
            'product_m_img' => 'Product M Img',
            'product_b_img' => 'Product B Img',
            'product_price' => 'Product Price',
            'product_description' => 'Product Description',
            'product_info' => 'Product Info',
            'product_num' => 'Product Num',
            'product_status' => 'Product Status',
            'product_addtime' => 'Product Addtime',
            'product_addip' => 'Product Addip',
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

        $criteria->compare('product_id', $this->product_id, true);
        $criteria->compare('product_user_id', $this->product_user_id);
        $criteria->compare('product_type', $this->product_type);
        $criteria->compare('product_name', $this->product_name, true);
        $criteria->compare('product_s_img', $this->product_s_img, true);
        $criteria->compare('product_m_img', $this->product_m_img, true);
        $criteria->compare('product_b_img', $this->product_b_img, true);
        $criteria->compare('product_price', $this->product_price, true);
        $criteria->compare('product_description', $this->product_description, true);
        $criteria->compare('product_info', $this->product_info, true);
        $criteria->compare('product_num', $this->product_num);
        $criteria->compare('product_status', $this->product_status);
        $criteria->compare('product_addtime', $this->product_addtime);
        $criteria->compare('product_addip', $this->product_addip, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Product the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 
     * 保存数据之前进行处理
     */
    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->product_addtime = time();
                $this->product_addip = Yii::app()->request->userHostAddress;
            }
            return true;
        } else {
            return false;
        }
    }

}
