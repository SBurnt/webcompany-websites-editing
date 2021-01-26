<?php

/* get tree of sections with 2 depth lvl*/
$arResult['SECTIONS_TREE'] = array_reduce($arResult["SECTIONS"], function($ar, $arSection) use ($arParams) {
	if ($arSection['DEPTH_LEVEL'] == 1) {
		$ar[] = $arSection;
	} else {
		$firstLevel = &$ar[ count($ar)-1 ];
		if (isset($firstLevel['SUBSECTIONS']) && count($firstLevel['SUBSECTIONS']) >= ($arParams['MAX_SUBSECTIONS'] ?: 5))
		{
			$firstLevel['SHOW_MORE']++;
		}
		else
		{
			$firstLevel['SUBSECTIONS'][] = $arSection;
		}
	}

	return $ar;
}, []);