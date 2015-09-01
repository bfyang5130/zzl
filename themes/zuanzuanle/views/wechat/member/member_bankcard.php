<div class="page_content" style="-webkit-transform: translate3d(0px, 0px, 0px);">
    <?php $this->renderPartial('//wechat/common/usertop') ?>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;">
        <div class="panel panel-default" style="margin-bottom: 0px;">
            <div class="panel-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">所属银行</label>
                        <input type="email" class="form-control text-center" id="exampleInputEmail1" placeholder="请输入开户银行">
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
                        <label for="exampleInputPassword1">银行所在地</label>
                        <input type="password" class="form-control text-center" id="exampleInputPassword1" placeholder="选择银行所在地">
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