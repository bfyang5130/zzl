<?php

#获得用户有没有中奖
if (isset($_GET['id'])) {
    $result = ProductCoupon::model()->find('user_id=:user_id', array(':user_id' => $_GET['id']));
    if ($result) {
        $text = '恭喜您！中奖啦！';
    } else {
        $text = '很遗憾，没有中奖呢。';
    }
} else {
    $text = '很遗憾，没有中奖呢。';
}
$im = imagecreatetruecolor(400, 30);            //创建400 30像素大小的画布

$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);

imagefilledrectangle($im, 0, 0, 399, 29, $white);       //输出一个使用白色填充的矩形作为背景
//如果有中文输出，需要将其转码，转换为UTF-8的字符串才可以直接传递
#$text = ic("GB2312", "UTF-8", "回忆经典");
//设定字体，将系统中与simsun.ttc对应的字体复制到当前目录下
$font = Yii::app()->theme->baseUrl . '/fonts/simsun.ttc';

//imagettftext($im, 20, 0, 12, 21, $grey, $font, $text);      //输出一个灰色的字符串作为阴影
imagettftext($im, 14, 0, 10, 20, $black, $font, $text);         //在阴影上输出一个黑色的字符串

header("Content-type: image/png");
imagepng($im);

imagedestroy($im);
