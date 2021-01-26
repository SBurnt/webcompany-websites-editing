<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arBanners = [];
$rsHeaderBanner = CIBlockElement::GetList(["SORT"=>"ASC"],["IBLOCK_ID"=>19,"ACTIVE_DATE"=>"Y","ACTIVE"=>"Y","PROPERTY_TYPE"=>106],false,false,["ID","NAME","SORT","DETAIL_TEXT","PROPERTY_LINK","PROPERTY_MAIN_PAGE","PROPERTY_LINK_TEMPLATE","PREVIEW_PICTURE"]);
while($arHeaderBanner = $rsHeaderBanner->GetNext()){
  if(MAIN_PAGE == "Y" && $arHeaderBanner["PROPERTY_MAIN_PAGE_VALUE"]=="Y")$SHOW = true;
  elseif(MAIN_PAGE != "Y" && !$arHeaderBanner["PROPERTY_LINK_TEMPLATE_VALUE"])$SHOW = true;
  elseif(MAIN_PAGE != "Y" && $arHeaderBanner["PROPERTY_LINK_TEMPLATE_VALUE"] && substr_count($curPage, $arHeaderBanner["PROPERTY_LINK_TEMPLATE_VALUE"]))$SHOW = true;
  else $SHOW = false;
  if($SHOW && $arHeaderBanner["ID"]){
    $arBanners[] = $arHeaderBanner;
  }
}

if(!empty($arBanners)){
  $rndBanners = [];
  $curBanner = $curSort = $Stop = 0;
  while(!$Stop){
    if(!$arBanners[$curBanner]){
      $Stop = true;
    }elseif($arBanners[$curBanner]["SORT"]>$curSort){
      $rndBanners[] = $curBanner;
      $curSort += 10;
    }else{
      $curSort = 0;
      $curBanner++;
    }
  }
  $arBanner = $arBanners[$rndBanners[rand(0, count($rndBanners)-1)]];
  if($arBanner["ID"]){
    ?>
    <div class="promobanner">
      <?if($arBanner["PROPERTY_LINK_VALUE"]){?>
        <a href="<?=$arBanner["PROPERTY_LINK_VALUE"]?>" onclick="countbanner(<?=$arBanner["ID"]?>);">
      <?}?>
        <?if($arBanner["DETAIL_TEXT"]){?>
          <?=$arBanner["DETAIL_TEXT"]?>
        <?}else{?>
          <img src="<?=CFile::GetPath($arBanner["PREVIEW_PICTURE"])?>" alt="<?=$arBanner["NAME"]?>">
        <?}?>
      <?if($arBanner["PROPERTY_LINK_VALUE"]){?>
        </a>
      <?}?>
    </div>
  <?}
}?>