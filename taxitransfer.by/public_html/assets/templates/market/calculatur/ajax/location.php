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

if (isset($_GET['trasfer_type']) && !empty($_GET['trasfer_type'])) {
    $result_arr = array();

    $type_of_trip_post_val = $modx->db->escape($_GET['trasfer_type']);
	$calc_route_table = $modx->getFullTableName('calc_route_new');
    $calc_auto_type_table = $modx->getFullTableName('calc_auto_type');
	$location_sql = "SELECT `location_route` FROM {$calc_route_table} WHERE `type_of_trip` = '{$type_of_trip_post_val}'
ORDER BY `id` ASC";
    $auto_type_sql = "SELECT `auto_type` FROM {$calc_auto_type_table} WHERE `type_of_trip` = '{$type_of_trip_post_val}'
ORDER BY `order_type` ASC";
    $location_result = $modx->db->query($location_sql);
    $auto_type_result = $modx->db->query($auto_type_sql);
    if (!is_null($location_result)) {
        $location_arr = $modx->db->makeArray($location_result);
        if (isset($location_arr) && !empty($location_arr)) {
            $loc_rez_arr = array();
            foreach ($location_arr as $loc_val) {
                $loc_rez_arr[] = $loc_val['location_route'];
            }
            if (!empty($loc_rez_arr)) {
                $loc_rez_arr = array_unique($loc_rez_arr);
                sort($loc_rez_arr, SORT_NATURAL);
                $result_arr['location']=$loc_rez_arr;
            }
        }
    }
    if (!is_null($auto_type_result)) {
        $auto_type_arr = $modx->db->makeArray($auto_type_result);
        if (isset($auto_type_arr) && !empty($auto_type_arr)) {
            $auto_type_rez_arr = array();
            foreach ($auto_type_arr as $auto_type_val) {
                $auto_type_rez_arr[] = $auto_type_val['auto_type'];
            }
            if (!empty($auto_type_rez_arr)) {
                $result_arr['auto_type']=$auto_type_rez_arr;
            }
        }
    }
    if(!empty($result_arr)){
        echo json_encode($result_arr);
    }
}
?>