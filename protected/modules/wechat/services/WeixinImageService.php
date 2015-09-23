<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WeixinKeyWordService
 *
 * @author Administrator
 */
class WeixinImageService {

    /**
     * 微信处理图片
     */
    public static function fitImage($obj,Users $user) {
     #获得图片地址
        $pic=  file_get_contents($obj->PicUrl);
        file_put_contents(Yii::getPathOfAlias('webroot').'/protected/runtime/1.gif',$pic); 
        $content = "已经保存。";
        WechatCheck::_transmitText($obj, $content);
    }

}

?>
