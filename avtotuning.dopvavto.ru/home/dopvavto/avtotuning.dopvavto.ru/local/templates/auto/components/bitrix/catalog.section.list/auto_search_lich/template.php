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
<h2 class="shop__title category rg"><?=$APPLICATION->ShowTitle();?></h2>
<div class="message_avto"></div>
<form method="post">
    <label>
        <div class="dropdown">
            <span class="dropdown-button" data-text="Марка" data-marka="Марка">
                <?if($arSpecUser['UF_MARKA']){
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
                <?}?>
            </span>
            <ul class="dropdown-list">
                <?foreach ($arResult['SECTIONS'] as $arSections){
                    if ($arSections['DEPTH_LEVEL']==1){?>
                        <li data-value="<?=$arSections['NAME']?>" data-id="<?=$arSections['ID']?>" data-lvl="<?=$arSections['DEPTH_LEVEL']?>" onClick="ajax(this);"><?=$arSections['NAME']?></li>
                    <?}?>
                <?}?>
            </ul>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 21.9 21.9"enable-background="new 0 0 21.9 21.9" class="svg replaced-svg">
                <path d="M14.1,11.3c-0.2-0.2-0.2-0.5,0-0.7l7.5-7.5c0.2-0.2,0.3-0.5,0.3-0.7s-0.1-0.5-0.3-0.7l-1.4-1.4C20,0.1,19.7,0,19.5,0  c-0.3,0-0.5,0.1-0.7,0.3l-7.5,7.5c-0.2,0.2-0.5,0.2-0.7,0L3.1,0.3C2.9,0.1,2.6,0,2.4,0S1.9,0.1,1.7,0.3L0.3,1.7C0.1,1.9,0,2.2,0,2.4  s0.1,0.5,0.3,0.7l7.5,7.5c0.2,0.2,0.2,0.5,0,0.7l-7.5,7.5C0.1,19,0,19.3,0,19.5s0.1,0.5,0.3,0.7l1.4,1.4c0.2,0.2,0.5,0.3,0.7,0.3  s0.5-0.1,0.7-0.3l7.5-7.5c0.2-0.2,0.5-0.2,0.7,0l7.5,7.5c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3l1.4-1.4c0.2-0.2,0.3-0.5,0.3-0.7  s-0.1-0.5-0.3-0.7L14.1,11.3z"></path>
            </svg>
        </div>
    </label>
    <label>
        <div class="dropdown">
            <span class="dropdown-button lvl2_span" data-text="Модель" data-marka="Модель">
                <?if($arSpecUser['UF_MODEL']){
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
                <?}?>
            </span>
            <ul class="dropdown-list lvl2">
                <?foreach ($arResult['SECTIONS'] as $arSections){
                    if ($arSections['DEPTH_LEVEL']==2){?>
                        <li data-value="<?=$arSections['NAME']?>" data-id="<?=$arSections['ID']?>" data-lvl="<?=$arSections['DEPTH_LEVEL']?>" onClick="ajax(this);"><?=$arSections['NAME']?></li>
                    <?}?>
                <?}?>
            </ul>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 21.9 21.9"enable-background="new 0 0 21.9 21.9" class="svg replaced-svg">
                <path d="M14.1,11.3c-0.2-0.2-0.2-0.5,0-0.7l7.5-7.5c0.2-0.2,0.3-0.5,0.3-0.7s-0.1-0.5-0.3-0.7l-1.4-1.4C20,0.1,19.7,0,19.5,0  c-0.3,0-0.5,0.1-0.7,0.3l-7.5,7.5c-0.2,0.2-0.5,0.2-0.7,0L3.1,0.3C2.9,0.1,2.6,0,2.4,0S1.9,0.1,1.7,0.3L0.3,1.7C0.1,1.9,0,2.2,0,2.4  s0.1,0.5,0.3,0.7l7.5,7.5c0.2,0.2,0.2,0.5,0,0.7l-7.5,7.5C0.1,19,0,19.3,0,19.5s0.1,0.5,0.3,0.7l1.4,1.4c0.2,0.2,0.5,0.3,0.7,0.3  s0.5-0.1,0.7-0.3l7.5-7.5c0.2-0.2,0.5-0.2,0.7,0l7.5,7.5c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3l1.4-1.4c0.2-0.2,0.3-0.5,0.3-0.7  s-0.1-0.5-0.3-0.7L14.1,11.3z"></path>
            </svg>
        </div>
    </label>
    <label>
        <div class="dropdown">
            <span class="dropdown-button lvl3_span" data-text="Год" data-marka="Год">
                <?if($arSpecUser['UF_YEAR']){
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
                <?}?>
            </span>
            <ul class="dropdown-list lvl3">
                <?foreach ($arResult['SECTIONS'] as $arSections){
                    if ($arSections['DEPTH_LEVEL']==3){?>
                        <li data-value="<?=$arSections['NAME']?>" data-id="<?=$arSections['ID']?>" data-lvl="<?=$arSections['DEPTH_LEVEL']?>"><?=$arSections['NAME']?></li>
                    <?}?>
                <?}?>
            </ul>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 21.9 21.9" enable-background="new 0 0 21.9 21.9" class="svg replaced-svg">
                <path d="M14.1,11.3c-0.2-0.2-0.2-0.5,0-0.7l7.5-7.5c0.2-0.2,0.3-0.5,0.3-0.7s-0.1-0.5-0.3-0.7l-1.4-1.4C20,0.1,19.7,0,19.5,0  c-0.3,0-0.5,0.1-0.7,0.3l-7.5,7.5c-0.2,0.2-0.5,0.2-0.7,0L3.1,0.3C2.9,0.1,2.6,0,2.4,0S1.9,0.1,1.7,0.3L0.3,1.7C0.1,1.9,0,2.2,0,2.4  s0.1,0.5,0.3,0.7l7.5,7.5c0.2,0.2,0.2,0.5,0,0.7l-7.5,7.5C0.1,19,0,19.3,0,19.5s0.1,0.5,0.3,0.7l1.4,1.4c0.2,0.2,0.5,0.3,0.7,0.3  s0.5-0.1,0.7-0.3l7.5-7.5c0.2-0.2,0.5-0.2,0.7,0l7.5,7.5c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3l1.4-1.4c0.2-0.2,0.3-0.5,0.3-0.7  s-0.1-0.5-0.3-0.7L14.1,11.3z"></path>
            </svg>
        </div>
    </label>
    <div class="auto-buttons">
        <button class="web-main-btn">
            Сохранить
        </button>
        <button class="remove">
            Сбросить
        </button>
    </div>
</form>

<script>
    function ajax(i){
        var id = $(i).attr('data-id');
        var lvl = $(i).attr('data-lvl');
        var value = $(i).attr('data-value');
        $.ajax({
            type: 'POST',
            url: '<?=SITE_DIR?>ajax/avto_marka.php',
            data: {id: id, lvl: lvl, value: value},
            success: function(data){
                if(lvl==1){
                    $('.lvl2').html(data);
                    $('.lvl2_span').text('Модель');
                    $('.lvl3_span').text('Год');
                }else if(lvl==2){
                    $('.lvl3').html(data);
                    $('.lvl3_span').text('Год');
                }
            }
        });
    }

    $('.web-main-btn').click(function(e){
        e.preventDefault();
        if($('span[data-marka="Марка"]').text()!='Марка'){
            var marka = $('span[data-marka="Марка"]').text();
        }else{
            var marka ='';
        }
        if($('span[data-marka="Модель"]').text()!='Модель'){
            var model = $('span[data-marka="Модель"]').text();
        }else{
            var model ='';
        }
        if($('span[data-marka="Год"]').text()!='Год'){
            var god = $('span[data-marka="Год"]').text();
        }else{
            var god='';
        }
        $.ajax({
            type: 'POST',
            url: '<?=SITE_DIR?>ajax/avto_save.php',
            data: {marka: marka, model: model, god: god},
            success: function(data){
                $('.message_avto').html(data);
            }
        });
    });
    $('.remove').click(function(){
        $.ajax({
            type: 'POST',
            url: '<?=SITE_DIR?>ajax/avto_save.php'
        });
    });



</script>
