<?
	$arSections = array();
	foreach( $arResult["SECTIONS"] as $arItem ):
		if( $arItem["DEPTH_LEVEL"] == 1 ):
			$arSections[$arItem["ID"]] = $arItem;
	    endif;
	endforeach;
	
	$arResult["SECTIONS"] = $arSections;

$cols = 6;
$rows = intVal(count($arResult["SECTIONS"]) / $cols);

$values2 = array_values($arResult["SECTIONS"]);
$t=1;
foreach($values2 as $value){
	
	$values[$t]=$value;
	$t++;
}
$y=1;
$d=1;
foreach($values2 as $key=>$value){
	if($y<=$rows+1){
	   $newArray[$d][$key]=$value;
	   
	}else{
		
		$y=1;
		$d++;
		$newArray[$d][$key]=$value;
	}
	$y++;
}
$arResult["SECTIONS"] = $newArray;
?>