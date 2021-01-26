<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$data = array(
	'H' => array(),
	'C' => 0,
	'CP' => 0,
	'SECTIONS' => array()
);
foreach ($arResult["SECTIONS"] as &$sect) {
	$sid = intval($sect['ID']);
	$data['SECTIONS'][$sid] = $sect;
	$data['H'][intval($sect['IBLOCK_SECTION_ID'])][] = $sid;
	$data['H_N'][intval($sect['IBLOCK_SECTION_ID'])][] = $sid . '_' . $sect['NAME'];
}
unset($sect);
$arResult['DATA'] = $data;