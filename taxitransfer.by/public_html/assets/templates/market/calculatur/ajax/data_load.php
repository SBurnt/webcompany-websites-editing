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
    && !empty($_GET['location']) && isset($_GET['where']) && !empty($_GET['where']) && isset($_GET['auto_type']) && !empty($_GET['auto_type'])) {

    $result_arr = [];
	$price_en = 0;
	$price_by = 0;
	$price_eu = 0;
	$price_ru = 0;
	
    /*Получаем и экранируем GET запросы*/
    $trasfer_type_get_val = $modx->db->escape($_GET['trasfer_type']);
    $location_get_val = $modx->db->escape($_GET['location']);
    $where_get_val = $modx->db->escape($_GET['where']);
    $auto_type_get_val = $modx->db->escape($_GET['auto_type']);
    $zone_get_val = $modx->db->escape($_GET['zone']);

	/*Определяем тип и авто и соответствующий ему параметр*/
	switch ( $auto_type_get_val) {
		case 'Средний класс':
			$price_param = 'type_auto_medium';
			break;
		case 'Бизнесс класс':
			$price_param = 'type_auto_business';
			break;
		case 'Представительский класс':
			$price_param = 'type_auto_representative';
			break;
		case 'Микроавтобус 8 мест':
			$price_param = 'type_auto_bus_8';
			break;
		case 'Микроавтобус 20 мест':
			$price_param = 'type_auto_bus_20';
			break;
	}
	
    /*Делаем запросы к БД*/
	
    $calc_route_table = $modx->getFullTableName('calc_route_new');

    $calc_route_data_sql = "SELECT `{$price_param}` FROM {$calc_route_table} WHERE `type_of_trip` = '{$trasfer_type_get_val}'
 AND `location_route` = '{$location_get_val}' AND `where_route` = '{$where_get_val}' ORDER BY `id` ASC";
	$calc_route_data_result = $modx->db->query($calc_route_data_sql);
	if (!is_null($calc_route_data_result)) {
        $price_by  = $modx->db->getValue($calc_route_data_result);
    }
	
    /*Получаем курсы валют*/
    $snip_name = 'ddGetMultipleField';
    $arrparams = array('inputString_docField' => 'courses', 'inputString_docId' => '1', 'outputFormat' => 'array');
    $courses_result = $modx->runSnippet($snip_name, $arrparams);//делаем обращение к сниппету ddGetMultipleField c нужными параметрами
    if (isset($courses_result) && !empty($courses_result)) {
        $courses = $courses_result[0];
		$result_arr['courses'] = $courses;
    }
	
	if(!empty($price_by)){
		if(!empty($courses[0]) && !empty($price_by)){
			$price_en = $price_by * $courses[0];
			$price_en = round($price_en, 2);
		}
		
		if(!empty($courses[1]) && !empty($price_by)){
			$price_eu = $price_by * $courses[1];
			$price_eu = round($price_eu, 2);
		}
		
		if(!empty($courses[2]) && !empty($price_by)){
			$price_ru = $price_by * $courses[2];
			$price_ru = round($price_ru, 2);
		}
		$result_arr['price']['price_en'] = $price_en;
		$result_arr['price']['price_by'] = $price_by;
		$result_arr['price']['price_eu'] = $price_eu;
		$result_arr['price']['price_ru'] = $price_ru;
	}
	
    if (!empty($result_arr)) {
        echo json_encode($result_arr);
    }
}
?>