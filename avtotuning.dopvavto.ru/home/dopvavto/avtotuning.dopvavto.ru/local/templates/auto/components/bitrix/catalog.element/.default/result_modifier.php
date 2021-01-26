<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arResult['COUNT_LIKES'] = getCountLikesDiz($arResult['ID']);
$arResult['COUNT_REVIEWS'] = getCountReviews($arResult['ID']);
$arResult['COUNT_REVIEWS_TEXT'] = getTermination(getCountReviews($arResult['ID']));
$arResult['GALLERY_1'] = array();

if($arResult['DETAIL_PICTURE']['ID'])
{
    $arResult['DETAIL_PICTURE_408_368'] = resizeImg($arResult['DETAIL_PICTURE']['ID'], 408, 368);
    $arResult['GALLERY'][] = $arResult['DETAIL_PICTURE_408_368'];
    $arResult['GALLERY_1'][] = $arResult['DETAIL_PICTURE']['SRC'];
}


if(is_array($arResult['PROPERTIES']['GALLERY']['VALUE']))
{
    foreach($arResult['PROPERTIES']['GALLERY']['VALUE'] as $gallery)
    {
        $arResult['GALLERY'][] = resizeImg($gallery, 408, 368);
        $arResult['GALLERY_1'][] = CFile::GetPath($gallery);
    }
}

if($arResult['PROPERTIES']['MANUFACTURER']['VALUE'])
{
    $res = CIBlockElement::GetByID($arResult['PROPERTIES']['MANUFACTURER']['VALUE']);
    if($ar_res = $res->GetNext())
    {
        $arResult['MANUFACTURER'] = $ar_res;
    }
}

// Текст для вкладки "Установка"
$arFilter = Array('IBLOCK_ID'=> 2, 'ID' => $arResult['IBLOCK_SECTION_ID']);
$db_list = CIBlockSection::GetList(Array("ID"=>"ASC"), $arFilter, false, array('UF_INSTALL', 'ID', 'UF_FAQ'));

$uf_faq = array();

while($ar_result = $db_list->GetNext())
{
    $arResult['UF_INSTALL'] = $ar_result['UF_INSTALL'];
    $uf_faq = $ar_result['UF_FAQ'];
}
// Поучаем элементы для вкладки "Вопрос-ответ"
if($uf_faq)
{
    $arSelect = Array("ID", "NAME", "PREVIEW_TEXT");
    $arFilter = Array("IBLOCK_ID"=> 15, "ID" => $uf_faq, "ACTIVE" => 'Y');
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $arResult['UF_FAQ'][] = $arFields;
    }
}

// Получаем отзывы к товару
$i = 0;
$arSelect = Array("ID", "NAME", "PROPERTY_NAME", "PROPERTY_SCORE", "PREVIEW_TEXT", "ACTIVE_FROM");
$arFilter = Array("IBLOCK_ID"=> 12, "ACTIVE"=>"Y", 'PROPERTY_ID_PRODUCT' => $arResult['ID']);
$res = CIBlockElement::GetList(Array("ACTIVE_FROM" => 'DESC'), $arFilter, false, false,$arSelect);
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arResult['REVIEWS'][$i] = $arFields;
    $arResult['REVIEWS'][$i]['LIKES'] = getCountLikesReview($arFields['ID']);;
    $i++;
}

foreach ($arResult['PROPERTIES']['KIT_ITEMS']['VALUE'] as $KIT_ITEM) {
    $arSelect1 = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_PICTURE", "CATALOG_GROUP_1", "DETAIL_PAGE_URL", "LIST_PAGE_URL");
    $arFilter1 = Array("IBLOCK_ID"=>2, 'ID' => $KIT_ITEM, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
    $res1 = CIBlockElement::GetList(Array(), $arFilter1, false, false, $arSelect1);
    while($ob1 = $res1->GetNextElement())
    {
        $arFields1[] = $ob1->GetFields();
        $arResult['PROPERTIES']['KIT_ITEMS']['KIT_ITEMS'] = $arFields1;
    }
}
foreach ($arResult['PROPERTIES']['PRODUCT_GIFT']['VALUE'] as $PRODUCT_GIFT) {
    $arSelect2 = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_PICTURE", "CATALOG_GROUP_1", "DETAIL_PAGE_URL", "LIST_PAGE_URL");
    $arFilter2 = Array("IBLOCK_ID"=>2, 'ID' => $PRODUCT_GIFT, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
    $res2 = CIBlockElement::GetList(Array(), $arFilter2, false, false, $arSelect2);
    while($ob2 = $res2->GetNextElement())
    {
        $arFields2[] = $ob2->GetFields();
        $arResult['PROPERTIES']['PRODUCT_GIFT']['PRODUCT_GIFT'] = $arFields2;
    }
}
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_PICTURE", "CATALOG_GROUP_1", "DETAIL_PAGE_URL", "LIST_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=>2, 'ID' => $arResult['PROPERTIES']['PODAROK']['VALUE'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arResult['PROPERTIES']['PODAROK']['PODAROK'] = $arFields;
}
$dbBasketItems = CSaleBasket::GetList(
    array(
        "NAME" => "ASC",
        "ID" => "ASC"
    ),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "PRODUCT_ID" => $arResult['ID'],
        "ORDER_ID" => "NULL",
        "DELAY" => "Y"
    ),
    false,
    false,
    array("PRODUCT_ID")
);
while ($arItems = $dbBasketItems->Fetch())
{
    $arResult['DELAY'] = $arItems['PRODUCT_ID'];
}


