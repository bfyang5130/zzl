<div class="navbar qys_top_navbar_bottomline qys_second_nav">
    <div class="container">
        <div class="row">
            <div class="hidden-xs col-xs-12 col-sm-12 col-md-12">
                <ul class="nav nav-justified">
                    <li><a title="浏览全部"  href="<?php echo Yii::app()->createUrl("/project/index"); ?>">浏览全部</a></li>
                    <?php
                    #获得项目下的分类项目
                    $main_menu = Menu::model()->find("menu_ename='project'");
                    if ($main_menu) {
                        $main_menu_id = $main_menu->menu_id;
                        $projectlist = Channel::model()->findAll("cl_menu_id=:menu_id AND cl_status=1 order by cl_left asc", array(":menu_id" => $main_menu_id));
                        if ($projectlist) {
                            foreach ($projectlist as $key => $value) {
                                echo '<li ><a href="' . Yii::app()->createUrl('/project/lists/list_id/' . $value->id) . '" title="' . QCHtml::encode($value->cl_name) . '">' . QCHtml::encode($value->cl_name) . '</a></li>';
                            }
                        }
                    }
                    ?>
                    <li><a href="http://www.10000rmb.com">中国网赚平台</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>