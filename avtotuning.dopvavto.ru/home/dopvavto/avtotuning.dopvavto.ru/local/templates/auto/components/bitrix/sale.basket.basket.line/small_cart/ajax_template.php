<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$this->IncludeLangFile('template.php');

$cartId = $arParams['cartId'];


if ($arParams["SHOW_PRODUCTS"] == "Y" && ($arResult['NUM_PRODUCTS'] > 0 || !empty($arResult['CATEGORIES']['DELAY'])))
{
//?><!----><?//pr($arResult);?>
<ul>
    <?foreach ($arResult["CATEGORIES"] as $category => $items):
        if (empty($items))
            continue;?>
        <?foreach ($items as $v):
//        pr($v);?>
            <li class="">
                <?if($v['KOM']){?>
                    <span class="basket__open--compl">Комплект:</span>
                <?}?>
                <a href="<?=$v["DETAIL_PAGE_URL"]?>" class="main_flex flex__align-items_center flex__jcontent_between">
                    <span class="basket__open--img">
                        <?if($v["PREVIEW_PICTURE"]){?>
                            <img src="<?=CFile::GetPath($v["PREVIEW_PICTURE"])?>" alt="<?=$v["NAME"]?>">
                        <?}else{?>
                            <img src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.png" alt="not">
                        <?}?>
                    </span>

                    <p class="rg flex__1"><?=$v["NAME"]?></p>
                    <div class="basket__open--price">
                        <?=$v["SUM_VALUE"].' руб.'?>
                        <?if(!$v['KOM'] && $v['PROPS_CART']['OLD_PRICE']['VALUE']){?><span class="old-price"><?=round(CCurrencyRates::ConvertCurrency($v['PROPS_CART']['OLD_PRICE']['VALUE']*$v['QUANTITY'], $v['CURRENCY'], "BYN"),2);?> руб.</span><?}?>
                    </div>
                </a>
                <?if($v['KOM']){?>
                    <?$arSelect1 = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_PICTURE","DETAIL_PAGE_URL");
                    foreach ($v['PROPS_CART']['KIT_ITEMS']['VALUE'] as $KOM){
                        $arFilter1 = Array("IBLOCK_ID"=>2, 'ID' => $KOM, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
                        $res3 = CIBlockElement::GetList(Array(), $arFilter1, false, false, $arSelect1);
                        while($ob3 = $res3->GetNextElement())
                        {
                            $arFields3[] = $ob3->GetFields();
                        }
                    }
                    foreach ($v['PROPS_CART']['PRODUCT_GIFT']['VALUE'] as $KOM1){
                        $arFilter1 = Array("IBLOCK_ID"=>2, 'ID' => $KOM1, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
                        $res2 = CIBlockElement::GetList(Array(), $arFilter1, false, false, $arSelect1);
                        while($ob2 = $res2->GetNextElement())
                        {
                            $arFields2[] = $ob2->GetFields();
                        }
                    }
                    $arFilter1 = Array("IBLOCK_ID"=>2, 'ID' => $v['PROPS_CART']['PODAROK']['VALUE'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
                    $res1 = CIBlockElement::GetList(Array(), $arFilter1, false, false, $arSelect1);
                    while($ob1 = $res1->GetNextElement())
                    {
                        $arFields1 = $ob1->GetFields();
                    }
                    if($v['PROPS_CART']['DISCOUNT_KIT_ACTIV']['VALUE'] == 'Y'){
                        foreach ($arFields3 as $KITS){?>
                            <a href="<?=((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] .'/catalog/'. $KITS["DETAIL_PAGE_URL"]?>" class="main_flex flex__align-items_center flex__jcontent_between">
                            <span class="basket__open--img">
                                <img src="<? if(CFile::GetPath($KITS["PREVIEW_PICTURE"])) {echo CFile::GetPath($KITS["PREVIEW_PICTURE"]);} else{echo SITE_TEMPLATE_PATH?>/img/no_photo.png<?}?>" alt="<?=$KITS["NAME"]?>">
                            </span>
                                <p class="rg flex__1"><?=$KITS["NAME"]?></p>
                                <div class="basket__open--price"><?=$v["SUM"]?></div>
                            </a>
                        <?}
                    }
                    if($v['PROPS_CART']['DISCOUNT_KIT_ACTIV']['VALUE'] != 'Y' && $v['PROPS_CART']['GIFT_SET_ACTIV']['VALUE'] == 'Y'){
                        foreach ($arFields2 as $GIFT){?>
                            <a href="<?=((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] .'/catalog/'. $GIFT["DETAIL_PAGE_URL"]?>" class="main_flex flex__align-items_center flex__jcontent_between">
                            <span class="basket__open--img">
                                <img src="<? if(CFile::GetPath($GIFT["PREVIEW_PICTURE"])) {echo CFile::GetPath($GIFT["PREVIEW_PICTURE"]);} else{echo SITE_TEMPLATE_PATH?>/img/no_photo.png<?}?>" alt="<?=$GIFT["NAME"]?>">
                            </span>
                                <p class="rg flex__1"><?=$GIFT["NAME"]?></p>
                                <div class="basket__open--price"><?=$v["SUM"]?></div>
                            </a>
                        <?}?>
                        <a href="<?=((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] .'/catalog/'. $arFields1["DETAIL_PAGE_URL"]?>" class="main_flex flex__align-items_center flex__jcontent_between">
                            <span class="basket__open--img">
                                <img src="<? if(CFile::GetPath($arFields1["PREVIEW_PICTURE"])) {echo CFile::GetPath($arFields1["PREVIEW_PICTURE"]);} else{echo SITE_TEMPLATE_PATH?>/img/no_photo.png<?}?>" alt="<?=$arFields1["NAME"]?>">
                            </span>
                            <p class="rg flex__1"><?=$arFields1["NAME"]?></p>
                            <div class="basket__open--price"><?=$v["SUM"]?></div>
                        </a>
                    <?}?>
                <?}?>
            </li>
        <?endforeach?>
    <?endforeach?>
</ul>
<div class="basket-open__all main_flex flex__align-items_center flex__jcontent_between">
    <div class="bd tov"><?=$arResult['NUM_PRODUCTS'].' '.$arResult['PRODUCT(S)']?></div>
    <div class="bd rub"><?=$arResult['TOTAL_PRICE']?></div>
</div>
<a href="/personal/cart/" class="order bd">Оформить заказ</a>
<script>
    BX.ready(function(){
        <?=$cartId?>.fixCart();
    });
</script>
<?
}else{
    ?><div class="bx-sbb-empty-cart-text">Ваша корзина пуста</div><?
}