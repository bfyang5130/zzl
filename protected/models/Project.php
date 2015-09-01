<?php

/**
 * This is the model class for table "{{project}}".
 *
 * The followings are the available columns in table '{{project}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property integer $type
 * @property integer $collection_type
 * @property integer $account
 * @property integer $account_yes
 * @property string $account_one
 * @property integer $account_lixi
 * @property string $account_danbao
 * @property integer $account_use
 * @property integer $status
 * @property integer $intime
 * @property integer $low_account
 * @property integer $area_limit
 * @property string $iplimit
 * @property string $litt_pic
 * @property integer $pic_limit
 * @property string $content
 * @property integer $choutimes
 * @property integer $addtime
 * @property string $other_remark
 * @property integer $verify_time
 * @property integer $success_time
 * @property integer $cancel_time
 * @property string $remark
 * @property string $addip
 */
class Project extends CActiveRecord {

    /**
     * 处理筹资类型
     */
    public static function getTypeValue($value = null) {
        return Linkage::getValueChina($value, "project_type");
    }

    /**
     * 处理筹资类型
     */
    public static function getCollectionValue($value = null) {
        return Linkage::getValueChina($value, "collection_type");
    }

    /**
     * 处理筹资类型
     */
    public static function getDayLimitValue($value = null) {
        $returnarray = array(
            "1" => '1天',
            '2' => '2天',
            "3" => '3天',
            '4' => '4天',
            "5" => '5天',
            '6' => '6天',
            "7" => '7天',
            '8' => '8天',
            "9" => '9天',
            '10' => '10天',
            "11" => '11天',
            '12' => '12天',
            "13" => '13天',
            '14' => '14天',
            "15" => '15天'
        );
        if ($value == null) {
            return $returnarray;
        } else {
            if (!isset($returnarray[$value])) {
                return '';
            } else {
                return $returnarray[$value];
            }
        }
    }

    /**
     * 处理筹资类型
     */
    public static function getLowAccountLimitValue($value = null) {
        $returnarray = array(
            "1" => '1元',
            '50' => '50元',
            "100" => '100元',
            '500' => '500元',
            "1000" => '1000元',
            '5000' => '5000元',
            "10000" => '10000元',
            '50000' => '50000元',
        );
        if ($value == null) {
            return $returnarray;
        } else {
            if (!isset($returnarray[$value])) {
                return '';
            } else {
                return $returnarray[$value];
            }
        }
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
                $this->status = 0;
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
        return '{{project}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, title', 'required'),
            array('account, account_yes, account_lixi, account_use,low_account', 'numerical'),
            array('user_id, type, collection_type, status, intime, low_account, area_limit, pic_limit, choutimes, addtime, verify_time, success_time, cancel_time', 'numerical', 'integerOnly' => true),
            array('title, litt_pic, other_remark', 'length', 'max' => 255),
            array('account_one, account_danbao, iplimit', 'length', 'max' => 11),
            array('remark', 'length', 'max' => 500),
            array('addip', 'length', 'max' => 100),
            array('content', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, title, type, collection_type, account, account_yes, account_one, account_lixi, account_danbao, account_use, status, intime, low_account, area_limit, iplimit, litt_pic, pic_limit, content, choutimes, addtime, other_remark, verify_time, success_time, cancel_time, remark, addip', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => '主键ID',
            'user_id' => '用户id',
            'title' => '项目标题',
            'type' => '类型',
            'collection_type' => '筹资方式',
            'account' => '筹资金额',
            'account_yes' => '已筹资金额',
            'account_one' => '单个商品价格',
            'account_lixi' => '筹资者收益',
            'account_danbao' => '担保资金',
            'account_use' => '已经使用',
            'status' => '状态',
            'intime' => '筹资时间',
            'low_account' => '最低筹资金额',
            'area_limit' => '城市限制',
            'iplimit' => '单个区域限制筹资人数',
            'litt_pic' => '形象图片',
            'pic_limit' => '轮播图限制',
            'content' => '内容',
            'choutimes' => '筹资次数',
            'addtime' => '添加时间',
            'other_remark' => '其他信息',
            'verify_time' => '初审时间',
            'success_time' => '成功时间',
            'cancel_time' => '撤消时间',
            'remark' => 'Remark',
            'addip' => '添加的IP',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('type', $this->type);
        $criteria->compare('collection_type', $this->collection_type);
        $criteria->compare('account', $this->account);
        $criteria->compare('account_yes', $this->account_yes);
        $criteria->compare('account_one', $this->account_one, true);
        $criteria->compare('account_lixi', $this->account_lixi);
        $criteria->compare('account_danbao', $this->account_danbao, true);
        $criteria->compare('account_use', $this->account_use);
        $criteria->compare('status', $this->status);
        $criteria->compare('intime', $this->intime);
        $criteria->compare('low_account', $this->low_account);
        $criteria->compare('area_limit', $this->area_limit);
        $criteria->compare('iplimit', $this->iplimit, true);
        $criteria->compare('litt_pic', $this->litt_pic, true);
        $criteria->compare('pic_limit', $this->pic_limit);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('choutimes', $this->choutimes);
        $criteria->compare('addtime', $this->addtime);
        $criteria->compare('other_remark', $this->other_remark, true);
        $criteria->compare('verify_time', $this->verify_time);
        $criteria->compare('success_time', $this->success_time);
        $criteria->compare('cancel_time', $this->cancel_time);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('addip', $this->addip, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Project the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
