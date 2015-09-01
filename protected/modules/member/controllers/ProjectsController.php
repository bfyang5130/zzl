<?php

class ProjectsController extends AbscontentController {

    public $layout = '//layouts/member_common';
    public $defaultaction = "publishing";

    /**
     * 筹资项目发布
     */
    public function actionPublishing() {
        $this->render('publishing');
    }

    /**
     * 项目修改
     */
    public function actionEditer() {
        #获得是否存在项目
        if (!isset($_REQUEST['id'])) {
            $errorarray = array(
                0 => 'fail',
                1 => '错误的操作！',
                2 => 'reurl',
                3 => Yii::app()->request->urlReferrer,
                4 => '/notice/errors.html',
            );
            //跳转到错误的页面
            parent::toUrl($errorarray);
        }
        $thisproject = Project::model()->findByPk($_REQUEST['id'], "user_id=:user_id AND status=0", array(":user_id" => Yii::app()->user->getId()));
        if (!$thisproject) {
            $errorarray = array(
                0 => 'fail',
                1 => '错误的操作！',
                2 => 'reurl',
                3 => Yii::app()->request->urlReferrer,
                4 => '/notice/errors.html',
            );
            //跳转到错误的页面
            parent::toUrl($errorarray);
        }
        $error = "";
        if (isset($_POST['Project'])) {//项目修改处理
            if ($thisproject->type == 3) {
                $editer_array = array('title', 'intime', 'content', 'litt_pic');
                foreach ($_POST['Project'] as $key => $value) {
                    if (!in_array($key, $editer_array)) {
                        unset($_POST['Project'][$key]);
                    }
                }
            }
            $thisproject->setAttributes($_POST['Project']);
            if ($thisproject->validate()) {
                $thisproject->update();
            }
        }
        $thisproject->setAttribute("low_account", intval($thisproject->low_account));
        if ($thisproject->type == 3) {
            $this->render('editer_taobao', array("thisproject" => $thisproject, "editer_error" => $error));
        } else {
            $this->render('editer', array("thisproject" => $thisproject, "editer_error" => $error));
        }
    }

    /**
     * 信用筹款的处理
     */
    public function actionEnding() {
        #获得是否存在项目
        if (!isset($_REQUEST['id'])) {
            $errorarray = array(
                0 => 'fail',
                1 => '错误的操作！',
                2 => 'reurl',
                3 => Yii::app()->request->urlReferrer,
                4 => '/notice/errors.html',
            );
            //跳转到错误的页面
            parent::toUrl($errorarray);
        }
        $thisproject = Project::model()->findByPk($_REQUEST['id'], "user_id=:user_id AND status=1", array(":user_id" => Yii::app()->user->getId()));
        if (!$thisproject) {
            $errorarray = array(
                0 => 'fail',
                1 => '错误的操作！',
                2 => 'reurl',
                3 => Yii::app()->request->urlReferrer,
                4 => '/notice/errors.html',
            );
            //跳转到错误的页面
            parent::toUrl($errorarray);
        }
        $error = "";
        if (isset($_POST['Project'])) {//项目修改处理
            $thisproject->setAttributes($_POST['Project']);
            if ($thisproject->validate()) {
                $thisproject->update();
            }
        }
        $thisproject->setAttribute("low_account", intval($thisproject->low_account));
        $this->render('ending', array("thisproject" => $thisproject, "editer_error" => $error));
    }

    /**
     * 项目图片更改给轮播图片的更改
     */
    public function actionPicupload() {
        if (!empty($_FILES['fileToUpload']) && is_uploaded_file($_FILES['fileToUpload']['tmp_name']) && isset($_REQUEST['content'])) {
            #得到当前的数据是否属于当前的人
            $error = false;
            #不带有项目ID或者类型错误
            if (!isset($_REQUEST['pro_id']) || !isset($_REQUEST['type'])) {
                $error = '错误的操作';
            }
            #不属于此人的项目
            if ($error === false) {
                $oneProject = Project::model()->findByPk($_REQUEST['pro_id'], "user_id=:user_id", array(":user_id" => Yii::app()->user->getId()));
                if (!$oneProject) {
                    $error = '错误的操作';
                }
            }
            #没有对应的轮播ID
            if ($error === false) {
                if ($_REQUEST['type'] != "base" && $_REQUEST['type'] != "new") {
                    $thislunbopic = ProjectLunbo::model()->findByPk($_REQUEST['type'], "projects_id=:projects_id", array(":projects_id" => $oneProject->id));
                    if (!$thislunbopic) {
                        $error = $_REQUEST['type'];
                    } elseif (empty($_REQUEST['content'])) {
                        $error = '新轮播图缺少描述';
                    }
                }
            }
            if ($error === false) {
                #判断项目图片还是轮播图片
                if ($_REQUEST['type'] == "new") {
                    $nums = ProjectLunbo::model()->count("projects_id=:projects_id", array(":projects_id" => $oneProject->id));
                    if ($nums >= $oneProject->pic_limit) {//默认为5个，如果超过，要购买
                        $error = '轮播图片数已达上限，请购买！';
                    }
                }
            }
            if ($error === false) {
                //传输要保存的图片路径
                $picdir = Yii::app()->params['projectpic_dir'] . "/project";
                $_REQUEST['project_id'] = $_REQUEST['pro_id'];
                $res = parent::Uploadpic($picdir);
                if (isset($res['msg'])) {//上传成功
                    // //判断要处理的是什么图片
                    $uppicdir = Yii::app()->params['projectpic_predir'] . "/project/" . $res['dir'];
                    if ($_REQUEST['type'] == "base") {//项目图片
                        $result = Project::model()->updateByPk($oneProject->id, array("litt_pic" => $uppicdir));
                        if ($result) {
                            #删除原来的图片
                            @unlink(Yii::getPathOfAlias('webroot') . '/' . $oneProject->litt_pic);
                        }
                    } elseif ($_REQUEST['type'] == "new") {
                        $newLuanbo = new ProjectLunbo();
                        $newLuanbo->setAttributes(array(
                            'projects_id' => $oneProject->id,
                            'pic_address' => $uppicdir,
                            'pic_remark' => $_REQUEST['content'],
                            'pic_status' => 0
                        ));
                        if ($newLuanbo->validate() && $newLuanbo->save()) {
                            
                        } else {
                            $error = '图片增失败，请重试';
                        }
                    } else {
                        $result = ProjectLunbo::model()->updateByPk($thislunbopic->id, array("pic_address" => $uppicdir, 'pic_status' => 0, 'pic_remark' => $_REQUEST['content']));
                        if ($result) {
                            #删除原来的图片
                            @unlink(Yii::getPathOfAlias('webroot') . '/' . $thislunbopic->pic_address);
                        }
                    }
                }
            }
            if ($error === false) {
                $data = $res;
            } else {
                $data = array(
                    'msg' => 1,
                    'error' => $error
                );
            }
        } else {
            $data = array(
                'msg' => 1,
                'error' => $_REQUEST['content']
            );
        }
        echo json_encode($data);
        Yii::app()->end();
    }

    /**
     * 删除轮播图片
     */
    public function actionLubopic() {
        if (isset($_REQUEST['id']) && isset($_REQUEST['luobo_id'])) {
            #获得当前项目的拥有人
            $thisproject = Project::model()->findByPk($_REQUEST['id'], "user_id=:user_id", array(":user_id" => Yii::app()->user->getId()));
            if ($thisproject) {
                $thislunbopic = ProjectLunbo::model()->find("projects_id=:projects_id AND id=:id", array(":projects_id" => $thisproject->id, ":id" => $_REQUEST['luobo_id']));
                ProjectLunbo::model()->deleteAll("projects_id=:projects_id AND id=:id", array(":projects_id" => $thisproject->id, ":id" => $_REQUEST['luobo_id']));
                @unlink(Yii::getPathOfAlias('webroot') . '/' . $thislunbopic->pic_address);
            }
        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * 信用筹资的处理
     */

    /**
     * 详细页面
     */
    public function actionFittenders() {
        $this->renderPartial("fittenderlists", $_REQUEST);
        Yii::app()->end();
    }

    /**
     * 处理信用筹资的状态
     */
    public function actionFittenderstatus() {
        if (isset($_REQUEST['id']) && isset($_REQUEST['lunbo_id']) && isset($_REQUEST['status'])) {
            #直接更改属于这个人的数据
            #获得当前项目的拥有人
            $thisproject = Project::model()->findByPk($_REQUEST['id'], "user_id=:user_id", array(":user_id" => Yii::app()->user->getId()));
            if ($thisproject) {

                #查询是否存在这个筹资记录
                $thistender = Tender::model()->findByPk($_REQUEST['lunbo_id'], "project_id=:project_id", array(":project_id" => $thisproject->id));
                if ($thistender) {
                    //处理淘宝项目跟别的不一样
                    if ($thisproject->type == 3) {

                        $addip = Yii::app()->request->userHostAddress;
                        $user_id = Yii::app()->user->getId();
                        try {
                            $conn = Yii::app()->db;
                            $command = $conn->createCommand('call p_Fit_TaoBao_Tender(:user_id,:tender_id,:in_addip,@out_status,@out_remark)');
                            $command->bindParam(":user_id", $user_id, PDO::PARAM_INT);
                            $command->bindParam(":tender_id", $thistender->id, PDO::PARAM_INT);
                            $command->bindParam(":in_addip", $addip, PDO::PARAM_STR, 50);
                            $command->execute();
                            $result = $conn->createCommand("select @out_status as status,@out_remark as remark")->queryRow(true);
                            if ($result['status'] == 1) {
                                echo 1;
                            } else {
                                echo $result['remark'];
                            }
                        } catch (Exception $e) {
                            echo '系统繁忙，暂时无法处理';
                        }
                    } else {
                        $result = Tender::model()->updateByPk($_REQUEST['lunbo_id'], array("status" => $_REQUEST['status']));
                        #如果所有都处理完了，那么更新这个项目为成功的

                        if ($result) {
                            $nums = Tender::model()->count("project_id=:project_id AND status=0", array(":project_id" => $thisproject->id));
                            if ($nums == 0) {
                                Project::model()->updateByPk($thisproject->id, array("status" => 3));
                            }
                            echo 1;
                        } else {
                            echo '错误的操作';
                        }
                    }
                } else {
                    echo '错误的操作';
                }
            } else {
                echo '错误的操作';
            }
        } else {
            echo '错误的操作';
        }
        Yii::app()->end();
    }

    /**
     * 成功的筹资
     */
    public function actionSuccess() {
        $this->render('success');
    }

    /**
     * 成功筹资的管理
     */
    public function actionManage() {

        #获得是否存在项目
        if (!isset($_REQUEST['id'])) {
            $errorarray = array(
                0 => 'fail',
                1 => '错误的操作！',
                2 => 'reurl',
                3 => Yii::app()->request->urlReferrer,
                4 => '/notice/errors.html',
            );
            //跳转到错误的页面
            parent::toUrl($errorarray);
        }
        $thisproject = Project::model()->findByPk($_REQUEST['id'], "user_id=:user_id AND (status=3 OR type=3)", array(":user_id" => Yii::app()->user->getId()));
        $oneprojectuse = new ProjectUse();
        if (!$thisproject) {
            $errorarray = array(
                0 => 'fail',
                1 => '错误的操作！',
                2 => 'reurl',
                3 => Yii::app()->request->urlReferrer,
                4 => '/notice/errors.html',
            );
            //跳转到错误的页面
            parent::toUrl($errorarray);
        }
        $error = "";
        if (isset($_POST['ProjectUse']) && $thisproject->type != 3) {//项目修改处理
            $oneprojectuse->setAttributes($_POST['ProjectUse']);
            if ($thisproject->collection_type == 0) {
                $oneprojectuse->setAttribute("status", 1);
            }
            $oneprojectuse->setAttribute("project_id", $thisproject->id);
            $oneprojectuse->setAttribute("addtime", time());
            $oneprojectuse->setAttribute("addip", Yii::app()->request->userHostAddress);
            $oneprojectuse->setAttribute("user_id", Yii::app()->user->getId());
            if ($oneprojectuse->validate()) {
                $oneprojectuse->qys_save();
            }
        }
        if ($thisproject->type == 3) {
            $this->render('manage_taobao', array("thisproject" => $thisproject, 'oneprojectuse' => $oneprojectuse, "editer_error" => $error));
        } else {
            $this->render('manage', array("thisproject" => $thisproject, 'oneprojectuse' => $oneprojectuse, "editer_error" => $error));
        }
    }

    /**
     * 失败的筹资
     */
    public function actionFail() {
        $this->render('fail');
    }

    /**
     * 锁定赞助列表
     */
    public function actionLock() {
        if (!isset($_REQUEST['projectid']) || !isset($_REQUEST['tenderid'])) {
            $errorarray = array(
                0 => 'fail',
                1 => '错误的操作！',
                2 => 'reurl',
                3 => Yii::app()->request->urlReferrer,
                4 => '/notice/errors.html',
            );
            //跳转到错误的页面
            parent::toUrl($errorarray);
        } else {
            if (empty($_REQUEST['projectid']) || empty($_REQUEST['tenderid'])) {
                $errorarray = array(
                    0 => 'fail',
                    1 => '错误的操作！',
                    2 => 'reurl',
                    3 => Yii::app()->request->urlReferrer,
                    4 => '/notice/errors.html',
                );
                //跳转到错误的页面
                parent::toUrl($errorarray);
            }
        }
        $user_id = Yii::app()->user->getId();
        try {
            $conn = Yii::app()->db;
            $command = $conn->createCommand('call p_lock_oneTender(:user_id,:project_id,:tender_id,@out_status,@out_remark)');
            $command->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $command->bindParam(":project_id", $_REQUEST['projectid'], PDO::PARAM_INT);
            $command->bindParam(":tender_id", $_REQUEST['tenderid'], PDO::PARAM_INT);
            $command->execute();
            $result = $conn->createCommand("select @out_status as status,@out_remark as remark")->queryRow(true);
            if ($result['status'] == 1) {
                $errorarray = array(
                    0 => 'success',
                    1 => "处理成功",
                    2 => 'reurl',
                    3 => Yii::app()->request->urlReferrer,
                    4 => '/notice/success.html',
                );
                //跳转到错误的页面
                parent::toUrl($errorarray);
            } else {
                $errorarray = array(
                    0 => 'fail',
                    1 => $result['remark'],
                    2 => 'reurl',
                    3 => Yii::app()->request->urlReferrer,
                    4 => '/notice/errors.html',
                );
                //跳转到错误的页面
                parent::toUrl($errorarray);
            }
        } catch (Exception $e) {
            $errorarray = array(
                0 => 'fail',
                1 => '系统繁忙，暂时无法处理！',
                2 => 'reurl',
                3 => Yii::app()->request->urlReferrer,
                4 => '/notice/errors.html',
            );
            //跳转到错误的页面
            parent::toUrl($errorarray);
        }
    }

}
