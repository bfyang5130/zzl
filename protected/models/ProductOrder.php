<?php

/**
 * This is the model class for table "{{product_order}}".
 *
 * The followings are the available columns in table '{{product_order}}':
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $user_id
 * @property integer $p_user_id
 * @property string $order_price
 * @property string $order_pay_price
 * @property integer $coupon_id
 * @property integer $order_status
 * @property string $realname
 * @property string $phone
 * @property string $address
 * @property integer $addtime
 * @property string $addip
 */
class ProductOrder extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{product_order}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('order_id, product_id, user_id', 'required'),
            array('order_id, product_id, user_id, p_user_id, coupon_id, order_status, addtime', 'numerical', 'integerOnly' => true),
            array('realname, phone, addip', 'length', 'max' => 100),
            array('order_price, order_pay_price', 'length', 'max' => 10),
            array('address', 'length', 'max' => 300),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('order_id, product_id, user_id, p_user_id, order_price, order_pay_price, coupon_id, order_status, realname, phone, address, addtime, addip', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'order_id' => 'Order',
            'product_id' => 'Product',
            'user_id' => 'User',
            'p_user_id' => 'P User',
            'order_price' => 'Order Price',
            'order_pay_price' => 'Order Pay Price',
            'coupon_id' => 'Coupon',
            'order_status' => 'Order Status',
            'realname' => 'Realname',
            'phone' => 'Phone',
            'address' => 'Address',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('order_id', $this->order_id);
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('p_user_id', $this->p_user_id);
        $criteria->compare('order_price', $this->order_price, true);
        $criteria->compare('order_pay_price', $this->order_pay_price, true);
        $criteria->compare('coupon_id', $this->coupon_id);
        $criteria->compare('order_status', $this->order_status);
        $criteria->compare('realname', $this->realname, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('addtime', $this->addtime);
        $criteria->compare('addip', $this->addip, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ProductOrder the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
