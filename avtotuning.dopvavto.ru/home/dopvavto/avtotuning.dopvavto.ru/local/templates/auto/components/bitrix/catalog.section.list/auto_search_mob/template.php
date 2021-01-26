<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
global $USER;
$filter = array("ID" => $USER->GetID());
$arParams["SELECT"] = array("UF_MARKA","UF_MODEL","UF_YEAR");
$rsUsers = CUser::GetList(($by="ID"), ($order="DESC"), $filter,$arParams);
while ($arUser = $rsUsers->Fetch()) {
    $arSpecUser['UF_MARKA'] = $arUser['UF_MARKA'];
    $arSpecUser['UF_MODEL'] = $arUser['UF_MODEL'];
    $arSpecUser['UF_YEAR'] = $arUser['UF_YEAR'];
}

?>
<form method="post" action="/avto_search/">
    <div class="search main_flex flex__align-items_start flex__jcontent_start">
        <div class="search__title">
            <span class="bd myauto">Мой автомобиль</span>
            <a href="<?if ($USER->IsAuthorized()) echo SITE_DIR.'personal/auto/'; else echo 'javascript:void(0)';?>" class="bd <?if (!$USER->IsAuthorized()) echo 'btn-login';?>">Добавить в список <img class="svg" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/double-angle-right.svg" width="7"></a>
        </div>
        <div class="search__select main_flex flex__align-items_center flex__1">
            <div class="dropdown">
                <span class="dropdown-button" data-text="Марка" data-cookie="Марка">
                    <?
                    if ($USER->IsAuthorized()){
                        if($_COOKIE['avto_marka']){
                            echo $_COOKIE['avto_marka'];
							$level=1;
							$what=1;
							$avto_id=$_COOKIE['avto_marka_id'];
							$avto_value=$_COOKIE['avto_marka'];
                        }else{
                            if($arSpecUser['UF_MARKA']){
								$level=1;
								$what=1;
								$avto_value=$arSpecUser['UF_MARKA'];
                                foreach ($arResult['SECTIONS'] as $arSections){
                                    if ($arSections['DEPTH_LEVEL']==1){
                                        if($arSpecUser['UF_MARKA'] == $arSections['NAME']){
                                            echo $arSections['NAME'];?>
                                            <?break;?>
                                        <?}?>
                                    <?}?>
                                <?}?>
                            <?}else{?>
                                Марка
                            <?}
                        }
                    }else{
                        if($_COOKIE['avto_marka']){
                            echo $_COOKIE['avto_marka'];
							$level=1;
							$what=1;
							$avto_id=$_COOKIE['avto_marka_id'];
							$avto_value=$_COOKIE['avto_marka'];
                        }else{?>
                            Марка
                        <?}
                    }?>
                </span>

                <ul class="dropdown-list">
                    <li data-what="1" data-value="Выбрать марку" data-id="-1" data-lvl="1" onClick="ajax(this);">Выбрать марку</li>
                    <?foreach ($arResult['SECTIONS'] as $arSections){
                        if ($arSections['DEPTH_LEVEL']==1){?>
                            <li data-what="1" data-value="<?=$arSections['NAME']?>" data-id="<?=$arSections['ID']?>" data-lvl="<?=$arSections['DEPTH_LEVEL']?>" onClick="ajax(this);"><?=$arSections['NAME']?></li>
                        <?}?>
                    <?}?>
                </ul>
                <img class="svg" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/cancel.svg" width="8">
            </div>

            <div class="dropdown">
                <span class="dropdown-button lvl2_span" data-text="Модель" data-cookie="Модель">
                    <?
                    if ($USER->IsAuthorized()){
                        if($_COOKIE['avto_model']){
                            echo $_COOKIE['avto_model'];
                        }else{
                            if($arSpecUser['UF_MODEL']){
                                foreach ($arResult['SECTIONS'] as $arSections){
                                    if ($arSections['DEPTH_LEVEL']==2){
                                        if($arSpecUser['UF_MODEL'] == $arSections['NAME']){
                                            echo $arSections['NAME'];?>
                                            <?break;?>
                                        <?}?>
                                    <?}?>
                                <?}?>
                            <?}else{?>
                                Модель
                            <?}
                        }

                    }else{
                        if($_COOKIE['avto_model']){
                            echo $_COOKIE['avto_model'];
                        }else{?>
                            Модель
                        <?}
                    }?>
                </span>
                <ul class="dropdown-list lvl2">
                    <li data-what="2" data-value="Выбрать модель" data-id="-1" data-lvl="2" onClick="ajax(this);">Выбрать модель</li>
                    <?foreach ($arResult['SECTIONS'] as $arSections){
                        if ($arSections['DEPTH_LEVEL'] == 2 && $_COOKIE['avto_marka_id'] == $arSections['IBLOCK_SECTION_ID']){?>
                            <li data-what="2" data-value="<?=$arSections['NAME']?>" data-id="<?=$arSections['ID']?>" data-lvl="<?=$arSections['DEPTH_LEVEL']?>" onClick="ajax(this);"><?=$arSections['NAME']?></li>
                        <?}?>
                    <?}?>
                </ul>
                <img class="svg" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/cancel.svg" width="8">
            </div>

            <div class="dropdown">
                <span class="dropdown-button lvl3_span" data-text="Год" data-cookie="Год">
                    <?if ($USER->IsAuthorized()){
                        if($_COOKIE['avto_god']){
                            echo $_COOKIE['avto_god'];
                        }else{
                            if($arSpecUser['UF_YEAR']){
                                foreach ($arResult['SECTIONS'] as $arSections){
                                    if ($arSections['DEPTH_LEVEL']==3){
                                        if($arSpecUser['UF_YEAR'] == $arSections['NAME']){
                                            echo $arSections['NAME'];?>
                                            <?break;?>
                                        <?}?>
                                    <?}?>
                                <?}?>
                            <?}else{?>
                                Год
                            <?}
                        }
                    }else{
                        if($_COOKIE['avto_god']){
                            echo $_COOKIE['avto_god'];
                        }else{?>
                            Год
                        <?}
                    }?>
                </span>
                <ul class="dropdown-list lvl3">
                    <li data-what="3" data-value="Выбрать год" data-id="-1" data-lvl="3" onClick="ajax(this);">Выбрать год</li>
                    <?foreach ($arResult['SECTIONS'] as $arSections){
                        if ($arSections['DEPTH_LEVEL']==3 && $_COOKIE['avto_model_id'] == $arSections['IBLOCK_SECTION_ID']){?>
                            <li data-what="3" data-value="<?=$arSections['NAME']?>" data-id="<?=$arSections['ID']?>" data-lvl="<?=$arSections['DEPTH_LEVEL']?>" onClick="ajax(this);"><?=$arSections['NAME']?></li>
                        <?}?>
                    <?}?>
                </ul>
                <img class="svg" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/cancel.svg" width="8">
            </div>
            <button class="btn bd">Найти в каталоге</button>
            <button li data-what="1" data-value="Выбрать марку" data-id="-1" data-lvl="1" onClick="ajax(this);" class="otm-btn otm-btn-mob btn">Сбросить</button>
        </div>
    </div>
</form>

