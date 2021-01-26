<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
foreach($arResult['SECTIONS'] as $k => $section)
{
	if($section['PICTURE']['ID'])
	{
		$arResult['SECTIONS'][$k]['PICTURE_260'] = resizeImg($section['PICTURE']['ID'], 260, 260);
	}
    $arResult['SECTIONS'][$k]['PICTURE_260_DETAL'] = resizeImg($section['DETAIL_PICTURE'], 260, 260);
}
?>