<div id="qys_address_show">
    <select name="province" class="qys_common_provice form-control">
        <?php
        #获得所有省份列表
        #先从缓冲获得数据
        $provice_list = Yii::app()->cache->get("qys_common_provice");
        if (!$provice_list) {
            $provice_list = Province::model()->findAll("1=1 order by id asc");
        }
        if ($provice_list) {
            foreach ($provice_list as $value) {
                echo '<option value="' . $value->provinceID . '">' . $value->province . '</option>';
            }
            Yii::app()->cache->set("qys_common_provice", $provice_list);
        } else {
            echo '<option value="0">无法加载</option>';
        }
        ?>
    </select>
    <?php
    #获得所有城市列表并按照省份排序
    #先从缓冲获得数据
    $city_list_fit = Yii::app()->cache->get("qys_common_city");
    //$city_list_fit=FALSE;
    if (!$city_list_fit) {
        $city_list = City::model()->findAll("1=1 order by father asc,id asc");
        if ($city_list) {
            $i = 0;
            $city_list_fit = '';
            foreach ($city_list as $value) {
                if ($value->father !== $i) {
                    $city_list_fit.='</select><select name="city" class="qys_common_city_' . $value->father . ' form-control">';
                    $i = $value->father;
                }
                $city_list_fit.='<option value="' . $value->cityID . '">' . $value->city . '</option>';
            }
            $city_list_fit.='</select>';
            $city_list_fit = substr($city_list_fit, 9);
            Yii::app()->cache->set("qys_common_city", $city_list_fit);
        }
    }
    echo $city_list_fit;
    ?>
    <?php
    #获得所有城市列表并按照省份排序
    #先从缓冲获得数据
    $area_list_fit = Yii::app()->cache->get("qys_common_area");
    //$area_list_fit=FALSE;
    if (!$area_list_fit) {
        $area_list = Area::model()->findAll("1=1 order by father asc,id asc");
        if ($area_list) {
            $i = 0;
            $area_list_fit = '';
            foreach ($area_list as $value) {
                if ($value->father !== $i) {
                    $area_list_fit.='</select><select name="area" class="qys_common_area_' . $value->father . ' form-control">';
                    $i = $value->father;
                }
                $area_list_fit.='<option value="' . $value->areaID . '">' . $value->area . '</option>';
            }
            $area_list_fit.='</select>';
            $area_list_fit = substr($area_list_fit, 9);
            Yii::app()->cache->set("qys_common_area", $area_list_fit);
        }
    }
    echo $area_list_fit;
    ?>
</div>