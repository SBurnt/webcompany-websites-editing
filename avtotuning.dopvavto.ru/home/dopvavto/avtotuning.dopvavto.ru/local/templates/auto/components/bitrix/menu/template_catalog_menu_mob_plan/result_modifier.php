<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach($arResult as $k => $item)
{
    $arResult[$k]['PICTURE'] = CFile::GetPath(getPictureSectionBYName($item['TEXT']));
}
?>
