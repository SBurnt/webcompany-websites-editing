<?php
/**
 * Created by PhpStorm.
 * User: Rising13
 * Date: 13.09.2017
 * Time: 14:03
 */
define('MODX_API_MODE', true);
include_once $_SERVER["DOCUMENT_ROOT"] . '/manager/includes/config.inc.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/manager/includes/document.parser.class.inc.php';
$modx = new DocumentParser;
$modx->db->connect();
$modx->getSettings();
startCMSSession();
if (isset($_GET['trasfer_type']) && !empty($_GET['trasfer_type']) && isset($_GET['location'])
    && !empty($_GET['location']) && isset($_GET['where']) && !empty($_GET['where'])) {
    $result_val = '';
    /*Получаем и экранируем GET запросы*/
    $trasfer_type_get_val = $modx->db->escape($_GET['trasfer_type']);
    $location_get_val = $modx->db->escape($_GET['location']);
    $where_get_val = $modx->db->escape($_GET['where']);
    if($trasfer_type_get_val =='a') {
        /*Делаем запросы к БД*/

        $calc_route_table = $modx->getFullTableName('calc_route');
        $calc_route_data_sql = "SELECT `zone` FROM {$calc_route_table} WHERE `type_of_trip` = '{$trasfer_type_get_val}'
 AND `location` = '{$location_get_val}' AND `where` = '{$where_get_val}'  ORDER BY `id` ASC";
        $calc_route_data_result = $modx->db->query($calc_route_data_sql);
        if (!is_null($calc_route_data_result)) {
            $calc_route_data_result_arr = $modx->db->makeArray($calc_route_data_result);
            if (isset($calc_route_data_result_arr) && !empty($calc_route_data_result_arr)) {
                if(count($calc_route_data_result_arr)>1){
                    $option_val = '';
                    foreach ($calc_route_data_result_arr as $data_result_val) {
                        $option_val .= "<option value='{$data_result_val['zone']}'>Зона {$data_result_val['zone']}</option>".PHP_EOL;
                    }
                    ?>
                    <div class="form-transfer__line">
                        <div class="form-transfer__label">
                            Зона:<span> *</span>
                        </div>
                        <div class="form-transfer__input">
                            <select name="zone" style="color:#919191" onchange="this.style.color='#333'" required>
                                <option disabled selected>Выберите Зону</option>
                                <?=$option_val;?>
                            </select>
                        </div>
                    </div>
                    <?
                    $kilometrage_val = $calc_route_data_result_arr[0]['kilometrage'];
                    $road_time_val = $calc_route_data_result_arr[0]['road_time'];
                    if (!empty($kilometrage_val)) {
                        $kilometrage_str = "Расстояние: {$kilometrage_val} км. ";
                    }
                    if (!empty($road_time_val)) {
                        $road_time_str = "Время в дороге: {$road_time_val}";
                    }
                    echo $kilometrage_str . $road_time_val;
                }else{
                    return 'false';
                }
            }
        }
    }else{
        return 'false';
    }
}else{
    return 'false';
}
?>