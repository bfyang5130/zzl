<?php

class UserController extends AbscontentController {

    public $layout = '//layouts/member_common';

    /**
     * 基本信息
     */
    public function actionIndex() {
        $thisuser = Users::model()->findByPk(Yii::app()->user->getId());
        $this->render('user_index', array("thisuser" => $thisuser));
    }

    /**
     * 安全信息
     */
    public function actionSafe() {
        $thisuser = Users::model()->findByPk(Yii::app()->user->getId());
        if (isset($_POST['Users'])) {
            $_POST['Users'] = $thisuser->checkUser($_POST['Users']);
            $thisuser->setAttributes($_POST['Users']);
            foreach ((array) $_POST['Users'] as $key => $value) {
                if (trim($value) == '') {
                    $thisuser->addError($key, "字段不能为空");
                    break;
                }
            }
            if (!$thisuser->getErrors()) {

                if ($thisuser->validate()) {
                    $thisuser->setAttribute("real_status", 1);
                    if (!$thisuser->update()) {
                        $thisuser->addError("realname", "更新失败");
                    }
                } else {

                    $thisuser->addError("realname", "更新失败");
                }
            }
        }
        $this->render('safe', array("thisuser" => $thisuser));
    }

    /**
     * 城市联动
     */
    public function actionUpdateCities() {
        //Cities
        //增加缓冲数据
        $citystring = "city_";
        $data = Yii::app()->cache->get($citystring . (int) $_POST['idProvince']);
        if (!$data) {
            $dataCity = City::model()->findAll('father=:idProvince', array(':idProvince' => (int) $_POST['idProvince']));
            if (!$dataCity) {
                $dataCity = Province::model()->findAll('provinceID=:idProvince', array(':idProvince' => (int) $_POST['idProvince']));
                $data = CHtml::listData($dataCity, 'provinceID', 'province');
            } else {
                $data = CHtml::listData($dataCity, 'cityID', 'city');
            }
            Yii::app()->cache->set($citystring . (int) $_POST['idProvince'], $data);
        }

        $dropDownCities = "<option value=''>选择城市</option>";
        foreach ($data as $value => $name) {
            $dropDownCities .= CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
        //District
        $dropDownDistricts = "<option value='null'>选择区域</option>";

        // return data (JSON formatted)
        echo CJSON::encode(array(
            'dropDownCities' => $dropDownCities,
            'dropDownDistricts' => $dropDownDistricts
        ));
    }

    /**
     * 地区联动
     */
    public function actionUpdateDistricts() {
        $areastring = "area_";
        $data = Yii::app()->cache->get($areastring . (int) $_POST['idCity']);
        if (!$data) {
            $dataArea = Area::model()->findAll('father=:idCity', array(':idCity' => (int) $_POST['idCity']));
            if (!$dataArea) {
                $dataArea = City::model()->findAll('cityID=:idCity', array(':idCity' => (int) $_POST['idCity']));
                if (!$dataArea) {
                    $dataArea = Province::model()->findAll('provinceID=:idCity', array(':idCity' => (int) $_POST['idCity']));
                    $data = CHtml::listData($dataArea, 'provinceID', 'province');
                } else {
                    $data = CHtml::listData($dataArea, 'cityID', 'city');
                }
            } else {
                $data = CHtml::listData($dataArea, 'areaID', 'area');
            }

            Yii::app()->cache->set($areastring . (int) $_POST['idCity'], $data);
        }

        echo "<option value=''>选择区域</option>";
        foreach ($data as $value => $name)
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
    }

    /**
     * 信誉等级
     */
    public function actionCredit() {
        $this->render('credit_index');
    }

    /**
     * 头像上传
     */
    public function actionUploadify() {
        if (isset($_POST['picsubmit'])) {//头像的上传
            $msg="";
            $newpicx1 = $_POST['picx1'];
            $newpicx2 = $_POST['picx2'];
            $newpicy1 = $_POST['picy1'];
            $newpicy2 = $_POST['picy2'];
            $picwidth = $_POST['picwidth'];
            $picheight = $_POST['picheight'];
            //计算实际要截取的位置
            if ($picwidth == 0 || empty($picwidth)) {
                $picwidth = 1;
            }
            $truepicx1 = $newpicx1 * $picwidth / 450;
            $truepicx2 = $newpicx2 * $picwidth / 450 - $truepicx1;
            if ($picheight == 0 || empty($picheight)) {
                $picheight = 0;
            }
            $truepicy1 = $newpicy1 * $picheight / 320;
            $truepicy2 = $newpicy2 * $picheight / 320 - $truepicy1;
            //获得原始图像所在位置
            $filename = $_POST['picfilename'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . "/themes/zuanzuanle/images/temp/upload/" . $filename;
            $fileParts = pathinfo($targetPath);
            //读取图片
            switch ($fileParts['extension']) {
                case 'gif':$im = imagecreatefromgif($targetPath);
                    break;
                case 'jpeg':$im = imagecreatefromjpeg($targetPath);
                    break;
                case 'jpg':$im = imagecreatefromjpeg($targetPath);
                    break;
                case 'png':$im = imagecreatefrompng($targetPath);
                    break;
                default :$msg = "头像不正确!上传失败";
            }
            if ($msg == "") {
                //图片截取长度
                $new_img_width = 150;
                $new_img_height = 150;
                //建立空白图片
                $newim = imagecreatetruecolor($new_img_width, $new_img_height);
                //截取此图片到的位置
                imagecopyresampled($newim, $im, 0, 0, $truepicx1, $truepicy1, 150, 150, $truepicx2, $truepicy2);
                /* 将图印出来 */
                $filename = explode("_", $filename);
                $filename = $filename[1];
                switch ($fileParts['extension']) {
                    case 'gif':imagegif($newim, $_SERVER['DOCUMENT_ROOT'] . "/data/upload/avatar/avatar_" . $filename, 100);
                        break;
                    case 'jpeg':imagejpeg($newim, $_SERVER['DOCUMENT_ROOT'] . "/data/upload/avatar/avatar_" . $filename, 100);
                        break;
                    case 'jpg':imagejpeg($newim, $_SERVER['DOCUMENT_ROOT'] . "/data/upload/avatar/avatar_" . $filename, 100);
                        break;
                    case 'png':imagepng($newim, $_SERVER['DOCUMENT_ROOT'] . "/data/upload/avatar/avatar_" . $filename, 0);
                        break;
                    default :return fasle;
                }

                /* 资源回收 */
                imagedestroy($newim);
                imagedestroy($im);
                //更改个人头像的地址
                $dirfilename="/data/upload/avatar/avatar_".$filename;
                Users::model()->updateAll(array("litpic" => $dirfilename), " user_id=:user_id ", array(":user_id" => Yii::app()->user->getId()));
                Yii::app()->user->setState('_litpic', $dirfilename); 
                Yii::app()->user->setFlash('success', "头像上传成功！");
                Yii::app()->user->setFlash('reurl', "/member/user/index.html#tab=tab1");
                $this->redirect("/notice/success.html");
            } else {
                //邮箱已经被激活，不能再激活
                Yii::app()->user->setFlash('fail', "头像上传失败!");
                Yii::app()->user->setFlash('reurl', "/member/user/index.html#tab=tab1");
                $this->redirect("/notice/errors.html");
            }
        }
// Define a destination
        $targetFolder = "/themes/zuanzuanle/images/temp/upload"; // Relative to the root
        $verifyToken = md5('unique_salt' . $_POST['timestamp']);

        if (!empty($_FILES) && $_POST['token'] == $verifyToken) {

            $imagarray = array();
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
//重命名图片名称
// Validate the file type
            $fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);
            $imgname = "temp_" . time() . rand(10000, 99999) . "." . $fileParts['extension'];
            $targetFile = rtrim($targetPath, '/') . '/' . $imgname;
            if (in_array($fileParts['extension'], $fileTypes)) {
                chmod($tempFile, 0755);
                move_uploaded_file($tempFile, $targetFile);
                list($width, $height) = getimagesize($targetFile);
                $imagarray['path'] = $imgname;
                $imagarray['width'] = $width;
                $imagarray['height'] = $height;
                echo json_encode($imagarray);
            } else {
                echo 'Invalid file type.';
            }
        }
    }

}
