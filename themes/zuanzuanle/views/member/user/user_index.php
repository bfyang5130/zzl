<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/uploadify.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/imgareaselect-default.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.uploadify.min.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.imgareaselect.pack.js');
if (!isset($_REQUEST['tab'])) {
    $_REQUEST['tab'] = '';
}
?>
<ul class="nav nav-tabs" role="tablist">
    <li <?php echo ($_REQUEST['tab'] == '') ? 'class="active"' : ''; ?>><a href="#tab0" role="tab" data-toggle="tab">基本信息</a></li>
    <li <?php echo ($_REQUEST['tab'] == 'tab1') ? 'class="active"' : ''; ?>><a href="#tab1" role="tab" data-toggle="tab">个人头像</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane <?php echo ($_REQUEST['tab'] == '') ? 'active' : ''; ?>" id="tab0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="border-top:none;">
                <tr>
                    <td colspan=2 style="border-top:none;color:red;"></td>
                </tr>
                <tr>
                    <td colspan=2 style="background-color: #ddd;font-weight: 900;">实名认证 <small style="float:right;"><a href="/member/user/safe.html">前往认证</a></small></td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">帐号名：</td>
                    <td class="qys_publish_td_right"><?php echo $thisuser->username; ?></td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">真实姓名：</td>
                    <td class="qys_publish_td_right"><?php echo $thisuser->realname; ?></td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">证件号码：</td>
                    <td class="qys_publish_td_right"><?php echo $thisuser->card_id; ?></td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">民族：</td>
                    <td class="qys_publish_td_right"><?php echo $thisuser->nation; ?></td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">所在地：</td>
                    <td class="qys_publish_td_right"></td>
                </tr>
                <tr>
                    <td colspan=2 style="background-color: #ddd;font-weight: 900;">手机认证 <small style="float:right;"><a href="/member/user/safe.html?tab=tab1">前往认证</a></small></td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">手机号码：</td>
                    <td class="qys_publish_td_right"><?php echo $thisuser->phone; ?></td>
                </tr>
                <tr>
                    <td colspan=2 style="background-color: #ddd;font-weight: 900;">邮箱认证 <small style="float:right;"><a href="/member/user/safe.html?tab=tab2">前往认证</a></small></td>
                </tr>
                <tr>
                    <td class="qys_publish_td_left">邮箱：</td>
                    <td class="qys_publish_td_right"><?php echo $thisuser->email; ?></td>
                </tr>
            </table>
        </div> 
    </div>
    <div class="tab-pane <?php echo ($_REQUEST['tab'] == 'tab1') ? 'active' : ''; ?>" id="tab1">
        <div class="table-responsive">
            <?php
            Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/uploadify.css');
            Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/imgareaselect-default.css');
            Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.uploadify.min.js');
            Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.imgareaselect.pack.js');
            ?>
            <table class="table table-bordered table-striped" style="border-top:none;">
                <tr>
                    <td class="memberlititle" style="text-align: center;padding:25px;border-top:none;">
                            <?php
                            $defaultimg = Yii::app()->theme->baseUrl ."/images/defaultpic.jpg";
                            if (!empty($thisuser->litpic)) {
                                $defaultimg = $thisuser->litpic;
                            }
                            echo '<img src="' . $defaultimg . '"/>';
                            ?>
                        <h3>我的头像</h3>
                    </td>
                </tr>
                <tr>
                    <td style="line-height:25px;">
                        <font color=red>* 上传图片应为png,jpg,gif格式.上传后.拖动选区选择合适的头像.双击选区.即可获得自己想要的图片!</font><br/>
                        <font color=red>* 获得头像后,点击提交即可!</font>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="width:700px;height:350px;margin:0 auto;margin-top:25px;margin-bottom:25px;">
                            <div style="width:450px;height:320px;border:1px solid #BBBBBB;text-align: center;float:left;" id="imgselectarea"><br/><br/>图片区域</div>
                            <div style="overflow: hidden;width:152px;height:200px;float:right;text-align:center;">
                                <div id="imageprivewarea" style="overflow: hidden;width:150px;height:150px;float:right;border:1px solid #BBBBBB;text-align:center;"><br/>预览区</div>
                                <div id="submitpicshow" style="width:150px;line-height:50px;height:50px;display: none;">
                                    <br/>
                                    <form id="submittouxiang" method="post" action="/member/user/uploadify.html" >
                                        <input type="hidden" name="picx1" id="picx1" value="0"/>
                                        <input type="hidden" name="picx2" id="picx2" value="0"/>
                                        <input type="hidden" name="picy1" id="picy1" value="0"/>
                                        <input type="hidden" name="picy2" id="picy2" value="0"/>
                                        <input type="hidden" name="picwidth" id="picwidth" value="0"/>
                                        <input type="hidden" name="picheight" id="picheight" value="0"/>
                                        <input type="hidden" name="picfilename" id="picfilename"/>
                                        <input class="btn btn-primary" type="submit" name="picsubmit" value="提交头像"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <div style="width:320px;height:40px;margin:0 auto;">
                            <form>
                                <div id="queue"></div>
                                <input id="file_upload" name="file_upload" type="file" multiple="true">
                            </form>
                        </div>
                    </td></tr>
            </table>
            <script type="text/javascript">
<?php $timestamp = time(); ?>
                $(function () {
                    $('#file_upload').uploadify({
                        'formData': {
                            'timestamp': '<?php echo $timestamp; ?>',
                            'token': '<?php echo md5('unique_salt' . $timestamp); ?>'
                        },
                        'swf': '<?php echo Yii::app()->theme->baseUrl; ?>/images/uploadify/uploadify.swf',
                        'uploader': '/member/user/uploadify.html',
                        'displayData': 'speed',
                        'fileExt': '*.jpg;*.jpeg;*.gif;*.png',
                        'buttonText': '上传头像', //通过文字替换钮扣上的文字
                        'buttonImg': '<?php echo Yii::app()->theme->baseUrl; ?>/images/uploadify/uploadtouxiang.png',
                        'width': 80,
                        'height': 25,
                        'rollover': true,
                        'onUploadSuccess': function (file, data, response) {
                            setCutImageArea(file, data);
                        },
                        'onUploadError': function (file, errorCode, errorMsg, errorString) {
                            alert("上传失败!请检查你的图片格式是否合法!" + errorMsg);
                        }
                    });
                });
                function setCutImageArea(obj1, obj2) {
                    json_str = JSON.parse(obj2);
                    var showwidth = 0;
                    var showheight = 0;
                    showwidth = (450 * 150 / json_str.width).toFixed(2);
                    showheight = (320 * 150 / json_str.height).toFixed(2);
                    if (showwidth > 450) {
                        showwidth = 450;
                    }
                    if (showheight > 320) {
                        showheight = 320;
                    }
                    $("#picfilename").val(json_str.path);
                    $("#picwidth").val(json_str.width);
                    $("#picheight").val(json_str.height);
                    $("#imgselectarea").html();
                    $("#imageprivewarea").html();
                    $("#imgselectarea").html("<img id='avater_selectimg' width=450 height=320 src='<?php echo Yii::app()->theme->baseUrl; ?>/images/temp/upload/" + json_str.path + "'/>");
                    $("#imageprivewarea").html("<img src='<?php echo Yii::app()->theme->baseUrl; ?>/images/temp/upload/" + json_str.path + "'/>");
                    $('#avater_selectimg').imgAreaSelect({x1: 0, y1: 0, x2: showwidth, y2: showheight, handles: true, onSelectChange: preview,
                        onSelectEnd: function (img, selection) {
                            $("#submitpicshow").css("display", "block");
                            $('#picx1').val(selection.x1);
                            $('#picy1').val(selection.y1);

                            $('#picx2').val(selection.x2);

                            $('#picy2').val(selection.y2);

                        }});
                }
                function preview(img, selection) {
                    var scaleX = 150 / (selection.width || 1);

                    var scaleY = 150 / (selection.height || 1);
                    $('#imageprivewarea img').css({
                        width: Math.round(scaleX * 450) + 'px',
                        height: Math.round(scaleY * 320) + 'px',
                        marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
                        marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'

                    });
                }
            </script>
        </div>
    </div>
</div>