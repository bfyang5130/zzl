<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MemberService
 *
 * @author qinyangsheng
 */
class MemberService {

//保存或者更新用户的送货地址
    public static function saveProAddress(UserProudctAddress $userprodaddress, $user_id) {

        $_POST['UserProudctAddress']['province'] = 'xx';
        $_POST['UserProudctAddress']['city'] = 'xx';
        $_POST['UserProudctAddress']['area'] = 'xx';
        $_POST['UserProudctAddress']['sysaddress'] = 'xx';
        if (isset($_POST['province'])) {
            $_POST['UserProudctAddress']['province'] = $_POST['province'];
            $provincename = Province::model()->find("provinceID=:proid", array(":proid" => $_POST['UserProudctAddress']['province']));
            if ($provincename) {
                $_POST['UserProudctAddress']['sysaddress'] = $provincename->province;
            }
        }
        if (isset($_POST['city'])) {
            $_POST['UserProudctAddress']['city'] = $_POST['city'];
            $cityname = City::model()->find("cityID=:cityid", array(":cityid" => $_POST['UserProudctAddress']['city']));
            if ($cityname) {
                $_POST['UserProudctAddress']['sysaddress'] .= $cityname->city;
            }
        }
        if (isset($_POST['area'])) {
            $_POST['UserProudctAddress']['area'] = $_POST['area'];
            $areaname = Area::model()->find("areaID=:areaid", array(":areaid" => $_POST['UserProudctAddress']['area']));
            if ($areaname) {
                $_POST['UserProudctAddress']['sysaddress'] .= $areaname->area;
            }
        }
        $_POST['UserProudctAddress']['user_id'] = $user_id;
        $userprodaddress->setAttributes($_POST['UserProudctAddress']);
        foreach ((array) $_POST['UserProudctAddress'] as $key => $value) {
            if (trim($value) == '') {
                $userprodaddress->addError($key, "字段不能为空");
                break;
            }
        }
        if (!$userprodaddress->getErrors()) {
            $userprodaddress->setAttribute('addtime', time());
            $userprodaddress->setAttribute('addip', Yii::app()->request->userHostAddress);
            if ($userprodaddress->validate()) {
                if ($userprodaddress->isNewRecord) {
                    $result = $userprodaddress->save();
                } else {
                    $result = $userprodaddress->update();
                }
                if (!$result) {
                    $userprodaddress->addError("realname", "更新失败");
                }
            } else {
                $userprodaddress->addError("realname", "更新失败");
            }
        }
        return $userprodaddress;
    }

}
