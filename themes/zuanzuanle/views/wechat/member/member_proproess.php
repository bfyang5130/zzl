<div class="page_content" style="-webkit-transform: translate3d(0px, 0px, 0px);">
    <?php $this->renderPartial('//wechat/common/usertop') ?>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;">
        <div class="panel panel-default" style="margin-bottom: 0px;">
            <div class="panel-heading">
                <h3 class="panel-title">物流进度查询</h3>
            </div>
            <div class="panel-body">
                <form class="form-inline">
                    <div class="form-group">
                        <label for="exampleInputName2">快捷单号</label>
                        <input type="text" class="form-control" id="exampleInputName2" placeholder="输入快递公司的单号">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail2">快递公司</label>
                        <select class="form-control">
                            <option>顺丰快递</option>
                            <option>圆通快递</option>
                            <option>韵达快递</option>
                            <option>申通快递</opEMStion>
                            <option>中通快递</option>
                            <option>天天快递</option>
                            <option>快捷快递</option>
                            <option>EMS快递</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-block btn-danger">查询</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;">
        <div class="panel panel-default" style="margin-bottom: 0px;">
            <div class="panel-heading">
                <h3 class="panel-title">查询结果</h3>
            </div>
            <div class="panel-body">
                暂无结果
            </div>
        </div>
    </div>
    <div class="col-lg-12" style="padding:10px 25px 0px 25px;height: 10px;">
    </div>
    <?php $this->renderPartial('//wechat/common/fonterend') ?>
</div>