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
?>

<?foreach($arResult["ITEMS"] as $arItem){?>
    <div class="team-block">
        <?if($arItem['PICTURE_240_290']){?>
            <div class="img">
                <img src="<?=$arItem['PICTURE_240_290'];?>" alt="<?=$arItem['NAME'];?>">
            </div>
        <?}?>
        <div class="info-block">
            <p class="name">
                <?=$arItem['NAME'];?>
            </p>
            <?if($arItem['PROPERTIES']['POST']['VALUE']){?>
                <p class="position">
                    <?=$arItem['PROPERTIES']['POST']['VALUE'];?>
                </p>
            <?}?>

            <?if($arItem['PROPERTIES']['OBRAZ']['VALUE']){?>
                <p class="info_item">
                    <span>
                        Образование:
                    </span>
                    <?=$arItem['PROPERTIES']['OBRAZ']['VALUE'];?>
                </p>
            <?}?>

            <?if($arItem['PROPERTIES']['DOP_OBRAZ']['VALUE']){?>
                <p class="info_item">
                    <span>Дополнительное образование:</span> <?=$arItem['PROPERTIES']['DOP_OBRAZ']['VALUE'];?>
                </p>
            <?}?>

            <?if($arItem['PROPERTIES']['EXP']['VALUE']){?>
                <p class="info_item">
                    <span>Опыт работы:</span>  <?=$arItem['PROPERTIES']['EXP']['VALUE'];?>
                </p>
            <?}?>

            <?if(is_array($arItem['PROPERTIES']['PHONES']['VALUE'])){
                foreach($arItem['PROPERTIES']['PHONES']['VALUE'] as $phone){
                ?>
                <a href="tel:<?=$phone;?>" class="phone">
                    <?=$phone;?>
                </a>
                <?}?>
            <?}?>
        </div>
    </div>
<?}?>