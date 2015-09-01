<?php
if (!isset($_REQUEST['tab'])) {
    $_REQUEST['tab'] = '';
}
?>
<ul class="nav nav-tabs" role="tablist">
    <li <?php echo ($_REQUEST['tab'] == '') ? 'class="active"' : ''; ?>><a href="#tab0" role="tab" data-toggle="tab">充值</a></li>
    <li <?php echo ($_REQUEST['tab'] == 'tab1') ? 'class="active"' : ''; ?>><a href="#tab1" role="tab" data-toggle="tab">提现</a></li>
    <li <?php echo ($_REQUEST['tab'] == 'tab2') ? 'class="active"' : ''; ?>><a href="#tab2" role="tab" data-toggle="tab">银行卡</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane <?php echo ($_REQUEST['tab'] == '') ? 'active' : ''; ?>" id="tab0">
        <div class="table-responsive">
            <?php $this->renderPartial('//member/index/views/chongzhi') ?>
        </div> 
    </div>
    <div class="tab-pane <?php echo ($_REQUEST['tab'] == 'tab1') ? 'active' : ''; ?>" id="tab1">
        <?php $this->renderPartial('//member/index/views/cash',array("thisuser" => $thisuser, "thisbank" => $thisbank)) ?>
    </div>
    <div class="tab-pane <?php echo ($_REQUEST['tab'] == 'tab2') ? 'active' : ''; ?>" id="tab2">
        <?php echo '';#$this->renderPartial('//member/index/views/bankcard',array("thisuser" => $thisuser, "thisbank" => $thisbank)) ?>
    </div>
</div>