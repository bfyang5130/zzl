<div class="index_clum_content" style="min-height: 550px">
    <div class="member_search">
        <?php
        echo '开始日期: ';
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'language' => 'zh_cn',
            'name' => 'keyDate',
            'options' => array(
                'dateFormat' => 'yy-mm-dd'
            ),
            'htmlOptions' => array(
                'style' => 'height:15px;'
            ),
        ));
        echo ' 结束日期: ';
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'language' => 'zh_cn',
            'name' => 'keyDate',
            'options' => array(
                'dateFormat' => 'yy-mm-dd'
            ),
            'htmlOptions' => array(
                'style' => 'height:15px;'
            ),
        ));
        ?>
        <input type="button" name="member_search" value="搜索"/>&nbsp;&nbsp;
    </div>
    <?php
    $pagecounts = $dataProvider->itemCount;
    $this->widget('zii.widgets.CListView', array(
        'id' => 'ajaxListView', //注意这个id要的下面注册js中的id一致
        'dataProvider' => $dataProvider,
        'itemView' => '/member/project/projecting',
        'emptyText' => '暂无数据',
        'summaryCssClass'=>'summary_container',
        'viewData' => array('icount' => $pagecounts),
        'pager' => array(
            'class' => 'CLinkPager',
            'firstPageLabel' => '首页', //定义首页按钮的显示文字
            'lastPageLabel' => '尾页', //定义末页按钮的显示文字
            'nextPageLabel' => '下一页', //定义下一页按钮的显示文字
            'prevPageLabel' => '前一页', //定义上一页按钮的显示文字
        //关于分页器这个array，具体还有很多属性，可参考CLinkPager的API
        ),
    ));
    ?>

</div>
<div class="index_clum_bottom">
    <div class="index_clum_b1"></div>
    <div class="index_clum_b2"></div>
    <div class="index_clum_b3"></div>
    <div class="clear"></div>
</div>