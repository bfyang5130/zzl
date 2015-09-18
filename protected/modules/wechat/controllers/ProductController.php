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
        $this->render('product_add');
        
    }

}
