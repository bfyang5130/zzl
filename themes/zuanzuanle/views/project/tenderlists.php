<?php
if (isset($page)) {
    $page = intval($page);
} else {
    $page = 1;
}
if (isset($id)) {
#获得筹资记录
    $startlog = ($page - 1) * 10;
    $thischoujilu = Tender::model()->findAll("project_id=:project_id order by id asc limit :startlog,10 ", array(":project_id" => intval($id), ":startlog" => $startlog));
    if ($thischoujilu) {
        foreach ($thischoujilu as $choujiluvalue) {
            echo '<ul class="list-inline text-right qys_choujilu_list"><li><span style="color:red;">' . intval($choujiluvalue->money) . ' 元</span></li><li>' . BaseTool::truncate_utf8_string($choujiluvalue->user->username, 6) . '</li><li style="color:#777;">' . date("Y/m/d", $choujiluvalue->addtime) . '</li></ul>';
        }
    } else {
        echo '没有数据';
    }
} else {
    echo '错误的数据';
}
?>
