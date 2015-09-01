<?php

class ToolController extends AbscontentController {

    public $layout = '//layouts/member_common';

    /**
     * 筹资项目发布
     */
    public function actionToolLogs() {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            switch ($id) {
                case 'zijin':$this->renderPartial("//member/index/pad/pad_zijinlogs");
                    break;
                case 'chongzhi':$this->renderPartial("//member/index/pad/pad_chongzhi");
                    break;
                case 'tixian':$this->renderPartial("//member/index/pad/pad_tixian");
                    break;
                default :echo '加载出错，请稍侯再试';
            }
        } else {
            echo '加载出错，请稍侯再试';
        }
    }

}
