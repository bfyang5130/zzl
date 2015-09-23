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
     * 选择图片
     */
    public function actionChangePro() {
        $this->pageTitle = "修改商品";
        $user_id = Yii::app()->user->getId();
        if (isset($_GET['id'])) {
            $product = Product::model()->find("product_id=:pid and product_user_id=:uid", array(":pid" => $_GET['id'], ":uid" => $user_id));
            if ($product) {
                $this->render('product_ch', array("product" => $product));
                Yii::app()->end();
            }
        }
        $this->redirect(Yii::app()->createUrl('/wechat/product/index'));
    }

}
