<?php

class ProductController extends AbsWechatController {

    public $layout = '//layouts/wechat_common';

    public function actionIndex() {
        $this->render('product_index');
    }

}
