<?php

class ProductController extends AbsWechatController {

    public $layout = '//layouts/wechat_common';

    /**
     * 商品中心
     */
    public function actionIndex() {
        $this->pageTitle = "商品中心";

        $this->render('product_index');
    }

    /**
     * 添加商品
     */
    public function actionAddProduct() {
        $this->pageTitle = "添加商品";
        $product = new Product();
        if (isset($_POST) && isset($_POST['Product'])) {
            $_POST['Product']['product_user_id'] = Yii::app()->user->getId();
            $product->setAttributes($_POST['Product']);
            if ($product->validate() && $product->save()) {
                $this->redirect(Yii::app()->createUrl('/wechat/product/changePro/id/' . $product->product_id));
                Yii::app()->end();
            }
        }
        $this->render('product_add', array("product" => $product));
    }

    /**
     * 记录订单
     */
    public function actionOrder() {
        $this->pageTitle = "购买商品";
        $error = "";
        if (isset($_GET['id'])) {
            $pid = $_GET['id'];
            $product = Product::model()->findByPk($pid);
            if ($product) {
                #获得用户的可用资金
                $user_id = Yii::app()->user->getId();
                #判断用户是否已经填写了送货地址
                $userAddress = UserProudctAddress::model()->find("user_id=:user_id", array(":user_id" => $user_id));
                if ($userAddress) {
                    $userAccount = Account::model()->find("user_id=:user_id", array(":user_id" => $user_id));
                    if (!$userAccount->use_money < $product->product_price) {
                        #调有存储过程冻结资金并生成订单
                        try {
                            $addip = Yii::app()->request->getUserHostAddress();
                            $in_order_price = $in_order_pay_price = $product->product_price;
                            $in_coupon_id = 0;
                            $in_p_user_id = $product->product_user_id;
                            $p_id = $product->product_id;
                            $in_realname = $userAddress->realname;
                            $in_phone = $userAddress->phone;
                            $in_address = $userAddress->address;
                            $conn = Yii::app()->db;
                            $command = $conn->createCommand('call p_build_Product_Order(:in_user_id,:in_p_user_id,:p_id,:in_order_price,:in_order_pay_price,:in_coupon_id,:in_realname,:in_phone,:in_address,:in_addip,@out_status,@out_remark)');
                            $command->bindParam(":in_user_id", $user_id, PDO::PARAM_INT);
                            $command->bindParam(":in_p_user_id", $in_p_user_id, PDO::PARAM_INT);
                            $command->bindParam(":p_id", $p_id, PDO::PARAM_INT);
                            $command->bindParam(":in_order_price", $in_order_price, PDO::PARAM_STR, 30);
                            $command->bindParam(":in_order_pay_price", $in_order_pay_price, PDO::PARAM_STR, 30);
                            $command->bindParam(":in_coupon_id", $in_coupon_id, PDO::PARAM_INT);
                            $command->bindParam(":in_realname", $in_realname, PDO::PARAM_STR, 30);
                            $command->bindParam(":in_phone", $in_phone, PDO::PARAM_STR, 30);
                            $command->bindParam(":in_address", $in_address, PDO::PARAM_STR, 200);
                            $command->bindParam(":in_addip", $addip, PDO::PARAM_STR, 50);
                            $command->execute();
                            $result = $conn->createCommand("select @out_status as status,@out_remark as remark")->queryRow(true);
                            if ($result['status'] == 1) {
                                $error = '购买成功！';
                                $notices = array(
                                    'type' => 3,
                                    'msgtitle' => '错误信息',
                                    'message' => $error,
                                    'backurl' => Yii::app()->request->urlReferrer,
                                    'backtitle' => '返回',
                                    'tourl' => Yii::app()->createUrl('/wechat/member/myProduct'),
                                    'totitle' => '查看订单'
                                );
                            } else {
                                $error = $result['remark'];
                                $notices = array('type' => 2, 'msgtitle' => '错误信息', 'message' => $error, 'backurl' => Yii::app()->request->urlReferrer, 'backtitle' => '返回');
                            }
                        } catch (Exception $e) {
                            $error = '系统繁忙，暂时无法处理';
                            $notices = array('type' => 2, 'msgtitle' => '错误信息', 'message' => $error, 'backurl' => Yii::app()->request->urlReferrer, 'backtitle' => '返回');
                        }
                    } else {
                        #跳转到充值页面
                        $error = "你的可用资金不足以购买此商品。";
                        $notices = array(
                            'type' => 3,
                            'msgtitle' => '错误信息',
                            'message' => $error,
                            'backurl' => Yii::app()->request->urlReferrer,
                            'backtitle' => '返回',
                            'tourl' => Yii::app()->createUrl('/wechat/member/addmoney'),
                            'totitle' => '前往充值'
                        );
                    }
                } else {
                    #跳转到充值页面
                    $error = "您没有填写收货地址。";
                    $notices = array(
                        'type' => 3,
                        'msgtitle' => '错误信息',
                        'message' => $error,
                        'backurl' => Yii::app()->request->urlReferrer,
                        'backtitle' => '返回',
                        'tourl' => Yii::app()->createUrl('/wechat/member/proAddress'),
                        'totitle' => '完善送货地址'
                    );
                }
            } else {
                $error = "不存在此商品或者该商品已下架。";
                $notices = array('type' => 2, 'msgtitle' => '错误信息', 'message' => $error, 'backurl' => Yii::app()->request->urlReferrer, 'backtitle' => '返回');
            }
        } else {
            $error = "不存在此商品或者该商品已下架。";
            $notices = array('type' => 2, 'msgtitle' => '错误信息', 'message' => $error, 'backurl' => Yii::app()->request->urlReferrer, 'backtitle' => '返回');
        }
        #msg类型：type=1错误信息2指示跳转3返回跳转

        Yii::app()->user->setFlash('wechat_fail', array($notices));
        $this->redirect(Yii::app()->createUrl('wechat/notice/errors'));
    }

    /**
     * 选择图片
     */
    public function actionChangePro() {
        $this->pageTitle = "修改商品";
        $user_id = Yii::app()->user->getId();
        if (isset($_GET['id'])) {
            $product = Product::model()->find("product_id=:pid and product_user_id=:uid", array(":pid" => $_GET['id'], ":uid" => $user_id));
            if ($product) {
                if (isset($_POST) && isset($_POST['Product'])) {
                    #更改数据的处理
                    $picarray = $_POST['Product'];
                    if (isset($_POST['pic_id'])) {
                        $pic_select = Pic::model()->findByPk($_POST['pic_id'], "user_id=:user_id", array(":user_id" => $user_id));
                        if ($pic_select) {
                            $picarray['product_s_img'] = $pic_select->pic_s_img;
                            $picarray['product_m_img'] = $pic_select->pic_m_img;
                            $picarray['product_b_img'] = $pic_select->pic_b_img;
                        }
                    }
                    $product->setAttributes($picarray);
                    if ($product->validate() && $product->save()) {
                        $this->redirect(Yii::app()->createUrl('/wechat/product/addProduct'));
                    }
                }
                $this->render('product_ch', array("product" => $product));
                Yii::app()->end();
            }
        }
        $this->redirect(Yii::app()->createUrl('/wechat/product/index'));
    }

}
