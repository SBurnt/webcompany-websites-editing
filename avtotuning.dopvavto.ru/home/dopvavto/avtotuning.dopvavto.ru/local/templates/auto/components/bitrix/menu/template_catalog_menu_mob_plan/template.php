<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)){?><?
    $previousLevel = 0;
//    pr($arResult);
foreach($arResult as $key=>$arItem){?>
        <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
            <?=str_repeat("</ul></nav>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
        <?endif?>
        <?if($key== 0 || $key == 16 || $key == 29){?>
            <div class="flex__9">
        <?}?>
        <?if ($arItem["IS_PARENT"]){?>
            <?if ($arItem["DEPTH_LEVEL"] == 1){
               ?>
                <nav class="content__nav">
                    <div class="content__nav--cl">
                        <a class="bd" href="/catalog<?=$arItem["LINK"]?>"><h2 class="bd"><?=$arItem["TEXT"]?></h2></a>
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
                    <a class="bd" href="/catalog<?=$arItem["LINK"]?>"><h2 class="bd"><?=$arItem["TEXT"]?></h2></a>
                </div>
            <?else:?>
                <li><a  class="bd" href="/catalog<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
            <?endif?>
        <?}?>
        <?if($key == 15 || $key==28 || $key == 37){?>
            </div>
        <?}?>
        <?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?}?>
    <?if ($previousLevel > 1)://close last item tags?>
        <?=str_repeat("</ul>", ($previousLevel-1) );?>
    <?endif?>
<?}?>