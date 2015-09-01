<?php

class PublishController extends AbscontentController {

    public $layout = '//layouts/member_common';
    public $defaultaction = "gongyi";

    /**
     * 筹资项目发布
     */
    public function actionGongyi() {
        //暂时不开放公益项目的分布
        $errorarray = array(
            0 => 'fail',
            1 => '暂时不开放当前类型项目发布！',
            2 => 'reurl',
            3 => Yii::app()->request->urlReferrer,
            4 => '/notice/errors.html',
        );
        //跳转到错误的页面
        parent::toUrl($errorarray);
        Yii::app()->end();
        $this->layout = "//layouts/member_html5";
        $error = "";
        if (isset($_POST['title'])) {//发布项目处理
            $_POST['type'] = 1;
            $_POST['collection_type'] = 1;
            $va_param = $_POST;
            unset($va_param['publis_submit']);
            unset($va_param['picname']);
            Yii::import("application.models.form.ProjectForm", true);
            //形象图片处理
            $attch = CUploadedFile::getInstanceByName("picname");
            $error = "";

            if ($attch == null) {
                $name = Yii::app()->theme->baseUrl . "/images/projectdefault.png";
            } elseif ($attch->size > 1024 * 1024) {
                $error = "形象图片不超过1M";
            } elseif (!in_array(strtolower($attch->extensionName), array("jpeg", "jpg", "gif", "png"))) {
                $error = "上传的图片格式不正确";
            } else {

                $filename = "user_" . Yii::app()->user->getId() . "_" . time() . "." . strtolower($attch->extensionName);
                $path = "/data/upload/project/" . date("Y-m-d") . "/";
                $filepath = Yii::getPathOfAlias('webroot') . $path . $filename;
                $name = $path . $filename;
                if (BaseTool::createFolder($path)) {
                    if (!$attch->saveAs($filepath)) {
                        $error = "形象图片上传出错";
                    }
                }
            }
            if (empty($error)) {
                $va_param['litt_pic'] = $name;
                $oneProjectForm = new ProjectForm();
                $oneProjectForm->scenario = 'gongyi';
                $oneProjectForm->setAttributes($va_param);
                if ($oneProjectForm->validate()) {
                    $oneProjectForm->save($va_param);
                    $this->redirect("/member/projects/publishing.html");
                    Yii::app()->end();
                } else {
                    $errorarray = $oneProjectForm->getErrors();
                    $error = current(current($errorarray));
                }
            }
        }
        $this->pageTitle = "发布项目-" . Yii::app()->name;
        $this->render('gongyi', array("publish_error" => $error));
    }

    /**
     * 个人作品
     */
    public function actionPersonart() {
        //暂时不开放公益项目的分布
        $errorarray = array(
            0 => 'fail',
            1 => '暂时不开放当前类型项目发布！',
            2 => 'reurl',
            3 => Yii::app()->request->urlReferrer,
            4 => '/notice/errors.html',
        );
        //跳转到错误的页面
        parent::toUrl($errorarray);
        Yii::app()->end();
        $this->layout = "//layouts/member_html5";
        $error = "";
        if (isset($_POST['title'])) {//发布项目处理
            $_POST['type'] = 2;
            $va_param = $_POST;
            unset($va_param['publis_submit']);
            unset($va_param['picname']);
            Yii::import("application.models.form.ProjectForm", true);
            //形象图片处理
            $attch = CUploadedFile::getInstanceByName("picname");
            $error = "";

            if ($attch == null) {
                $name = Yii::app()->theme->baseUrl . "/images/projectdefault.png";
            } elseif ($attch->size > 1024 * 1024) {
                $error = "形象图片不超过1M";
            } elseif (!in_array(strtolower($attch->extensionName), array("jpeg", "jpg", "gif", "png"))) {
                $error = "上传的图片格式不正确";
            } else {

                $filename = "user_" . Yii::app()->user->getId() . "_" . time() . "." . strtolower($attch->extensionName);
                $path = "/data/upload/project/" . date("Y-m-d") . "/";
                $filepath = Yii::getPathOfAlias('webroot') . $path . $filename;
                $name = $path . $filename;
                if (BaseTool::createFolder($path)) {
                    if (!$attch->saveAs($filepath)) {
                        $error = "形象图片上传出错";
                    }
                }
            }
            if (empty($error)) {
                $va_param['litt_pic'] = $name;
                $oneProjectForm = new ProjectForm();
                $oneProjectForm->scenario = 'art';
                $oneProjectForm->setAttributes($va_param);
                if ($oneProjectForm->validate()) {
                    $oneProjectForm->save($va_param);
                    $this->redirect("/member/projects/publishing.html");
                    Yii::app()->end();
                } else {
                    $errorarray = $oneProjectForm->getErrors();
                    $error = current(current($errorarray));
                }
            }
        }
        $this->pageTitle = "发布项目-" . Yii::app()->name;
        $this->render('personart', array("publish_error" => $error));
    }

    /**
     * 淘宝项目
     */
    public function actionTaobao() {
        $this->layout = "//layouts/member_html5";
        $error = "";
        if (isset($_POST['title'])) {//发布项目处理
            $_POST['type'] = 3;
            $_POST['low_account'] = 50;
            $va_param = $_POST;
            unset($va_param['publis_submit']);
            unset($va_param['picname']);
            Yii::import("application.models.form.ProjectForm", true);
            //形象图片处理
            $attch = CUploadedFile::getInstanceByName("picname");
            $error = "";

            if ($attch == null) {
                $name = Yii::app()->theme->baseUrl . "/images/projectdefault.png";
            } elseif ($attch->size > 1024 * 1024) {
                $error = "形象图片不超过1M";
            } elseif (!in_array(strtolower($attch->extensionName), array("jpeg", "jpg", "gif", "png"))) {
                $error = "上传的图片格式不正确";
            } else {

                $filename = "user_" . Yii::app()->user->getId() . "_" . time() . "." . strtolower($attch->extensionName);
                $path = "/data/upload/project/" . date("Y-m-d") . "/";
                $filepath = Yii::getPathOfAlias('webroot'). $path . $filename;
                $name = $path . $filename;
                if (BaseTool::createFolder($path)) {
                    if (!$attch->saveAs($filepath)) {
                        $error = "形象图片上传出错";
                    }
                }
            }
            if (empty($error)) {
                $va_param['litt_pic'] = $name;
                $oneProjectForm = new ProjectForm();
                $oneProjectForm->scenario = 'taobao';
                $oneProjectForm->setAttributes($va_param);
                if ($oneProjectForm->validate()) {
                    $va_param['account'] = $va_param['account_one'] * $va_param['choutimes'];
                    $result = $oneProjectForm->taobaoSave($va_param);
                    if ($result === true) {
                        $this->redirect("/member/projects/publishing.html");
                        Yii::app()->end();
                    } else {
                        $errorarray = $oneProjectForm->getErrors();
                        $error = current(current($errorarray));
                    }
                } else {
                    $errorarray = $oneProjectForm->getErrors();
                    $error = current(current($errorarray));
                }
            }
        }
        $this->pageTitle = "发布项目-" . Yii::app()->name;
        $this->render('taobao', array("publish_error" => $error));
    }

}
