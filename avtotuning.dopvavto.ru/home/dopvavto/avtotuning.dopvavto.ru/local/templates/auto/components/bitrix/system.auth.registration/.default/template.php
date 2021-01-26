<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}
?>
<div class="bx-auth">
<?
ShowMessage($arParams["~AUTH_RESULT"]);
?>
<?if($arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>
	<p><?echo GetMessage("AUTH_EMAIL_SENT")?></p>
<?endif;?>

<?if(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"] && $arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
	<p><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></p>
<?endif?>
<?if($arResult["SHOW_SMS_FIELD"] == true):?>

<!--<form method="post" action="--><?//=$arResult["AUTH_URL"]?><!--" name="regform">-->
<!--<input type="hidden" name="SIGNED_DATA" value="--><?//=htmlspecialcharsbx($arResult["SIGNED_DATA"])?><!--" />-->
<!--<table class="data-table bx-registration-table">-->
<!--	<tbody>-->
<!--		<tr>-->
<!--			<td><span class="starrequired">*</span>--><?//echo GetMessage("main_register_sms_code")?><!--</td>-->
<!--			<td><input size="30" type="text" name="SMS_CODE" value="--><?//=htmlspecialcharsbx($arResult["SMS_CODE"])?><!--" autocomplete="off" /></td>-->
<!--		</tr>-->
<!--	</tbody>-->
<!--	<tfoot>-->
<!--		<tr>-->
<!--			<td></td>-->
<!--			<td><input type="submit" name="code_submit_button" value="--><?//echo GetMessage("main_register_sms_send")?><!--" /></td>-->
<!--		</tr>-->
<!--	</tfoot>-->
<!--</table>-->
<!--</form>-->

<script>
new BX.PhoneAuth({
	containerId: 'bx_register_resend',
	errorContainerId: 'bx_register_error',
	interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
	data:
		<?=CUtil::PhpToJSObject([
			'signedData' => $arResult["SIGNED_DATA"],
		])?>,
	onError:
		function(response)
		{
			var errorDiv = BX('bx_register_error');
			var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
			errorNode.innerHTML = '';
			for(var i = 0; i < response.errors.length; i++)
			{
				errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
			}
			errorDiv.style.display = '';
		}
});
</script>

<div id="bx_register_error" style="display:none"><?ShowError("error")?></div>

<div id="bx_register_resend"></div>

<?elseif(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>
    <div id="content" class="registration-content web-content">
        <div class="wrapper">
            <div class="content clearfix">

                <div class="flex__block content__op">
                    <? include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/inc/profile_left-sidebar.php';?>

                </div>

                <div class="right-col rad">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:breadcrumb",
                        "template_bread",
                        Array(
                            "PATH" => "",
                            "SITE_ID" => "s1",
                            "START_FROM" => "0"
                        )
                    );?>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "template_left_menu_mob",
                        Array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "left",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(""),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "left",
                            "USE_EXT" => "N"
                        )
                    );?>


                    <h2 class="shop__title category rg"><?=GetMessage("AUTH_REGISTER")?></h2>
                    <div class="registration-block">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/pictures/checkform.png" alt="">
                        <p>
                            Зарегистрируйтесь, чтобы использовать все возможности личного кабинета: отслеживание заказов, настройку подписки, связи с социальными сетями и другое.
                        </p>
                        <p>
                            Уже зарегистрирована? <a href="javascript:void(0);" class="btn-login">Войдите</a> в личный кабинет.
                        </p>
                        <p>
                            Мы никогда и ни при каких условиях не разглашаем личные данные клиентов. Контактная информация будет использована только для оформления заказов и более удобной работы с сайтом.
                        </p>
                    </div>

                    <form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform" enctype="multipart/form-data">
                        <input type="hidden" name="AUTH_FORM" value="Y" />
                        <input type="hidden" name="TYPE" value="REGISTRATION" />
                        <div class="checkout-block checkout-flex">
                            <div class="checkout-buttons">
                                <label class="checkcontainer ways-nav physical-nav">Физическое лицо
                                    <input type="radio" name="type">
                                    <span class="radiobtn"></span>
                                </label>
                                <label class="checkcontainer ways-nav juridical-nav">Юридическое лицо
                                    <input type="radio" name="type">
                                    <span class="radiobtn"></span>
                                </label>
                            </div>
                        </div>
                        <div class="checkout-block ways-block">
                            <div class="checkout-buttons physical">
                                <label class="customer-element">
                                    <p><?=GetMessage("AUTH_NAME")?> <span>*</span></p>
                                    <input type="text" name="USER_NAME" maxlength="50" value="<?=$arResult["USER_NAME"]?>" class="form-element" />
                                </label>
                                <?if($arResult["EMAIL_REGISTRATION"]):?>
                                    <label class="customer-element">
                                        <p><?=GetMessage("AUTH_EMAIL")?> <?if($arResult["EMAIL_REQUIRED"]):?><span>*</span><?endif?></p>
                                        <input type="text" name="USER_EMAIL" maxlength="255" value="<?=$arResult["USER_EMAIL"]?>" class="form-element" />
                                    </label>
                                <?endif?>
                                <label class="customer-element">
                                    <p>
                                        Телефон <span>*</span>
                                    </p>
                                    <input type="text" class="form-element">
                                </label>
                                <label>
                                    <p><?=GetMessage("AUTH_PASSWORD_REQ")?> <span>*</span></p>
                                    <input type="password" name="USER_PASSWORD" maxlength="255" value="<?=$arResult["USER_PASSWORD"]?>" class="form-element" autocomplete="off" />
                                    <?if($arResult["SECURE_AUTH"]):?>
                                        <span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
                                            <div class="bx-auth-secure-icon"></div>
                                        </span>
                                        <noscript>
                                            <span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
                                                <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                                            </span>
                                        </noscript>
                                        <script type="text/javascript">
                                            document.getElementById('bx_auth_secure').style.display = 'inline-block';
                                        </script>
                                    <?endif?>
                                </label>
                                <label>
                                        <p><?=GetMessage("AUTH_CONFIRM")?> <span>*</span></p>
                                        <input type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="form-element" autocomplete="off" />
                                </label>
                                <?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
                                    <?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?>
                                    <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
                                        <?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;
                                                ?><?=$arUserField["EDIT_FORM_LABEL"]?>:
                                                <?$APPLICATION->IncludeComponent(
                                                    "bitrix:system.field.edit",
                                                    $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                                                    array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "bform"), null, array("HIDE_ICONS"=>"Y"));?>
                                    <?endforeach;?>
                                <?endif;?>
                                <input class="web-main-btn" type="submit" name="Register" value="<?=GetMessage("AUTH_REGISTER_BUTTON")?>" />
                            </div>
                            <div class="checkout-buttons juridical">
                                <label class="customer-element">
                                    <p><?=GetMessage("UR_NAME")?> <span>*</span></p>
                                    <input type="text" name="UR_NAME" maxlength="50" value="<?=$arResult["UR_NAME"]?>" class="form-element" />
                                </label>
                                <label class="customer-element">
                                    <p><?=GetMessage("UR_ADRESS")?> <span>*</span></p>
                                    <input type="text" name="UR_ADRESS" maxlength="50" value="<?=$arResult["UR_ADRESS"]?>" class="form-element" />
                                </label>
                                <label class="customer-element">
                                    <p><?=GetMessage("UR_UNP")?> <span>*</span></p>
                                    <input type="text" name="UR_UNP" maxlength="50" value="<?=$arResult["UR_UNP"]?>" class="form-element" />
                                </label>
                                <label class="customer-element">
                                    <p><?=GetMessage("UR_CONTACTS")?> <span>*</span></p>
                                    <input type="text" name="UR_CONTACTS" maxlength="50" value="<?=$arResult["UR_CONTACTS"]?>" class="form-element" />
                                </label>
                                <?if($arResult["EMAIL_REGISTRATION"]):?>
                                    <label class="customer-element">
                                        <p><?=GetMessage("AUTH_EMAIL")?> <?if($arResult["EMAIL_REQUIRED"]):?><span>*</span><?endif?></p>
                                        <input type="text" name="UR_EMAIL" maxlength="255" value="<?=$arResult["UR_EMAIL"]?>" class="form-element" />
                                    </label>
                                <?endif?>
                                <label class="customer-element">
                                    <p>
                                        Телефон <span>*</span>
                                    </p>
                                    <input type="text" class="form-element">
                                </label>
                                <label>
                                    <p><?=GetMessage("AUTH_PASSWORD_REQ")?> <span>*</span></p>
                                    <input type="password" name="UR_PASSWORD" maxlength="255" value="<?=$arResult["UR_PASSWORD"]?>" class="form-element" autocomplete="off" />
                                    <?if($arResult["SECURE_AUTH"]):?>
                                        <span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
                                            <div class="bx-auth-secure-icon"></div>
                                        </span>
                                        <noscript>
                                            <span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
                                                <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                                            </span>
                                        </noscript>
                                        <script type="text/javascript">
                                            document.getElementById('bx_auth_secure').style.display = 'inline-block';
                                        </script>
                                    <?endif?>
                                </label>
                                <label>
                                    <p><?=GetMessage("AUTH_CONFIRM")?> <span>*</span></p>
                                    <input type="password" name="UR_CONFIRM_PASSWORD" maxlength="255" value="<?=$arResult["UR_CONFIRM_PASSWORD"]?>" class="form-element" autocomplete="off" />
                                </label>
                                <input class="web-main-btn" type="submit" name="Register" value="<?=GetMessage("AUTH_REGISTER_BUTTON")?>" />
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
document.bform.USER_NAME.focus();
</script>

<?endif?>

</noindex>
</div>