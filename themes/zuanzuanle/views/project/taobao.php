<?php
$com_per = ceil($oneProject->account_yes / $oneProject->account * 100);
$startdate = strtotime(date("Y-m-d", time()));
$enddate = strtotime(date('Y-m-d', $oneProject->addtime + $oneProject->intime * 86400));
$days = round(($enddate - $startdate) / 3600 / 24);
?>
<div class="warp qys_color_F8F8F8">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-sm-12 col-md-12 qys_details_title_h3">
                <div class="panel panel-default qys_panel_default_zoupad" style="margin-top:15px;background-color:#E3E3E3;">
                    <h5 class="panel-title qys_details_panel_title" style="padding:10px;font-size: 20px;">
                        <strong><?php echo $oneProject->title; ?></strong>
                    </h5>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-9 col-md-9">
                        <div id="myCarousel" class="carousel slide">
                            <!-- 轮播（Carousel）指标 -->  
                            <!-- 轮播（Carousel）项目 -->
                            <div class="carousel-inner">
                                <?php
                                $lubopiclists = ProjectLunbo::model()->findAll("projects_id=:id AND pic_status=1", array(":id" => $oneProject->id));
                                if ($lubopiclists) {
                                    foreach ($lubopiclists as $key => $onelubo) {
                                        $class = 'class="item"';
                                        if ($key == 1) {
                                            $class = 'class="item active"';
                                        }
                                        ?>
                                        <div <?php echo $class; ?>>
                                            <img class="img-rounded" src="/<?php echo $onelubo->pic_address; ?>" alt="<?php echo $key; ?>">
                                            <div class="carousel-caption qys_carousel-caption"><?php echo $onelubo->pic_remark; ?></div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    $title = array(
                                        '1' => '何芷琪住在花溪区石板镇，她曾经有一个幸福的家。然而厄运突然降临，何芷琪一岁多时奶奶因车祸离去。2013年3月，她的妈妈又狠心抛下两岁的女儿离家出走。妈妈离开后的第3天，芷琪在爸爸修车铺子的旁边玩耍时，一辆大货车从她身旁驶过，把小女孩卷入车轮下。',
                                        '2' => '车祸一年后，何芷琪来到贵阳市残疾人联合会下属假肢矫正装配站，在装配站工作人员的帮助下安装假肢进行训练。每次要穿假肢训练时，芷琪都会很不情愿，但是爷爷问“你不想上学了吗？”她又乖乖的听话穿上。受过死亡考验和病痛折磨的她，比同龄的孩子坚强得多。',
                                    );
                                    for ($i = 1; $i <= 2; $i++) {
                                        $class = 'class="item"';
                                        if ($i == 1) {
                                            $class = 'class="item active"';
                                        }
                                        ?>
                                        <div <?php echo $class; ?>>
                                            <img class="img-rounded" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/demo/<?php echo $i; ?>.jpg" alt="<?php echo $i; ?>">
                                            <div class="carousel-caption qys_carousel-caption"><?php echo $title[$i]; ?></div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <!-- 轮播（Carousel）导航 -->
                            <a class="carousel-control left" style="background-image: none;" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                            <a class="carousel-control right" style="background-image: none;" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <div class="panel panel-default qys_panel_default_zoupad">
                            <div class="panel-heading qys_panel_heading_title">
                                <h5 class="panel-title qys_details_panel_title">
                                    <strong>项目筹资状态</strong>
                                </h5>
                            </div>
                            <div class="panel-body">
                                <div class="row qys_index_pad_t">
                                    <span class="pull-left"><span class="qys_little_tittle">目标：</span><span class="qys_little_number"><strong><?php echo $oneProject->intime; ?></strong></span><small class="qys_little_style"> 天 </small><span class="qys_little_number"><strong><?php echo intval($oneProject->account); ?></strong></span><small class="qys_little_style"> 元 </small></span><span class="pull-right label label-info">众筹中</span>
                                </div>
                                <div class="row">
                                    <div class="progress qys_index_progress">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" 
                                             aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $com_per; ?>%;">
                                            <span class="sr-only"><?php echo $com_per; ?>% 完成</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row qys_index_pad_t">
                                    <ul class="list-inline">
                                        <li><span class="qys_little_tittle">完成筹资</span><br/><span class="qys_little_number"><?php echo intval($oneProject->account_yes); ?></span></li>
                                        <li><span class="qys_little_tittle">还需筹资</span><br/><?php echo intval($oneProject->account - $oneProject->account_yes); ?></li>
                                        <li><span class="qys_little_tittle">剩余时间</span><br/><span class="qys_little_number"><?php echo $days; ?></span><small class="qys_little_style"> 天 </small></li>
                                        <li><span class="qys_little_tittle">进度</span><br/><span class="qys_little_number"><?php echo $com_per; ?></span><small class="qys_little_style"> % </small></li>
                                    </ul>
                                </div>
                                <div class="row qys_index_pad_t">
                                    <table class="table table-striped table-bordered" style="margin-bottom: 5px;">
                                        <tbody>
                                            <tr>
                                                <td>每次筹资金额</td>
                                                <td><span class="qys_little_number"><strong><?php echo $oneProject->account_one; ?></strong></span><small class="qys_little_style"> 元 </small></td>
                                            </tr>
                                            <tr>
                                                <td>筹资次数</td>
                                                <td><span class="qys_little_number"><strong><?php echo $oneProject->choutimes; ?></strong></span><small class="qys_little_style"> 次 </small></td>
                                            </tr>
                                            <tr>
                                                <td>已筹次数</td>
                                                <td><span class="qys_little_number"><strong><?php echo $oneProject->account_yes / $oneProject->account_one; ?></strong></span><small class="qys_little_style"> 次 </small></td>
                                            </tr>
                                            <tr>
                                                <td>每次收益</td>
                                                <td><span class="qys_little_number"><strong><?php echo $oneProject->account_lixi; ?></strong></span><small class="qys_little_style"> 元 </small></td>
                                            </tr>
                                            <tr>
                                                <td>筹资方式</td>
                                                <td><span class="qys_little_number"><strong><?php echo Linkage::getValueChina($oneProject->collection_type, "collection_type"); ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td>范围限制</td>
                                                <?php
                                                $arealimitname = "省份";
                                                switch ($oneProject->area_limit) {
                                                    case 1:$arealimitname = "省份";
                                                        break;
                                                    case 2:$arealimitname = "城市";
                                                        break;
                                                    case 3:$arealimitname = "小区";
                                                        break;
                                                    default :$arealimitname = "省份";
                                                }
                                                ?>
                                                <td>每个<?php echo $arealimitname; ?><span class="qys_little_number"><strong><?php echo $oneProject->iplimit; ?></strong>次</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <form role="form" action="#" method="post">
                                            <input type="hidden" name="project_id" value="<?php echo $oneProject->id; ?>"/>
                                            <button type="submit" name="chou_submit" class="btn btn-default btn-success">确定赞助</button>
                                            <input type="checkbox" name="buy" value="1"/><span> 购买 <small style="color:#888888;">别随便购买</small></span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-9 col-md-9">
                <div class="panel panel-default qys_member_panel qys_panel_default_zoupad">
                    <div class="panel-heading qys_panel_heading_title">
                        <h5 class="panel-title qys_details_panel_title">
                            <strong>项目详细信息（<?php echo $oneProject->other_remark; ?>）</strong>
                        </h5>
                    </div>
                    <div class="panel-body">
                        <?php echo $oneProject->content; ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3">
                <div class="panel panel-default qys_member_panel qys_panel_default_zoupad">
                    <div class="panel-heading qys_panel_heading_title">
                        <h5 class="panel-title qys_details_panel_title">
                            <strong>赞助记录</strong>
                        </h5>
                    </div>
                    <div class="panel-body">
                        <?php
                        #获得筹资记录
                        $thischoujilu = Tender::model()->findAll("project_id=:project_id order by id asc limit 10 ", array(":project_id" => $oneProject->id));
                        if (!$thischoujilu) {
                            echo '暂无记录';
                        } else {
                            ?>
                            <div id="page-content">
                                <?php
                                foreach ($thischoujilu as $choujiluvalue) {
                                    echo '<ul class="list-inline text-right qys_choujilu_list"><li><span style="color:red;">' . intval($choujiluvalue->money) . ' 元</span></li><li>' . BaseTool::truncate_utf8_string($choujiluvalue->user->username, 6) . '</li><li style="color:#777;">' . date("Y/m/d", $choujiluvalue->addtime) . '</li></ul>';
                                }
                                ?>
                            </div>
                            <div class="text-center">
                                <ul id="pagination-zhoulog" class="pagination-sm"></ul>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="panel panel-default qys_member_panel qys_panel_default_zoupad">
                    <div class="panel-heading qys_panel_heading_title">
                        <h5 class="panel-title qys_details_panel_title">
                            <strong>使用记录</strong>
                        </h5>
                    </div>
                    <div class="panel-body">
                        暂无记录
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
<?php
$thischoujilutotal = Tender::model()->count("project_id=:project_id", array(":project_id" => $oneProject->id));
if ($thischoujilu) {
    ?>
        $('#pagination-zhoulog').twbsPagination({
            totalPages: <?php echo $thischoujilu ? ceil($thischoujilutotal / 10) : 0; ?>,
            visiblePages: 1,
            href: '/project/tenders/id/<?php echo $oneProject->id; ?>/choulog/page/{{number}}.html',
            onPageClick: function (event, page) {
                $.ajax({
                    url: '/project/tenders/id/<?php echo $oneProject->id; ?>/page/' + page + '.html',
                    dataType: "html",
                    type: "POST",
                    success: function (ajaxobj) {
                        $('#page-content').html(ajaxobj);
                    },
                    error: function (ajaxobj)
                    {
                        $('#page-content').html("<font color=red><strong>获取数据失败，请重试!</stonr></font>");
                    }
                });

            }
        });
    <?php
}
?>
</script>