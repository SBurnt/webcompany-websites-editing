<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)){?><?
    $previousLevel = 0;
foreach($arResult as $arItem){?>
        <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
            <?=str_repeat("</ul></nav>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
        <?endif?>
        <?if ($arItem["IS_PARENT"]){?>
            <?if ($arItem["DEPTH_LEVEL"] == 1){?>
            <nav class="content__nav">
                <div class="content__nav--cl">
                    <a class="bd" href="/catalog<?=$arItem["LINK"]?>"><span class="bd autoaccessories"><?=$arItem["TEXT"]?></span></a>
                </div>
                <ul class="content__nav--show">
            <?}else{?>
                <li><a class="bd" href="/catalog<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                <ul class="content__nav--fx">
            <?}?>

        <?}else{?>
            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
            <nav class="content__nav">
                <div class="content__nav--cl">
                    <a class="bd" href="/catalog<?=$arItem["LINK"]?>"><span class="bd autoaccessories"><?=$arItem["TEXT"]?></span></a>
                </div>
            <?else:?>
                <li><a  class="bd" href="/catalog<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
            <?endif?>
        <?}?>
        <?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?}?>
    <?if ($previousLevel > 1)://close last item tags?>
        <?=str_repeat("</ul>", ($previousLevel-1) );?>
    <?endif?>
<?}?>