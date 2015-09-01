<div class="row">
    <div class="col-md-12"><h5 style="height:35px;line-height: 35px;border-bottom: 1px solid #000;">选择充值方式</h5></div>
    <form name="chongzhi_form" onSubmit="return checkChongZhi();" target="_blank" method="post" action="/pay/gotopay.html">
        <div class="col-md-12" style="margin-top: 5px">
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="ICBC" value="ICBC" type="hidden">
                        <img style="border:2px solid #ed5e58;" class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/icbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="ABC" value="ABC" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/acbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="CMB"  value="CMB"  type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/cmbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="HXBANK"  value="HXBANK"  type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/hxbc.png"/>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="margin-top: 5px">
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="SHBANK" value="SHBANK"   type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/shbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="SHRCB" value="SHRCB" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/shnsbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="BOC" value="BOC" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/zgbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="CZBANK" value="CZBANK" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/zsbc.png"/>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="margin-top: 5px">
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="CCB" value="CCB"  type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/cnnbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="HZCB" value="HZCB" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/hzbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="NJCB" value="NJCB" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/njbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="NBBANK" value="NBBANK" value="" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/nbbc.png"/>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="margin-top: 5px">
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="CEB" value="CEB" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/zggdbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="CITIC" value="CITIC" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/zxbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="BOHAIB" value="BOHAIB" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/bhbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="HKBEA" value="HKBEA" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/dybc.png"/>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="margin-top: 5px">
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="SPABANK" value="SPABANK" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/pabc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="HSBANK" value="HSBANK" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/wsbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="CMBC" value="CMBC" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/zgmsbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="BJBANK" value="BJBANK" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/bjbc.png"/>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="margin-top: 5px">
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="GDB" value="GDB" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/gfbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="COMM" value="COMM" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/jtbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="SPDB" value="SPDB" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/pfbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="CIB" value="CIB" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/xybc.png"/>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="margin-top: 5px">
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="PSBC" value="PSBC" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/zgyzbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="BJRCB" value="BJRCB" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/bjnsbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="GCB" value="GCB" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/gzbc.png"/>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <label class="bank_change_label">
                        <input name="ZFB" value="ZFB" type="hidden">
                        <img class="qys_bank" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/zfb.png"/>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12"><h5 style="height:25px;line-height: 25px;border-top: 1px solid #000;"></h5></div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="input-group">
                    <img style="border:2px solid #cccccc;" id="select_bank_img" class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/bank/icbc.png"/>
                    <span class="input-group-addon" style="font-weight:900;color:red;">充值金额：</span>
                    <input id="select_bank" value="ICBC" name="chongzhi_form[bank]" type="hidden">
                    <input id="chongzhimoney" name="chongzhi_form[chongzhimoney]" type="text" class="form-control">
                    <span class="input-group-addon" style="font-size: 12px;color: #999;background-color: #fff;border: none;">元</span>
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="submit">确认充值</button>
                    </span>
                </div>
            </div>
            <div class="col-md-6"></div>
        </div>
    </form>
</div>
<script type="text/javascript">
    var dialogdir = "<?php echo Yii::app()->theme->baseUrl; ?>/src";
    function checkChongZhi() {
        var price = $("#chongzhimoney").val();
        if (!checkPrice(price)) {
            alert('请输入正确的金额');
            return false;
        }
        seajs.use(['jquery', dialogdir + '/dialog-plus'], function ($, dialog) {
            var d = dialog({
                title: '充值信息',
                content: '是否完成了您的充值？',
                okValue: '完成充值',
                ok: function () {
                    window.location.href = "/member/index/log.html";
                },
                cancelValue: '继续充值',
                cancel: function () {
                }
            });
            d.width(350).height(50).showModal();
        });
    }
    function checkPrice(price) {
        return (/^(([1-9]\d*)|\d)(\.\d{1,2})?$/).test(price.toString());
    }
    $(".bank_change_label").click(function () {
        $(".bank_change_label").find("img").css("border", "none");
        $(this).find("img").css({'border-width': '2px', 'border-color': '#ed5e58', "border-style": "solid"});
        var obj = $(this).find("input");
        $("#select_bank").val(obj.val());
        var img = $(this).find("img");
        $("#select_bank_img").attr("src", img.attr("src"));
    });
</script>