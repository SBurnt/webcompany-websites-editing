<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
$arSelect = Array("ID", "IBLOCK_ID", "NAME","SORT", "PROPERTY_*");
$arFilter = Array("IBLOCK_ID"=>array(30,31,32,33,34), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC", "PROPERTY_SORT"=>"ASC"), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
    $arResult['vidjet'][] =  $ob->GetProperties();
}
