<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
use Bitrix\Main;

$defaultParams = array(
	'TEMPLATE_THEME' => 'blue'
);
$arParams = array_merge($defaultParams, $arParams);
unset($defaultParams);

$arParams['TEMPLATE_THEME'] = (string)($arParams['TEMPLATE_THEME']);
if ('' != $arParams['TEMPLATE_THEME'])
{
	$arParams['TEMPLATE_THEME'] = preg_replace('/[^a-zA-Z0-9_\-\(\)\!]/', '', $arParams['TEMPLATE_THEME']);
	if ('site' == $arParams['TEMPLATE_THEME'])
	{
		$templateId = (string)Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', SITE_ID);
		$templateId = (preg_match("/^eshop_adapt/", $templateId)) ? 'eshop_adapt' : $templateId;
		$arParams['TEMPLATE_THEME'] = (string)Main\Config\Option::get('main', 'wizard_'.$templateId.'_theme_id', 'blue', SITE_ID);
	}
	if ('' != $arParams['TEMPLATE_THEME'])
	{
		if (!is_file($_SERVER['DOCUMENT_ROOT'].$this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
			$arParams['TEMPLATE_THEME'] = '';
	}
}


foreach ($arResult['GRID']['ROWS'] as $key => $PRODUCT_GIFT) {
    if($PRODUCT_GIFT['DELAY'] == 'N'){
        if($PRODUCT_GIFT['PROPERTY_PRODUCT_GIFT_VALUE']):
            foreach (explode(',', $PRODUCT_GIFT['PROPERTY_PRODUCT_GIFT_VALUE']) as $PROPERTY_PRODUCT_GIFT){
                $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "CATALOG_GROUP_1");
                $arFilter = Array("IBLOCK_ID"=>2, 'ID' => $PROPERTY_PRODUCT_GIFT, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                while($ob = $res->GetNextElement())
                {
                    $arFields = $ob->GetFields();
                    $arResult['GRID']['ROWS'][$key]['PRODUCT_GIFT'][] = $arFields;
                }
            }
        endif; 
    }
}
unset($arFields);
foreach ($arResult['GRID']['ROWS'] as $key => $PODAROK) {
    if($PODAROK['DELAY'] == 'N'){
        if($PODAROK['PROPERTY_PODAROK_VALUE']):
            $arSelect2 = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "CATALOG_GROUP_1");
            $arFilter2 = Array("IBLOCK_ID"=>2, 'ID' => $PODAROK['PROPERTY_PODAROK_VALUE'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
            $res2 = CIBlockElement::GetList(Array(), $arFilter2, false, false, $arSelect2);
            while($ob2 = $res2->GetNextElement())
            {
                $arFields2 = $ob2->GetFields();
                $arResult['GRID']['ROWS'][$key]['PODAROK'] = $arFields2;
            }
        endif;  
    }
    
}
unset($arFields2);
foreach ($arResult['GRID']['ROWS'] as $key => $KIT_ITEMS) {
    if($KIT_ITEMS['DELAY'] == 'N'){
        if($KIT_ITEMS['PROPERTY_KIT_ITEMS_VALUE']):
            foreach (explode(',', $KIT_ITEMS['PROPERTY_KIT_ITEMS_VALUE']) as $PROPERTY_KIT_ITEMS){
                $arSelect1 = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "CATALOG_GROUP_1");
                $arFilter1 = Array("IBLOCK_ID"=>2, 'ID' => $PROPERTY_KIT_ITEMS, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
                $res1 = CIBlockElement::GetList(Array(), $arFilter1, false, false, $arSelect1);
                while($ob1 = $res1->GetNextElement())
                {
                    $arFields1 = $ob1->GetFields();
                    $arResult['GRID']['ROWS'][$key]['KIT_ITEMS'][] = $arFields1;
                }
            }
        endif; 
    }
}
unset($arFields1);

foreach ($arResult['GRID']['ROWS'] as $key => $ROW) {
    $skidka = $ROW['PROPERTY_KIT_ITEMS_SKIDKA_VALUE'] ? $ROW['PROPERTY_KIT_ITEMS_SKIDKA_VALUE'] : 5;
    if($ROW['DELAY'] == 'N'){
        foreach (explode(',',$ROW['PROPERTY_NADBAVKA_VALUE']) as $elNadbavka){
            $arFilter = Array("IBLOCK_ID"=>17, "ID"=>$elNadbavka);
            $res = CIBlockElement::GetList(Array(), $arFilter);
            if ($ob = $res->GetNextElement()){;
                $arFields = $ob->GetFields(); // поля элемента
                $arProps = $ob->GetProperties(); // свойства элемента
            }
            if($ROW['PROPS_ALL']['nadbavka']['VALUE'] == $arFields['ID']){
                $arResult['GRID']['ROWS'][$key]['NADBAVKA']['PRICE'] = stristr($arProps['PRICE_NADBAVKA']['VALUE'], ' ', true);
            }
        }
        if($ROW['PROPS_ALL']['Komplect']['VALUE'] == 'KOM'){
            $ROWS = $ROW['PRICE'] * $ROW['QUANTITY'];
            $arResult['GRID']['ROWS'][$key]['PROPERTY_OLD_PRICE_VALUE'] = $arResult['GRID']['ROWS'][$key]['PROPS_ALL']['PROPERTY_OLD_PRICE_VALUE']['VALUE']*$ROW['QUANTITY'];
            $arResult['DISCOUNT_OLD_FULL'] += $arResult['GRID']['ROWS'][$key]['PROPS_ALL']['PROPERTY_OLD_PRICE_VALUE']['VALUE']*$ROW['QUANTITY'];
        }elseif($ROW['PROPS_ALL']['Komplect']['VALUE'] == 'POD'){
            $ROWS = ($ROW['PRICE']+ round(CCurrencyRates::ConvertCurrency($ROW['PODAROK']['CATALOG_PRICE_1'], $ROW['PODAROK']['CATALOG_CURRENCY_1'], "BYN"),2))* $ROW['QUANTITY'];
            $arResult['GRID']['ROWS'][$key]['PROPERTY_OLD_PRICE_VALUE'] = $ROWS;
            $arResult['DISCOUNT_OLD_FULL'] += $ROWS;
        }elseif ($ROW['PROPERTY_OLD_PRICE_VALUE']){
            $ROWS = (round(CCurrencyRates::ConvertCurrency($ROW['PROPERTY_OLD_PRICE_VALUE'], $ROW['CURRENCY'], "BYN"),2)+$arResult['GRID']['ROWS'][$key]['NADBAVKA']['PRICE']) * $ROW['QUANTITY'];
            $arResult['GRID']['ROWS'][$key]['PROPERTY_OLD_PRICE_VALUE'] = $ROWS;
//            number_format($ROWS, 2, '.',' ');
            $arResult['DISCOUNT_OLD_FULL'] += $ROWS;
        }else{
            $arResult['DISCOUNT_OLD_FULL'] += round($ROW['SUM_VALUE'],2);
        }
    }
}
unset($arFields);
$arResult['SAVING'] = $arResult['DISCOUNT_OLD_FULL'] - $arResult['allSum'];




if ('' == $arParams['TEMPLATE_THEME'])
	$arParams['TEMPLATE_THEME'] = 'blue';