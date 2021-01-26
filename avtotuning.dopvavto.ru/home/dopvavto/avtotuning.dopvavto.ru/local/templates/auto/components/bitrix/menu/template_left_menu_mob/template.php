<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<ul class="sidebar-menu sidebar-menu__sm">
    <?foreach($arResult as $arItem){?>
        <li>
            <a href="<?=$arItem['LINK'];?>">
                <?=$arItem['TEXT'];?>
                <svg class="arrow-right" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 1.8125 7.07129)"/>
                    <rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 0 7.07129)" fill="#0C202E"/>
                </svg>
            </a>
        </li>
    <?}?>
</ul>