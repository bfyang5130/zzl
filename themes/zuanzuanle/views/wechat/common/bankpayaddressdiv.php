<div id="qys_address_show">
    <select name="province" class="qys_common_pay_provice form-control">
        <?php
        #获得所有省份列表
        #先从缓冲获得数据
        $provice_list = Yii::app()->cache->get("qys_common_pay_provice");
        $provice_list=FALSE;
        if (!$provice_list) {
            $provice_list = Payarea::model()->findAll("pid=0 order by id asc");
        }
        if ($provice_list) {
            foreach ($provice_list as $value) {
                echo '<option value="' . $value->p_code . '">' . $value->name . '</option>';
            }
            Yii::app()->cache->set("qys_common_pay_provice", $provice_list);
        } else {
            echo '<option value="0">无法加载</option>';
        }
        ?>
    </select>
    <?php
    #获得所有城市列表并按照省份排序
    #先从缓冲获得数据
    $city_list_fit = Yii::app()->cache->get("qys_common_pay_city");
    $city_list_fit=FALSE;
    if (!$city_list_fit) {
        $city_list = Payarea::model()->findAll("pid<>0 order by pid asc,id asc");
        if ($city_list) {
            $i = 0;
            $city_list_fit = '';
            foreach ($city_list as $value) {
                if ($value->p_code !== $i) {
                    $city_list_fit.='</select><select name="city" class="qys_common_pay_city_' . $value->p_code . ' form-control">';
                    $i = $value->p_code;
                }
                $city_list_fit.='<option value="' . $value->a_code . '">' . $value->name . '</option>';
            }
            $city_list_fit.='</select>';
            $city_list_fit = substr($city_list_fit, 9);
            Yii::app()->cache->set("qys_common_pay_city", $city_list_fit);
        }
    }
    echo $city_list_fit;
    ?>
</div>