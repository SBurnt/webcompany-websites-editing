<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $arResult
 * @var SaleOrderAjax $component
 */

$component = $this->__component;
$component::scaleImages($arResult['JS_DATA'], $arParams['SERVICES_IMAGES_SCALING']);

global $USER;
if ($USER->IsAuthorized()){
    $filter = array("ID" => $USER->GetID());
    $arParams["SELECT"] = array("UF_*");
    $rsUsers = CUser::GetList(($by="ID"), ($order="DESC"), $filter,$arParams);
    while ($arUser = $rsUsers->Fetch()) {
        if($arUser['UF_TYPE']==1){
            $arResult['AUTH']['ID'] = $arUser['ID'];
            $arResult['AUTH']['NAME'] = $arUser['NAME'];
            $arResult['AUTH']['PERSONAL_PHONE'] = $arUser['PERSONAL_PHONE'];
            $arResult['AUTH']['EMAIL'] = $arUser['EMAIL'];
        }else{
            $arResult['AUTH']['ID'] = $arUser['ID'];
            $arResult['AUTH']['NAME'] = $arUser['NAME'];
            $arResult['AUTH']['EMAIL'] = $arUser['EMAIL'];
            $arResult['AUTH']['PERSONAL_PHONE'] = $arUser['PERSONAL_PHONE'];
            $arResult['AUTH']['NAME_COMPANY'] = $arUser['UF_NAME_COMPANY'];
            $arResult['AUTH']['UR_ADDRESS'] = $arUser['UF_UR_ADDRESS'];
            $arResult['AUTH']['UNP'] = $arUser['UF_UNP'];
            $arResult['AUTH']['BANK'] = $arUser['UF_BANK'];
            $arResult['AUTH']['CONTACT'] = $arUser['UF_CONTACT'];
        }

    }
}