<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)){?>
    <ul class="sidebar-menu">

<!--    --><?//pr($arResult);
    $previousLevel = 0;
foreach($arResult as $arItem){?>

    <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
        <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
    <?endif?>

    <?if ($arItem["IS_PARENT"]){?>

        <?if ($arItem["DEPTH_LEVEL"] == 1){?>
            <li class="sidebar-menu__dropdown">
                <a href="/catalog<?=$arItem["LINK"]?>" >
					<?
                    if($arItem['PICTURE'])
                        print '<span class="nav-ico"><img width="35px" src="'.$arItem["PICTURE"].'"></span>';
                    ?>
                    <?=$arItem["TEXT"]?>
                    <svg class="arrow-right" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 1.8125 7.07129)"/>
                        <rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 0 7.07129)" fill="#0C202E"/>
                    </svg>
                </a>
            <ul class="submenu">
            <?}else{?>
            <li>
                <a href="/catalog<?=$arItem["LINK"]?>">
                    <?
                    if($arItem['PICTURE']){?>
                        <span class="nav-ico">
                           <img width="35px" src="<?=$arItem["PICTURE"]?>">
                       </span>
                    <?}?>


                    <?=$arItem["TEXT"]?>
                    <svg class="arrow-right" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 1.8125 7.07129)"/>
                        <rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 0 7.07129)" fill="#0C202E"/>
                    </svg>
                </a>
            <ul class="thirdmenu">
        <?}?>

    <?}else{?>

        <?if ($arItem["DEPTH_LEVEL"] == 1):?>
            <li>
                <a href="/catalog<?=$arItem["LINK"]?>">
                    <?
                    if($arItem['PICTURE']){?>
                        <span class="nav-ico">
                           <img width="35px" src="<?=$arItem["PICTURE"]?>">
                       </span>
                    <?}?>
                    <?=$arItem["TEXT"]?>
                </a>
            </li>
        <?else:?>
            <li>
                <a href="/catalog<?=$arItem["LINK"]?>">
                    <?=$arItem["TEXT"]?>
                </a>
            </li>
        <?endif?>


    <?}?>

    <?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?}?>

    <?if ($previousLevel > 1)://close last item tags?>
        <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
    <?endif?>

    </ul>
<?}?>