<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MailTemplet
 *
 * @author bfyang
 */
class MailTemplet {

    /**
     * 获得激活邮件的模板
     */
    public static function getActiveEmail($username = "", $activecode = "") {
        $msg = "<h3>亲爱的" . $username . ": </h3><p>您在赚赚乐的激活链接地址为:<a href=" . Yii::app()->params['main_site'] . "/user/activeMail?token=" . $activecode . ">" . Yii::app()->params['main_site'] . "/user/activeMail?token=" . $activecode . "</a>请在1小时之内激活。否则将失效 ( 如无法点击激活，可复制到浏览器地址栏进行打开 )</p>";
        return $msg;
    }

}

?>
