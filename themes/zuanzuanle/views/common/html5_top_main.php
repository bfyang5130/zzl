<div class="nav qys_top_bgline">
</div>
<div class="navbar qys_top_navbar_bottomline">
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                <h1>
                    <a alt="赚赚乐" class="ie6fixpic" title="赚赚乐" href="/index.html"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo-zuanzuanle.png"/></a>
                </h1>
            </div>
            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-8">
                <nav class="navbar qys-top_navbar" role="navigation">
                    <div class='navbar-header'>
                        <a class="navbar-toggle btn btn-navbar qys_little_bar" data-toggle="collapse" 
                           data-target="#top-navbar-collapse">
                            <span class="sr-only">切换导航</span>
                            <span class="icon-bar qys_icon_bar"></span>
                            <span class="icon-bar qys_icon_bar"></span>
                            <span class="icon-bar qys_icon_bar"></span>
                        </a> 
                    </div>
                    <div class="collapse navbar-collapse" id="top-navbar-collapse">
                        <ul class="nav navbar-nav">
                            <?php
                            #获得主菜单
                            $main_menu = Menu::model()->find("menu_ename='main_menu'");
                            $main_menu_id = 1;
                            if ($main_menu) {
                                $main_menu_id = $main_menu->menu_id;
                            }
                            $mainmenulist = Channel::model()->findAll("cl_menu_id=:menu_id AND cl_status=1 order by cl_left asc", array(":menu_id" => $main_menu_id));
                            if ($mainmenulist) {
                                foreach ($mainmenulist as $key => $value) {
                                    ?>
                                    <li 
                                    <?php
                                    if ($key == 0) {
                                        echo 'class="active"';
                                    }
                                    ?>>
                                            <?php
                                            if ($value->cl_exturl) {
                                                ?>
                                            <a target="_blank" href="<?php echo $value->cl_exturl; ?>"><?php echo CHtml::encode($value->cl_name); ?> </a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="<?php echo Yii::app()->createUrl("/" . $value->cl_en_name); ?>"><?php echo CHtml::encode($value->cl_name); ?> </a>
                                            <?php
                                        }
                                        ?>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="hidden-xs col-sm-3 col-md-3 col-lg-2">
                <?php $this->renderPartial('//common/html5_login') ?>
            </div>
        </div>
    </div>
</div>
