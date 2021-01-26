<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");
if (isset($_REQUEST['id']))$ID = intval($_REQUEST['id']);
else $ID = 0;
if($USER->IsAuthorized()){
    $arUser = $USER->GetByID($USER->GetID())->GetNext();
    if($arUser["WORK_NOTES"])$arFavorites = explode(";",$arUser["WORK_NOTES"]); else $arFavorites = array();
}else{
    if(isset($_SESSION['favorites']) && is_array($_SESSION['favorites'])) $arFavorites = $_SESSION['favorites'];
    elseif($APPLICATION->get_cookie('favorites')) $arFavorites = explode(";", $APPLICATION->get_cookie('favorites'));
    else $arFavorites=array();
}

if($ID && $_REQUEST["actionType"]=="delete"){ // Удаление из избранного
    if(in_array($ID, $arFavorites)){
        unset($arFavorites[array_search($ID, $arFavorites)]);
        if($USER->IsAuthorized()){
            $USER->Update($arUser["ID"], array("WORK_NOTES"=>implode(";",$arFavorites)));
        }else{
            $_SESSION['favorites'] = $arFavorites;
            $APPLICATION->set_cookie("favorites", implode(";",$arFavorites), time()+60*60*24*30);
        }
    }
}elseif($ID && $_REQUEST["actionType"]=="add"){ // Добавление в избранное
    if(!in_array($ID, $arFavorites)){
        $arFavorites[] = $ID;
        if($USER->IsAuthorized()){
            $USER->Update($arUser["ID"], array("WORK_NOTES"=>implode(";",$arFavorites)));
        }else{
            $_SESSION['favorites'] = $arFavorites;
            $APPLICATION->set_cookie("favorites", implode(";", $arFavorites), time()+60*60*24*30);
        }
    }
   CSaleBasket::Delete($_REQUEST["basketid"]);

}
?>
    <svg class="favorites-top-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" viewBox="0 0 17 16">
        <defs>
            <style>
                .heart-icon-cls-2 {
                    fill: #000;
                    fill-rule: evenodd;
                }
            </style>
        </defs>
        <path d="M8.811,15.862 L8.500,16.000 L8.189,15.862 C4.197,13.390 -0.000,7.762 -0.000,4.637 C0.013,2.078 2.088,-0.000 4.636,-0.000 C6.247,-0.000 7.669,0.830 8.500,2.087 C9.331,0.830 10.753,-0.000 12.364,-0.000 C14.912,-0.000 16.986,2.078 17.000,4.637 C17.000,7.762 12.803,13.390 8.811,15.862 ZM12.364,0.777 C11.068,0.777 9.864,1.427 9.143,2.518 L8.500,3.490 L7.857,2.517 C7.136,1.427 5.932,0.777 4.636,0.777 C2.518,0.777 0.784,2.510 0.773,4.637 C0.773,7.394 4.727,12.758 8.500,15.142 C12.273,12.758 16.227,7.394 16.227,4.641 C16.216,2.510 14.482,0.777 12.364,0.777 Z" class="heart-icon-cls-2"/>
    </svg>

    <span class="favorites-top-title">Favorites</span> (<?=count($arFavorites)?>)
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>