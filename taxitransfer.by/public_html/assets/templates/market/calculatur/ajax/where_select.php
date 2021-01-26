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

if (isset($_GET['trasfer_type']) && !empty($_GET['trasfer_type']) && isset($_GET['location']) && !empty($_GET['location'])) {
    $type_of_trip_post_val = $modx->db->escape($_GET['trasfer_type']);
    $location_post_val = $modx->db->escape($_GET['location']);
    $calc_route_table = $modx->getFullTableName('calc_route_new');
    $where_sql = "SELECT `id`,`where_route` FROM {$calc_route_table} WHERE `type_of_trip` = '{$type_of_trip_post_val}' AND
	`location_route` = '{$location_post_val}' ORDER BY `where_route` ASC";


    $where_result = $modx->db->query($where_sql);
    if (!is_null($where_result)) {
        $where_arr = $modx->db->makeArray($where_result);
        if (isset($where_arr) && !empty($where_arr)) {
            $where_rez_arr = array();
            foreach ($where_arr as $where_val) {
                $where_rez_arr[] = $where_val['where_route'];
            }
            if(!empty($where_rez_arr)){
                $where_rez_arr = array_unique($where_rez_arr);
				$numeric_val_table = ['s','c'];
				if(in_array($type_of_trip_post_val,$numeric_val_table )){
					switch ($type_of_trip_post_val) {
						case 's':
							$calc_where_route_table = $modx->getFullTableName('calc_sanatorium');
						break;
						case 'c':
							$calc_where_route_table = $modx->getFullTableName('calc_city');
						break;
					}
					if(!empty($calc_where_route_table)){
						$where_option = '<option disabled=\'\' selected=\'\'>Выберите пункт назначения</option>';
						$city_san_name_array = [];
						foreach ($where_rez_arr as $where_option_val) {
							if(is_numeric($where_option_val)){
								$where_sql = "SELECT `id`,`value` FROM {$calc_where_route_table} WHERE `id` = '{$where_option_val}' ORDER BY `value` ASC";
								$where_result = $modx->db->query($where_sql);
								$where_arr = $modx->db->makeArray($where_result);
								$id_city = $where_arr[0]["id"];
								$city_san_name_array[$id_city] = $where_arr[0]['value'];
							}
						}
						if(!empty($city_san_name_array)){
						asort($city_san_name_array,SORT_NATURAL );
							foreach($city_san_name_array as $key => $value){
									$where_option.= "<option value='{$key}'>{$value}</option>";
							}
						}
					}
				}else{
					sort($where_rez_arr,SORT_NATURAL );
					$where_option = '<option disabled=\'\' selected=\'\'>Выберите пункт назначения</option>';
					foreach ($where_rez_arr as $where_option_val) {
						$where_option.= "<option value='{$where_option_val}'>{$where_option_val}</option>";
					}
				}
                if(!empty($where_option) && $where_option!=='<option disabled=\'\' selected=\'\'>Выберите пункт назначения</option>'){
                    echo $where_option;
                }
            }
        }
    }
}
?>