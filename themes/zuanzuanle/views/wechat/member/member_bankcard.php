<div class="page_content" style="-webkit-transform: translate3d(0px, 0px, 0px);">
    <?php $this->renderPartial('//wechat/common/usertop') ?>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;">
        <div class="panel panel-default" style="margin-bottom: 0px;">
            <div class="panel-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">所属银行</label>
                        <?php
                        echo QCHtml::dropDownList("bank", "2", Linkage::getValueChina("qys_none", "account_bank"), array(
                            "class" => "form-control",
                        ));
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">真实姓名</label>
                        <input type="password" class="form-control text-center" id="exampleInputPassword1" placeholder="请输入开户银行的真实姓名">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">银行卡号</label>
                        <input type="password" class="form-control text-center" id="exampleInputPassword1" placeholder="请输入银行的卡号">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="exampleInputPassword1">银行所在地</label>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                <select class="form-control">
                                    <option>省份</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                <select name="city_code" id="city_code" class="form-control">
                                    <option value="10">北京市</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">支行名称</label>
                        <input type="password" class="form-control text-center" id="exampleInputPassword1" placeholder="请输入支行名称">
                    </div>
                    <button type="submit" class="btn btn-block btn-danger">更改</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;height: 10px;">
    </div>
    <?php $this->renderPartial('//wechat/common/fonterend') ?>
</div>
