<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if(!$arResult["ERRORS"]){?>

    <div class="pictures">
        <?foreach ( $arResult["ITEM"] as $k => $element){?>
            <img src="<?=$element["IMAGE"];?>" alt="">
        <?
        if($k + 1 == $arParams['MEDIA_COUNT'])
            break;
        }?>
    </div>

<?}else{
     foreach ($arResult["ERRORS"] as $error){
         echo $error.'<br>';
     }
}?>
