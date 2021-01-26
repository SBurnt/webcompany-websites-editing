<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/script.js");
Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/style.css");
CJSCore::Init(array('clipboard', 'fx'));

Loc::loadMessages(__FILE__);

if (!empty($arResult['ERRORS']['FATAL']))
{
	foreach($arResult['ERRORS']['FATAL'] as $error)
	{
		ShowError($error);
	}
	$component = $this->__component;
	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}

}
else
{
    ?><div class="shop orders-history">
        <h2 class="shop__title rg">Мои заказы</h2>
    <?
	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
	if (!count($arResult['ORDERS']))
	{
		if ($_REQUEST["filter_history"] == 'Y')
		{
			if ($_REQUEST["show_canceled"] == 'Y')
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_CANCELED_ORDER')?></h3>
				<?
			}
			else
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_HISTORY_ORDER_LIST')?></h3>
				<?
			}
		}
		else
		{
			?>
			<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST')?></h3>
			<?
		}
	}
	if (!count($arResult['ORDERS']))
	{
		?>
		<div class="row col-md-12 col-sm-12">
			<a href="<?=htmlspecialcharsbx($arParams['PATH_TO_CATALOG'])?>" class="sale-order-history-link">
				<?=Loc::getMessage('SPOL_TPL_LINK_TO_CATALOG')?>
			</a>
		</div>
		<?
	}

	if ($_REQUEST["filter_history"] !== 'Y')
	{
		$paymentChangeData = array();
		$orderHeaderStatus = null;
//        pr($arResult['ORDERS']);
//        $arOrder = CSaleOrder::GetByID($arResult['ORDERS'][0]['ORDER']['ID']);

		foreach ($arResult['ORDERS'] as $key => $order)
		{?>
            <div class="order">
                <div class="order__block main_flex__nowrap flex__align-items_center flex__jcontent_between">
                    <div id="order__id"><?=$order['ORDER']['ACCOUNT_NUMBER']?></div>
                    <p class="rg"><?=$order['ORDER']['DATE_INSERT_FORMATED']?></p>
                    <div class="arrow"></div>
                </div>
                <div class="order__table">
                    <table>
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Описание</th>
                            <th>Количество</th>
                            <th>Стоимость</th>
                            <th></th>
                        </tr>
                        </thead>
                        <? $i=1;
                        foreach ($order['BASKET_ITEMS'] as $BASKET_ITEMS) {
//                            pr($BASKET_ITEMS);
                            ?>
                            <tbody>
                            <?if($BASKET_ITEMS['KOM']){?>
                                <tr>
                                    <td></td>
                                    <td colspan="4">
                                        <p class="rg" style="margin: 40px 0 0 0;">Комплект:</p>
                                    </td>
                                </tr>
                            <?}?>
                            <tr>
                                <td class="nmb"><?=$i?></td>
                                <td>
                                    <div class="div main_flex flex__align-items_center">
                                        <img width="56px" src="<? if(CFile::GetPath($BASKET_ITEMS["PREVIEW_PICTURE"])) {echo CFile::GetPath($BASKET_ITEMS["PREVIEW_PICTURE"]);} else{echo SITE_TEMPLATE_PATH?>/img/no_photo.png<?}?>" alt="img">
                                        <a href="<?=$BASKET_ITEMS['DETAIL_PAGE_URL']?>" class="bd"><?=$BASKET_ITEMS['NAME']?></a>
                                    </div>
                                    <?if($BASKET_ITEMS['KOM']){
                                        $arSelect1 = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_PICTURE", "DETAIL_PAGE_URL");
                                        foreach ($BASKET_ITEMS['PROPS_CART']['KIT_ITEMS']['VALUE'] as $KOM){
                                            $arFilter1 = Array("IBLOCK_ID"=>2, 'ID' => $KOM, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
                                            $res3 = CIBlockElement::GetList(Array(), $arFilter1, false, false, $arSelect1);
                                            while($ob3 = $res3->GetNextElement())
                                            {
                                                $arFields3[] = $ob3->GetFields();
                                            }
                                        }
                                        foreach ($BASKET_ITEMS['PROPS_CART']['PRODUCT_GIFT']['VALUE'] as $KOM1){
                                            $arFilter1 = Array("IBLOCK_ID"=>2, 'ID' => $KOM1, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
                                            $res2 = CIBlockElement::GetList(Array(), $arFilter1, false, false, $arSelect1);
                                            while($ob2 = $res2->GetNextElement())
                                            {
                                                $arFields2[] = $ob2->GetFields();
                                            }
                                        }
                                        $arFilter1 = Array("IBLOCK_ID"=>2, 'ID' => $BASKET_ITEMS['PROPS_CART']['PODAROK']['VALUE'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
                                        $res1 = CIBlockElement::GetList(Array(), $arFilter1, false, false, $arSelect1);
                                        while($ob1 = $res1->GetNextElement())
                                        {
                                            $arFields1 = $ob1->GetFields();
                                        }
//                                        pr($arFields3);
                                        if($BASKET_ITEMS['PROPS_CART']['DISCOUNT_KIT_ACTIV']['VALUE'] == 'Y'){
                                            foreach ($arFields3 as $KITS){?>
                                                <div class="div main_flex flex__align-items_center">
                                                    <img width="56px" src="<? if(CFile::GetPath($KITS["PREVIEW_PICTURE"])) {echo CFile::GetPath($KITS["PREVIEW_PICTURE"]);} else{echo SITE_TEMPLATE_PATH?>/img/no_photo.png<?}?>" alt="img">
                                                    <a href="<?='/'.$KITS['IBLOCK_TYPE_ID'].'/'.$KITS['DETAIL_PAGE_URL']?>" class="bd"><?=$KITS['NAME']?></a>
                                                </div>
                                            <?}
                                        }
                                        if($BASKET_ITEMS['PROPS_CART']['DISCOUNT_KIT_ACTIV']['VALUE'] != 'Y' && $BASKET_ITEMS['PROPS_CART']['GIFT_SET_ACTIV']['VALUE'] == 'Y'){
                                            foreach ($arFields2 as $GIFT){?>
                                                <div class="div main_flex flex__align-items_center">
                                                    <img width="56px" src="<? if(CFile::GetPath($GIFT["PREVIEW_PICTURE"])) {echo CFile::GetPath($GIFT["PREVIEW_PICTURE"]);} else{echo SITE_TEMPLATE_PATH?>/img/no_photo.png<?}?>" alt="img">
                                                    <a href="<?='/'.$GIFT['IBLOCK_TYPE_ID'].'/'.$GIFT['DETAIL_PAGE_URL']?>" class="bd"><?=$GIFT['NAME']?></a>
                                                </div>
                                            <?}?>
                                            <div class="div main_flex flex__align-items_center">
                                                <img width="56px" src="<? if(CFile::GetPath($arFields1["PREVIEW_PICTURE"])) {echo CFile::GetPath($arFields1["PREVIEW_PICTURE"]);} else{echo SITE_TEMPLATE_PATH?>/img/no_photo.png<?}?>" alt="img">
                                                <a href="<?='/'.$arFields1['IBLOCK_TYPE_ID'].'/'.$arFields1['DETAIL_PAGE_URL']?>" class="bd"><?=$arFields1['NAME']?></a>
                                            </div>
                                        <?}?>
                                    <?}?>
                                </td>
                                <td><?=$BASKET_ITEMS['QUANTITY']?> шт.</td>
                                <td><?=round($BASKET_ITEMS['PRICE'],2)?> руб.</td>
                                </td>
                            </tr>
                            </tbody>
                        <?$i++;
                        }?>


<!--                        <tr>-->
<!--                            <td class="nmb">3</td>-->
<!--                            <td rowspan="2">-->
<!--                                <div class="div main_flex flex__align-items_center">-->
<!--                                    <img src="./public/img/img-table.png" alt="img">-->
<!--                                    <p class="bd">Автомобильный коврик  в салон AUDI Q7</p>-->
<!--                                </div>-->
<!--                                <div class="div main_flex flex__align-items_center">-->
<!--                                    <img src="./public/img/img-table.png" alt="img">-->
<!--                                    <p class="bd">Автомобильный коврик в багажник AUDI Q7</p>-->
<!--                                </div>-->
<!--                            </td>-->
<!--                            <td>1 шт.</td>-->
<!--                            <td>151,62 руб.</td>-->
<!--                            </td>-->
<!--                        </tr>-->

                    </table>

                    <div class="order__info main_flex flex__align-items_center">
                        <div class="order__ship">
                            <ul>
                                <li class="main_flex flex__align-items_center">
                                    <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icon/maps-and-flags.svg" width="16">
                                    <? foreach ($order['ORDER']['PROPS'] as $PROPS) {
                                        if($PROPS['ORDER_PROPS_ID']== 13 || $PROPS['ORDER_PROPS_ID']== 4){?>
                                             <p class="rg"><?=$PROPS['VALUE']?></p>
                                        <?}?>
                                    <?}?>
                                </li>
                                <li class="main_flex flex__align-items_center">
                                    <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icon/user.svg" width="16">
                                    <? foreach ($order['ORDER']['PROPS'] as $PROPS) {
                                        if($PROPS['ORDER_PROPS_ID']== 10 || $PROPS['ORDER_PROPS_ID']== 1){?>
                                            <p class="rg"><?=$PROPS['VALUE']?></p>
                                        <?}?>
                                    <?}?>
                                </li>
                                <li class="main_flex flex__align-items_center">
                                    <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icon/phone-call.svg" width="16">
                                    <? foreach ($order['ORDER']['PROPS'] as $PROPS) {
                                        if($PROPS['ORDER_PROPS_ID']== 12 || $PROPS['ORDER_PROPS_ID']== 3){?>
                                            <p class="rg"><?=$PROPS['VALUE']?></p>
                                        <?}?>
                                    <?}?>
                                </li>
                                <li class="main_flex flex__align-items_center">
                                    <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icon/credit-cards-payment.svg" width="16">
                                    <p class="rg"><?=$order['PAYMENT'][0]['PAY_SYSTEM_NAME']?></p>
                                </li>
                                <li class="main_flex flex__align-items_center">
                                    <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icon/lorry.svg" width="16">
                                    <p class="rg"><?=$order['SHIPMENT'][0]['DELIVERY_NAME']?></p>
                                </li>
                            </ul>
                        </div>

                        <div class="order__total">
                            <div class="total main_flex flex__align-items_center">
                                <p class="rg wd">Заказ</p>
                                <p class="rg"><?=round($order['ORDER']['PRICE']-$order['ORDER']['PRICE_DELIVERY'],2)?> руб.</p>
                            </div>
                            <div class="total main_flex flex__align-items_center">
                                <p class="rg wd">Доставка</p>
                                <p class="rg"><?=$order['SHIPMENT'][0]['FORMATED_DELIVERY_PRICE']?></p>
                            </div>
                            <div class="bd money">ИТОГО<span class="bd"><?=$order['ORDER']['FORMATED_PRICE']?></span></div>
                        </div>
                    </div>
                </div>
            </div>
			<?
		}
	}
	else
	{
		$orderHeaderStatus = null;

		if ($_REQUEST["show_canceled"] === 'Y' && count($arResult['ORDERS']))
		{
			?>
			<h1 class="sale-order-title">
				<?= Loc::getMessage('SPOL_TPL_ORDERS_CANCELED_HEADER') ?>
			</h1>
			<?
		}

		foreach ($arResult['ORDERS'] as $key => $order)
		{
			if ($orderHeaderStatus !== $order['ORDER']['STATUS_ID'] && $_REQUEST["show_canceled"] !== 'Y')
			{
				$orderHeaderStatus = $order['ORDER']['STATUS_ID'];
				?>
				<h1 class="sale-order-title">
					<?= Loc::getMessage('SPOL_TPL_ORDER_IN_STATUSES') ?> &laquo;<?=htmlspecialcharsbx($arResult['INFO']['STATUS'][$orderHeaderStatus]['NAME'])?>&raquo;
				</h1>
				<?
			}
			?>
			<div class="col-md-12 col-sm-12 sale-order-list-container">
				<div class="row">
					<div class="col-md-12 col-sm-12 sale-order-list-accomplished-title-container">
						<div class="row">
							<div class="col-md-8 col-sm-12 sale-order-list-accomplished-title-container">
								<h2 class="sale-order-list-accomplished-title">
									<?= Loc::getMessage('SPOL_TPL_ORDER') ?>
									<?= Loc::getMessage('SPOL_TPL_NUMBER_SIGN') ?>
									<?= htmlspecialcharsbx($order['ORDER']['ACCOUNT_NUMBER'])?>
									<?= Loc::getMessage('SPOL_TPL_FROM_DATE') ?>
									<?= $order['ORDER']['DATE_INSERT'] ?>,
									<?= count($order['BASKET_ITEMS']); ?>
									<?
									$count = substr(count($order['BASKET_ITEMS']), -1);
									if ($count == '1')
									{
										echo Loc::getMessage('SPOL_TPL_GOOD');
									}
									elseif ($count >= '2' || $count <= '4')
									{
										echo Loc::getMessage('SPOL_TPL_TWO_GOODS');
									}
									else
									{
										echo Loc::getMessage('SPOL_TPL_GOODS');
									}
									?>
									<?= Loc::getMessage('SPOL_TPL_SUMOF') ?>
									<?= $order['ORDER']['FORMATED_PRICE'] ?>
								</h2>
							</div>
							<div class="col-md-4 col-sm-12 sale-order-list-accomplished-date-container">
								<?
								if ($_REQUEST["show_canceled"] !== 'Y')
								{
									?>
									<span class="sale-order-list-accomplished-date">
										<?= Loc::getMessage('SPOL_TPL_ORDER_FINISHED')?>
									</span>
									<?
								}
								else
								{
									?>
									<span class="sale-order-list-accomplished-date canceled-order">
										<?= Loc::getMessage('SPOL_TPL_ORDER_CANCELED')?>
									</span>
									<?
								}
								?>
								<span class="sale-order-list-accomplished-date-number"><?= $order['ORDER']['DATE_STATUS_FORMATED'] ?></span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 sale-order-list-inner-accomplished">
						<div class="row sale-order-list-inner-row">
							<div class="col-md-3 col-sm-12 sale-order-list-about-accomplished">
								<a class="sale-order-list-about-link" href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_DETAIL"])?>">
									<?=Loc::getMessage('SPOL_TPL_MORE_ON_ORDER')?>
								</a>
							</div>
							<div class="col-md-3 col-md-offset-6 col-sm-12 sale-order-list-repeat-accomplished">
								<a class="sale-order-list-repeat-link sale-order-link-accomplished" href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_COPY"])?>">
									<?=Loc::getMessage('SPOL_TPL_REPEAT_ORDER')?>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?
		}
	}
	?>
	<div class="clearfix"></div>
	<?
	echo $arResult["NAV_STRING"];

	if ($_REQUEST["filter_history"] !== 'Y')
	{
		$javascriptParams = array(
			"url" => CUtil::JSEscape($this->__component->GetPath().'/ajax.php'),
			"templateFolder" => CUtil::JSEscape($templateFolder),
			"templateName" => $this->__component->GetTemplateName(),
			"paymentList" => $paymentChangeData
		);
		$javascriptParams = CUtil::PhpToJSObject($javascriptParams);
		?>
		<script>
			BX.Sale.PersonalOrderComponent.PersonalOrderList.init(<?=$javascriptParams?>);
		</script>
		<?
	}
    ?>
    </div>
<?}
?>
<script>
    $('.order__block').click(function(e) {
        $('.order__block').not($(this)).find('.arrow').removeClass('active');
        $('.order__block').not($(this)).next('.order__table').slideUp();
        $(this).find('.arrow').toggleClass('active');
        $(this).next('.order__table').slideToggle();
    });
</script>