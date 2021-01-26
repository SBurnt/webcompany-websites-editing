<?php
/*ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);*/
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
    /*$zone_get_val = $modx->db->escape($_GET['zone']);
    if(isset($_GET['zone']) && !empty($_GET['zone'])){
        $zone_get_val = $modx->db->escape($_GET['zone']);
    }else{
        $zone_get_val = '0';
    }*/
}
    /*Делаем запросы к БД*/
    $calc_route_table = $modx->getFullTableName('calc_route_new');
    $calc_route_data_sql = "SELECT `kilometrage` FROM {$calc_route_table} WHERE `type_of_trip` = '{$trasfer_type_get_val}'
 AND `location_route` = '{$location_get_val}' AND `where_route` = '{$where_get_val}' ORDER BY `id` ASC";
    $calc_route_data_result = $modx->db->query($calc_route_data_sql);
    if (!is_null($calc_route_data_result)) {
        $calc_route_data_result_arr = $modx->db->makeArray($calc_route_data_result);
        if (isset($calc_route_data_result_arr) && !empty($calc_route_data_result_arr)) {
            $kilometrage_val = $calc_route_data_result_arr[0]['kilometrage'];
            //$road_time_val = $calc_route_data_result_arr[0]['road_time'];
            if(!empty($kilometrage_val)){
                $kilometrage_str = "Расстояние: {$kilometrage_val} км. ";
            }
            /*if(!empty($road_time_val)){
                $road_time_str = "Время в дороге: {$road_time_val}";
            }
            echo $kilometrage_str.$road_time_val;
			*/
			echo $kilometrage_str;
        }
    }
?>