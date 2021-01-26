<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var $APPLICATION CMain
 */


if ($arParams["SET_TITLE"] == "Y")
{
    $APPLICATION->SetTitle(Loc::getMessage("SOA_ORDER_COMPLETE"));
}
$arOrder = CSaleOrder::GetByID($arResult["ORDER_ID"]);
//pr($arOrder);
//pr($arResult);
?>

<? if (!empty($arOrder)): ?>
    <h2 class="shop__title category rg">Заказ сформирован</h2>
    <div class="thanks-block">
        <img src="<?=SITE_TEMPLATE_PATH?>/img/pictures/thx.png" alt="">
        <p><?
            $date = new \DateTime($arOrder["DATE_INSERT"]);
            ?>
            <?=Loc::getMessage("SOA_ORDER_SUC", array(
//                "#ORDER_DATE#" => $arOrder["DATE_INSERT"]->toUserTime()->format('d.m.Y H:i'),
                "#ORDER_DATE#" => $date->format('d.m.Y H:i'),
                "#ORDER_ID#" => $arOrder["ACCOUNT_NUMBER"]
            ))?>
        </p>
        <p>
            <? if (!empty($arResult['ORDER']["PAYMENT_ID"])): ?>
                <?=Loc::getMessage("SOA_PAYMENT_SUC", array(
                    "#PAYMENT_ID#" => $arResult['PAYMENT'][$arResult['ORDER']["PAYMENT_ID"]]['ACCOUNT_NUMBER']
                ))?>
            <? endif ?>
        </p>
        <?if($USER->IsAuthorized()){?>
            <p class="description">
                Вы можете следить за выполнением своего заказа в <a href="/personal/history/">Персональном разделе сайта</a>. Обратите
                внимение, что для входа в этот раздел вам необходимо будет ввести логин и пароль пользователя
                сайта.
            </p>
        <?}?>
    </div>
<? else: ?>
    <b><?=Loc::getMessage("SOA_ERROR_ORDER")?></b>
    <br /><br />

    <table class="sale_order_full_table">
        <tr>
            <td>
                <?=Loc::getMessage("SOA_ERROR_ORDER_LOST", ["#ORDER_ID#" => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"])])?>
                <?=Loc::getMessage("SOA_ERROR_ORDER_LOST1")?>
            </td>
        </tr>
    </table>
<? endif ?>