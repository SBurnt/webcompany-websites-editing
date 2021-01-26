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
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):
    if($arUserField["EDIT_FORM_LABEL"] == "UF_TYPE"):?>
        <?$APPLICATION->IncludeComponent(
            "bitrix:system.field.edit",
            $arUserField["USER_TYPE"]["USER_TYPE_ID"],
            array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));?>
    <?endif;
endforeach;?>
<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):
if($arUserField["EDIT_FORM_LABEL"] != "UF_TYPE"):?>
<label>
    <p><?=$arUserField["EDIT_FORM_LABEL"]?> <?if ($arUserField["MANDATORY"]=="Y"):?><span>*</span><?endif;?></p>
    <?$APPLICATION->IncludeComponent(
        "bitrix:system.field.edit",
        'string1',
        array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));?>
    <?endif;
    endforeach;?>
    <?foreach ($arResult["SHOW_FIELDS"] as $FIELD):
    ?>

    <?if($FIELD == "EMAIL" || $FIELD == "PERSONAL_PHONE"){?>
        <label <?if($FIELD == 'LOGIN') echo 'style="display: none;"';?>>
            <p><?=GetMessage("REGISTER_FIELD_".$FIELD)?>:<?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span>*</span><?endif?></p>
            <input size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" class="form-element"/>
        </label>
    <?}?>
    <?switch ($FIELD)
    {
    case "PASSWORD":?>
        <label>
            <p><?=GetMessage("REGISTER_FIELD_".$FIELD)?> <?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span>*</span><?endif?></p>
            <input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="form-element" />
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
        <?break;
    case "CONFIRM_PASSWORD":?>
        <label>
            <p><?=GetMessage("REGISTER_FIELD_".$FIELD)?> <?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span>*</span><?endif?></p>
            <input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="form-element"/>
        </label>
        <?break;
    default:
    if ($FIELD == 'LOGIN'){?>
    <input size="30" style="display: none;" type="text" name="REGISTER[<?=$FIELD?>]" value="<?= uniqid('user_'); ?>" class="form-element"/>
</label>
<?}
}?>

<?endforeach?>

<input class="web-main-btn" type="submit" name="register_submit_button" value="<?=GetMessage("AUTH_ZAREGISTER")?>" />