<?php
if (isset($page)) {
    $page = intval($page);
} else {
    $page = 1;
}
if (isset($id)) {
#获得筹资记录
    $thisproject = Project::model()->findByPk($id, "user_id=:user_id", array(":user_id" => Yii::app()->user->getId()));
    if ($thisproject) {
        $startlog = ($page - 1) * 15;
        $thischoujilu = Tender::model()->findAll("project_id=:project_id order by id asc limit :startlog,15 ", array(":project_id" => intval($id), ":startlog" => $startlog));
        if ($thischoujilu) {
            ?>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>序号</th>
                    <th>赞助资金</th>
                    <th>赞助类型</th>
                    <th>用户名</th>
                    <th>赞助时间</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                <?php
                foreach ($thischoujilu as $value) {
                    ?>
                    <tr>
                        <td><?php echo $value->id; ?></td>
                        <td>
                            <?php echo $value->money; ?>
                        </td>
                        <td>
                            <?php echo Project::getCollectionValue($value->type); ?>
                        </td>
                        <td>
                            <?php echo $value->user->username; ?>
                        </td>
                        <td>
                            <?php echo date("Y/m/d H:i:s", $value->addtime); ?>
                        </td>
                        <td>
                            <?php
                            switch ($value->status) {
                                case 0: echo '<span style="color:blue;">处理中</span>';
                                    break;
                                case 1: echo '<span style="color:green;">已汇款</span>';
                                    break;
                                case 2: echo '<span style="color:red;">失信</span>';
                                    break;
                                default:'<span style="color:blue;">处理中</span>';
                                    break;
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($value->status == 0) {
                                ?>
                                <span tval="<?php echo $value->id; ?>" class="btn btn-sm btn-success">已汇款</span>
                                <span tval="<?php echo $value->id; ?>" class="btn btn-sm btn-warning">失信</span>
                                <?php
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?></table>
            <?php
        } else {
            echo '没有数据';
        }
    } else {
        echo '错误的数据';
    }
} else {
    echo '错误的数据';
}
?>
