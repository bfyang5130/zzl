<?php

class ProductController extends AbsWechatController {

    public $layout = '//layouts/wechat_common';

    public function actionIndex() {
        $this->pageTitle = "商品中心";
        $this->render('product_index');
    }

}
